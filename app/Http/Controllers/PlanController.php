<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Plan;
use App\Models\PlanOrder;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\Utility;
use File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('Manage Plans')) {
            $objUser = \Auth::user();
            // if ($objUser->type == 'super admin' || $objUser->type == 'Owner') {
            if ($objUser->type == 'super admin') {
                $orders = PlanOrder::select(
                    [
                        'plan_orders.*',
                        'users.name as user_name',
                    ]
                )->join('users', 'plan_orders.user_id', '=', 'users.id')->orderBy('plan_orders.created_at', 'DESC')->get();
            } else {
                $orders = PlanOrder::select(
                    [
                        'plan_orders.*',
                        'users.name as user_name',
                    ]
                )->join('users', 'plan_orders.user_id', '=', 'users.id')->orderBy('plan_orders.created_at', 'DESC')->where('users.id', '=', $objUser->id)->get();
            }

            $plans                  = Plan::get();
            $admin_payments_setting = Utility::getAdminPaymentSetting();

            return view('plans.index', compact('plans', 'orders', 'admin_payments_setting'));
            // } else {
            //     return redirect()->route('dashboard');
            // }
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->can('Create Plans')) {
            if (\Auth::user()->type == 'super admin') {
                $arrDuration = Plan::$arrDuration;

                return view('plans.create', compact('arrDuration'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->can('Create Plans')) {
            if (\Auth::user()->type == 'super admin') {
                $admin_payments_setting = Utility::getAdminPaymentSetting();
                if ((isset($admin_payments_setting['is_stripe_enabled']) && $admin_payments_setting['is_stripe_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_paypal_enabled']) && $admin_payments_setting['is_payfast_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_paystack_enabled']) && $admin_payments_setting['is_paystack_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_flutterwave_enabled']) && $admin_payments_setting['is_flutterwave_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_razorpay_enabled']) && $admin_payments_setting['is_razorpay_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_mercado_enabled']) && $admin_payments_setting['is_mercado_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_mollie_enabled']) && $admin_payments_setting['is_mollie_enabled']  == 'on')
                    || (isset($admin_payments_setting['is_payfast_enabled']) && $admin_payments_setting['is_payfast_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_toyyibpay_enabled']) && $admin_payments_setting['is_toyyibpay_enabled'] == 'on'
                        || (isset($admin_payments_setting['is_manuallypay_enabled']) && $admin_payments_setting['is_manuallypay_enabled'] == 'on'))
                    || (isset($admin_payments_setting['is_bank_enabled']) && $admin_payments_setting['is_bank_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_iyzipay_enabled']) && $admin_payments_setting['is_iyzipay_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_sspay_enabled']) && $admin_payments_setting['is_sspay_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_paytab_enabled']) && $admin_payments_setting['is_paytab_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_benefit_enabled']) && $admin_payments_setting['is_benefit_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_cashfree_enabled']) && $admin_payments_setting['is_cashfree_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_aamarpay_enabled']) && $admin_payments_setting['is_aamarpay_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_paytr_enabled']) && $admin_payments_setting['is_paytr_enabled'] == 'on')
                ) {
                    $validation                 = [];
                    $validation['name']         = 'required|unique:plans';
                    $validation['price']        = 'required|numeric|min:0';
                    $validation['duration']     = 'required';
                    $validation['max_users']   = 'required|numeric';
                    $validation['storage_limit'] = 'required|numeric';
                    $validation['max_stores']   = 'required|numeric';
                    $validation['max_products'] = 'required|numeric';

                    // if($request->image)
                    // {
                    //     $validation['image'] = 'required|max:20480';
                    // }

                    $request->validate($validation);
                    $post = $request->all();


                    if ($request->hasFile('image')) {
                        $filenameWithExt = $request->file('image')->getClientOriginalName();
                        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension       = $request->file('image')->getClientOriginalExtension();
                        $fileNameToStore = 'plan_' . time() . '.' . $extension;
                        $settings = Utility::getStorageSetting();
                        if ($settings['storage_setting'] == 'local') {
                            $dir        = 'uploads/plan/';
                        } else {
                            $dir        = 'uploads/plan/';
                        }
                        $path = Utility::upload_file($request, 'image', $fileNameToStore, $dir, []);
                        if ($path['flag'] == 1) {
                            $url = $path['url'];
                        } else {
                            return redirect()->route('plans.index', \Auth::user()->id)->with('error', __($path['msg']));
                        }

                        $post['image'] = $fileNameToStore;
                    }
                    if (!isset($request->enable_custdomain)) {
                        $post['enable_custdomain'] = 'off';
                    }
                    if (!isset($request->enable_custsubdomain)) {
                        $post['enable_custsubdomain'] = 'off';
                    }
                    if (!isset($request->shipping_method)) {
                        $post['shipping_method'] = 'off';
                    }
                    if (!isset($request->pwa_store)) {
                        $post['pwa_store'] = 'off';
                    }

                    if (!isset($request->enable_chatgpt)) {
                        $post['enable_chatgpt'] = 'off';
                    }

                    if (Plan::create($post)) {
                        return redirect()->back()->with('success', __('Plan created Successfully!'));
                    } else {
                        return redirect()->back()->with('error', __('Something is wrong'));
                    }
                } else {
                    return redirect()->back()->with('error', __('Please set atleast one payment api key & secret key for add new plan'));
                }
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($plan_id)
    {
        if (\Auth::user()->can('Edit Plans')) {
            if (\Auth::user()->type == 'super admin') {
                $arrDuration = Plan::$arrDuration;
                $plan        = Plan::find($plan_id);

                return view('plans.edit', compact('plan', 'arrDuration'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function update($planID, Request $request)
    {
        if (\Auth::user()->can('Edit Plans')) {
            if (\Auth::user()->type == 'super admin') {
                $admin_payments_setting = Utility::getAdminPaymentSetting();
                if ((isset($admin_payments_setting['is_stripe_enabled']) && $admin_payments_setting['is_stripe_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_paypal_enabled']) && $admin_payments_setting['is_paypal_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_paystack_enabled']) && $admin_payments_setting['is_paystack_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_flutterwave_enabled']) && $admin_payments_setting['is_flutterwave_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_razorpay_enabled']) && $admin_payments_setting['is_razorpay_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_mercado_enabled']) && $admin_payments_setting['is_mercado_enabled'] == 'on')
                    || (isset($admin_payments_setting['is_mollie_enabled']) && $admin_payments_setting['is_mollie_enabled']
                        || (isset($admin_payments_setting['is_payfast_enabled']) && $admin_payments_setting['is_payfast_enabled'] == 'on'))
                    || (isset($admin_payments_setting['is_iyzipay_enabled']) && $admin_payments_setting['is_iyzipay_enabled'] == 'on')
                ) {
                    $plan = Plan::find($planID);
                    if ($plan) {
                        if ($plan->price == 0) {
                            $validator = \Validator::make(
                                $request->all(),
                                [
                                    'name' => 'required|unique:plans,name,' . $planID,
                                    'duration' => 'required',
                                    'max_users'   => 'required|numeric',
                                    'storage_limit' => 'required|numeric',
                                    'max_stores' => 'required|numeric',
                                    'max_products' => 'required|numeric',
                                ]
                            );
                        } else {
                            $validator = \Validator::make(
                                $request->all(),
                                [
                                    'name' => 'required|unique:plans,name,' . $planID,
                                    'price' => 'required|numeric|min:0',
                                    'duration' => 'required',
                                    'max_users'   => 'required|numeric',
                                    'storage_limit' => 'required|numeric',
                                    'max_stores' => 'required|numeric',
                                    'max_products' => 'required|numeric',
                                ]
                            );
                        } {
                        }
                        if ($validator->fails()) {
                            $messages = $validator->getMessageBag();

                            return redirect()->back()->with('error', $messages->first());
                        }

                        $post = $request->all();
                        if (!isset($request->enable_custdomain)) {
                            $post['enable_custdomain'] = 'off';
                        }
                        if (!isset($request->enable_custsubdomain)) {
                            $post['enable_custsubdomain'] = 'off';
                        }
                        if (!isset($request->shipping_method)) {
                            $post['shipping_method'] = 'off';
                        }
                        if (!isset($request->pwa_store)) {
                            $post['pwa_store'] = 'off';
                        }

                        if (!isset($request->enable_chatgpt)) {
                            $post['enable_chatgpt'] = 'off';
                        }

                        if ($request->hasFile('image')) {
                            $filenameWithExt = $request->file('image')->getClientOriginalName();
                            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            $extension       = $request->file('image')->getClientOriginalExtension();
                            $fileNameToStore = 'plan_' . time() . '.' . $extension;
                            $settings = Utility::getStorageSetting();
                            if ($settings['storage_setting'] == 'local') {
                                $dir        = 'uploads/plan/';
                            } else {
                                $dir        = 'uploads/plan/';
                            }

                            $image_path = $dir . '/' . $plan->image;
                            if (File::exists($image_path)) {
                                File::delete($image_path);
                            }

                            $path = Utility::upload_file($request, 'image', $fileNameToStore, $dir, []);

                            if ($path['flag'] == 1) {
                                $url = $path['url'];
                            } else {
                                return redirect()->route('plans.index', \Auth::user()->id)->with('error', __($path['msg']));
                            }

                            $post['image'] = $fileNameToStore;
                        }

                        if ($plan->update($post)) {
                            return redirect()->back()->with('success', __('Plan updated Successfully!'));
                        } else {
                            return redirect()->back()->with('error', __('Something is wrong'));
                        }
                    } else {
                        return redirect()->back()->with('error', __('Plan not found'));
                    }
                } else {
                    return redirect()->back()->with('error', __('Please set atleast one payment api key & secret key for add new plan'));
                }
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($planID)
    {
    }

    public function userPlan(Request $request)
    {
        $objUser = \Auth::user();
        $planID  = \Illuminate\Support\Facades\Crypt::decrypt($request->code);
        $plan    = Plan::find($planID);
        if ($plan) {
            if ($plan->monthly_price <= 0) {
                $objUser->assignPlan($plan->id);

                return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        } else {
            return redirect()->back()->with('error', __('Plan not found'));
        }
    }

    public function payment($code)
    {
        $planID = \Illuminate\Support\Facades\Crypt::decrypt($code);
        $plan   = Plan::find($planID);
        if ($plan) {
            return view('plans.payment', compact('plan'));
        } else {
            return redirect()->back()->with('error', __('Plan is deleted.'));
        }
    }

    public function planPrepareAmount(Request $request)
    {
        $user = \Auth::user();
        $plan = Plan::find(\Illuminate\Support\Facades\Crypt::decrypt($request->plan_id));
        if ($plan) {
            $original_price = number_format($plan->price);
            $coupons        = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
            $coupon_id      = null;
            if (!empty($coupons)) {
                $usedCoupun = $coupons->used_coupon();
                if ($coupons->limit == $usedCoupun) {
                } else {
                    $discount_value = ($plan->price / 100) * $coupons->discount;
                    $plan_price     = $plan->price - $discount_value;
                    $price          = $plan->price - $discount_value;
                    $discount_value = '-' . $discount_value;
                    $coupon_id      = $coupons->id;


                    if ($price == 0 || $price < 0) {
                        $user->plan = $plan->id;
                        $user->save();

                        $assignPlan = $user->assignPlan($plan->id, $request->paystack_payment_frequency);

                        $coupons = Coupon::find($request->coupon_id);
                        $user = Auth::user();
                        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                        if (!empty($coupons)) {
                            $userCoupon            = new UserCoupon();
                            $userCoupon->user   = $user->id;
                            $userCoupon->coupon = $coupons->id;
                            $userCoupon->order  = $orderID;
                            $userCoupon->save();


                            $usedCoupun = $coupons->used_coupon();
                            if ($coupons->limit <= $usedCoupun) {
                                $coupons->is_active = 0;
                                $coupons->save();
                            }
                        }


                        if ($assignPlan['is_success'] == true && !empty($plan)) {
                            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                            $planorder                 = new PlanOrder();
                            $planorder->order_id       = $orderID;
                            $planorder->name           = $user->name;
                            $planorder->email           = $user->email;
                            $planorder->card_number    = '';
                            $planorder->card_exp_month = '';
                            $planorder->card_exp_year  = '';
                            $planorder->plan_name      = $plan->name;
                            $planorder->plan_id        = $plan->id;
                            $planorder->price          = $price;
                            $planorder->price_currency = env('CURRENCY');
                            $planorder->txn_id         = '';
                            $planorder->payment_type   = $request->payment;
                            $planorder->payment_status = 'succeeded';
                            $planorder->receipt        = null;
                            $planorder->user_id        = $user->id;
                            $planorder->store_id       = $user->current_store;
                            $planorder->save();
                            
                            return response()->json(
                                [
                                    'final_price' => $price,
                                    'message' => __('Plan activated Successfully.'),
                                ]
                            );
                        } else {
                            return Utility::error_res(__('Plan fail to upgrade.'));
                        }
                    } else {
                        return response()->json(
                            [
                                'is_success' => true,
                                'discount_price' => $discount_value,
                                'final_price' => $price,
                                'price' => $plan_price,
                                'coupon_id' => $coupon_id,
                                'message' => __('Coupon code has applied successfully.'),
                            ]
                        );
                    }
                }
            } else {
                return response()->json(
                    [
                        'is_success' => true,
                        'final_price' => $original_price,
                        'coupon_id' => $coupon_id,
                        'price' => $plan->price,
                    ]
                );
            }
        }
    }
}
