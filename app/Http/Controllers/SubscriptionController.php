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


        $getplandetails = planstriple::where('slug',$slug)->first();
        $plan = $getplandetails->plan_id;
        if(!$getplandetails){
            return back()->withErrors([
                'error' =>'Unable to locate subscription',
            ]);
        }
        $subcriberuser = Auth::user();
        return view('Package.subscriptionform', [
            'intent' => $subcriberuser->createSetupIntent(),
        ],get_defined_vars());

    }

    public function subcription(Request $request)
    {

        $subcriberuser = Auth::user();
        $subcriberuser->createOrGetStripeCustomer();
        $paymentMethod = null;
        $paymentMethod = $request->payment_method;
        if($paymentMethod != null){
            $subcriberuser->addPaymentMethod($paymentMethod);
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

    }
    public function refund_subscription(request $request){


        $request->subscriptionName;
        $stripe = new \Stripe\StripeClient('sk_test_51KhLF7J5CNuTNvMYG43rQ5JIHfysm31ktZxesfAk5QoM7tNKwqjBsZdW7yiGyDHP0pv5xbCRX0oZymO1YzKlPSqa00k0tTHGiP');
        $package_value = $stripe->charges->all();
        $stripe->refunds->create(['charge' => $package_value->data[0]->id, 'amount' => $package_value->data[0]->amount]);
        return response('RefundPayments');
    }

    public function cancel_plan(Request $request)
    {

      new \Stripe\StripeClient(
            'sk_test_51KhLF7J5CNuTNvMYG43rQ5JIHfysm31ktZxesfAk5QoM7tNKwqjBsZdW7yiGyDHP0pv5xbCRX0oZymO1YzKlPSqa00k0tTHGiP'
        );
        \Stripe\Stripe::setApiKey('sk_test_51KhLF7J5CNuTNvMYG43rQ5JIHfysm31ktZxesfAk5QoM7tNKwqjBsZdW7yiGyDHP0pv5xbCRX0oZymO1YzKlPSqa00k0tTHGiP');
        $user = User::where('id', Auth::id())->first();
        $user->subscription('default')->cancel();
        return response('response');

    }
}
