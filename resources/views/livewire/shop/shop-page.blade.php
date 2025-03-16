<div>

    <div class="fancy-hero-three">
        <div class="shapes shape-one"></div>
        <div class="shapes shape-two"></div>
        <div class="shapes shape-three"></div>
        <div class="shapes shape-four"></div>
        <div class="shapes shape-five"></div>
        <div class="shapes shape-six"></div>
        <div class="bg-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 m-auto">
                        <h3 class="heading h4 pb-0">كل ما تحتاجه سيارتك الكهربائية</h3>
                        <nav aria-label="breadcrumb rtl">
                            <ol class="breadcrumb m-auto bg-transparent justify-content-center">
                                <li class="breadcrumb-item active h6" aria-current="page">كل ما تحتاجه سيارتك الكهربائية</li>
                                <li class="breadcrumb-item h6"><a href="">السيارات</a></li>
                                <li class="breadcrumb-item h6"><a href="">الصفحة الرئيسية</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- /.bg-wrapper -->
    </div>


    <div class="cars mb-60 mt-120">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="row rtl" id="product-list">
                        @forelse ($products as $product)
                            <div class="col-md-3 col-sm-6 product-item" wire:key="{{ $product->id }}" data-category="{{ $product->category->slug }}" data-brand="{{ $product->brand->slug }}" data-price="{{ $product->price }}">
                                <div class="product-card">
                                    <div class="img-holder text-center mb-3">
                                        <a href="{{ route('shop.products.show', $product->slug) }}" class="d-flex align-items-center justify-content-center h-100">
                                            <img src="{{ asset('storage/'.$product->images[0]) }}" alt="{{ $product->name }}" class="product-img tran4s" style="max-width:100%;">
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
                                        <button class="cart-btn" wire:click="addToCart({{ $product->id }})"> <img src="{{ asset('frontend/images/icon/200.svg') }}" wire:loading.remove wire:target="addToCart({{ $product->id }})">
                                            <span wire:loading wire:target="addToCart({{ $product->id }})">...</span>
                                        </button>
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

                    {{ $products->links('vendor.pagination.custom') }}
                </div>

                <div class="col-md-3 sidebar rtl text-right">
                    <div class="d-flex align-items-center justify-content-between border-bottom pb-2">
                        <h4>تصنيفات</h4>
                        <a href="{{ route('shop') }}" class="small">افتراضي</a>
                    </div>
                    <div class="filter-section border-bottom">
                        <h4 class="mb-4">تصنيفات</h4>
                        <ul class="list-unstyled tag-list">
                            @foreach ($categories as $category)
                                <li class="tag-item" wire:key="{{ $category->id }}">
                                    <div class="custom-checkbox mb-0">
                                        <input type="checkbox" class="filter-checkbox" wire:model.live="selected_categories" id="{{ $category->slug }}" value="{{ $category->id }}">
                                        <label for="{{ $category->slug }}">{{ $category->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="filter-section border-bottom">
                        <h4 class="mb-4">العلامة التجارية</h4>
                        @foreach ($brands as $brand)
                            <div class="custom-checkbox" wire:key="{{ $brand->id }}">
                                <input type="checkbox" class="filter-checkbox brand-filter" wire:model.live="selected_brands" id="{{ $brand->slug }}" value="{{ $brand->id }}" checked>
                                <label for="{{ $brand->slug }}">{{ $brand->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="filter-section pb-3 border-bottom">
                        <h4 class="mb-4">السعر</h4>
                        {{-- <div class="price-inputs">
                            <input type="number" wire:model.live="min_price" id="minPrice" placeholder="Min Price" value="{{ $min_price }}">
                            <span> - </span>
                            <input type="number" wire:model.live="max_price" id="maxPrice" placeholder="Max Price" value="{{ $max_price }}">
                        </div> --}}

                        <div class="price-range-container">
                            <div class="price-labels d-flex justify-content-between">
                              <span class="min-price h6">{{ Number::currency(1000, 'EGP') }}</span>
                              <span class="max-price h6">{{ Number::currency(100000, 'EGP') }}</span>
                            </div>
                            <input type="range" id="priceRange" min="1000" max="100000" step="1000" wire:model.live="price_range" value="{{ $price_range }}">
                            {{ Number::currency($price_range, 'EGP') }}
                        </div>
                    </div>

                    <div class="filter-section">
                        <div class="custom-checkbox">
                            <input type="checkbox" id="is_featured" class="filter-checkbox" wire:model.live="is_featured" data-filter="type" value="1">
                            <label for="is_featured">مميزة</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" id="on_sale" class="filter-checkbox" wire:model.live="on_sale" data-filter="type" value="1">
                            <label for="on_sale">عليها خصم</label>
                        </div>
                    </div>
                    <div class="filter-section">
                        <h4 class="mb-4">نوع الوصلة</h4>
                        <div class="custom-checkbox">
                            <input type="checkbox" class="filter-checkbox" data-filter="type" value="كابلات شحن  عامة">
                            <label>كابلات شحن عامة</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" id="cabel2">
                            <label for="cabel2">كابلات شحن منزلية</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" id="volkswagen">
                            <label for="volkswagen">Volkswagen</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" id="cabel3">
                            <label for="cabel3">كابلات متعددة الاستخدامات</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')

@endpush
