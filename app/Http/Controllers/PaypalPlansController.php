<?php

namespace App\Http\Controllers;

use Stripe\Plan;
use App\Models\Package;
use PayPal\Api\Currency;
use App\Models\PaypalPlan;
use PayPal\Api\ChargeModel;
use Illuminate\Http\Request;
use App\Models\PaypalProduct;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\MerchantPreferences;
use Srmklive\PayPal\Facades\PayPal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalPlansController extends Controller
{
    public function index()
    {

        $getCMS = PaypalPlan::all();
        return view('paypal.plans.plan', get_defined_vars());
    }

    public function create($product_id)
    {
        $getPaypalProduct = PaypalPlan::where('product_id', $product_id)->first();
        if($getPaypalProduct){
            // dd('you have already created plan for this product');
            $notification = array('message' => 'You have already created plan for this product ', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }elseif($getPaypalProduct == null){
            // dd('you have not created plan for this product');
            $getPaypalProduct = PaypalProduct::where('product_id', $product_id)->first();
            return view('paypal.plans.create', get_defined_vars());
        }
    }


      /// ====== Function for Fixed Price of Plan Payments ========!

    public function store(Request $request)
    {

        $ID = $request->product_id;
        $name = $request->name;
        $description = $request->description;
        $value = $request->fixed_price;
        $currency_code = $request->currency_code;
        $interval_count = $request->interval_count;
        $interval_unit = $request->interval_unit;


        $provider = PayPal::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $data = json_decode('{
            "product_id":"' . $ID . '",
            "name": "' . $name . '",
            "description": "' . $description . '",
            "status": "ACTIVE",
            "billing_cycles": [
            {
                "frequency": {
                    "interval_unit": "' . $interval_unit . '",
                    "interval_count": 1
                },
                "tenure_type": "REGULAR",
                "sequence": 1,
                "total_cycles": 0,
                "pricing_scheme": {
                "fixed_price": {
                    "value": ' . $value . ',
                    "currency_code": "USD"
                    }
                }
            }
            ],
            "payment_preferences": {
            "auto_bill_outstanding": true,
            "payment_failure_threshold": 1
            },
            "taxes": {
            "percentage": 0,
            "inclusive": false
            }
        }', true);

        $request_id = 'Plan-' . time();
        $plan = $provider->createPlan($data, $request_id);
        PaypalPlan::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'product_id' => $request->product_id,
            'plan_price' => $request->fixed_price,
            'Currency' => $request->currency_code,
            'interval_count' => $request->interval_count,
            'billing_cycles_period' => $request->interval_unit,
            'plan_id' => $plan['id'],
            'plan_response' => json_encode($plan),
        ]);
        $notification = array('message' => 'Your Plans has been created Successfully ', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }
    /// ====== Function for Total method of Plan Payments ========!
    // public function store(Request $request)
    // {

    //     $ID = $request->product_id;
    //     $name = $request->name;
    //     $description = $request->description;
    //     $value = $request->fixed_price;
    //     $currency_code = $request->currency_code;
    //     $interval_count = $request->interval_count;
    //     $interval_unit = $request->interval_unit;


    //     $provider = PayPal::setProvider();
    //     $provider->setApiCredentials(config('paypal'));
    //     $provider->getAccessToken();

    //     $data = json_decode('{
    //         "product_id":"' . $ID . '",
    //         "name": "' . $name . '",
    //         "description": "' . $description . '",
    //         "status": "ACTIVE",
    //         "billing_cycles": [
    //         {
    //             "frequency": {
    //             "interval_unit": "' . $interval_unit . '",
    //             "interval_count": "' . $interval_count . '"
    //             },
    //             "tenure_type": "TRIAL",
    //             "sequence": 1,
    //             "total_cycles": 2,
    //             "pricing_scheme": {
    //             "fixed_price": {
    //                 "value": "' . $value . '",
    //                 "currency_code": "USD"
    //             }
    //             }
    //         },
    //         {
    //             "frequency": {
    //                 "interval_unit": "' . $interval_unit . '",
    //                 "interval_count": "' . $interval_count . '"
    //             },
    //             "tenure_type": "TRIAL",
    //             "sequence": 2,
    //             "total_cycles": 3,
    //             "pricing_scheme": {
    //             "fixed_price": {
    //                 "value": "' . $value . '",
    //                 "currency_code": "USD"
    //             }
    //             }
    //         },
    //         {
    //             "frequency": {
    //                 "interval_unit": "' . $interval_unit . '",
    //                 "interval_count": "' . $interval_count . '"
    //             },
    //             "tenure_type": "REGULAR",
    //             "sequence": 3,
    //             "total_cycles": 12,
    //             "pricing_scheme": {
    //             "fixed_price": {
    //                 "value": "' . $value . '",
    //                 "currency_code": "USD"
    //             }
    //             }
    //         }
    //         ],
    //         "payment_preferences": {
    //         "auto_bill_outstanding": true,
    //         "setup_fee": {
    //             "value": "' . $value . '",
    //             "currency_code": "USD"
    //         },
    //         "setup_fee_failure_action": "CONTINUE",
    //         "payment_failure_threshold": 3
    //         },
    //         "taxes": {
    //         "percentage": "10",
    //         "inclusive": false
    //         }
    //     }', true);

    //     $request_id = 'Plan-' . time();
    //     $plan = $provider->createPlan($data, $request_id);
    //     // dd($provider);
    //     // return $plan;
    //     PaypalPlan::create([
    //         'user_id' => Auth::user()->id,
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'product_id' => $request->product_id,
    //         'plan_price' => $request->fixed_price,
    //         'Currency' => $request->currency_code,
    //         'interval_count' => $request->interval_count,
    //         'billing_cycles_period' => $request->interval_unit,
    //         'plan_id' => $plan['id'],
    //         'plan_response' => json_encode($plan),
    //     ]);
    //     $notification = array('message' => 'Your Plans has been created Successfully ', 'alert-type' => 'success');
    //     return redirect()->back()->with($notification);
    //     // return view('paypal.plans.plan', get_defined_vars());

    // }
    public function edit($id)
    {
        $getPaypalProduct = PaypalPlan::find($id);
        return view('paypal.plans.edit', get_defined_vars());
    }

    /// ====== Function for update price of Plan Payments ========!

    public function updateprice(Request $request)
    {

        $value = $request->fixed_price;
        $provider = PayPal::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $interval_unit = $request->interval_unit;

        $data = json_decode('[
            {
                "op": "replace",
                "path": "/update-pricing-schemes/billing_cycle_sequence",
                "billing_cycle_sequence": 1,
                "pricing_scheme": {
                  "fixed_price": {
                    "value": "' . $value . '",
                    "currency_code": "USD"
                  }
                }
            }
            ]', true);

          $plan_id = $request->plan_id;

        $provider->updatePlanPricing($plan_id, $data);
        $object = PaypalPlan::where('plan_id', $request->plan_id)->first();
        $object->plan_price = $value;
        $object->save();
        $notification = array('message' => 'Your Plans Price has been update Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

        ///================== FOR UPDATE PLAN total_cycles ==================!
        // $data = json_decode('[
        //     {
        //         "op": "replace",
        //         "path": "/payment_preferences/payment_failure_threshold",
        //         "value": ' . $value . '
        //     }
        //     ]', true);
        //  $provider->updatePlan($request->plan_id, $data);
        // dd($plan);


    }

      /// ====== Function for ON & OFF Plans ========!

    public function suspend($plan_id)
    {
        // dd($plan_id);
        $checkstatus = PaypalPlan::where('plan_id', $plan_id)->first();
        if ($checkstatus->status == 0) {
            // dd('ON');

            $provider = PayPal::setProvider();
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $provider->deactivatePlan($plan_id);
            $object = PaypalPlan::where('plan_id', $plan_id)->first();
            $object->status = 1;
            $object->save();
        } elseif ($checkstatus->status == 1) {
            // dd('OFF');
            $provider = PayPal::setProvider();
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $plan = $provider->activatePlan($plan_id);
            $object = PaypalPlan::where('plan_id', $plan_id)->first();
            $object->status = 0;
            $object->save();
        }

        $notification = array('message' => 'Your Status Updated Successfully.!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
