@extends('components.worker.table.tstructure')

@section('table-body')
    @foreach ($services as $key => $service)
        <tr>
            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                <div>
                    <h2 class="font-medium text-gray-800 ">{{ $service->user->name }}</h2>
                </div>
            </td>
            <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                <div class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60">
                    <span class="text-sm font-medium text-gray-800 ">€{{ $service->final_price/100 }}</span>
                </div>
            </td>

            <td class="px-4 py-4 text-sm whitespace-nowrap">
                <div>
                    <x-service.badge-status :service="$service" />
                </div>
            </td>

            <td class="px-4 py-4 text-sm whitespace-nowrap">
                <div>
                    <span class="text-sm font-medium text-gray-800 ">{{ $service->created_at->diffForHumans() }} - {{ $service->created_at->format('d/m/Y') }}</span>
                </div>
            </td>

            <td class="px-4 py-4 text-sm whitespace-nowrap">
                <x-service.show.chat-dropdown :id="$service->id" />
            </td>

            <td class="px-4 py-4 text-sm whitespace-nowrap">
                <button wire:click='completeService({{$service->id}})' class="btn btn-square border bordered border-success bg-white hover:border-warning hover:bg-white" @if ($service->status === 'completed') disabled @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#818cf8" d="m9.55 18l-5.7-5.7l1.425-1.425L9.55 15.15l9.175-9.175L20.15 7.4L9.55 18Z"/></svg>
                </button>
            </td>
        </tr>
    @endforeach
@endsection
