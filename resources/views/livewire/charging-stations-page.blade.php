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
                                <li class="">
                                    <h4 class="d-flex align-items-center"><img src="{{ asset('frontend/images/icon/15.svg') }}" alt="" class="ml-2" width="30px"> محطات الشحن</h4>
                                    <ul class="list-unstyled tag-list mt-3">
                                        @foreach ($chargingStations as $station)
                                            <div class="block-style-thirtyOne p-3 w-100">
                                                <h5
                                                    class="station-link"
                                                    data-lat="{{ $station->latitude }}"
                                                    data-lng="{{ $station->longitude }}"
                                                    style="cursor: pointer;"
                                                >
                                                    {{ $station->name }}
                                                </h5>
                                                <p class="m-0 p-0 text-muted">{{ $station->description }}</p>
                                            </div>

                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </nav> <!-- /.doc-links -->
                    </div> <!-- /.doc-sidebar -->
                    <!-- ****************************** DOC MAIN BODY ********************************* -->
                    <main class="col-md-10 col-xl-10 doc-main-body p-0">
                        <div id="map2" style="height: 100%;height: 100vh;" ></div>
                    </main> <!-- /.doc-main-body -->
                </div>
            </div>
        </div>
    </div>

</div>


@push('scripts')
<script>
    // تهيئة الخريطة
    var map = L.map('map2').setView([26.8206, 30.8025], 6); // Adjusted zoom level to 5 for a broader view of Egypt

    // إضافة طبقة الخريطة
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
    }).addTo(map);

    // بيانات المحطات (يمكنك جلبها من الباك إند)
    var stations = @json($chargingStations);

    // Store markers in an object for easy access
    var markers = {};

    // Add markers for each station
    stations.forEach(function(station) {
        var stationId = station.id;
        var popupContent = `
            <div class="station-popup rtl">
                <a href="/charging-stations/${stationId}"
                    class="station-name text-right font-bold mb-2 block hover:text-blue-600">
                    ${station.name}
                </a>
                <div class="station-info text-right">
                    <p class="m-0 p-0 mb-2">الوصف: ${station.description}</p>
                    <p class="m-0 p-0 mb-2">القدرة بالكيلوواط: ${station.kw} kW</p>
                    <p class="m-0 p-0 mb-2">العنوان: ${station.address}</p>
                    ${station.status === 1 ? `<span class="badge bg-success text-white">Active</span>` : `<span class="badge bg-danger text-white">Not Active</span>`}
                </div>
            </div>
        `;

        var markerDiv = L.divIcon({
            className: 'custom-icon',
            html: '<i class="fa fa-bolt" style="color: #000000; font-size: 24px;"></i>',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        });

        // Create the marker and store it in the markers object
        markers[station.id] = L.marker([station.latitude, station.longitude], { icon: markerDiv })
            .bindPopup(popupContent)
            .addTo(map);
    });

    // ضبط حدود الخريطة لتشمل جميع العلامات
    if (stations.length > 0) {
        var bounds = L.latLngBounds(stations.map(s => [s.latitude, s.longitude]));
        map.fitBounds(bounds);
        map.setZoom(6); // Set the desired zoom level here
    }

    // Add click event listeners to station links
    document.querySelectorAll('.station-link').forEach(function(link) {
        link.addEventListener('click', function() {
            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);

            // Pan to the location and zoom in
            map.setView([lat, lng], 15);

            // Find and open the corresponding marker's popup
            stations.forEach(function(station) {
                if (station.latitude === lat && station.longitude === lng) {
                    markers[station.id].openPopup();
                }
            });
        });
    });
</script>
@endpush



