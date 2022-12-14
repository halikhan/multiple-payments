<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PaypalPlansController;
use App\Http\Controllers\SinglePaypalController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaypalProductController;
use App\Http\Controllers\PaypalPackagesController;
use App\Http\Controllers\PaypalSubcriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard.menu');
Route::get('stripemenu-menu', [CustomAuthController::class, 'stripemenuMenu'])->name('stripemenu.menu');
Route::get('paypal-menu', [CustomAuthController::class, 'paypalMenu'])->name('paypal.menu');
Route::get('paypal-plans-menu', [CustomAuthController::class, 'paypalPlansMenu'])->name('paypal.plans.menu');
Route::get('paypal-singlepayment-menu', [CustomAuthController::class, 'paypalsinglepaymentMenu'])->name('paypal.singlepayment.menu');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');


Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('log-Out', [CustomAuthController::class, 'logOut'])->name('log.out');
Route::get('plans-list', [PackageController::class, 'plans'])->name('plans.list');
Route::get('stripe-form', [PackageController::class, 'paypal_form'])->name('paypal.form');
Route::get('single-stripe', [PackageController::class, 'singlestripe'])->name('single.stripe');
// Route::post('single-stripe', [PackageController::class, 'singlestripe'])->name('single.stripe');
Route::post('stripe-payment', [PackageController::class, 'stripe_payment'])->name('stripe.payment');


Route::get('plans-subscribe', [SubscriptionController::class, 'subscribe'])->name('plans.subscribe');
Route::get('plans-checkout/{slug}', [SubscriptionController::class, 'checkout'])->name('plans.checkout');
Route::post('stripe-subcription', [SubscriptionController::class, 'subcription'])->name('stripe.subcription');
Route::get('show-subscription', [PackageController::class, 'showsubscription'])->name('show.subscription');
Route::get('cancel-user-subscription', [PackageController::class, 'cancel_subscription'])->name('cancel.user.subscription');
Route::get('resume-subscription', [PackageController::class, 'resume_subscription'])->name('subscriptions.resume');
Route::get('refund-subscription', [SubscriptionController::class, 'refund_subscription'])->name('subscriptions.refund');
Route::get('cancel-subscription', [SubscriptionController::class, 'cancel_plan'])->name('cancelplan');


Route::prefix('Package')->group(function () {

    Route::get('Package', [PackageController::class, 'index'])->name('Package');
    Route::get('Package-create', [PackageController::class, 'create'])->name('Package_create');
    Route::post('Package-store', [PackageController::class, 'store'])->name('Package_store');
    Route::get('Package-edit/{id}', [PackageController::class, 'edit'])->name('Package_edit');
    Route::post('Package-update/{id}', [PackageController::class, 'update'])->name('Package_update');
    Route::get('Package-destroy/{id}', [PackageController::class, 'destroy'])->name('Package_destroy');

});



Route::prefix('paypal')->group(function () {

    // =============== Paypal Product ==================//

    Route::get('product-list', [PaypalProductController::class, 'index'])->name('product.list');

    Route::get('product-create', [PaypalProductController::class, 'create'])->name('product.create');

    Route::post('product-store', [PaypalProductController::class, 'store'])->name('product.store');
    Route::get('product-edit/{id}', [PaypalProductController::class, 'edit'])->name('product.edit');
    Route::post('product-update/{id}', [PaypalProductController::class, 'update'])->name('plans.update');
    Route::get('product-show/{product_id}', [PaypalProductController::class, 'show'])->name('product.show');



    // =============== Paypal Payment Plans==================//

    Route::get('plans-index', [PaypalPlansController::class, 'index'])->name('Plans.index');
    Route::get('plans-create/{product_id}', [PaypalPlansController::class, 'create'])->name('Plans.create');
    Route::post('plans-store', [PaypalPlansController::class, 'store'])->name('plans.store');
    Route::get('product-suspend/{plan_id}', [PaypalPlansController::class, 'suspend'])->name('product.suspend');
    Route::get('plans-edit/{id}', [PaypalPlansController::class, 'edit'])->name('plans.edit');

    Route::post('plans-price.update', [PaypalPlansController::class, 'updateprice'])->name('plans.updateprice');
    // =============== Paypal Subscriptions ==================//

    Route::get('subcription-index', [PaypalSubcriptionController::class, 'index'])->name('subcription.index');
    Route::get('paypal-subcription/{id}', [PaypalSubcriptionController::class, 'paypal'])->name('paypal.subcription');

    Route::get('store-paypal-payment', [PaypalSubcriptionController::class, 'store_payment'])->name('storepaypal_payment');
    Route::get('paypal-subcription-update/{id}', [PaypalSubcriptionController::class, 'updatepaypal'])->name('subcription.updatepaypal');
    Route::get('paypal-amount-update/{id}', [PaypalSubcriptionController::class, 'updatepaypalamount'])->name('updatepaypal.amount');
    Route::get('subcription-updatepaypal_payment', [PaypalSubcriptionController::class, 'updatepaypal_payment'])->name('subcription.updatepaypal_payment');
    Route::get('show-paypal-payment/{package_id}', [PaypalSubcriptionController::class, 'paypalshowpayment'])->name('showpaypal.payment');
    Route::get('cancel-paypal-payment/{package_id}', [PaypalSubcriptionController::class, 'cancelpaypalrepayment'])->name('cancel.paypal.payment');
    Route::post('suspend-paypal-payment/{package_id}', [PaypalSubcriptionController::class, 'Suspendpaypalrepayment'])->name('paypal.suspend.payment');
    Route::post('reactive-paypal-payment/{package_id}', [PaypalSubcriptionController::class, 'reactivepaypalrepayment'])->name('paypal.reactive.payment');


    // =============== Paypal Single payment ==================//

    Route::get('single-payment-index', [SinglePaypalController::class, 'index'])->name('single.payment.index');
    Route::get('singlepayment-button/{id}', [SinglePaypalController::class, 'singlepaypalbutton'])->name('singlepayment.button');
    Route::post('store-single-payment', [SinglePaypalController::class, 'storeSinglepayment'])->name('storesingle_payment');
    Route::get('show-paypal-payment', [SinglePaypalController::class, 'payments'])->name('single.payment.show');

    Route::post('single-payments-show/{payment_id}', [SinglePaypalController::class, 'showSinglepayment'])->name('single.paypal.packages.show');

    Route::post('single-payments-refund/{payment_id}', [SinglePaypalController::class, 'refundSinglepayment'])->name('single.paypal.packages.refund');

    Route::get('single-payments-showRefund/{payment_id}', [SinglePaypalController::class, 'showRefundedpaymentdetails'])->name('single.paypal.packages.showRefund');



    // =============== Paypal Payment Packages==================//

    Route::get('plans-list', [PaypalPackagesController::class, 'plans'])->name('paypal.plans.list');
    Route::get('packages', [PaypalPackagesController::class, 'index'])->name('paypal.packages');
    Route::get('Package-create', [PaypalPackagesController::class, 'create'])->name('paypal.packages.create');
    Route::post('Package-store', [PaypalPackagesController::class, 'store'])->name('paypal.packages.store');
    Route::get('Package-edit/{id}', [PaypalPackagesController::class, 'edit'])->name('paypal.packages.edit');
    Route::post('Package-update/{id}', [PaypalPackagesController::class, 'update'])->name('paypal.packages.update');
    Route::get('Package-destroy/{id}', [PaypalPackagesController::class, 'destroy'])->name('paypal.packages.destroy');

    Route::post('package-paymentupdate/{id}', [PaypalPackagesController::class, 'paymentupdate'])->name('paypal.package.payment.update');
    Route::post('package.paymentSuspend/{id}', [PaypalPackagesController::class, 'paymentSuspend'])->name('paypal.package.payment.Suspend');

});

Route::get('/clear', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    // return "Cache is cleared";
    return back()->with("Cache is cleared");
})->name('clear');

Route::any('{url}', function(){
    return view('errors.404');
})->where('url', '.*');
