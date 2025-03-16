<div>

    <div>
        <div class="doc-container full-width top-border border-bottom mb-100 rtl text-right pl-0">
            <div class="clearfix">
                <div class="row flex-xl-nowrap no-gutters">
                    <!-- ****************************** cars ********************************* -->
                    <div class="col-md-3 col-xl-2 doc-sidebar">
                        <div class="clearfix">
                            <button class="btn btn-link d-md-none collapsed" type="button" data-target="#doc-sidebar-nav" aria-controls="doc-sidebar-nav" aria-expanded="false" aria-label="Toggle docs navigation"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path></svg></button>
                        </div>
                        <nav class="doc-links collapse clearfix nav-fix" id="doc-sidebar-nav">

                            <ul class="list-item">

                                {{-- <li class="{{ request()->is('my-account') ? 'active' : '' }}">
                                    <a href="">
                                        <i class="fa fa-user"></i>
                                        الحساب
                                    </a>
                                </li> --}}
                                <li class="{{ request()->is('my-orders') ? 'text-success' : '' }}">
                                    <a href="{{ route('my-orders') }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        الطلبات
                                    </a>
                                </li>

                            </ul>
                        </nav> <!-- /.doc-links -->
                    </div> <!-- /.doc-sidebar -->
                    <!-- ****************************** DOC MAIN BODY ********************************* -->
                    <main class="col-md-10 col-xl-10 doc-main-body">
                        <h3 class="d-flex align-items-center">الطلب</h3>
                        <div class="row">
                            <div class="col-3">
                                <div class="card" style="border-style: dashed;">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0 pb-0">الطلب رقم</h5>
                                        <p class="card-text mb-0 pb-0">#{{ $order->id }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card" style="border-style: dashed;">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0 pb-0">العميل</h5>
                                        <p class="card-text mb-0 pb-0 h6">
                                            {{ $order->user->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card" style="border-style: dashed;">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0 pb-0">حالة الدفع</h5>
                                        <p class="card-text mb-0 pb-0">
                                            <span class="badge badge-{{ $order->payment_status == 'pending' ? 'warning' : ($order->payment_status == 'paid' ? 'success' : 'danger') }}">{{ $order->payment_status }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card" style="border-style: dashed;">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0 pb-0">حالة الطلب</h5>
                                        <p class="card-text mb-0 pb-0">
                                            <span class="badge badge-{{ $order->status == 'new' ? 'light' : ($order->status == 'processing' ? 'info' : ($order->status == 'completed' ? 'success' : 'danger')) }}">{{ $order->status }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-50">
                            <div class="col-12">
                                <h3 class="d-flex align-items-center">المنتجات</h3>

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>الرقم</th>
                                                <th>المنتج</th>
                                                <th>الكمية</th>
                                                <th>سعر الوحدة</th>
                                                <th>الإجمالي</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($orderItems as $item)

                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('storage/' . $item->product->images[0]) }}" alt="{{ $item->product->name }}" class="rounded-circle ml-3" width="50" height="50">
                                                            <a href="{{ route('shop.products.show', $item->product->slug) }}">
                                                                {{ $item->product->name }}
                                                            </a>
                                                        </div>

                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ Number::currency($item->unit_amount, 'EGP') }}</td>
                                                    <td>{{ Number::currency($item->total_amount, 'EGP') }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">العنوان</h5>
                                        <p class="card-text">
                                            {{$address->country}} - {{$address->city}} - {{$address->street}}
                                        </p>
                                        <h5 class="card-title">ملاحظات</h5>
                                        <p class="card-text">
                                            {{ $order->note }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </main> <!-- /.doc-main-body -->
                </div>
            </div>
        </div>
    </div>

</div>
