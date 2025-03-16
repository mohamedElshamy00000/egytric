<div>

    <div class="fancy-hero-three">
        <div class="shapes shape-one"></div>
        <div class="shapes shape-two"></div>
        <div class="shapes shape-three"></div>
        <div class="shapes shape-four"></div>
        <div class="shapes shape-five"></div>
        <div class="shapes shape-six"></div>
        <div class="bg-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 m-auto">
                        <h3 class="heading h4">جدول مقارنة السيارات</h3>
                        <nav aria-label="breadcrumb rtl">
                            <ol class="breadcrumb m-auto bg-transparent justify-content-center">
                                <li class="breadcrumb-item active" aria-current="page">جدول مقارنة السيارات</li>
                                <li class="breadcrumb-item"><a href="index.html">الصفحة الرئيسية</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- /.bg-wrapper -->
    </div>


    <div class="pricing-section-eight lg-container mb-150 md-mt-100 rtl text-right" id="pricing">
        <div class="container pt-80">
            @if (count($comparisonItems) > 0)
                <div class="row no-gutters position-relative">
                    <div class="col-lg-3 pr-list-wrapper d-none d-lg-block text-center">
                        <ul>
                            <li class="st-r d-none">صور المنتج</li>
                            <li class="h-80">الاسم</li>
                            <li class="h-160">العلامة التجارية</li>
                            <li class="h-80">السعر</li>
                            <li class="h-80">نوع الهيكل</li>
                            <li class="h-80">سعة البطارية</li>
                            <li class="h-80">القدرة</li>
                            <li class="h-80">وقت الشحن المنزلي</li>
                            <li class="h-80">وقت الشحن المحطة</li>
                            <li class="h-80">التسارع</li>
                            <li class="h-80">سنة الصنع</li>
                            <li class="h-80">اللون الخارجي</li>
                            <li class="h-80">اللون الداخلي</li>
                            <li class="h-80">الوصف</li>
                        </ul>
                    </div>
                    <div class="col-lg-9 pr-table-wrapper">
                        <div class="row no-gutters">
                            @foreach ($comparisonItems as $car)
                                <div class="col-md-4 pr-column">
                                    <div class="pr-header">
                                        <button class="comparison-tag" wire:click="removeCarFromComparison({{ $car->id }})">حزف من المقارنة <i class="fa fa-trash" aria-hidden="true"></i></button>

                                        <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" class="h-200">
                                    </div>
                                    <div class="pr-body">
                                        <ul>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->model }}</span>
                                            </li>
                                            <li>
                                                <img src="{{ asset('storage/' . $car->brand->image) }}" alt="" class="m-auto">
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->msrp }} جنيه مصري.</span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->body_type }}</span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->battery_capacity }} kWh</span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->horsepower }} kW</span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->charging_time_ac }} ساعة</span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->charging_time_dc }} ساعة</span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->acceleration }} sec</span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">{{ $car->year }}</span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">
                                                    <span style="background-color: {{ $car->exterior_color }}; width: 20px; height: 20px; display: inline-block;" class="rounded-circle"></span>
                                                </span>
                                            </li>
                                            <li class="h-80">
                                                <span class="pr-text">
                                                    <span style="background-color: {{ $car->interior_color }}; width: 20px; height: 20px; display: inline-block;" class="rounded-circle"></span>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="p-2">
                                        <div class="trial-text text-right m-0 p-0">{!! $car->description !!}</div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Demo data for additional columns -->
                            @for ($i = count($comparisonItems); $i < 3; $i++)
                                <div class="col-md-4 pr-column">
                                    <div class="pr-header d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('frontend/images/icon/car.svg') }}" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="pr-body">
                                        <ul>
                                            <li class="h-80"><a href="{{ route('cars') }}" class="pr-text">اضف سيارة للمقارنة</a></li>
                                            <li></li>
                                            <li class="h-80"><span class="pr-text">----</span></li>
                                            <li class="h-80"><span class="pr-text">----</span></li>
                                            <li class="h-80"><span class="pr-text">----</span></li>
                                            <li class="h-80"><span class="pr-text">----</span></li>
                                            <li class="h-80"><span class="pr-text">----</span></li>
                                            <li class="h-80"><span class="pr-text">----</span></li>
                                            <li class="h-80"><span class="pr-text">----</span></li>
                                            <li class="h-80"><span class="pr-text">----</span></li>
                                            <li class="h-80"><span class="pr-text"><span style="background-color: #000; width: 20px; height: 20px; display: inline-block;" class="rounded-circle"></span></span></li>
                                            <li class="h-80"><span class="pr-text"><span style="background-color: #fff; width: 20px; height: 20px; display: inline-block;" class="rounded-circle"></span></span></li>
                                        </ul>
                                    </div>
                                    <div class="p-2">
                                        <div class="trial-text m-0 p-0">-----------</div>
                                    </div>
                                </div>
                            @endfor

                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-center">
                        <p>لا توجد سيارات في جدول المقارنة.</p>
                        <a href="{{ route('cars') }}" class="text-dark fw-bold mt-3">اضافة سيارات</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
