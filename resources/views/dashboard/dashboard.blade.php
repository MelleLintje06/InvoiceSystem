<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('InspireWeb') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Grid --}}
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight db-header-1"><p><span id="action">Acties</span></p></h2>
                    <div class="dashboard">
                        @foreach ($tasks as $task)
                            <a class="db-link" id="task-{{ $task->id }}" href="{{ $task->url }}">
                                <div class="db-item">
                                    <div>
                                        <div class="db-image">
                                            <span class="iconify" data-icon="{{ $task->icon }}"></span>
                                        </div>
                                        <div class="db-title">
                                            {{ $task->title }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="db-actions">
                        <button id="previous" disabled onclick="removeToCurrentPage()"><</button>
                        <button id="next" onclick="addToCurrentPage();">></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    // Random Background Setter
    const taskBackground = () => {
        document.querySelectorAll('.db-item').forEach(item => {
            let randomColor = Math.floor(Math.random()*16777215).toString(16);
            item.style.backgroundColor = "#" + randomColor;
        })
    }
    // taskBackground();

    // Item Pagination
    let current_page = 1;
    let min = 0
    const counter = 8;
    const addpagination = () => {
        const totaal_items = document.querySelectorAll('.db-link');
        for (let i = 0; i < totaal_items.length; i++) {
            if (i <= (current_page * counter - 1) && i > (min - 1)) {
                totaal_items[i].classList.add('db-view');
                totaal_items[i].classList.remove('db-invis');
            } else {
                totaal_items[i].classList.remove('db-view');
                totaal_items[i].classList.add('db-invis');
            }
        }
    }
    addpagination();

    const addToCurrentPage = () => {
        if ((document.querySelectorAll('.db-link').length / counter) >= current_page){
            current_page = current_page + 1;
            min = min + counter;
            // Disable / Enable buttons
            if ((current_page * counter +1) > document.querySelectorAll('.db-link').length) {
                document.getElementById("next").disabled = true;
                document.getElementById("previous").disabled = false;
            }
            else {
                document.getElementById("next").disabled = false;
                document.getElementById("previous").disabled = false;
            }
            addpagination();
        }
    }

    const removeToCurrentPage = () => {
        // Nog oplossen
        if (current_page <= 1){}
        else {
            current_page = current_page - 1;
            min = min - counter;
            // Disable / Enable buttons
            if ((current_page * counter +1 ) < document.querySelectorAll('.db-link').length) {
                document.getElementById("next").disabled = false;
                document.getElementById("previous").disabled = true;
            }
            else {
                document.getElementById("next").disabled = false;
                document.getElementById("previous").disabled = false;
            }
            // document.getElementById("previous").disabled = false;
            addpagination();
        }
    }

    if (document.querySelectorAll('.db-link').length <= counter) {
        document.getElementById("previous").disabled = true;
        document.getElementById("next").disabled = true;
    }
</script>
