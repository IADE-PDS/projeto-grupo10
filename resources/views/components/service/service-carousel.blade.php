@props(['photos'])
<div class="">
    @if ($photos->isNotEmpty())
        @php
            $photoCount = count($photos);
        @endphp
        <div @class([
            'grow',
            'grid',
            'grid-cols-2' => $photoCount < 5,
            'grid-cols-3' => $photoCount == 5,
            'gap-1',
        ])>
            @foreach ($photos as $key => $photo)
                <div @class([
                    'full', 
                    'h-64', 
                    'overflow-hidden',
                    'col-span-2' => $key == 0 && $photoCount != 2 && $photoCount != 4,
                    'row-span-2' => $key == 0 && $photoCount == 1,
                    ])>
                    <img x-on:click.prevent="$dispatch('modal-images', {path: '/storage/{{ $photo->path }}'})" class="object-cover w-full h-full rounded-md" src="{{ url('/storage/'.$photo->path) }}" alt="">
                </div>
            @endforeach
        </div>
    @endif

    <x-service.show.image-modal />
</div>
