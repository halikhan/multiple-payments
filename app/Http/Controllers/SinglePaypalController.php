<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\RefundPayment;
use App\Models\SinglePaypalPayment;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class SinglePaypalController extends Controller
{
    public function index()
    {
        $getCMS = Package::all();
        return view('paypal.singlepayment.plan', get_defined_vars());
    }
    public function singlepaypalbutton($id)
    {
        $getCMS = Package::find($id);
        session()->put('package_id', $getCMS->id);
        return view('paypal.singlepayment.paypalbutton', get_defined_vars());
    }
    public function storeSinglepayment(Request $request)
    {
        $get_package = Package::find(session()->get('package_id'));
        SinglePaypalPayment::create([
            'user_id' => Auth::user()->id,
            'package_id' => $get_package->id,
            'name' =>  Auth::user()->name,
            'package_amount' => $get_package->amount,
            'payment_id' => $request->id,
            'package_response' => json_encode($request->all()),
        ]);
        session()->forget('package_id');
        return response()->json([
            'status' => 200,
            'Success', 'Y0u have paid Successfully!'
        ]);
    }

    public function payments()
    {
        $getCMS = SinglePaypalPayment::where('user_id', Auth::id())->get();
        return view('paypal.singlepayment.show_payments', get_defined_vars());
    }

    public function showSinglepayment(Request $request, $payment_id)
    {

        $packageSubs = SinglePaypalPayment::where('payment_id', $payment_id)->first();
        $transactionid = json_decode($packageSubs->package_response, true)['purchase_units'][0]['payments']['captures'][0]['id'];
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $payment_id = $transactionid;
        $response = $provider->showCapturedPaymentDetails($payment_id);
        return view('paypal.singlepayment.show_details', get_defined_vars());


    }
    public function refundSinglepayment(Request $request, $payment_id)
    {

        $packageSubs = SinglePaypalPayment::where('payment_id', $payment_id)->first();
        $marchantID = json_decode($packageSubs->package_response, true)['purchase_units'][0]['payments']['captures'][0]['id'];
        $userpayment_id = json_decode($packageSubs->package_response, true)['id'];
        if ($userpayment_id) {
            $userpayment_details = RefundPayment::where('payment_id', $userpayment_id)->first();
            if ($userpayment_details) {
                session()->flash('error');
                return back()->with('error', 'This user has already refunded!');
            } else {
                $invoiveNo = $payment_id;
                $provider = new PayPalClient;
                $provider->setApiCredentials(config('paypal'));
                $provider->getAccessToken();
                $payment_id = $marchantID;
                $amount = $packageSubs->package_amount;
                $response = $provider->refundCapturedPayment($payment_id, $invoiveNo, $amount, 'Defective product');
                RefundPayment::create([
                    'status' => 1,
                    'payment_id' => $userpayment_id,
                    'user_id' => Auth::user()->id,
                    'package_response' => json_encode($response),
                ]);
                return back()->withSuccess('User Payment refunded Successfuly!');
            }
        }


    }
    public function showRefundedpaymentdetails(Request $request, $payment_id)
    {
        $packageSubs = RefundPayment::where('payment_id', $payment_id)->first();
        if ($packageSubs) {
            $transactionid = json_decode($packageSubs->package_response, true)['id'];
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $payment_id1 = $transactionid;
            $response = $provider->showRefundDetails($payment_id1);
            return view('paypal.singlepayment.show_refundDetails', get_defined_vars());
        } elseif ($packageSubs == null) {
            session()->flash('error');
            return back()->with('error', 'This user is not refunded yet!');
        }
    }
}
