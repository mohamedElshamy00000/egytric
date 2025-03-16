<div>

    <div class="user-data-page clearfix d-lg-flex mb-100">

        <div class="form-wrapper m-auto">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form wire:submit.prevent="save" class="user-data-form mt-80 md-mt-40">
                <h3>نسيت كلمة المرور؟</h3>
                <p class="header-info pt-30 pb-50 rtl">من فضلك قم بإدخال البريد الإلكتروني</p>
                <div class="row rtl text-right pt-50">

                    <div class="col-12 ">
                        <div class="input-group-meta mb-40 sm-mb-70">
                            <label>البريد الإلكتروني</label>
                            <input type="email" placeholder="" wire:model="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="theme-btn-one mb-50" wire:loading.attr="disabled">إرسال <div class="spinner-border spinner-border-sm text-white" wire:loading wire:target="save"></div></button>
                    </div>
                </div>
            </form>
        </div> <!-- /.form-wrapper -->
    </div> <!-- /.user-data-page -->

</div>
