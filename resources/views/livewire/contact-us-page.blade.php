<div>

    <div class="fancy-hero-four bg-doc space-fix">
        <div class="bg-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-11 col-md-10 m-auto">
                        <h6>تواصل معنا</h6>
                        <h3>نحن هنا لمساعدتك! سواء كنت ترغب في الاستفسار عن خدماتنا أو بحاجة إلى دعم، فريقنا جاهز للإجابة على أسئلتك.</h3>
                    </div>
                </div>
            </div>
        </div> <!-- /.bg-wrapper -->
    </div> <!-- /.fancy-hero-four -->

    <div class="contact-style-two mb-100">
        <div class="container">
            <div class="contact-info-wrapper">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6 d-lg-flex">
                        <div class="address-info">
                            <div class="title">العنوان</div>
                            <p class="font-rubik"></p>
                        </div> <!-- /.address-info -->
                    </div>

                    <div class="col-lg-4 col-sm-6 d-lg-flex">
                        <div class="address-info">
                            <div class="title">بيانات التواصل</div>
                            <p class="font-rubik">{{ setting("site_email")  }} <br> {{setting("site_phone") }}</p>
                        </div> <!-- /.address-info -->
                    </div>

                    <div class="col-lg-4 col-sm-6 d-lg-flex">
                        <div class="address-info">
                            <div class="title">تابعنا علي</div>
                            <p class="font-rubik"></p>
                            <ul class="d-flex justify-content-center">

                                @foreach($contactData as $social)
                                    <li><a href="{{ $social['link'] }}"><i class="fa fa-{{ $social['vendor'] }}" aria-hidden="true"></i></a></li>
                                @endforeach
                            </ul>
                        </div> <!-- /.address-info -->
                    </div>
                </div>
                <img src="images/shape/64.svg" alt="" class="shapes shape-one">
            </div> <!-- /.contact-info-wrapper -->

            <div class="form-style-classic mt-150 md-mt-80" dir="rtl">
                <form wire:submit.prevent="submitForm" id="contact-form" data-toggle="validator">
                    <div class="messages"></div>
                    <div class="row controls">
                        <div class="col-md-6" >
                            <div class="input-group-meta form-group mb-60">
                                <label>الاسم كامل</label>
                                <input type="text" wire:model="name" required="required" data-error="Name is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group-meta form-group mb-60">
                                <label>رقم الهاتف</label>
                                <input type="text" wire:model="phone" required="required" data-error="phone is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group-meta form-group mb-60">
                                <label>البريد الالكتروني</label>
                                <input type="email" wire:model="email" required="required" data-error="Valid email is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group-meta form-group lg mb-40">
                                <label>الرسالة</label>
                                <textarea placeholder="رسالتك هنا.." wire:model="message" required="required" data-error="Please, leave us a message."></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="theme-btn-six lg" wire:loading.attr="disabled">
                                ارسال طلب التواصل
                                <span class="spinner-border spinner-border-sm text-white" wire:loading wire:target="submitForm"></span>
                            </button>
                        </div>

                    </div>
                </form>
            </div> <!-- /.form-style-classic -->
        </div>
    </div> <!-- /.contact-style-two -->

</div>
