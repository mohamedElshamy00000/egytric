
<!--
=====================================================
    Footer
=====================================================
-->
<footer class="theme-footer-seven direction-rtl">
    <div class="lg-container">
        <div class="container">
            <div class="row text-right">
                <div class="col-xl-3 col-lg-2 mb-40" data-aos="fade-up" data-aos-duration="1200">
                    <div class="logo text-start"><a href="{{ route('home') }}"><img src="{{ asset('frontend/images/logo/Artboard 23.png') }}" width="200px" alt=""></a></div>
                </div>
                <div class="col-lg-2 col-md-6 mb-40" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                    <h5 class="title">روابط</h5>
                    <ul class="footer-list">
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('about') }}">من نحن</a></li>
                        <li><a href="{{ route('shop') }}">المتجر</a></li>
                        <li><a href="{{ route('fq') }}">الاسئلة الشائعة</a></li>
                        <li><a href="{{ route('contact-us') }}">تواصل معنا</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-40 pr-md-5" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                    <h5 class="title">سياسة ايجيترك</h5>
                    <ul class="footer-list">
                        <li><a href="#">سياسة الخصوصية</a></li>
                        <li><a href="#">شروط الاستخدام</a></li>
                        <li><a href="#">حقوق النشر</a></li>
                        <li><a href="#">طلب الدعم</a></li>
                    </ul>
                </div>

                <div class="newsletter rtl">
                    <p>انضم الى <span>68,000</span> الأشخاص الذين يحصلون على تحديثاتنا</p>

                    @if($successMessage)
                    <div class="alert alert-success">
                        تم تسجيل رقم هاتفك بنجاح!
                    </div>
                    @endif

                    @if($errorMessage)
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                    @endif

                    <form wire:submit.prevent="subscribe">
                        <input type="tel" wire:model.defer="phone" placeholder="أدخل رقم الهاتف الخاص بك" pattern="[0-9]+" dir="ltr" class="text-right">
                        <button type="submit" class="dark-btn ml-2">إشترك الأن</button>
                        @error('phone')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                    <div class="info">نحن نرسل فقط الرسائل المهمة والمفيدة.</div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="bottom-footer">
                <div class="row">
                    <div class="col-lg-4 order-lg-1 mb-20">
                        <ul class="d-flex justify-content-center justify-content-lg-start footer-nav">
                            <li><a href="#">الخصوصية والشروط.</a></li>
                            <li><a href="#">اتصل بنا</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 order-lg-3 mb-20">
                        <ul class="d-flex justify-content-center justify-content-lg-end social-icon">
                            @foreach($socials as $social)
                                <li><a href="{{ $social['link'] }}"><i class="fa fa-{{ $social['vendor'] }}" aria-hidden="true"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-4 order-lg-2 mb-20">
                        <p class="copyright text-center">كل الحقوق محفوطة {{ now()->year }} <a href="https://frameless.co" target="_blank"> Frameless</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.lg-container -->

</footer> <!-- /.theme-footer-seven -->
