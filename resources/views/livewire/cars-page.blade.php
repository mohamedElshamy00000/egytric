<div>
    <div class="doc-container full-width top-border border-bottom mb-100 rtl text-right pl-0">
        <div class="clearfix">
            <div class="row flex-xl-nowrap no-gutters">
                <!-- ****************************** cars ********************************* -->
                <div class="col-md-3 col-xl-2 doc-sidebar">
                    <div class="clearfix">
                        <button class="btn btn-link d-md-none collapsed" type="button" data-target="#doc-sidebar-nav" aria-controls="doc-sidebar-nav" aria-expanded="false" aria-label="Toggle docs navigation"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path></svg></button>
                    </div>
                    <nav class="doc-links collapse clearfix nav-fix" id="doc-sidebar-nav">

                        <ul class="list-item">
                            <li class="">
                                <h5 class="mb-3">الماركات</h5>
                                <ul class="list-unstyled tag-list">
                                    @foreach ($brands as $brand)
                                        <li class="tag-item" wire:key="brand-{{ $brand->id }}">
                                            <div class="custom-checkbox mb-0">
                                                <input type="checkbox" class="filter-checkbox brand-filter" wire:model.live="selected_brands" id="{{ $brand->slug }}" value="{{ $brand->id }}">
                                                <label for="{{ $brand->slug }}">{{ $brand->name }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="">
                                <h5 class="mb-3">هيكل السيارة</h5>
                                <ul class="">
                                    @foreach ($carBodyTypes as $carBodyType)
                                        <li>
                                            <div class="custom-checkbox" wire:key="{{ $carBodyType }}">
                                                <input type="checkbox" class="filter-checkbox" wire:model.live="selected_body_types" id="{{ $carBodyType }}" value="{{ $carBodyType }}">
                                                <label for="{{ $carBodyType }}">{{ $carBodyType }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="">
                                <h5 class="mb-3">موديل السيارة</h5>
                                <ul class="">
                                    <li>
                                        <select wire:model.live="model" class="form-control text-right">
                                            <option value="">كل الموديلات</option>
                                            @foreach($models as $carModel)
                                                <option value="{{ $carModel }}">{{ $carModel }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                </ul>
                            </li>

                            <li class="">
                                <h5 class="mb-3">سنة الصنع</h5>
                                <ul class="">
                                    <li>
                                        <select wire:model.live="year" class="form-control text-right">
                                            <option value="">الكل</option>
                                            @foreach($years as $carYear)
                                                <option value="{{ $carYear }}">{{ $carYear }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                </ul>
                            </li>

                            <li class="">
                                <h5 class="mb-3">السرعة القصوى</h5>
                                <ul class="">
                                    <li>
                                        <div class="price-range-container">
                                            <input type="range"
                                                wire:model.live="max_speed"
                                                class="form-range"
                                                min="0"
                                                max="350"
                                                step="10">
                                            <div class="d-flex justify-content-between">
                                                <span class="h6">0 km/h</span>
                                                <span class="h6">{{ $max_speed ?? 350 }} km/h</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="">
                                <h5 class="mb-3">السعر</h5>
                                <ul class="">
                                    <li>
                                        <div class="price-range-container">
                                            <div class="price-labels d-flex justify-content-between">
                                                <span class="min-price h6">{{ Number::currency(10000, 'EGP') }}</span>
                                                <span class="max-price h6">{{ Number::currency(50000000, 'EGP') }}</span>
                                            </div>
                                            <input type="range" id="priceRange" min="" max="50000000" step="10000" wire:model.live="price_range" value="{{ $price_range }}">
                                            {{ Number::currency($price_range, 'EGP') }}
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <h5 class="mb-3">الحالة</h5>
                                <ul class="">
                                    <li>
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="filter-checkbox brand-filter" id="available_now" checked wire:model.live="available_now">
                                            <label for="available_now">متوفر فوري</label>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="">
                                <h5 class="mb-3">المدي</h5>
                                <ul class="range-filters">
                                    <li>
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="filter-checkbox" id="range_300_500" wire:model.live="range" value="300-500">
                                            <label for="range_300_500">300-500 km</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="filter-checkbox" id="range_500_800" wire:model.live="range" value="500-800">
                                            <label for="range_500_800">500-800 km</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="filter-checkbox" id="range_800_plus" wire:model.live="range" value="800+">
                                            <label for="range_800_plus">800+ km</label>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav> <!-- /.doc-links -->
                </div> <!-- /.doc-sidebar -->
                <!-- ****************************** DOC MAIN BODY ********************************* -->
                <main class="col-md-9 col-xl-10 doc-main-body">
                    <h3 class="d-flex align-items-center"><img src="{{ asset('frontend/images/icon/car.svg') }}" class="ml-2" alt=""> اختر سيارتك الكهربائية في مصر</h3>
                    <div class="row">
                        @forelse ($eCars as $eCar)
                            <div class="col-md-3 col-sm-6">
                                <div class="product-card" car-price="{{ $eCar->offer_price }}" car-body="{{ $eCar->body_type }}">
                                    <div class="img-holder">
                                        <a href="" class="d-flex align-items-center justify-content-center h-100">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                                                <div class="carousel-inner">
                                                    @foreach ($eCar->images as $image)
                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                            <img src="{{ asset('storage/'.$image->image_path) }}" class="d-block w-100" alt="">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </a>
                                        <div class="price-tag h6">{{ number_format($eCar->offer_price) }} ج.م</div>
                                        <div class="model-tag">{{ $eCar->model }}</div>

                                    </div>
                                    <div class="product-meta">
                                        <div class="meta-info row pb-0">
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <div class="info-item d-flex align-items-center justify-content-start rtl">
                                                    <i class="fa fa-bolt fa-2x ml-2" aria-hidden="true"></i>
                                                    <span class="h6 mb-0">{{ $eCar->range_km }} km</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <div class="info-item d-flex align-items-center justify-content-start rtl">
                                                    <i class="fa fa-car fa-2x ml-2" aria-hidden="true"></i>
                                                    <span class="h6 mb-0">{{ $eCar->body_type }} </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <div class="info-item d-flex align-items-center justify-content-start rtl">
                                                    <i class="fa fa-tachometer fa-2x ml-2" aria-hidden="true"></i>
                                                    <span class="h6 mb-0">{{ $eCar->acceleration }} s</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <div class="info-item d-flex align-items-center justify-content-start rtl">
                                                    <i class="fa fa-battery-full fa-2x ml-2" aria-hidden="true"></i>
                                                    <span class="h6 mb-0">{{ $eCar->battery_capacity }} kWh</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action mt-3">
                                            <a href="{{ route('cars.show', $eCar->slug) }}" class="price-button">عرض سعر</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="partner-slider-two d-flex col-12 justify-content-center align-items-center">
                                <p class="text-center text-lg pb-0">لا يوجد حاليا </p>
                                <img src="{{ asset('frontend/images/icon/61.svg') }}" class="mr-3" width="60px" alt="">
                            </div>
                        @endforelse
                    </div>

                    {{ $eCars->links('vendor.pagination.custom') }}
                </main> <!-- /.doc-main-body -->
                <nav class="d-none d-xl-block col-xl-2 doc-sideNav" style="
                    background: url({{ asset('frontend/images/Frameee.svg') }});height: 100vh;
                    background-repeat: repeat;
                    height: 100vh;
                    background-size: cover;">
                    <nav class="main-side-nav px-3">
                        <a href="{{ route('cars') }}" class="fancy-short-banner-two">
                            <div class="content-wrapper">
                                <div class="bg-wrapper d-lg-flex p-3 flex-column text-right" style="background-color: #191e18">
                                    <h4 class="text-white d-flex align-items-center"> <img src="{{ asset('frontend/images/icon/114.svg') }}" style="background: #FFF;border-radius: 4px;padding: 6px;margin-left: 11px;width: 40px;" alt=""> تصفح محطات الشحن</h4>
                                    <div class="bubble-one"></div>
                                    <div class="bubble-two"></div>
                                    <div class="bubble-three"></div>
                                    <div class="bubble-four"></div>
                                    <div class="bubble-five"></div>
                                </div> <!-- /.bg-wrapper -->
                            </div> <!-- /.content-wrapper -->
                        </a>

                        <a href="{{ route('shop') }}" class="fancy-short-banner-two mt-3">
                            <div class="content-wrapper">
                                <div class="bg-wrapper d-lg-flex p-3 flex-column text-right" style="background-color: #191e18">
                                    <h4 class="text-white d-flex align-items-center"> <img src="{{ asset('frontend/images/icon/75.svg') }}" style="background: #FFF;border-radius: 4px;padding: 6px;margin-left: 11px;" alt=""> تصفح المنتجات والاكسسوارات</h4>
                                    <div class="bubble-one"></div>
                                    <div class="bubble-two"></div>
                                    <div class="bubble-three"></div>
                                    <div class="bubble-four"></div>
                                    <div class="bubble-five"></div>
                                </div> <!-- /.bg-wrapper -->
                            </div> <!-- /.content-wrapper -->
                        </a>

                    </nav>

                </nav>

            </div>
        </div>
    </div>
</div>

