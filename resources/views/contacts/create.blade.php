<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Contact Toevoegen') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="content-wrap">
                        <div class="content-wrapper">
                            <form action="{{ route('post-contact') }}" method="POST" class="invoice-form">
                                @csrf
                                <select name="gender">
                                    <option value="dhr">Dhr</option>
                                    <option value="mevr">Mevr</option>
                                </select>
                                <div class="c-name">
                                    <div class="naam">
                                        <h4>Voornaam</h4>
                                        <input type="text" class="" name="f-name"></input>
                                    </div>
                                    <div class="naam">
                                        <h4>Achternaam</h4>
                                        <input type="text" class="" name="l-name"></input>
                                    </div>
                                </div>
                                <div class="price">
                                    <h4>Bedrijf</h4>
                                    <select name="company">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="role">
                                    <h4>Rol binnen bedrijf</h4>
                                    <input type="text" class="" name="role"></input>
                                </div>
                                <div class="email">
                                    <h4>Email</h4>
                                    <input type="text" class="" name="email"></input>
                                </div>
                                <div class="phone">
                                    <h4>Telefoon</h4>
                                    <input type="text" class="" name="phone"></input>
                                </div>
                                <div style="margin-top: 20px">
                                    <input type="submit" value="Toevoegen">
                                <div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
