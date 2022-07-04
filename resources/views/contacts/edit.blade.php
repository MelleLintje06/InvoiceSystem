<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <p>Contact Bewerken</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="">
                        <form action="{{ route('update-contact') }}" method="POST" class="invoice-form">
                            @csrf
                            <input type="hidden" value="{{ $contact->id }}" name="id">
                            <select name="gender">
                                @if($contact->gender == 'dhr')
                                    <option selected value="dhr">Dhr</option>
                                @else
                                    <option selected value="mevr">Mevr</option>
                                @endif
                            </select>
                            <div class="c-name">
                                <div class="naam">
                                    <h4>Voornaam</h4>
                                    <input type="text" class="" name="f-name" value="{{ $contact->firstname }}"></input>
                                </div>
                                <div class="naam">
                                    <h4>Achternaam</h4>
                                    <input type="text" class="" name="l-name" value="{{ $contact->lastname }}"></input>
                                </div>
                            </div>
                            <div class="price">
                                <h4>Bedrijf</h4>
                                <select name="company">
                                    @foreach ($companies as $company)
                                        @if ($contact->company_id == $company->id)
                                            <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                        @else
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="role">
                                <h4>Rol binnen bedrijf</h4>
                                <input type="text" class="" name="role" value="{{ $contact->role }}"></input>
                            </div>
                            <div class="email">
                                <h4>Email</h4>
                                <input type="text" class="" name="email" value="{{ $contact->email }}"></input>
                            </div>
                            <div class="phone">
                                <h4>Telefoon</h4>
                                <input type="text" class="" name="phone" value="{{ $contact->phone }}"></input>
                            </div>
                            <div style="margin-top: 20px">
                                <input type="submit" value="Bewerken">
                            <div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
