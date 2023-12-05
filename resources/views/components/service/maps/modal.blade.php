<x-breeze.modal name="maps-modal-open" focusable>
    <div class="p-2">
        <h2 class="text-lg text-center font-medium text-gray-900">
            <p>Localização aproximada do serviço</p>
        </h2>
        <div class="flex justify-center">
            @php
                $lat = $service->latitude;
                $lng = $service->longitude;

                $key = env('KEY_MAPS');
                $api = "https://maps.googleapis.com/maps/api/staticmap?center=".$lat.",".$lng."&zoom=12&size=800x800&markers=color:red%7Clabel:S%7C".$lat.",".$lng."&key=".$key;
            @endphp
           <img src="{{ $api }}" alt="">
        </div>
    </div>
</x-breeze.modal>
