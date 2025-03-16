<div>

    <div class="main-sidebar-nav">
        <div class="offcanvas-header d-flex justify-content-between align-items-center pb-4">
            <button type="button" class="close-btn tran3s"><i class="fa fa-times" aria-hidden="true"></i></button>
            <div class="logo"><a href="{{ route('home') }}" class="d-block"><img src="{{ asset('frontend/images/logo/Artboard 23.png') }}" width="130px" alt=""></a></div>
        </div>

        <div class="sidebar-nav-item">
            <ul class="navbar-nav text-right">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">المنتجات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cars') }}">السيارات الكهربائية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('car-comparison') }}">جدول المقارنة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('charging-stations') }}">المحطات الشحن</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('help-me-choose') }}">مساعدة على الاختيار</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog') }}">المدونة</a>
                </li>
                {{-- <li class="nav-item dropdown text-right">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">المنتجات</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('help-me-choose') }}" class="dropdown-item text-right">مساعدة على الاختيار</a></li>
                    </ul> <!-- /.dropdown-menu -->
                </li> --}}
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">تسجيل الخروج</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>


    <!--
    =============================================
        Theme Main Menu
    ==============================================
    -->
    <div class="theme-main-menu sticky-menu bg-none theme-menu-eight direction-rtl">
        <div class="d-flex align-items-center justify-content-between">
            <div class="logo d-flex">
                <div class="d-flex align-items-center">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/images/logo/Artboard 23.png') }}" width="150px" alt=""></a>
                </div>
                <nav id="mega-menu-holder" class="navbar navbar-expand-lg d-none d-lg-block">
                    <div class="nav-container">
                        <button class="navbar-toggler">
                            <span></span>
                        </button>
                        <div class="navbar-collapse collapse" id="navbarSupportedContent">
                            <div class="d-lg-flex align-items-center">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown position-static">
                                        <a class="nav-link p-md-0" href="{{ route('cars') }}">السيارات الكهربائية</a>
                                    </li>
                                    <li class="nav-item dropdown position-static">
                                        <a class="nav-link p-md-0" href="{{ route('shop') }}">المنتجات</a>
                                    </li>
                                    <li class="nav-item dropdown position-static">
                                        <a class="nav-link p-md-0" href="{{ route('about') }}">عن المنصة</a>
                                    </li>
                                    <li class="nav-item dropdown position-static">
                                        <a class="nav-link p-md-0" href="{{ route('help-me-choose') }}"> 🌟 ساعدني علي الاختيار</a>
                                    </li>
                                    <li class="nav-item dropdown position-static">
                                        <a class="nav-link p-md-0" href="{{ route('contact-us') }}">تواصل معنا</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="right-widget d-flex align-items-center">

                @auth
                    <a href="{{ route('my-orders') }}" class="signIn-action d-none d-sm-flex align-items-center">
                        <img src="{{ asset('frontend/images/icon/199.svg') }}" alt="" class="ml-2">
                        <div class="d-flex flex-column text-right">
                            <span class="mb-0 h6">{{ auth()->user()->name }}</span>
                            <p class="mb-0 h6">{{ auth()->user()->email }}</p>
                        </div>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="signIn-action d-none d-sm-flex align-items-center">
                        <img src="{{ asset('frontend/images/icon/199.svg') }}" alt="" class="ml-2">
                        <span>تسجيل الدخول</span>
                    </a>
                @endauth

                <a href="{{ route('car-comparison') }}" class="signIn-action d-none d-sm-flex align-items-center mr-3" title="جدول المقارنة">
                    <img src="{{ asset('frontend/images/icon/74.svg') }}" alt="" class="mr-2">
                </a>

                <div class="cart-group-wrapper">
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('frontend/images/icon/200.svg') }}" alt="" class="m-auto">
                        <span class="item-count">{{ $total_count }}</span>
                    </button>
                    <div class="dropdown-menu">
                        <ul class="style-none cart-product-list">
                            @forelse ($nav_cartItems as $nav_cart_item)
                            <li wire:key="{{ $nav_cart_item['product_id'] }}" class="d-flex align-items-top selected-item">
                                <a href="{{ route('shop.products.show', $nav_cart_item['slug']) }}" class="item-img d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('storage/'.$nav_cart_item['images'][0]) }}" alt="">
                                </a>
                                <div class="item-info">
                                    <a href="{{ route('shop.products.show', $nav_cart_item['slug']) }}" class="name">{{ $nav_cart_item['name'] }}</a>
                                    <div class="price">{{ Number::currency($nav_cart_item['total_amount'], 'EGP') }}<span class="quantity">x {{ $nav_cart_item['quantity'] }}</span></div>
                                </div>
                            </li>
                            @empty
                            <li class="d-flex align-items-center selected-item justify-content-center">
                                <div class="">
                                    <div class="">لا يوجد منتجات في العربة</div>
                                </div>
                            </li>
                            @endforelse
                        </ul> <!-- /.cart-product-list -->

                        @if ($nav_cartItems)
                        <div class="subtotal d-flex justify-content-between align-items-center rtl">
                            <div class="title">الإجمالي</div>
                            <div class="total-price text-right">{{ Number::currency($nav_grandTotal, 'EGP') }}</div>
                        </div>
                        <ul class="style-none button-group">
                            <li><a href="{{ route('shop.cart') }}" class="view-cart m-0 w-100 mb-2">عربة التسوق</a></li>
                            <li><a href="{{ route('shop.checkout') }}" class="checkout m-0 w-100">الدفع</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
                <button class="sidebar-nav-button"><img src="{{ asset('frontend/images/icon/201.svg') }}" alt=""></button>
            </div> <!-- /.right-widget -->
        </div>
    </div>

</div>
