
<div>
    <div class="hero-banner-fifteen lg-container border-bottom overflow-hidden">
        <div class="container-fluid" >
            <div class="position-relative">
                <div class="row">
                    <div class="col-xl-6 col-md-6 m-auto">
                        <div class="hero-content">
                            <h1 class="h2" data-aos="fade-right">{{$allsetting->where('name', 'site_header_title')->first()->payload}}</h1>
                            <p class="hero-sub-heading" data-aos="fade-right" data-aos-delay="100">{{$allsetting->where('name', 'site_header_sub_title')->first()->payload}}</p>
                            <div class="d-sm-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                                <a href="#charging-stations" class="shop-btn tran3s mr-4 rounded">محطات الشحن</a>
                                <a href="{{ route('help-me-choose') }}" class="shop-outline-btn tran3s mr-4 rounded">ساعدني علي الاختيار</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-4 pr-0" data-aos="fade-left">
                        <img src="{{ asset('frontend/images/Frame 1261158232.png') }}" alt="" class="product-img rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="partner-slider-two mt-80 mb-40 md-mt-80">
        <div class="container">
            <div class="row align-items-center rtl">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <div class="title-style-eleven text-right mb-40">
                        <h2>تصفح العلامات التجارية</h2>
                        {{-- <p class="text-muted my-3">استعرض حسب العلامة التجارية</p> --}}
                    </div>
                    {{-- show all btn --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('cars') }}" class="text-muted">عرض الكل <i class="fas fa-arrow-left fw-normal mr-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="partnerSliderTwo">
                @foreach  ($brands as $brand)
                <div class="item" wire:key="{{$brand->id}}">
                    <a href="{{ route('cars', ['selected_brands[0]' => $brand->id]) }}" class="border border-2 round-bg img-meta d-flex align-items-center justify-content-center flex-column">
                        <img src="{{ asset('storage/' .$brand->image) }}" height="auto" style="max-width: 50px" alt="{{ $brand->name }}">
                        <p class="m-0 p-0 small">{{ $brand->name }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- <div class="fancy-short-banner-ten hero-banner-five mt-100 md-mt-80 border-top border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 text-right">
                    <h2>كل ما تحتاج لعالم السيارات الكهربائية</h3>
                    <p class="hero-sub-heading">مقارنة مفصلة للطرازات واكسسوارات لتعزيز تجربتك.</p>
                </div>
            </div>
            <div class="d-sm-flex align-items-center justify-content-end button-group border-0">
                <a href="{{ route('car-comparison') }}" class="d-flex align-items-center ios-button direction-rtl">
                    <i class="fa fa-car icon width-lg" aria-hidden="true" class="icon"></i>
                    <div>
                        <strong style="font-size: 14px;" class="mb-0">جدول مقارنة السيارات</strong>
                    </div>
                </a>
                <a href="{{ route('cars') }}" class="d-flex align-items-center windows-button bg-white border-0">
                    <i class="fa fa-shopping-cart icon width-lg" aria-hidden="true" class="icon" ></i>
                    <div>
                        <strong style="font-size: 14px;" class="mb-0">عرض احدث الإصدارات</strong>
                    </div>
                </a>
            </div>
        </div>

    </div> --}}

    <div class="fancy-short-banner-ten hero-banner-five mt-100 md-mt-80 border-top border-bottom">
        <div class="video-background">
            <video autoplay loop muted>
                <source src="{{$allsetting->where('name', 'site_video')->first()->payload}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <!-- Overlay Div -->
            <div class="overlay"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 text-right">
                    <h2 class="text-white">كل ما تحتاج لعالم السيارات الكهربائية</h2>
                    <p class="hero-sub-heading text-white">مقارنة مفصلة للطرازات واكسسوارات لتعزيز تجربتك.</p>
                </div>
            </div>
            <div class="d-sm-flex align-items-center justify-content-end button-group border-0">
                <a href="{{ route('car-comparison') }}" class="d-flex align-items-center ios-button direction-rtl">
                    <i class="fa fa-car icon width-lg" aria-hidden="true"></i>
                    <div>
                        <strong style="font-size: 14px;" class="mb-0">جدول مقارنة السيارات</strong>
                    </div>
                </a>
                <a href="{{ route('cars') }}" class="d-flex align-items-center windows-button bg-white border-0">
                    <i class="fa fa-shopping-cart icon width-lg" aria-hidden="true"></i>
                    <div>
                        <strong style="font-size: 14px;" class="mb-0">عرض احدث الإصدارات</strong>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="block-style-eighteen pt-150 pb-150">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 order-lg-last text-right">
                    <div class="text-wrapper">
                        <h3 class="title" style="line-height: 1.5em;">ليه تشتري سيارة <span>بنزين</span> كهرباء؟</h3>
                        <p>اكتشف مزايا السيارات الكهربائية</p>

                    </div> <!-- /.text-wrapper -->
                </div>
                <div class="col-lg-7 order-lg-first">
                    <div class="screen-holder-two">
                        <img src="{{ asset('frontend/images/pngwing.com.png') }}" alt="">
                    </div>
                </div>
            </div>

        </div>
        <div class="block-style-one mt-5">
            <div class="container">
                <div class="row">
                    <div class=" col-sm-6 aos-init aos-animate" data-aos="fade-up">
                        <div class="block-style-twentySeven py-4">
                            <div class="icon d-flex align-items-center justify-content-center m-0 h4 text-muted"><i class="fas fa-tools"></i></div>
                            <h5 class="font-gordita mt-3">تكلفة ترخيص وصيانة أقل</h5>
                        </div>
                    </div>
                    <div class=" col-sm-6 aos-init aos-animate" data-aos="fade-up">
                        <div class="block-style-twentySeven py-4">
                            <div class="icon d-flex align-items-center justify-content-center m-0 h4 text-muted"><i class="fas fa-battery-full"></i></div>
                            <h5 class="font-gordita mt-3">نفس المدى بتكلفة شحن ٢٥٪ من تكلفة البنزين</h5>
                        </div>
                    </div>

                    <div class=" col-sm-6 aos-init aos-animate" data-aos="fade-up">
                        <div class="block-style-twentySeven py-4">
                            <div class="icon d-flex align-items-center justify-content-center m-0 h4 text-muted"><i class="fas fa-bolt"></i></div>
                            <h5 class="font-gordita mt-3">تجربة قيادة أكثر هدوءا وراحة</h5>
                        </div>
                    </div>

                    <div class=" col-sm-6 aos-init aos-animate" data-aos="fade-up">
                        <div class="block-style-twentySeven py-4">
                            <div class="icon d-flex align-items-center justify-content-center m-0 h4 text-muted"><i class="fas fa-road"></i></div>
                            <h5 class="font-gordita mt-3">أداء غير مسبوق وتسارع خاطف</h5>
                        </div>
                    </div>

                    {{-- <div class=" col-sm-6 aos-init aos-animate" data-aos="fade-up">
                        <div class="block-style-twentySeven py-4">
                            <div class="icon d-flex align-items-center justify-content-center m-0 h4 text-muted"><i class="fas fa-truck-moving"></i></div>
                            <h5 class="font-gordita mt-3">دعم متزايد للبنية التحتية في مصر</h5>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="fancy-feature-thirtyOne pt-120 pb-160 md-pt-80 md-pb-100" style="background-color: #E8F4B4;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class=" text-center pb-50 md-pb-20">
                        <h2>ما نقدمه</h2>
                        <p>كل ما تحتاجه لتجربة السيارات الكهربائية في مصر</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="block-style-thirtyTwo d-flex text-right">
                        <div class="icon d-flex align-items-center justify-content-center"><img src="{{ asset('frontend/images/icon/178.svg') }}" alt=""></div>
                        <div class="text">
                            <h4>استشارات متخصصة</h4>
                            <p>احصل على المشورة الفنية والمالية لتسهيل اقتناء سيارتك الكهربائية بأفضل الشروط والأسعار.</p>
                            <a href="#" class="tran3s"><img src="{{ asset('frontend/images/icon/182.svg') }}" alt=""></a>
                        </div>
                    </div> <!-- /.block-style-thirtyTwo -->
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="block-style-thirtyTwo d-flex text-right">
                        <div class="icon d-flex align-items-center justify-content-center"><img src="{{ asset('frontend/images/icon/179.svg') }}" alt=""></div>
                        <div class="text">
                            <h4>خطط رحلتك</h4>
                            <p>
                                استخدم خدمة تخطيط الرحلات لتحديد أفضل مسارات القيادة وتحديد مواقع محطات الشحن على طول الطريق لرحلة خالية من القلق.
                            </p>
                            <a href="#" class="tran3s"><img src="{{ asset('frontend/images/icon/182.svg') }}" alt=""></a>
                        </div>
                    </div> <!-- /.block-style-thirtyTwo -->
                </div>
                <div class="col-md-6" data-aos="fade-up">
                    <div class="block-style-thirtyTwo d-flex text-right">
                        <div class="icon d-flex align-items-center justify-content-center"><img src="{{ asset('frontend/images/icon/180.svg') }}" alt=""></div>
                        <div class="text">
                            <h4>شراكات مع محطات الشحن</h4>
                            <p>
                                استفد من شراكاتنا مع أفضل محطات الشحن الكهربائي لضمان توفير وصول مريح وسريع لشحن سيارتك في مصر.
                            </p>
                            <a href="#" class="tran3s"><img src="{{ asset('frontend/images/icon/182.svg') }}" alt=""></a>
                        </div>
                    </div> <!-- /.block-style-thirtyTwo -->
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="block-style-thirtyTwo d-flex text-right">
                        <div class="icon d-flex align-items-center justify-content-center"><img src="{{ asset('frontend/images/icon/181.svg') }}" alt=""></div>
                        <div class="text">
                            <h4>دعم فني عند الطلب</h4>
                            <p>تمتع بخدمة دعم فني سريعة وف ّعالة لمساعدتك في الحلول الفورية لأي استفسارات أو مشاكل قد تواجه سيارتك الكهربائية.</p>
                            <a href="#" class="tran3s"><img src="{{ asset('frontend/images/icon/182.svg') }}" alt=""></a>
                        </div>
                    </div> <!-- /.block-style-thirtyTwo -->
                </div>
            </div>
        </div>
    </div>

    <div class="fancy-feature-fortyThree lg-container pt-100 pb-100 mt-100 lg-mt-100 lg-pt-60 lg-pb-60" dir="rtl">
        <div class="container">
            <div class="row align-items-center justify-content-center rtl" data-aos="fade-up">
                <div class="w-100">
                    <div class="title-style-eleven text-right">
                        <h2>أفضل السيارات الكهربائية للسوق المصري</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-80 lg-mt-50">
            <div class="row">
                @forelse ($eCars as $eCar)
                <div class="col-md-3 col-sm-6">
                    <div class="product-card" car-price="{{ $eCar->offer_price }}" car-body="{{ $eCar->body_type }}">
                        <div class="img-holder">
                            <a href="{{ route('cars.show', $eCar->slug) }}" class="d-flex align-items-center justify-content-center h-100">
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
                <div class="partner-slider-two col-12 justify-content-center align-items-center">
                    <p class="text-center text-lg pb-0">لا يوجد حاليا </p>
                    <img src="{{ asset('frontend/images/icon/61.svg') }}" class="mr-3 m-auto" width="60px" alt="">
                </div>
                @endforelse

            </div>

            <div class="text-center mt-30 md-mt-10" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="50"><a href="{{ route('cars') }}" class="theme-btn-one">عرض الكل</a></div>

        </div>
    </div>

    <div class="fancy-feature-fortyFour lg-container mt-100 lg-mt-100 lg-pt-80 lg-pb-80" id="charging-stations">
        <div class="container">
            <div class="row align-items-center rtl">
                <div class="col-md-12">
                    <div class="title-style-eleven text-right">
                        <h2>أفضل محطات الشحن للسيارات الكهربائية</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-80 lg-mt-50 position-relative">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div id="map"></div>
                    </div> <!-- /.product-block-two -->

                </div>
                <div class="map-float">
                    @foreach ($chargingStations as $station)
                        <div class="rtl text-right">
                            <ol>
                                <li class="p-1">
                                    <h5 class="h6 mb-0"><i class="fa fa-bolt ml-2" style="color: #b6f119; font-size: 20px;"></i> {{ $station->name }}</h5>
                                </li>
                            </ol>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> <!-- /.xl-container -->
    </div>

    <!-- SHOP -->
    <div class="fancy-feature-fortyThree lg-container pt-100 pb-150 mt-100 lg-mt-100 lg-pt-0 lg-pb-0"  dir="rtl">
        <div class="container">
            <div class="row align-items-center rtl">
                <div class="col-md-12">
                    <div class="title-style-eleven text-right">
                        <h2>ملحقات واكسسوارات السيارات الكهربائية</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-80 lg-mt-50">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-3 col-sm-6">
                        <div class="product-card">
                            <div class="img-holder text-center mb-3">
                                <a href="{{ route('shop.products.show', $product->slug) }}" class="d-flex align-items-center justify-content-center h-100">
                                    <img src="{{ asset('storage/'.$product->images[0]) }}" alt="" class="product-img tran4s" style="max-width:100%;">
                                </a>
                            </div>
                            <div class="product-meta text-right" dir="rtl">
                                <div class="product-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 order-1">{{ $product->name }}</h5>
                                    <span class="mb-0 text-success h6 font-weight-bold order-2">{{ $product->price }} ج.م</span>
                                </div>
                                <div class="ratings d-flex justify-content-between align-items-center mt-2">
                                    <span class="badge badge-secondary">{{ $product->category->name }}</span>
                                </div>
                                <div class="product-details text-muted mt-2">
                                    <p class="mb-0">{{ Str::limit($product->description, 50) }}</p>
                                </div>
                            </div>
                            <div class="action d-flex" style="gap: 5px;">
                                <a href="{{ route('shop.products.show', $product->slug) }}" class="price-button text-center">عرض</a>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="partner-slider-two col-12 justify-content-center align-items-center d-flex">
                    <p class="text-center text-lg pb-0">لا يوجد حاليا </p>
                    <img src="{{ asset('frontend/images/icon/61.svg') }}" class="mr-3" width="60px" alt="">
                </div>
                @endforelse
            </div>
            @if ($products->count() > 0)
            <div class="text-center mt-30 md-mt-10" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="50"><a href="{{ route('shop') }}" class="theme-btn-one">عرض الكل</a></div>
            @endif
        </div>
    </div>

    <div class="feature-blog-one blog-page-bg">
        <div class="container">
            <div class="text-center mt-0">
                <div class="title-style-eleven text-right">
                    <h2>جديد عالم السيارات الكهربائية</h2>
                </div>
            </div>
        </div>
        <div class="container mt-80 lg-mt-50" dir="rtl">
            <div class="row">
                @forelse ($posts->take(3) as $post)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1200">
                        <div class="post-meta shadow-none text-end">
                            <img src="{{ asset('storage/'.$post->cover_photo_path) }}" alt="{{ $post->photo_alt_text }}" class="image-meta">
                            <div class="tag">{{ $post->title }}</div>
                            <h3>
                                <a href="{{ route('blog.show', $post->slug) }}" class="h5">
                                    {{ Str::limit(strip_tags($post->body), 50) }}
                                </a>
                            </h3>
                            <a href="{{ route('blog.show', $post->slug) }}" class="read-more d-flex justify-content-between align-items-center">
                                <span>اقرأ المزيد </span>
                                <span class="badge bg-light">{{ $post->tags->pluck('name')->implode(', ') }}</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="partner-slider-two col-12 justify-content-center align-items-center">
                        <p class="text-center text-lg pb-0">لا يوجد أخبار حاليا </p>
                        <img src="{{ asset('frontend/images/icon/61.svg') }}" class="mr-3" width="60px" alt="">
                    </div>
                @endforelse
            </div>
            @if ($posts->count() > 0)
                <div class="text-center mt-30 md-mt-10" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="50">
                    <a href="{{ route('blog') }}" class="theme-btn-one">عرض الكل</a>
                </div>
            @endif
        </div>
    </div>

    @if ($testimonials->count() > 0)
    <div class="client-feedback-slider-nine lg-container position-relative mt-lg-0 md-mt-150" id="testimonials">
        <div class="container">
            <div class="title-style-sixteen text-right">
                <h2>أراء العملاء</h2>
            </div>
            <div class="main-content position-relative mt-60">
                <div class="clientSliderEight row">
                    @forelse ($testimonials as $testimonial)
                    <div class="item rtl">
                        <div class="bg-wrapper">
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
    @endif

    @if ($faqs->count() > 0)
        <div class="faq-section-four">

            <div class="container">
                <div class="title-style-five text-right mb-80 md-mb-60">
                    <h2><span>الأسئلة الشائعة</span></h2>
                    <p>إجابات لأكثر الاستفسارات شيو ًعا حول السيارات الكهربائية</p>
                </div>
                <div class="row">
                    <div class="col-xl-9 col-lg-10 m-auto" data-aos="fade-up" data-aos-duration="1200">
                        <div id="accordionThree" class="accordion-style-four">
                            @foreach ($faqs->sortBy('order') as $index => $faq)
                                <div class="card rounded">
                                    <div class="card-header" id="headingOne{{ $index + 1 }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link d-flex align-items-center justify-content-between w-100">
                                                <!-- Icon on the left -->
                                                <span class="me-2">
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                                </span>
                                                <!-- Text on the right -->
                                                <span class="text-end">
                                                    {{ $faq->question }}
                                                </span>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne{{ $index + 1 }}" class="collapse">
                                        <div class="card-body">
                                            <p class="text-end" dir="rtl"> {{ $faq->answer }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="text-center mt-60 md-mt-50" data-aos="fade-up" data-aos-duration="1200">
                    <h3 class="font-rubik pb-30">لم تجد إجابتك؟</h3>
                    <a href="{{ route('contact-us') }}" class="theme-btn-five">تواصل معنا</a>
                </div>
            </div> <!-- /.container -->
        </div>
    @endif

    <div class="fancy-short-banner-twelve border-bottom rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200">
                    <div class="title-style-ten text-right">
                        <h2>كن أول من يعلم بإطلاق تطبيقنا.</h2>
                        <p class="pt-25 pb-45"> سجل الآن وكن من السباقين لاكتشاف تطبيقنا الجديد الذي يوفر لك الوصول الفوري لمحطات الشحن وإدارة تفاصيل سيارتك الكهربائية بسهولة. استفد من  العضوية المميزة والحوافز الحصرية بمجرد إطلاق التطبيق.</p>
                    </div>
                    <div data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150" class="aos-init">
                        <div class="d-sm-flex align-items-center button-group">
                            <a href="https://wa.me/{{ setting('site_phone') }}?text={{ urlencode('مرحباً، أحتاج إلى مساعدة من App store.') }}" class="d-flex align-items-center text-right">

                                <img src="{{ asset('frontend/images/icon/apple-black.svg') }}" alt="" class="icon">
                                <div>
                                    <span>Download on the</span>
                                    <strong>App store</strong>
                                </div>
                            </a>
                            <a href="https://wa.me/{{ setting('site_phone') }}?text={{ urlencode('مرحباً، أحتاج إلى مساعدة من Google play.') }}" class="d-flex align-items-center text-right">
                                <img src="{{ asset('frontend/images/icon/playstore.svg') }}" alt="" class="icon">
                                <div>
                                    <span>Get it on</span>
                                    <strong>Google play</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- /.container -->
    </div>

    <!-- DOWNLOAD APP -->
    <!-- SHOP DISCOUNT SUBSCRIPTION -->

    {{-- <div class="shop-discount-subscription lg-container mt-120 mb-150 lg-mt-100 lg-mb-100" dir="rtl">
        <div class="container">
            <div class="row align-items-end">
                <!-- Right section (text) -->
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="title-style-eleven">
                        <!-- RTL title -->
                        <h2 class="pl-xl-5 ml-xl-2 text-end">اشترك الآن لتكون الأول</h2>
                    </div>
                </div>
                <!-- Left section (form) -->
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="form-wrapper">
                        <form action="#" style="height: unset">
                            <!-- Email input aligned right -->
                            <input type="text" class="form-control text-end" placeholder="الاسم بالكامل">
                            <input type="text" class="form-control text-end" placeholder="رقم الهاتف على واتساب">
                            <input type="email" class="form-control text-end" placeholder="ادخل بريدك الإلكتروني">
                        </form>
                        <p class="px-2 text-end">
                            <button class="mt-4" type="submit">
                                <img src="{{ asset('frontend/images/icon/53.svg') }}" alt="" class="m-auto">
                            </button>
                        </p>
                    </div> <!-- /.form-wrapper -->
                </div>
            </div>
        </div>
    </div> --}}
</div>


@push('scripts')
<script>
    // تهيئة الخريطة
    var map = L.map('map').setView([26.8206, 30.8025], 6); // Adjusted zoom level to 5 for a broader view of Egypt

    // إضافة طبقة الخريطة
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
    }).addTo(map);

    // بيانات المحطات (يمكنك جلبها من الباك إند)
    var stations = @json($chargingStations);

    // إضافة العلامات للمحطات
    stations.forEach(function(station) {
        // إنشاء محتوى النافذة المنبثقة
        var popupContent = `
            <div class="station-popup rtl">
                <div class="station-name text-right">${station.name}</div>
                <div class="station-info text-right">
                    <p>الوصف: ${station.description}</p>
                    <p>القدرة بالكيلوواط: ${station.kw} kW</p>
                    <p>العنوان: ${station.address}</p>
                    ${station.status == 1 ? `<span class="badge bg-success text-white">Active</span>` : `<span class="badge bg-danger text-white">Not Active</span>`}
                </div>
            </div>
        `;

        // Create a custom marker with Font Awesome icon
        var markerDiv = L.divIcon({
            className: 'custom-icon',
            html: '<i class="fa fa-bolt" style="color: #000; font-size: 24px;"></i>', // Use your desired Font Awesome icon
            iconSize: [30, 30], // Size of the icon
            iconAnchor: [15, 30], // Point of the icon which will correspond to marker's location
            popupAnchor: [0, -30] // Point from which the popup should open relative to the iconAnchor
        });

        // إضافة العلامة مع النافذة المنبثقة
        var marker = L.marker([station.latitude, station.longitude], { icon: markerDiv }) // Use the custom Font Awesome icon
            .bindPopup(popupContent)
            .addTo(map);
    });

    // ضبط حدود الخريطة لتشمل جميع العلامات
    if (stations.length > 0) {
        var bounds = L.latLngBounds(stations.map(s => [s.latitude, s.longitude]));
        map.fitBounds(bounds);
        map.setZoom(6); // Set the desired zoom level here
    }
</script>
@endpush



