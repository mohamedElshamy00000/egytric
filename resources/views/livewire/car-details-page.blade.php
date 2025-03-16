<div>

    <div class="product-details-one lg-container mt-150 rtl">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-lg-2">
                    <button class="comparison-tag" wire:click="addToComparison({{ $car->id }})">اضف الي جدول المقارنة <i class="fa fa-flag-checkered" aria-hidden="true"></i></button>
                    <div class="tab-content product-img-tab-content">
                        @foreach ($car->images as $index => $image)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="img{{$index}}" role="tabpanel" >
                                <a class="fancybox h-100 w-100 d-flex align-items-center justify-content-center" data-fancybox="" href="{{asset('storage/'.$image->image_path)}}" tabindex="-1">
                                    <img src="{{asset('storage/'.$image->image_path)}}" alt="" class="m-auto rounded">
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-1 order-lg-1">
                    <ul class="nav nav-tabs flex-lg-column product-img-tab" id="myTab" role="tablist">
                        @foreach ($car->images as $index => $image)
                        <li class="nav-item">
                            <button class="nav-link @if($loop->first) active @endif " data-toggle="tab" data-target="#img{{$index}}" type="button" role="tab" aria-controls="img{{$index}}" aria-selected="true"><img src="{{asset('storage/'.$image->image_path)}}" alt="" class="m-auto"></button>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-6 order-lg-3">
                    <div class="product-info pl-xl-5 md-mt-50 text-right">
                        <div class=" stock-tag">متوفر</div>

                        <h3 class="product-name rtl text-right">{{ $car->model }}</h3>
                        <ul class="style-none d-flex align-items-center rating">

                            @php
                                $avgRating = $car->ratings->avg('rating');
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

                            <li><a href="#">({{ $car->ratings->count() }} مراجعة)</a></li>
                        </ul>

                        <div class="price rtl text-right">
                            @if($car->offer_price == $car->msrp)
                                {{ number_format($car->msrp, 0, '.', ',') }} ج.م
                            @else

                            {{ number_format($car->msrp , 0, '.', ',') }} ج.م
                            <sub class="placeholder-price mx-2">{{ number_format($car->offer_price, 0, '.', ',') }} ج.م </sub>

                            @endif
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4">
                            <div class="color-selection mt-25 mb-25">
                                <ul class="style-none d-flex align-items-center justify-content-between">
                                    <li>
                                        <span class="mb-3">داخلية</span>
                                        <span class="carColor" style="background:{{ $car->interior_color }};"></span>
                                    </li>
                                    <li>
                                        <span>خارجية</span>
                                        <span class="carColor" style="background:{{ $car->exterior_color }};"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="availability text-right mb-10">38 قطعة متاحة  </p>

                        <div class="product-shop">
                            <div class="shop-info d-flex flex-wrap g-3">
                                <div class="">
                                    <div class="d-flex align-items-top car-feature-box">
                                        <i class="fa fa-road mb-2 ml-2 car-icon" aria-hidden="true"></i>
                                        <div class="info-meta">
                                            <h5>المدى</h5>
                                            <span class="font-rubik">{{ $car->range_km }} كم</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="d-flex align-items-top car-feature-box">
                                        <i class="fa fa-battery-full mb-2 ml-2 car-icon" aria-hidden="true"></i>
                                        <div class="info-meta">
                                            <h5>سعة البطارية</h5>
                                            <span class="font-rubik">{{ $car->battery_capacity }} كيلوواط ساعة</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="d-flex align-items-top car-feature-box">
                                        <i class="fa fa-bolt mb-2 ml-2 car-icon" aria-hidden="true"></i>
                                        <div class="info-meta">
                                            <h5>القوة الحصانية</h5>
                                            <span class="font-rubik">{{ $car->horsepower }} حصان</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="d-flex align-items-top car-feature-box">
                                        <i class="fa fa-tachometer mb-2 ml-2 car-icon" aria-hidden="true"></i>
                                        <div class="info-meta">
                                            <h5>التسارع </h5>
                                            <span class="font-rubik">{{ $car->acceleration }} ث (0-100 كم/س)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="d-flex align-items-top car-feature-box">
                                        <i class="fa fa-road mb-2 ml-2 car-icon" aria-hidden="true"></i>
                                        <div class="info-meta">
                                            <h5>كفاءة الوقود على الطريق</h5>
                                            <span class="font-rubik">{{ $car->mpge_highway }} ميل/جالون</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="d-flex align-items-top car-feature-box">
                                        <i class="fa fa-road mb-2 ml-2 car-icon" aria-hidden="true"></i>
                                        <div class="info-meta">
                                            <h5>كفاءة الوقود في المدينة</h5>
                                            <span class="font-rubik">{{ $car->mpge_city }} ميل/جالون</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-group mt-30 d-sm-flex">
                            @if($car->is_available)
                                <button wire:click="OrderThisCar({{ $car->id }}, 'immediate')" wire:loading.attr="disabled" class="cart-btn mt-15 d-block mr-0 w-100">تسليم فوري <span wire:loading wire:target="OrderThisCar({{ $car->id }}, 'immediate')">...</span> </button>
                            @else
                                <button wire:click="addToWishlist({{ $car->id }}, 'special')" wire:loading.attr="disabled" class="wishlist-btn mt-15 d-block w-100 mr-0 ">عرض سعر خاص <span wire:loading wire:target="addToWishlist({{ $car->id }}, 'special')">...</span> </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-review-tab mt-150 lg-mt-100">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item mx-3">
                        <button class="nav-link active" data-toggle="tab" data-target="#item1" type="button" role="tab" aria-selected="true">المواصفات</button>
                    </li>
                    <li class="nav-item mx-3">
                        <button class="nav-link" data-toggle="tab" data-target="#item2" type="button" role="tab"  aria-selected="false">التعليقات</button>
                    </li>
                </ul>
                <div class="tab-content mt-40 lg-mt-20">
                    <div class="tab-pane fade show active" id="item1" role="tabpanel" >
                        <div class="row gx-5">
                            <div class="col-xl-6 text-right">
                                <h5>نبذة عن السيارة:</h5>
                                <p>{!! $car->description !!}</p>
                            </div>
                            <div class="col-xl-6 text-right">
                                <h5>المميزات الرئيسية للمنتج</h5>
                                <ul class="style-none product-feature">
                                    @foreach ($car->features as $features)
                                        <li>{{ $features }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="item2" role="tabpanel" >
                        <livewire:partials.rating-table :carId="$car->id" />
                    </div>
                </div>
            </div> <!-- /.product-review-tab -->
        </div>
    </div> <!-- /.product-details-one -->


    <div class="fancy-feature-fortyThree lg-container pb-100 mt-60">
        <div class="container">
            <div class="row align-items-center rtl" data-aos="fade-up">
                <div class="col-md-7">
                    <div class="title-style-eleven text-md-left">
                        <h2>مواصفات السيارة</h2>
                    </div>
                </div>
            </div>
        </div>
        @if ($car->includes_home_charger == true)
        <div class="container mt-60">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-6 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                    <div class="counter-box-three">
                        <h2 class="number"><span class="timer" data-from="0" data-to="{{ $car->home_charging_power }}" data-speed="1200" data-refresh-interval="5">{{ $car->home_charging_power }}</span> كيلوواط</h2>
                        <p class="font-rubik">قدرة الشحن المنزلي</p>
                    </div> <!-- /.counter-box-three -->
                </div>
                <div class="col-lg-4 col-6 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="counter-box-three">
                        <h2 class="number"><span class="timer" data-from="0" data-to="{{ $car->home_charging_time_hours }}" data-speed="1200" data-refresh-interval="5">{{ $car->home_charging_time_hours }}</span> ساعات</h2>
                        <p class="font-rubik">وقت الشحن المنزلي</p>
                    </div> <!-- /.counter-box-three -->
                </div>
                <div class="col-lg-4 col-6 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200">
                    <div class="counter-box-three">
                        <h2 class="number"><span class="">{{ $car->home_charger_type }}</span></h2>
                        <p class="font-rubik">نوع الشاحن المنزلي</p>
                    </div> <!-- /.counter-box-three -->
                </div>
            </div>
        </div>
        @endif


        <div class="container mt-60 rtl">

            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0">
                        <div class="card-body table-borderless">
                            <h4 class="mb-4 text-right">مواصفات السيارة</h4>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> عدد دورات الشحن المتوقعة </div>
                                <h5 class="text-end">{{ $car->battery_cycles }} </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> ضمان البطارية </div>
                                <h5 class="text-end">{{ $car->battery_warranty }} </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> معدل تدهور البطارية السنوي </div>
                                <h5 class="text-end">{{ $car->battery_degradation_rate }}% </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> فولتية البطارية </div>
                                <h5 class="text-end">{{ $car->battery_voltage }} فولت </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> استهلاك الطاقة لكل 100 كم </div>
                                <h5 class="text-end">{{ $car->power_consumption_kwh_100km }} كيلوواط ساعة </h5>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card border-0">
                        <div class="card-body table-borderless">
                            <h4 class="mb-4 text-right">مواصفات السيارة</h4>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> التسارع من 0 إلى 100 كم/ساعة </div>
                                <h5 class="text-end">{{ $car->acceleration }} ث </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> السرعة القصوى </div>
                                <h5 class="text-end">{{ $car->top_speed }} كم/س </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> المدى </div>
                                <h5 class="text-end">{{ $car->range_km }} كم </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> إجمالي الطاقة </div>
                                <h5 class="text-end">{{ $car->total_power }} كيلوواط ({{ $car->total_power_ps }} حصان) </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> إجمالي عزم الدوران </div>
                                <h5 class="text-end">{{ $car->total_torque }} نيوتن متر </h5>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0">
                        <div class="card-body table-borderless">
                            <h4 class="mb-4 text-right">مواصفات البطارية</h4>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> عدد وحدات البطارية</div>
                                <h5 class="text-end">{{ $car->battery_modules }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> عدد خلايا البطارية</div>
                                <h5 class="text-end">{{ $car->battery_cells }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> نظام إدارة حرارة البطارية</div>
                                <h5 class="text-end">{{ $car->battery_thermal_management }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> عدد الوسائد الهوائية</div>
                                <h5 class="text-end">{{ $car->airbag_count }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> تصنيف اختبار التصادم</div>
                                <h5 class="text-end">{{ $car->crash_test_rating }}</h5>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="card border-0">
                        <div class="card-body table-borderless">
                            <h4 class="mb-4 text-right">مواصفات الأمان</h4>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> نظام تنبيه المشاة</div>
                                <h5 class="text-end">{{ $car->has_pedestrian_alert ? 'نعم' : 'لا' }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> نظام حماية البطارية</div>
                                <h5 class="text-end">{{ $car->has_battery_protection ? 'نعم' : 'لا' }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> نظام مغادرة المسار</div>
                                <h5 class="text-end">{{ $car->has_lane_departure ? 'نعم' : 'لا' }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> نظام كشف النقاط العمياء</div>
                                <h5 class="text-end">{{ $car->has_blind_spot ? 'نعم' : 'لا' }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> نظام الفرامل الطارئ</div>
                                <h5 class="text-end">{{ $car->has_emergency_brake ? 'نعم' : 'لا' }}</h5>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="card border-0">
                        <div class="card-body table-borderless">
                            <h4 class="mb-4 text-right">ابعاد السيارة</h4>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> الطول بالملم</div>
                                <h5 class="text-end">{{ $car->length_mm }} مم </h5>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> العرض بالملم</div>
                                <h5 class="text-end">{{ $car->width_mm }} مم </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> قاعدة العجلات بالملم</div>
                                <h5 class="text-end">{{ $car->wheelbase_mm }} مم </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> الارتفاع عن الأرض</div>
                                <h5 class="text-end">{{ $car->ground_clearance_mm }} مم </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> حجم صندوق الأمتعة باللتر</div>
                                <h5 class="text-end">{{ $car->cargo_volume_l }} لتر </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> وزن السيارة فارغة</div>
                                <h5 class="text-end">{{ $car->curb_weight_kg }} كجم </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> الوزن الإجمالي المسموح</div>
                                <h5 class="text-end">{{ $car->gross_weight_kg }} كجم </h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-start table-tag"><i class="fa fa-check tabel-icon-check" aria-hidden="true"></i> سعة الحمولة</div>
                                <h5 class="text-end">{{ $car->payload_capacity_kg }} كجم </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="fancy-feature-fortyThree lg-container pb-100  mb-120">
        <div class="container">
            <div class="row align-items-center rtl" data-aos="fade-up">
                <div class="col-md-7">
                    <div class="title-style-eleven text-md-left">
                        <h2>سيارات مقترحة</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-80 lg-mt-50">
            <div class="row">
                @foreach ($suggestedCars as $suggestedCar)
                <div class="col-md-3 col-sm-6">
                    <div class="product-card" car-price="{{ $suggestedCar->price }}" car-body="{{ $suggestedCar->body_type }}">
                        <div class="img-holder">
                            <a href="" class="d-flex align-items-center justify-content-center h-100">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">
                                        @foreach ($suggestedCar->images as $image)
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                <img src="{{ asset('storage/'.$image->image_path) }}" class="d-block w-100" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                            <div class="price-tag h6">{{ number_format($suggestedCar->offer_price) }} ج.م</div>
                            <div class="model-tag">{{ $suggestedCar->model }}</div>

                        </div>
                        <div class="product-meta">
                            <div class="meta-info row pb-0">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="info-item d-flex align-items-center rtl">
                                        <i class="fa fa-bolt fa-2x ml-2" aria-hidden="true"></i>
                                        <span class="fs-4">{{ $suggestedCar->range_km }} كم</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="info-item d-flex align-items-center rtl">
                                        <i class="fa fa-car fa-2x ml-2" aria-hidden="true"></i>
                                        <span class="fs-4">{{ $suggestedCar->body_type }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="info-item d-flex align-items-center rtl">
                                        <i class="fa fa-tachometer fa-2x ml-2" aria-hidden="true"></i>
                                        <span class="fs-4">{{ $suggestedCar->acceleration }}ث</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="info-item d-flex align-items-center rtl">
                                        <i class="fa fa-battery-full fa-2x ml-2" aria-hidden="true"></i>
                                        <span class="fs-4">{{ $suggestedCar->battery_capacity }} كيلو واط</span>
                                    </div>
                                </div>
                            </div>
                            <div class="action mt-3">
                                <a href="{{ route('cars.show', $suggestedCar->slug) }}" class="price-button">عرض سعر</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

</div>



