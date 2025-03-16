<div>

    <!--
    =============================================
        Fancy Hero One
    ==============================================
    -->
    <div class="fancy-hero-one">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-10 m-auto">
                    <h3 class="">عن السيارات الكهربائية في مصر | إيچيتريك</h3>
                </div>
                <div class="col-lg-9 m-auto">
                    <p class="text-muted"> أحدث تطورات سوق السيارات الكهربائية في مصر مع مدونة إيچيتريك. اقرأ عن أحدث الموديلات، نصائح الصيانة، تقييمات، وأفضل الإرشادات لشراء سيارة كهربائية.</p>
                </div>
            </div>
        </div>
        <div class="bubble-one"></div>
        <div class="bubble-two"></div>
        <div class="bubble-three"></div>
        <div class="bubble-four"></div>
        <div class="bubble-five"></div>
        <div class="bubble-six"></div>
    </div> <!-- /.fancy-hero-one -->



    <!--
    =====================================================
        Feature Blog One
    =====================================================
    -->
    <div class="feature-blog-one blog-page-bg mb-100" dir="rtl">
        <div class="container">
            <div class="row">
                @forelse ($posts as $post)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1200">
                    <div class="post-meta">
                        <img src="{{ asset('storage/'.$post->cover_photo_path) }}" alt="{{ $post->photo_alt_text }}"class="image-meta">
                        <div class="tag">{{ $post->tags->pluck('name')->implode(', ') }}</div>
                        <h3><a href="{{ route('blog.show', $post->slug) }}" class="title">{{ $post->title }}</a></h3>
                        <a href="{{ route('blog.show', $post->slug) }}" class="read-more d-flex justify-content-left align-items-center">
                            <i class="flaticon-right-arrow ml-2"></i>
                            <span>قراءة المزيد</span>
                        </a>
                    </div> <!-- /.post-meta -->
                </div>
                @empty
                <div class="partner-slider-two col-12 justify-content-center align-items-center">
                    <p class="text-center text-lg pb-0">لا يوجد حاليا </p>
                    <img src="{{ asset('frontend/images/icon/61.svg') }}" class="mr-3" width="60px" alt="">
                </div>
                @endforelse

            </div>

            <div class="text-center mt-30 md-mt-10" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="50">
                {{ $posts->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div> <!-- /.feature-blog-one -->

</div>
