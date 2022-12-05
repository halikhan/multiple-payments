<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Paypalpayment;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPackagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('Package');
        $getCMS = Package::all();
        return view('paypal.Package.index',get_defined_vars());

    }


    public function plans()
    {
        // dd('Package');
         $getCMS = Package::all();
        return view('paypal.Package.plan',get_defined_vars());

    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('paypal.Package.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'details' => "required|max:255",
            'amount' => "required|max:255",
            'type' => "required|max:255",
            // 'title' => "required|unique:packages",
        ]);

        $cms = new Package();
        $cms->amount = $request->amount;
        $cms->type = $request->type;
        $cms->details = $request->details;
        $cms->save();
        $notification = array('message' =>'Your data Inserted Successfully ' , 'alert-type'=>'success' );
        return redirect()->route('Package')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
        $currentURL = url()->current('https://www.sandbox.paypal.com/webapps/billing/subscriptions?ba_token=BA-26B91448FW9877514&country.x=US&locale.x=en_US&mode=member&token=6D452910EX8134150');
        dd($currentURL);

    }

    public function paymentupdate(Request $request,$id)
    {

        // dd($id);
        $currentURL = url('https://www.sandbox.paypal.com/webapps/billing/subscriptions?ba_token=BA-26B91448FW9877514&country.x=US&locale.x=en_US&mode=member&token=6D452910EX8134150')->current();
        dd($currentURL);

        // $data = $request->id;
        // $data = 'https://www.sandbox.paypal.com/webapps/billing/subscriptions?ba_token=BA-26B91448FW9877514&country.x=US&locale.x=en_US&mode=member&token=6D452910EX8134150';
        // dd($data);

        $packageSubs = Paypalpayment::where('package_id', $id)->orderBy('id', 'desc')->first();
        $amount ['data']= $packageSubs['package_amount'];
        //  $data = json_decode($packageSubs->package_amount, true);
        // return $data;
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;

        $data = json_decode('[
            {
              "op": "replace",
              "path": "/billing_info/outstanding_balance",
              "value": {
                "currency_code": "USD",
                "value": "0.00"
              }
            }
          ]', true);
        // return data[];
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->updateSubscription($transactionid, $data);
        // return jaso($response);
        // return redirect()->json($response['paypal_link']);
        return response()->json([
            $response,
            'status' => 'success'
        ]);

    }
    public function paymentSuspend(Request $request,$id)
    {
        // dd($id);
        $packageSubs = Paypalpayment::where('package_id', $id)->orderBy('id', 'desc')->first();
         $amount ['data']= $packageSubs['package_amount'];
        //  $data = json_decode($packageSubs->package_amount, true);
        // return $data;
        $transactionid = json_decode($packageSubs->package_response)->subscriptionID;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->suspendSubscription($transactionid , 'Item out of stock');
        // return jaso($response);
        // return redirect()->json($response['paypal_link']);
        return response()->json([
            $response,
            'status' => 'success'
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = Package::where('id',$id)->first();
        return view('paypal.Package.edit',get_defined_vars());
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

        $cms = Package::findOrFail($id);
        $cms->amount = $request->amount;
        $cms->type = $request->type;
        $cms->details = $request->details;
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
        $cms = Package::where('id',$id)->first();
        $cms->delete();
        return redirect()->route('paypal.packages');
    }


}
