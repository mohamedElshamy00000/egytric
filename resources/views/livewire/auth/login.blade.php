<div>

    <div class="user-data-page clearfix d-lg-flex mb-100">
        <div class="illustration-wrapper d-flex align-items-center justify-content-center flex-column" style="background: url('{{asset('frontend/images/Frameee.svg')}}'); background-size:cover;border-right: 1px solid #ededed;"></div> <!-- /.illustration-wrapper -->

        <div class="form-wrapper">
            {{-- alert --}}
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form wire:submit.prevent="login" class="user-data-form mt-80 md-mt-40">
                <h2> تسجيل الدخول </h2>
                <p class="header-info pt-30 pb-50 rtl">ليس لديك حساب؟ <a href="{{ route('register') }}">انشاء حساب</a></p>

                <div class="row rtl text-right">

                    <div class="col-12">
                        <div class="input-group-meta mb-80 sm-mb-70">
                            <label>البريد الإلكتروني</label>
                            <input type="email" placeholder="" wire:model="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group-meta mb-15">
                            <label>كلمة المرور</label>
                            <input type="password" placeholder="" class="pass_log_id" wire:model="password">
                            <span class="placeholder_icon"><span class="passVicon"><img src="{{ asset('frontend/images/icon/view.svg') }}" alt=""></span></span>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="agreement-checkbox d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" id="remember" wire:model="remember">
                                <label for="remember">البقاء مسجل الدخول</label>
                            </div>
                            <a href="{{ route('password.forgot') }}">نسيت كلمة المرور؟</a>
                        </div> <!-- /.agreement-checkbox -->
                    </div>
                    <div class="col-12">
                        <button class="theme-btn-one mt-50 mb-50">تسجيل الدخول</button>
                    </div>
                </div>
            </form>
        </div> <!-- /.form-wrapper -->
    </div> <!-- /.user-data-page -->

</div>
