<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <a class="new-invoice" href="{{ route('create-product') }}">Nieuw Product</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight db-header-1"><p><span id="action">Producten</span></p></h2>
                    <table class="p-table" style="width: 100%">
                        <tr>
                            <td><div>Productnaam</div></td>
                            <td><div>Prijs</div></td>
                            <td><div style="text-align: center;">Acties</div></td>
                        </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td><div>{{ $product->name }}</div></td>
                            <td><div>€ {{ $product->price }},-</div></td>
                            <td class="icons">
                                <div class="icon-container">
                                <a href="{{ route('edit-product', ['id'=>$product->id]) }}" style="padding-left: 35px;">
                                    <span class="iconify icon edit" data-icon="bxs:edit"></span>
                                </a>
                                <a href="{{ route('destroy-product', ['id'=>$product->id]) }}">
                                    <span class="iconify icon delete" data-icon="akar-icons:circle-x-fill"></span>
                                </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
