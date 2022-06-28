<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Medewerkers') }}
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
                            <table style="width: 100%">
                                <tr>
                                    <td>Naam</td>
                                    <td>Email</td>
                                    <td>Accountdatum</td>
                                </tr>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
