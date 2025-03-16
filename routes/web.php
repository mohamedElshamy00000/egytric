<?php

use App\Http\Controllers\Admin\ElectricCarController;
use App\Livewire\AboutUs;
use App\Livewire\ChargingStationsPage;
use App\Livewire\ChargingStationSinglePage;
use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\BlogPage;
use App\Livewire\BlogSinglePage;
use App\Livewire\CarsPage;
use App\Livewire\CarDetailsPage;
use App\Livewire\CarComparisonPage;
use App\Livewire\Shop\ShopPage;
use App\Livewire\Shop\ProductDetailsPage;
use App\Livewire\Shop\CartPage;
use App\Livewire\HelpMePage;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\BrandsPage;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Shop\Checkout;
use App\Livewire\SuccessPage;
use App\Livewire\FailedPage;
use App\Livewire\CallbackPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\MyOrderDetailsPage;
use App\Livewire\ContactUsPage;
use App\Livewire\FandQ;
use App\Livewire\MyCarOrderPage;
use App\Models\ElectricCar;

Route::get('/', HomePage::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.forgot');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

// cars
Route::get('/cars', CarsPage::class)->name('cars');
Route::get('/car/{slug}', CarDetailsPage::class)->name('cars.show');
Route::get('/car-comparison', CarComparisonPage::class)->name('car-comparison');

// Shop
Route::get('/shop', ShopPage::class)->name('shop');
Route::get('/shop/{slug}', ProductDetailsPage::class)->name('shop.products.show');
Route::get('/cart', CartPage::class)->name('shop.cart');
// blog
Route::get('/blog', BlogPage::class)->name('blog');
Route::get('/blog/{slug}', BlogSinglePage::class)->name('blog.show');

Route::get('/charging-stations', ChargingStationsPage::class)->name('charging-stations');
Route::get('/charging-stations/{chargingStation}', ChargingStationSinglePage::class)->name('charging-stations.show');

// contact us
Route::get('/contact-us', ContactUsPage::class)->name('contact-us');
Route::get('/fq', FandQ::class)->name('fq');
Route::get('/about', AboutUs::class)->name('about');

// help me choose
Route::get('/help-me-choose', HelpMePage::class)->name('help-me-choose');

// brands
Route::get('brands', BrandsPage::class)->name('brands');

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
    // Route::get('/dashboard', Dashboard::class)->name('dashboard');
    // Route::get('/my-account', MyAccountPage::class)->name('my-account');

    Route::get('/checkout', Checkout::class)->name('shop.checkout');
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-order/{orderId}', MyOrderDetailsPage::class)->name('my-orders.show');
    Route::get('/my-car-orders', MyCarOrderPage::class)->name('my-car-orders');

    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/failed', FailedPage::class)->name('failed');
    Route::get('/callback', CallbackPage::class)->name('callback');
});


Route::get('/electric-cars/export-template', [ElectricCarController::class, 'exportTemplate'])->name('electric-cars.export-template');
