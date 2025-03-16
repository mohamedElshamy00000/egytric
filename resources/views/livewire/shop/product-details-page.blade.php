@section('title', $product->name)
@section('description', Str::limit(strip_tags($product->description), 150))
@section('og:title',  $product->name)
@section('og:description', Str::limit(strip_tags($product->description), 150))
@section('og:image', asset('storage/' .$product->images[0]) )
@section('twitter:title',  $product->name)
@section('twitter:description', Str::limit(strip_tags($product->description), 150))
@section('twitter:image', asset('storage/' .$product->images[0]) )

<div>
    <div class="product-details-one lg-container pt-100 lg-pt-150  pb-100 rtl text-right">
        <div class="breadcrumb-area pb-70">
            <div class="container">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <nav class="breadcrumb-style-one mt-20">
                        <ol class="breadcrumb bg-white style-none m0 p0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('shop') }}">المنتجات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                    <div class="share-dropdown mt-20">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            شارك
                        </button>
                        <div class="dropdown-menu">
                            <ul class="d-flex justify-content-between social-icon style-none">
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="https://www.pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.breadcrumb-area -->
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-lg-2">
                    <div class="tab-content product-img-tab-content">
                        @foreach ($product->images as $index => $image)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="img{{$index}}" role="tabpanel" >
                                <a class="fancybox h-100 w-100 d-flex align-items-center justify-content-center" data-fancybox="" href="{{asset('storage/'.$image)}}" tabindex="-1">
                                    <img src="{{asset('storage/'.$image)}}" alt="" class="m-auto rounded">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-1 order-lg-1">
                    <ul class="nav nav-tabs flex-lg-column product-img-tab" id="myTab" role="tablist">
                        @foreach ($product->images as $index => $image)
                        <li class="nav-item">
                            <button class="nav-link @if($loop->first) active @endif " data-toggle="tab" data-target="#img{{$index}}" type="button" role="tab" aria-controls="img{{$index}}" aria-selected="true"><img src="{{asset('storage/'.$image)}}" alt="" class="m-auto"></button>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6 order-lg-3">
                    <div class="product-info pl-xl-5 md-mt-50">

                        @if ($product->is_stock)
                        <div class="stock-tag">متوفر</div>
                        @else
                        <div class="stock-tag">غير متوفر</div>
                        @endif

                        <h3 class="product-name">{{ $product->name }}</h3>
                        <ul class="style-none d-flex align-items-center rating">
                            @php
                                $avgRating = $product->ratings->avg('rating');
                                $fullStars = floor($avgRating);
                                $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                            @endphp

                            @for ($i = 0; $i < $fullStars; $i++)
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            @endfor

                            @if ($hasHalfStar)
                                <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
                            @endif

                            @for ($i = 0; $i < $emptyStars; $i++)
                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            @endfor

                            <li><a href="#">({{ $product->ratings->count() }} مراجعة)</a></li>

                        </ul>

                        <div class="price">{{ Number::currency($product->price, 'EGP') }}</div>
                        <p class="availability">{{ $product->quantity ?? '0' }} قطعة متاحة</p>
                        <p class="my-2">{!! Str::markdown($product->description) !!}</p>

                        <div class="customize-order">
                            <div class="row">
                                <div class="col-xl-11">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                            <div class="size-selection mt-25">
                                                <ul class="style-none d-flex align-items-center size-custome-input">
                                                    @if ($product->features)
                                                        @foreach ($product->features as $feature)
                                                        <li>
                                                            <div class="" wire:key="{{ $feature }}">
                                                                <div class="d-flex align-items-top car-feature-box">
                                                                    <i class="fa fa-check ml-2" aria-hidden="true"></i>
                                                                    <div class="info-meta">
                                                                        <h6 class="mb-0 text-muted">{{ $feature }}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="quantity mt-25">
                                                <h6>الكمية</h6>
                                                <div class="button-group">
                                                    <ul class="style-none d-flex align-items-center">
                                                        <li><button class="value-decrease" wire:click="decrementQuantity">-</button></li>
                                                        <li><input type="text" wire:model="quantity" readonly min="1" max="22" value="{{ $quantity }}" class="product-value val"></li>
                                                        <li><button class="value-increase" wire:click="incrementQuantity">+ </button></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-group mt-30 d-sm-flex align-items-center">
                            <button class="cart-btn mt-15 mr-sm-4 d-block" wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled">
                                اضافة الي السلة
                                <span wire:loading wire:target="addToCart({{ $product->id }})">...</span>
                            </button>
                            {{-- <button class="wishlist-btn mt-15 d-block">المفضلة</button> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-60 lg-mt-40">
                <div class="row">
                    @if ($product->free_delivery)
                    <div class="col-lg-3 col-sm-6 m-auto" data-aos="fade-up">
                        <div class="block-style-thirtyNine mt-40 text-center">
                            <div class="icon rounded-circle d-flex align-items-center justify-content-center m-auto"><img src="{{asset('frontend/images/icon/203.svg')}}" alt=""></div>
                            <h3>توصيل مجاني</h3>
                            <p class="pl-xl-3 pr-xl-3">تبسيط عملية إنشاء العروض.</p>
                        </div>
                    </div>
                    @endif
                    @if ($product->free_return)
                    <div class="col-lg-3 col-sm-6 m-auto" data-aos="fade-up" data-aos-delay="100">
                        <div class="block-style-thirtyNine mt-40 text-center">
                            <div class="icon rounded-circle d-flex align-items-center justify-content-center m-auto"><img src="{{asset('frontend/images/icon/204.svg')}}" alt=""></div>
                            <h3>إرجاع مجاني</h3>
                            <p class="pl-xl-3 pr-xl-3">إرجاع الأموال خلال 7 أيام فقط!</p>
                        </div>
                    </div>
                    @endif
                    @if ($product->cash_on_delivery)
                    <div class="col-lg-3 col-sm-6 m-auto" data-aos="fade-up" data-aos-delay="200">
                        <div class="block-style-thirtyNine mt-40 text-center">
                            <div class="icon rounded-circle d-flex align-items-center justify-content-center m-auto"><img src="{{asset('frontend/images/icon/205.svg')}}" alt=""></div>
                            <h3>دفع عند الاستلام</h3>
                            <p class="pl-xl-3 pr-xl-3">دفع عند الاستلام المنتج</p>
                        </div>
                    </div>
                    @endif
                    @if ($product->installment_plan)
                    <div class="col-lg-3 col-sm-6 m-auto" data-aos="fade-up" data-aos-delay="300">
                        <div class="block-style-thirtyNine mt-40 text-center">
                            <div class="icon rounded-circle d-flex align-items-center justify-content-center m-auto"><img src="{{asset('frontend/images/icon/206.svg')}}" alt=""></div>
                            <h3>خطة تقسيط</h3>
                            <p class="pl-xl-3 pr-xl-3">تقسيط المنتجات بأسعار معقولة</p>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-3 col-sm-6 m-auto" data-aos="fade-up" data-aos-delay="200">
                        <div class="block-style-thirtyNine mt-40 text-center">
                            <div class="icon rounded-circle d-flex align-items-center justify-content-center m-auto"><img src="{{asset('frontend/images/icon/205.svg')}}" alt=""></div>
                            <h3>دفع آمن</h3>
                            <p class="pl-xl-3 pr-xl-3">نضمن سلامة الدفع </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-60">
                    <livewire:partials.product-rating-table :productId="$product->id" />
            </div>

        </div>
    </div>
    <!--
    =============================================
        Fancy Feature Forty Three
    ==============================================
    -->
    {{-- <div class="fancy-feature-fortyThree lg-container pt-100 pb-100 mt-130 mb-120 lg-pt-80 lg-pb-80 lg-mt-100 lg-mb-100">
        <div class="container">
            <div class="row align-items-center" data-aos="fade-up">
                <div class="col-lg-6">
                    <div class="title-style-eleven text-center text-md-left">
                        <h2>Releted Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="xl-container mt-60 lg-mt-40">
            <div class="product_slider_two product_slider_space">
                <div class="item">
                    <div class="product-block-two">
                        <div class="img-holder">
                            <a href="shop-details.html" class="d-flex align-items-center justify-content-center h-100">
                                <img src="images/shop/img_13.png" alt="" class="product-img tran4s">
                            </a>
                            <a href="cart.html" class="cart-icon" title="Add To Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </div> <!-- /.img-holder -->
                        <div class="product-meta">
                            <ul class="style-none d-flex justify-content-center rating">
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            </ul>
                            <a href="shop-details.html" class="product-title">Quilted Gilet With Hood</a>
                            <div class="price">$17.99</div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="product-block-two">
                        <div class="img-holder">
                            <a href="shop-details.html" class="d-flex align-items-center justify-content-center h-100">
                                <img src="images/shop/img_14.png" alt="" class="product-img tran4s">
                            </a>
                            <a href="cart.html" class="cart-icon" title="Add To Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </div> <!-- /.img-holder -->
                        <div class="product-meta">
                            <ul class="style-none d-flex justify-content-center rating">
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            </ul>
                            <a href="shop-details.html" class="product-title">Rolex Gold Watch</a>
                            <div class="price">$139.99</div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="product-block-two">
                        <div class="img-holder">
                            <a href="shop-details.html" class="d-flex align-items-center justify-content-center h-100">
                                <img src="images/shop/img_15.png" alt="" class="product-img tran4s">
                            </a>
                            <a href="cart.html" class="cart-icon" title="Add To Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </div> <!-- /.img-holder -->
                        <div class="product-meta">
                            <ul class="style-none d-flex justify-content-center rating">
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            </ul>
                            <a href="shop-details.html" class="product-title">Quilted Gilet With Hood</a>
                            <div class="price">$17.99</div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="product-block-two">
                        <div class="img-holder">
                            <a href="shop-details.html" class="d-flex align-items-center justify-content-center h-100">
                                <img src="images/shop/img_16.png" alt="" class="product-img tran4s">
                            </a>
                            <a href="cart.html" class="cart-icon" title="Add To Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </div> <!-- /.img-holder -->
                        <div class="product-meta">
                            <ul class="style-none d-flex justify-content-center rating">
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            </ul>
                            <a href="shop-details.html" class="product-title">Jogers with Black strip</a>
                            <div class="price">$217.99</div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="product-block-two">
                        <div class="img-holder">
                            <a href="shop-details.html" class="d-flex align-items-center justify-content-center h-100">
                                <img src="images/shop/img_14.png" alt="" class="product-img tran4s">
                            </a>
                            <a href="cart.html" class="cart-icon" title="Add To Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </div> <!-- /.img-holder -->
                        <div class="product-meta">
                            <ul class="style-none d-flex justify-content-center rating">
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            </ul>
                            <a href="shop-details.html" class="product-title">Rolex Gold Watch</a>
                            <div class="price">$139.99</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.xl-container -->
    </div> --}}
</div>
