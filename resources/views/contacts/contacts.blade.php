<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <a class="new-invoice" href="{{ route('create-contact') }}">Nieuw Contact</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight db-header-1"><p><span id="action">Contacten</span></p></h2>
                    <div class="content-wrap">
                        <div class="content-wrapper">
                            <div class="grid contacts">
                                @foreach ($contacts as $contact)
                                    <a href="{{ route('contact', ['id'=>$contact->id]) }}" class="contact">
                                        <div>
                                            <div class="contact-name">
                                                <div>
                                                    @if ($contact->gender == 'dhr')
                                                        <span class="iconify" data-icon="et:profile-male"></span>
                                                    @else
                                                        <span class="iconify" data-icon="et:profile-female"></span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p>{{ $contact->firstname }} {{ $contact->lastname }}</p>
                                                </div>
                                            </div>
                                            <div class="contact-company">
                                                @foreach ($companies as $company)
                                                    @if ($company->id == $contact->company_id)
                                                        <p>{{ $company->name }}</p>
                                                    @endif
                                                @endforeach

                                            </div>
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
<script>
    const transitionGrid = () => {
        let i = 0.2
        document.querySelectorAll('.contact').forEach(contact => {
            contact.style.transitionDelay = `${i}s`;
            contact.style.opacity = 1;
            i = i + 0.2;
        })
    }
    window.onload = () => {
        document.getElementById('action').style.setProperty("--scale", "scaleX(.1)");
        transitionGrid();
    }


</script>
