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

                                <li class="{{ request()->is('my-car-orders') ? 'text-success' : '' }}">
                                    <a href="{{ route('my-car-orders') }}">
                                        <i class="fa fa-car"></i>
                                        طلبات السيارات
                                    </a>
                                </li>
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
                        <h3 class="d-flex align-items-center">الطلبات</h3>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>رقم الطلب</th>
                                                <th>تاريخ الطلب</th>
                                                <th>نوع الطلب</th>
                                                <th>السيارة</th>
                                                <th>الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse($orders as $order)
                                                <tr wire:key="{{ $order['id'] }}">

                                                    <td class="text-right">#{{ $order['id'] }}</td>
                                                    <td class="text-right">{{ $order['created_at']->format('d/m/Y') }}</td>
                                                    <td class="text-right">
                                                        @if($order['order_type'] == 'immediate')
                                                            <span class="badge badge-success">فوري</span>
                                                        @else
                                                            <span class="badge badge-info">انتظار</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">{{ $order['car']['model'] }}</td>
                                                    <td class="text-right">
                                                        <span class="badge badge-{{ $order['status'] == 'new' ? 'light' : ($order['status'] == 'processing' ? 'info' : ($order['status'] == 'completed' ? 'success' : 'danger')) }}">{{ $order['status'] }}</span>
                                                    </td>
                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-5 font-weight-bold"><a href="{{ route('cars') }}">  لا يوجد طلبات</a></td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $orders->links('vendor.pagination.custom') }}
                        </div>

                    </main> <!-- /.doc-main-body -->
                </div>
            </div>
        </div>
    </div>

</div>
