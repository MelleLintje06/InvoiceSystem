<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <a class="new-invoice" href="{{ route('create-invoice') }}">Nieuwe Factuur</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="content-wrap">
                        <div class="content-wrapper scroll">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight db-header-1"><p><span id="action">Facturen</span></p></h2>
                            <table class="invoices">
                                <tr>
                                    <td colspan="2">Factuurnummer</td>
                                    <td>Klant</td>
                                    <td>Datum aangemaakt</td>
                                    <td>Acties</td>
                                </tr>
                                @foreach ($invoices as $i)
                                    @if ($i->id !== 1 && $i->id !== 2)
                                        <tr class="row">
                                            <td>
                                            @if (!$i->paid)
                                                <span style="margin-left: 20px; font-size: 35px;" class="iconify invoice" data-icon="fa-solid:file-invoice-dollar"></span>
                                            @else
                                                <span style="margin-left: 20px; font-size: 35px;" class="iconify invoice" data-icon="ant-design:file-done-outlined"></span>
                                            @endif
                                            </td>
                                            <td>{{ $i->id }}</td>
                                            @foreach ($customers as $c)
                                                @if ($c->id == $i->customer_id)
                                                    <td><span>#{{ $c->id }} {{ $c->name }}</span></td>
                                                @endif
                                            @endforeach
                                            <td class="creation_date">{{ $i->created_at->format('d-m-Y') }}</td>
                                            <td class="icons">
                                                {{-- View --}}
                                                <a target="_blank" href="{{ route('invoice-pdf', ['status'=>'view', 'id'=>$i->id]) }}">
                                                    <span class="iconify icon eye" data-icon="akar-icons:eye"></span>
                                                </a>
                                                {{-- Download --}}
                                                <a target="_blank" href="{{ route('invoice-pdf', ['status'=>'download', 'id'=>$i->id]) }}">
                                                    <span class="iconify icon download" data-icon="akar-icons:download"></span>
                                                </a>
                                                {{-- Mail --}}
                                                @if (!$i->paid)
                                                    <a href="/invoice/mailto?id={{ $i->id }}">
                                                        <span class="iconify icon send" data-icon="bx:mail-send"></span>
                                                    </a>
                                                @else
                                                    <a class="disabled-link" href="{{ route('mail-invoice') }}">
                                                        <span class="iconify icon send" data-icon="bx:mail-send"></span>
                                                    </a>
                                                @endif
                                                {{-- Delete --}}
                                                <a href="/invoice/delete?id={{ $i->id }}">
                                                    <span class="iconify icon delete" data-icon="akar-icons:circle-x-fill"></span>
                                                </a>
                                                {{-- Finish --}}
                                                <div class="finished">
                                                @if (!$i->paid)
                                                    <form action="{{ route('finish-invoice', ['id'=>$i->id]) }}" method="POST">
                                                        @csrf
                                                        <input type="submit" value="Afronden">
                                                    </form>
                                                    @else
                                                        <span class="iconify icon finish" data-icon="akar-icons:circle-check-fill"></span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
