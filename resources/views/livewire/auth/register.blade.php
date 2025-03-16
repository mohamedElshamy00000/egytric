<div>

    <div class="user-data-page clearfix d-lg-flex mb-100">
        {{-- <div class="illustration-wrapper d-flex align-items-center justify-content-center flex-column">
            <div class="illustration-holder">
                <img src="{{ asset('frontend/images/assets/ils_08.svg') }}" alt="" class="illustration">
                <img src="{{ asset('frontend/images/assets/ils_08.1.svg') }}" alt="" class="shapes shape-one">
                <img src="{{ asset('frontend/images/assets/ils_08.2.svg') }}" alt="" class="shapes shape-two">
            </div>
        </div> --}}
        <div class="illustration-wrapper d-flex align-items-center justify-content-center flex-column" style="background: url('{{asset('frontend/images/Frameee.svg')}}'); background-size:cover;border-right: 1px solid #ededed;"></div> <!-- /.illustration-wrapper -->

        <div class="form-wrapper rtl">

            <form wire:submit="register" class="user-data-form mt-100">
                <h2>انشاء حساب</h2>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <p class="header-info pt-30 pb-50">لديك حساب؟  <a href="{{ route('login') }}">تسجيل الدخول</a></p>

                <div class="row">
                    <div class="col-12">
                        <div class="input-group-meta mb-50">
                            <label>الاسم الكامل</label>
                            <input type="text" placeholder="" wire:model="name">

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="input-group-meta mb-50">
                            <label>البريد الإلكتروني</label>
                            <input type="email" placeholder="" wire:model="email">

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group-meta mb-50">
                            <label>كلمة المرور</label>
                            <input type="password" placeholder="" class="pass_log_id" wire:model="password">
                            <span class="placeholder_icon"><span class="passVicon"><img src="{{ asset('frontend/images/icon/view.svg') }}" alt=""></span></span>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="input-group-meta mb-15">
                            <label>اعادة كتابة كلمة المرور</label>
                            <input type="password" placeholder="" class="pass_log_id" wire:model="password_confirmation">
                            <span class="placeholder_icon"><span class="passVicon"><img src="{{ asset('frontend/images/icon/view.svg') }}" alt=""></span></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="agreement-checkbox d-flex justify-content-between align-items-center sm-mt-10">
                            <div>
                                <input type="checkbox" id="agree_to_policy" wire:model="agree_to_policy">
                                <label for="agree_to_policy">بالضغط على "انشاء حساب" أوافق على الشروط والأحكام وسياسة الخصوصية.</label>
                            </div>
                        </div> <!-- /.agreement-checkbox -->
                    </div>
                    <div class="col-12">
                        <button class="theme-btn-one mt-30 mb-50">انشاء حساب</button>
                    </div>
                </div>
            </form>
        </div> <!-- /.form-wrapper -->
    </div>

</div>
