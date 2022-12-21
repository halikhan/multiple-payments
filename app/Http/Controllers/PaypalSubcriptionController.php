<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Paypalpayment;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalSubcriptionController extends Controller
{
    public function index()
    {
        $getCMS = Paypalpayment::where('user_id', Auth::id())->with('PackageDetails')->get();
        return view('paypal.Package.subscriptions', get_defined_vars());
    }
    public function paypal($id)
    {
        session()->put('package_id', $id);
        $getPackage = Package::find($id);
        return view('paypal.Package.paypal', get_defined_vars());
    }

    public function store_payment(Request $request)
    {

        $get_package = Package::find(session()->get('package_id'));
        Paypalpayment::create([
            'user_id' => Auth::user()->id,
            'package_id' => $get_package->id,
            'name' =>  Auth::user()->name,
            'package_amount' => $get_package->amount,
            'package_response' => json_encode($request->all()),
            'orderID' => $request->orderID,
            'subscriptionID' => $request->subscriptionID,
        ]);

        session()->forget('package_id');
        return response()->json([
            'status' => 200
        ]);
    }

    public function updatepaypal(Request $request, $id)
    {
        $oldgetPackage = Package::find($id);
        session()->put('oldpackage_id', $oldgetPackage->id);
        $getCMS = Package::all();
        return view('paypal.Package.updateplan', get_defined_vars());
    }
    public function updatepaypalamount($id)
    {
        $getPackage = Package::find($id);
        session()->put('updatepackage_id', $getPackage->id);
        return view('paypal.Package.updatepaypal', get_defined_vars());
    }
    public function updatepaypal_payment(Request $request)
    {
        $updatepackage = Session()->get('updatepackage_id');
        $oldgetPackage = Session()->get('oldpackage_id');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $packageSubs = Paypalpayment::where('package_id', $oldgetPackage)->where('user_id', Auth::id())->first();
        if (empty($response)) {
            Paypalpayment::where('subscriptionID', $packageSubs->subscriptionID)
                ->where('user_id', Auth::id())->update(['status' => 3]);
            $response = $provider->cancelSubscription(json_decode($packageSubs->package_response)->subscriptionID, 'cancel Subscription');
        }
        $get_package = Package::find($updatepackage);
        Paypalpayment::create([
            'user_id' => Auth::id(),
            'package_id' => $get_package->id,
            'name' => Auth::user()->name,
            'package_amount' => $get_package->amount,
            'package_response' => json_encode($request->all()),
            'orderID' => $request->orderID,
            'subscriptionID' => $request->subscriptionID,
        ]);
        session()->forget('package_id');
        return response()->json([
            'status' => 200
        ]);
    }
    public function paypalshowpayment(Request $request, $package_id)
    {

        $packageSubs = Paypalpayment::where('package_id', $package_id)->orderBy('id', 'desc')->first();
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $show_subscriptionresponse = $provider->showSubscriptionDetails($transactionid);
        return view('paypal.Package.show_subscriptions', get_defined_vars());

    }

    public function cancelpaypalrepayment($package_id)
    {
        $packageSubs = Paypalpayment::where('package_id', $package_id)->orderBy('id', 'desc')->first();
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;
        $amount = $packageSubs->package_amount;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->cancelSubscription($transactionid, 'Not satisfied with the service');
        $object = Paypalpayment::where('subscriptionID', $transactionid)->first();
        $object->status = 2;
        $object->save();
        $notification = array('message' => 'Your Subscription Canceled Successfully ', 'alert-type' => 'success');
        return redirect()->route('subcription.index')->with($notification);

    }

    public function Suspendpaypalrepayment($package_id)
    {
        $packageSubs = Paypalpayment::where('package_id', $package_id)->orderBy('id', 'desc')->first();
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->suspendSubscription($transactionid, 'Not satisfied with the service');
        $object = Paypalpayment::where('subscriptionID', $transactionid)->first();
        $object->status = 1;
        $object->save();
        $notification = array('message' => 'Your Subscription Suspended Successfully.!', 'alert-type' => 'success');
        return redirect()->route('subcription.index')->with($notification);

    }
    public function reactivepaypalrepayment($package_id)
    {
        $packageSubs = Paypalpayment::where('package_id', $package_id)->orderBy('id', 'desc')->first();
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->activateSubscription($transactionid, 'Not satisfied with the service');
        $object = Paypalpayment::where('subscriptionID', $transactionid)->first();
        $object->status = 0;
        $object->save();
        $notification = array('message' => 'Your Subscription Re-Activated Successfully.!', 'alert-type' => 'success');
        return redirect()->route('subcription.index')->with($notification);

    }
}
