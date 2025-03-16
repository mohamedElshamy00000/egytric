<div>
    <!--
    =============================================
        Cart Page
    ==============================================
    -->
    <div class="product-details-one lg-container pt-100 lg-pt-150 rtl text-right">
        <div class="breadcrumb-area pb-70">
            <div class="container">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <nav class="breadcrumb-style-one mt-20">
                        <ol class="breadcrumb bg-white style-none m0 p0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('shop') }}">المنتجات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">عربة التسوق</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div> <!-- /.breadcrumb-area -->

        <div class="cart-section pb-100 lg-pt-180 sm-pb-50 rtl text-right">
            <div class="container">
                <form action="#" class="cart-list-form">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">المنتج</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>الإجمالي</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($cartItems as $item)
                                    <tr wire:key="{{ $item['product_id'] }}">
                                        <td class="product-thumbnails"><a href="{{ route('shop.products.show', $item['slug']) }}" class="product-img"><img src="{{ asset('storage/'.$item['images'][0]) }}" alt=""></a></td>
                                        <td class="product-info">
                                            <a href="{{ route('shop.products.show', $item['slug']) }}" class="product-name">{{ $item['name'] }}</a>
                                            <div class="serial">#{{ $item['slug'] }} {{ $item['product_id'] }}</div>
                                            <ul class="style-none">
                                                {{-- <li class="size">Size: {{ $item['size'] }}</li> --}}
                                            </ul>
                                        </td>
                                        <td class="price"><span>{{ Number::currency($item['unit_amount'], 'EGP') }}</span></td>
                                        <td class="quantity">
                                            <ul class="order-box style-none">
                                                <li><div class="btn value-decrease" wire:click="decrementQuantity({{ $item['product_id'] }})">-</div></li>
                                                <li><input type="text" min="1" max="22" value="{{ $item['quantity'] }}" readonly class="product-value val"></li>
                                                <li><div class="btn value-increase" wire:click="incrementQuantity({{ $item['product_id'] }})">+ </div></li>
                                            </ul>
                                        </td>
                                        <td class="price total-price"><span>{{ Number::currency($item['total_amount'], 'EGP') }}</span></td>
                                        <td><a href="#" wire:click.prevent="removeFromCart({{ $item['product_id'] }})" class="remove-product" wire:loading.remove wire:target="removeFromCart({{ $item['product_id'] }})">x</a> <div class="spinner-border spinner-border-sm text-dark" wire:loading wire:target="removeFromCart({{ $item['product_id'] }})" role="status"></div> </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 font-weight-bold"><a href="{{ route('shop') }}">  لا يوجد منتجات في العربة</a></td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div> <!-- /.table-responsive -->

                    <div class="d-sm-flex justify-content-between cart-footer">
                        {{-- <div class="coupon-section d-flex flex-column">
                            <div class="coupon-form d-lg-flex align-items-center">
                                <input type="text" placeholder="Enter your code">
                                <button class="theme-btn-seven md-mt-20 sm-mb-20">Apply Coupne</button>
                            </div> <!-- /.coupon-form -->
                            <div class="mt-auto"><button class="theme-btn-seven update-cart-button">Update cart</button></div>
                        </div> <!-- /.coupon-section --> --}}

                        <div class="cart-total-section d-flex flex-column sm-pt-40">
                            <table class="cart-total-table">
                                <tbody>
                                    <tr>
                                        <th>المجموع الفرعي</th>
                                        <td>{{ Number::currency($grandTotal, 'EGP') }}</td>
                                    </tr>
                                    <tr>
                                        <th>تكلفة التوصيل</th>
                                        <td>{{ Number::currency(0, 'EGP') }}</td>
                                    </tr>
                                    <tr>
                                        <th>الضريبة</th>
                                        <td>{{ Number::currency(0, 'EGP') }}</td>
                                    </tr>
                                    <tr>
                                        <th>المجموع الكلي</th>
                                        <td>{{ Number::currency($grandTotal , 'EGP') }}</td>
                                    </tr>
                                </tbody>
                            </table> <!-- /.cart-total-table -->
                            @if ($cartItems)
                                <a href="{{ route('shop.checkout') }}" class="theme-btn-seven checkout-process mt-30">الدفع</a>
                            @endif
                        </div>
                    </div> <!-- /.cart-footer -->
                </form>
            </div> <!-- /.container -->
        </div> <!-- /.cart-section -->


        <div class="lg-container position-relative mt-lg-0 md-mt-150" id="testimonials">
            <div class="container">

                <div class="main-content position-relative mt-60">
                    <div class="clientSliderEight row">
                        @forelse ($testimonials as $testimonial)
                        <div class="item rtl">
                            <div class="bg-wrapper" style="background-color: #f5f5f5 !important;">
                                <div class="d-flex align-items-center">
                                    <div class="text-right">
                                        <h6 class="name">{{ $testimonial->author }}</h6>
                                        <span class="region">{{ $testimonial->author_position }}</span>
                                    </div>
                                </div>
                                <p class="pt-25 pb-30 text-right">“ {{ $testimonial->content }} “</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <ul class="d-flex justify-content-center rating">
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    </ul>
                                    <img src="{{ asset('frontend/images/icon/198.svg') }}" alt="">
                                </div>
                            </div> <!-- /.bg-wrapper -->
                            </div>
                        @empty
                            <div class="partner-slider-two col-12 justify-content-center align-items-center">
                                <p class="text-center text-lg pb-0 text-white">لا يوجد تعليقات حاليا </p>
                            </div>
                        @endforelse
                    </div>
                </div> <!-- /.main-content -->
            </div>
        </div>

    </div>

</div>
