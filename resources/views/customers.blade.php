<link rel="stylesheet" href="./stylesheet.css">
<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <a class="new-invoice" href="#">Nieuw Bedrijf</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="content-wrap">
                        <div class="content-wrapper">
                            <div class="grid">
                                @foreach ($customers as $c)
                                <a class="griditemlink" href="{{ route('customer-details', ['slug'=>$c->slug]) }}">
                                    <div class="griditem">
                                        <img class="customerLogo" src="/media/{{ $c->logo }}" alt="">
                                        <p class="customerName">{{ $c->name }}</p>
                                        <p class="customerEmail">{{ $c->email }}</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
