<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Package;
use App\Models\planstriple;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        dd('Subscription');
    }


    public function checkout($slug){

        // dd($slug);
        // $subscriptionplan = ModelsPlan::where('plan_id',$getplandetails->plan_id)->first();
        // return view('Package.plan',get_defined_vars());
        $getplandetails = planstriple::where('slug',$slug)->first();
        $plan = $getplandetails->plan_id;
        // dd($plan);
        if(!$getplandetails){
            return back()->withErrors([
                'error' =>'Unable to locate subscription',
            ]);
        }
        $subcriberuser = Auth::user();
        // return $subcriberuser->name;
        return view('Package.subscriptionform', [
            'intent' => $subcriberuser->createSetupIntent(),
        ],get_defined_vars());

        // return view('Package.subscriptionform', [
        //     'getplandetails'=>$getplandetails,
        //     'intent' => $user1->createSetupIntent(),
        //     'plan' => $plan,
        // ],get_defined_vars());

    }
    // stripe.subcription
    public function subcription(Request $request)
    {

            //    return $request->all();
        $subcriberuser = Auth::user();
        $subcriberuser->createOrGetStripeCustomer();

        $paymentMethod = null;
        $paymentMethod = $request->payment_method;
        // dd($subcriberuser);

        if($paymentMethod != null){

            $paymentMethodid =$subcriberuser->addPaymentMethod($paymentMethod);
            // dd($paymentMethod);
        }
        $plan = $request->plan_id;
        try{
            $subcriberuser->newSubscription(
                    'default', $plan
                )->create($paymentMethod != null ? $paymentMethod:'');
        }
        catch(Exception $ex){
            dd($ex->getMessage());
            $notification = array('message' =>$ex->getMessage(), 'alert-type'=>'error' );
            return redirect()->back()->with($notification);
        }

        $request->session()->flash('alert-success', 'You have successfully subscribed!');
        return redirect()->route('show.subscription', $plan)->with('subscribe', 'You have Successfully Subscribed');
        // return redirect()->route('plans.list','testsubcription');

    }
    public function refund_subscription(request $request){

        // dd($request->all());
        $subscriptionName = $request->subscriptionName;

        // if($subscriptionName){
        //     $user = Auth::user();
        //     $payment = $user->charge(3500, $subscriptionName);
        //     $user->refund($payment->id);
        // }
        $stripe = new \Stripe\StripeClient('sk_test_51KhLF7J5CNuTNvMYG43rQ5JIHfysm31ktZxesfAk5QoM7tNKwqjBsZdW7yiGyDHP0pv5xbCRX0oZymO1YzKlPSqa00k0tTHGiP');

        $package_value = $stripe->charges->all();
        $stripe->refunds->create(['charge' => $package_value->data[0]->id, 'amount' => $package_value->data[0]->amount]);

        return response('RefundPayments');
    }

    public function cancel_plan(Request $request)
    {
        dd($request->all());
        $stripe = new \Stripe\StripeClient(
            'sk_test_51KhLF7J5CNuTNvMYG43rQ5JIHfysm31ktZxesfAk5QoM7tNKwqjBsZdW7yiGyDHP0pv5xbCRX0oZymO1YzKlPSqa00k0tTHGiP'
        );
        \Stripe\Stripe::setApiKey('sk_test_51KhLF7J5CNuTNvMYG43rQ5JIHfysm31ktZxesfAk5QoM7tNKwqjBsZdW7yiGyDHP0pv5xbCRX0oZymO1YzKlPSqa00k0tTHGiP');
        $user = User::where('id', Auth::id())->first();
        $user->subscription('default')->cancel();

        return response('response');

    }
}
