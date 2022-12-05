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
        // dd('Your payment');
        $getCMS = Paypalpayment::where('user_id', Auth::id())->with('PackageDetails')->get();
        return view('paypal.Package.subscriptions', get_defined_vars());
    }
    public function paypal($id)
    {
        // dd($id);
        session()->put('package_id', $id);
         $getPackage = Package::find($id);
        return view('paypal.Package.paypal', get_defined_vars());
    }

    public function store_payment(Request $request)
    {

        // dd($request->orderID);
        // dd($request->all());
        // return $request->all();
        // return $packageSubs->package_response;subscriptionID
        //         return json_decode($packageSubs->package_response)->orderID;
        $get_package = Package::find(session()->get('package_id'));
        // $transactionid = json_decode($request->subscriptionID);

        Paypalpayment::create([
            // 'response'=> $request->response,
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

        $getPackage = Package::find($id);
        return view('Package.updatepaypal', get_defined_vars());
    }
    public function updatepaypal_payment(Request $request)
    {

        $package_id = Session()->get('package_id');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $packageSubs = Paypalpayment::where('package_id', $package_id)->orderBy('id', 'desc')->first();

        if (empty($response)) {
            $response = $provider->cancelSubscription(json_decode($packageSubs->package_response)->subscriptionID, 'cancel Subscription');
        }
        $get_package = Package::find($package_id);
        Paypalpayment::create([
            'user_id' => Auth::id(),
            'package_id' => $get_package->id,
            'name' => Auth::user()->name,
            'package_amount' => $get_package->amount,
            'package_response' => json_encode($request->all()),
            'status' => 1
        ]);

        return response()->json([
            'status' => 200
        ]);
    }
    public function paypalshowpayment(Request $request, $package_id)
    {

        $packageSubs = Paypalpayment::where('package_id', $package_id)->orderBy('id', 'desc')->first();
        //   $transactionid = json_decode($packageSubs->package_response)->orderID;
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;
        // $transactionid = json_decode($packageSubs->package_response);
        // return $transactionid;
        // $amount = $packageSubs->package_amount;
        // To issue partial refund, you must provide the amount as well for refund:
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        // return   $response = $provider->listSubscriptionTransactions($transactionid);
          $show_subscriptionresponse = $provider->showSubscriptionDetails($transactionid);
        // return $show_subscriptionresponse['id'];
        return view('paypal.Package.show_subscriptions', get_defined_vars());

        // return jaso($response);
        // return response()->json([
        //     $show_subscriptionresponse,
        // ]);
    }
    public function cancelpaypalrepayment($package_id)
    {


        $packageSubs = Paypalpayment::where('package_id', $package_id)->orderBy('id', 'desc')->first();
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;
        // return $transactionid;
        $amount = $packageSubs->package_amount;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->cancelSubscription($transactionid, 'Not satisfied with the service');

        $object = Paypalpayment::where('subscriptionID',$transactionid)->first();
        $object->status = 1;
        $object->save();
        $notification = array('message' => 'Your Subscription Canceled Successfully ', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);
        return redirect()->route('subcription.index')->with($notification);

        // return response()->json([
        //     'status' => 200,
        //     $response
        // ]);
    }
    public function reactivepaypalrepayment($package_id)
    {


        $packageSubs = Paypalpayment::where('package_id', $package_id)->orderBy('id', 'desc')->first();
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;
        // return $transactionid;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->activateSubscription($transactionid, 'Not satisfied with the service');

        $object = Paypalpayment::where('subscriptionID',$transactionid)->first();
        $object->status = 0;
        $object->save();
        $notification = array('message' => 'Your Subscription Re-Activated Successfully.!', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);
        // return redirect()->route('subcription.index')->with($notification);

        return response()->json([
            'status' => 200,
            $response
        ]);
    }
}
