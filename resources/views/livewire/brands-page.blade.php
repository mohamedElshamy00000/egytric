<div>
    <div class="fancy-hero-four bg-doc space-fix" style="padding-bottom: 140px;">
        <div class="bg-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-11 col-md-10 m-auto">
                        <h3>العلامات التجارية</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="partner-slider-two mt-80 mb-100 md-mt-80">
        <div class="container">
            <div class="row">
                @foreach  ($brands as $brand)
                <div class="item col-2 mb-4" wire:key="{{$brand->id}}">
                    <a href="{{ route('cars', ['selected_brands[0]' => $brand->id]) }}" class="border border-2 round-bg img-meta d-flex align-items-center justify-content-center flex-column">
                        <img src="{{ asset('storage/' .$brand->image) }}" height="auto" style="max-width: 50px" alt="{{ $brand->name }}">
                        <p class="m-0 p-0 small">{{ $brand->name }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>