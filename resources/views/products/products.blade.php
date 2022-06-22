<link rel="stylesheet" href="./stylesheet.css">
<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
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
                    <table class="p-table" style="width: 100%">
                        <tr>
                            <td><div>ID</div></td>
                            <td><div>Productnaam</div></td>
                            <td><div>Prijs</div></td>
                            <td><div>Acties</div></td>
                        </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td><div>{{ $product->id }}</div></td>
                            <td><div>{{ $product->name }}</div></td>
                            <td><div>{{ $product->price }}</div></td>
                        </tr>
                    @endforeach
                    <table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
