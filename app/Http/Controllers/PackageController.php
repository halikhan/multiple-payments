<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Stripe;
use App\Models\Package;
use App\Models\planstriple;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;

class PackageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('Package');
        $getCMS = planstriple::all();
        return view('Package.index',get_defined_vars());

    }
    public function showsubscription()
    {
        // dd('Package');
         $getsubscription = Subscription::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        // return $getsubscription = Subscription::where('user_id',Auth::user()->id)->with('plan')->get();
        // $getCMS = planstriple::all();
        return view('Package.showsubscriptions',get_defined_vars());

    }

    public function plans()
    {
        // dd('Package');
        $getCMS = planstriple::all();
        return view('Package.plan',get_defined_vars());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Package.create');

    }
    public function cancel_subscription(request $request){
        // dd($request->all());

        $subcriptionName = $request->subscriptioname;
        if($subcriptionName){
            $user = Auth::user();
            $user->subscription($subcriptionName)->cancel();
        }
        return response('data');
                    //     $notification = array('message' =>$ex->getMessage(), 'alert-type'=>'success' );
                    // return redirect()->back()->with($notification);
    }
    public function resume_subscription(request $request){
        // dd($request->all());

        $subcriptionName = $request->subscriptioname;
        if($subcriptionName){
            $user = Auth::user();
            $user->subscription($subcriptionName)->resume();
        }
        return response('resumesubs');
                    //     $notification = array('message' =>$ex->getMessage(), 'alert-type'=>'success' );
                    // return redirect()->back()->with($notification);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   return $request->all();

        $this->validate($request, [
            'name' => "required|max:255",
            'price' => "required|max:255",
            'intervalCount' => "required|max:255",
            'billing_Period' => "required|max:255",

        ]);

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $amount = ($request->price * 100);
            try{
            $plan_id = \Stripe\Plan::create(array(
                "amount" =>  $amount,
                "interval_count" => $request->intervalCount,
                "interval" => $request->billing_Period,
                "product" => array(
                    "name" => $request->name
                ),
                "currency" => "usd",
                // "id" => $request->name
                ));

            }
            catch(Exception $ex){
                    // dd($ex->getMessage());
                    $notification = array('message' =>$ex->getMessage(), 'alert-type'=>'success' );
                    return redirect()->back()->with($notification);
            }

            // dd($plan_id->id);
                $cms = new planstriple();
                $cms->name = $request->name;
                $cms->slug = Str::slug($request->name.Str::random(4), '-');
                $cms->price = $request->price;
                $cms->interval_count = $request->intervalCount;
                $cms->billing_payment = $request->billing_Period;
                $cms->currency = 'usd';
                $cms->plan_id = $plan_id->id;
                $cms->save();
            // return 'success';

        $notification = array('message' =>'Your plan has been created Successfully ' , 'alert-type'=>'success' );
        return redirect()->route('Package')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paypal_form(Request $request)
    {
        // dd($id  );
        $user = Auth::user();
        // $getpayment = Package::where('id', $id)->first();
        return view('Package.stripeform',
    [
        'intent' => $user->createSetupIntent(),
    ],get_defined_vars());
    }

    public function singlestripe(Request $request)
    {
        // dd($id  );
        // dd('payment');
        $user = Auth::user();
        // $getpayment = Package::where('id', $id)->first();
        return view('Package.singlestripe',
    [
        'intent' => $user->createSetupIntent(),
    ],get_defined_vars());
    }


    public function stripe_payment(Request $request)
    {

        //    return $request->all();
       $useramount = (round($request->amount));

       //    return $useramount;
       $paymentMethod = $request->payment_method;
       $user = Auth::user();
       $user->createOrGetStripeCustomer();
       $paymentMethodid =$user->addPaymentMethod($paymentMethod);
       $user->charge(
        $useramount, $paymentMethodid->id
        );
        return redirect()->route('plans.list');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = planstriple::where('id',$id)->first();
        return view('Package.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'details' => "required|max:255",
            'amount' => "required|max:255",
            'type' => "required|max:255",
        ]);

        $cms = planstriple::findOrFail($id);
        $cms->name = $request->name;
        $cms->price = $request->price;
        $cms->interval_count = $request->interval_count;
        $cms->billing_payment = $request->billing_payment;
        $cms->currency = $request->currency;
        $cms->save();

        $notification = array('message' =>'Your data updated Successfully ' , 'alert-type'=>'success' );
        return redirect()->route('Package')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        // dd($id);
        $cms = planstriple::where('id',$id)->first();
        $cms->delete();
        return redirect()->route('Package');
    }


}
