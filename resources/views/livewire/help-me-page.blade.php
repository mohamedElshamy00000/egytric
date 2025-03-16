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
                        <h3 class="h3">نساعدك على اختيار السيارة الكهربائية المناسبة لك</h3>
                        <p>غير متأكد من السيارة الكهربائية المناسبة لك؟ دع إيچيتريك يساعدك بنا ًء على احتياجاتك وأسلوب حياتك. سجل الآن لتلقي استشارة مخصصة واكتشف أفضل الخيارات المتاحة لك.</p>
                    </div>
                </div>
            </div>
        </div> <!-- /.bg-wrapper -->
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="fancy-feature-fortyThree lg-container pb-100 mb-120 lg-pt-80 lg-pb-80 lg-mt-100 lg-mb-100">
        <div class="container mt-5 rtl text-right">
            <div class="row">
                <div class="col-md-6">
                    <div class="row align-items-center rtl">
                        <div class="col-md-12">
                            <div class="title-style-eleven text-md-left">
                                <h2>نساعدك على اختيار السيارة الكهربائية المثالية</h2>
                                <p class="text-muted mb-4 pt-4">أخبرنا عن تفضيلاتك واحتياجاتك، وسنقدم لك أفضل الخيارات المتوافقة مع أسلوب حياتك وميزانيتك</p>
                            </div>
                        </div>
                    </div>

                    <form wire:submit.prevent="submit">
                        <!-- Progress bar -->
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: {{ $currentStep * 20 }}%"></div>
                        </div>

                        @if($currentStep === 1)
                            <div class="step-content" wire:key="step-1">
                                <div class="form-style-light m-0 shadow-none p-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group-meta mb-35">
                                                <label>الإسم</label>
                                                <input type="text" wire:model="name" placeholder="الإسم">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <div class="input-group-meta mb-35">
                                                <label>الهاتف</label>
                                                <input type="text" wire:model="phone" placeholder="الهاتف">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <div class="input-group-meta mb-35">
                                                <label>البريد الإلكتروني</label>
                                                <input type="email" wire:model="email" placeholder="gobapubo@jogi.net">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Step 2: Living Situation -->
                        @if($currentStep === 2)
                            <div class="step-content" wire:key="step-2">
                                <div class="form-style-light m-0 shadow-none p-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group-meta mb-35">
                                                <label>المحافظة</label>
                                                <input type="text" wire:model="city" placeholder="المحافظة">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group-meta mb-35">
                                                <label>المنطقة</label>
                                                <input type="text" wire:model="area" placeholder="المنطقة">
                                                @error('area')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Step 3: Travel Habits -->
                        @if($currentStep === 3)
                            <div class="step-content" wire:key="step-3">
                                <div class="form-style-light m-0 shadow-none p-0">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="mb-3">هل تستخدم السيارة للسفر؟</label>
                                            <div class="row">

                                                <div class="col-6">
                                                    <label class="btn btn-outline border btn-active-light-primary d-flex flex-stack text-start p-3 mb-20">
                                                        <div class="d-flex align-items-center mr-2">
                                                            <div class="form-check form-check-custom form-check-solid form-check-primary mr-6">
                                                                <input class="form-check-input" name="useCarToTravel" type="radio" value="1" wire:model="useCarToTravel"/>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                    نعم
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </label>

                                                </div>
                                                <div class="col-6">

                                                    <label class="btn btn-outline border btn-active-light-primary d-flex flex-stack text-start p-3 mb-20">
                                                        <div class="d-flex align-items-center mr-2">
                                                            <div class="form-check form-check-custom form-check-solid form-check-primary mr-6">
                                                                <input class="form-check-input" name="useCarToTravel" type="radio" value="0" wire:model="useCarToTravel"/>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                    لا
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>

                                                @error('useCarToTravel')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <div class="col-12">
                                                    <label class="mb-3">نوع السكن</label>

                                                    <label class="btn btn-outline border btn-active-light-primary d-flex flex-stack text-start p-3 mb-20">
                                                        <div class="d-flex align-items-center mr-2">
                                                            <div class="form-check form-check-custom form-check-solid form-check-primary mr-6">
                                                                <input class="form-check-input" type="radio" name="propertyType" value="apartment" wire:model="propertyType"/>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                    شقة
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </label>

                                                    <label class="btn btn-outline border btn-active-light-primary d-flex flex-stack text-start p-3 mb-20">
                                                        <div class="d-flex align-items-center mr-2">
                                                            <div class="form-check form-check-custom form-check-solid form-check-primary mr-6">
                                                                <input class="form-check-input" type="radio" name="propertyType" value="house" wire:model="propertyType"/>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                    منزل
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </label>

                                                    <label class="btn btn-outline border btn-active-light-primary d-flex flex-stack text-start p-3 mb-20">
                                                        <div class="d-flex align-items-center mr-2">
                                                            <div class="form-check form-check-custom form-check-solid form-check-primary mr-6">
                                                                <input class="form-check-input" type="radio" name="propertyType" value="independent" wire:model="propertyType"/>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                    بيت مستقل
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </label>

                                                    <label class="btn btn-outline border btn-active-light-primary d-flex flex-stack text-start p-3 mb-20">
                                                        <div class="d-flex align-items-center mr-2">
                                                            <div class="form-check form-check-custom form-check-solid form-check-primary mr-6">
                                                                <input class="form-check-input" type="radio" name="propertyType" value="villa" wire:model="propertyType"/>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                    فيلا
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </label>

                                                    <label class="btn btn-outline border btn-active-light-primary d-flex flex-stack text-start p-3 mb-20">
                                                        <div class="d-flex align-items-center mr-2">
                                                            <div class="form-check form-check-custom form-check-solid form-check-primary mr-6">
                                                                <input class="form-check-input" type="radio" name="propertyType" value="other" wire:model="propertyType"/>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                    اخرى
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </label>

                                                    @error('propertyType')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Step 4: Family Needs -->
                        @if($currentStep === 4)
                            <div class="step-content" wire:key="step-4">
                                <!-- Family needs questions here -->
                                <div class="form-style-light m-0 shadow-none p-0">
                                    <div class="row">

                                        {{-- ميزانية والبراند المفضل و ماهو الاستخدام الاساسي للسيارة و التفضيلا الخاصة --}}
                                        <div class="col-12">
                                            <label for="brands" class="mb-3">البراند المفضل</label>
                                            <ul class="list-unstyled tag-list  mb-35">
                                                @foreach ($brands as $brand)
                                                    <li class="tag-item" wire:key="brand-{{ $brand->id }}">
                                                        <div class="custom-checkbox mb-0">
                                                            <input type="checkbox" class="filter-checkbox brand-filter" wire:model.live="selected_brands" id="{{ $brand->slug }}" value="{{ $brand->id }}">
                                                            <label for="{{ $brand->slug }}">{{ $brand->name }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @error('selected_brands')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-10">
                                            <div class="custom-checkbox mb-0">
                                                <input type="checkbox" class="filter-checkbox brand-filter" wire:model.live="is_quote_request" id="quoteRequest">
                                                <label for="quoteRequest" class="h2">طلب عرض سعر</label>
                                            </div>
                                            @if($is_quote_request)
                                                <div class="form-group mb-4">
                                                    <label for="car" class="mb-3">اختر السيارة المفضلة لديك</label>
                                                    <select class="form-control" id="car" wire:model.live="car_id">
                                                        <option value="">اختر السيارة</option>
                                                        @foreach(\App\Models\ElectricCar::all() as $car)
                                                            <option value="{{ $car->id }}">{{ $car->model }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="priceRange" class="mb-3">ميزانيتك</label>
                                            <div class="price-range-container mb-35">
                                                <div class="price-labels d-flex justify-content-between" wire:key="price-range">
                                                    <span class="min-price h6">{{ Number::currency(10000, 'EGP') }}</span>
                                                    <span class="max-price h6">{{ Number::currency(50000000, 'EGP') }}</span>
                                                </div>
                                                <input type="range" id="priceRange" min="10000" max="50000000" step="10000" wire:model.live="price_range" value="{{ $price_range }}">
                                                {{ Number::currency($price_range, 'EGP') }}
                                            </div>
                                            @error('price_range')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($currentStep === 5)
                            <div class="step-content" wire:key="step-5">
                                <div class="form-style-light m-0 shadow-none p-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group-meta lg">
                                                <label for="comment">تفضيلا خاصة</label>
                                                <textarea wire:model="comment" placeholder="اكتب هنا..."></textarea>
                                            </div>
                                            @error('comment')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- Navigation buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            @if($currentStep > 1 )
                                <button type="button" class="theme-btn-six lg" wire:click="previousStep">السابق</button>
                            @endif

                            @if($currentStep < 5)
                                <button type="button" class="theme-btn-six lg nextStep" wire:loading.attr="disabled" wire:click="nextStep">التالي <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                            @endif

                            @if($currentStep === 5)
                                <button type="submit" class="theme-btn-six lg submit" wire:loading.attr="disabled">إرسال <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                            @endif


                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-end">
                        <img src="{{ asset('frontend/images/imageslogo.png') }}" width="80%" alt="help me">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
