<div>
    <div class="fancy-hero-four bg-doc space-fix" style="padding-bottom: 140px;">
        <div class="bg-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-11 col-md-10 m-auto">
                        <h6>الأسئلة الشائعة</h6>
                        <h3>إجابات لأكثر الاستفسارات شيو ًعا حول السيارات الكهربائية.</h3>
                    </div>
                </div>
            </div>
        </div> <!-- /.bg-wrapper -->
    </div> <!-- /.fancy-hero-four -->

    <div class="faq-section-four mb-100">

        <div class="container">
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
</div>
