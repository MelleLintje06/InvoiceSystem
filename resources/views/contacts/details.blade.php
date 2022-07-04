<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <a class="new-invoice" href="{{ route('edit-contact', ['id'=>$contact->id]) }}">Contact Bewerken</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="contactdetails">
                        <div class="contactinfo">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight contactname">{{ $contact->firstname }} {{ $contact->lastname }}</h2>
                            <p>Bedrijf: <span><a href="{{ $company->website }}" target="_blank">{{ $company->name }}</a></span></p>
                            <p>Rol binnen bedrijf: <span>{{ $contact->role }}</span></p>
                            <p>Email: <span><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></span></p>
                            <p>Telefoonnummer: <span><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></span></p>
                        </div>
                        <div class="contactimg">
                            <img src="../media/{{ $contact->image }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
