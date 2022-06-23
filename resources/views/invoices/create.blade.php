<x-app-layout>
    <x-slot name="header">
        <div class="breeze-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('InspireWeb') }}
            </h2>
            <div class="new">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuwe Factuur</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('post-invoice') }}" class="invoice-form">
                        @csrf
                        <div class="input-customer">
                            <h4 style="margin-top: 0px;">Bedrijfsnaam</h4>
                            <select name="customers" id="customers" onchange="getCurrentCompany();">
                                @foreach ($customers as $c)
                                    <option class="customers" value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <a class="add-content new-company" onclick="displayCompanyModal();">Nieuw bedrijf toevoegen</a>
                            <h4>Contactpersoon</h4>
                            <select name="contacts">
                                @foreach ($contacts as $p)
                                    <option class="contacts company_{{ $p->company_id }}" id="{{ $p->id }}" value="{{ $p->id }}">{{ $p->firstname }} {{ $p->lastname }}</option>
                                @endforeach
                            </select>
                            <a class="add-content new-contact">Nieuw contact toevoegen</a>
                        </div>
                        <div class="beschrijving">
                            <h4>Beschrijving</h4>
                            <textarea class="ckeditor form-control" name="description"></textarea>
                        </div>
                        <div class="producten">
                            <h4>Producten</h4>
                            <table class="product">
                                <tbody class="product-body"></tbody>
                            </table>
                            <button onclick="addRowToTable();" type="button" class="add-row-button">Voeg regel toe</button>
                        </div>
                        <input id="date" name="datetime" type="hidden" value="">
                        <input id="expiredate" name="expiredate" type="hidden" value="">
                        <br><br>
                        <input type="submit" value="Factuur Opslaan">
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- Company Modal --}}
<div class="modal-company">
    <div class="modal-company-content">
        <span onclick="closeCompanyModal()" class="close-modal">&times;</span>
        <div class="company-content">
            <h2>Nieuw bedrijf toevoegen</h2>
            <form method="POST" action="/new-invoice/customer">
                @csrf
                <div>
                    <span>Bedrijfsnaam*</span><br>
                    <input onkeyup="createslug(this.value)" name="companyname" id="companyname" type="text">
                    <input type="hidden" name="slug" id="slug">
                </div>
                <div class="multiple-items">
                    <div>
                        <span>Email*</span><br>
                        <input name="mail" id="mail" type="email">
                    </div>
                    <div>
                        <span>Email 2</span><br>
                        <input name="mail2" id="mail2" type="email">
                    </div>
                </div>
                <div class="multiple-items">
                    <div>
                        <span>Telefoonnummer*</span><br>
                        <input name="tel" id="tel" type="tel">
                    </div>
                    <div>
                        <span>Telefoonnummer 2</span><br>
                        <input name="tel2" id="tel2" type="tel">
                    </div>
                </div>
                <div>
                    <span>Adres*</span><br>
                    <input name="address" id="address" type="text">
                </div>
                <div>
                    <span>Stad*</span><br>
                    <input name="city" id="city" type="text">
                </div>
                <div>
                    <span>Regio*</span><br>
                    <input name="region" id="region" type="text">
                </div>
                <div>
                    <span>Postcode*</span><br>
                    <input name="postalcode" id="postalcode" type="text">
                </div>
                <div>
                    <span>Land*</span><br>
                    <input name="country" id="country" type="text">
                </div>
                <span class="star-required-text">* is verplicht</span>
                <br>
                <input type="submit" class="company-save" value="Opslaan">
                <br>
            </form>
        </div>
    </div>
</div>
<script>
    // Filter contactpersoon
    const getCurrentCompany = () => {
        const companies = document.getElementById('customers');
        let company = companies.options[companies.selectedIndex].value;
        filterContacts(company);
    }

    const filterContacts = (company) => {
        const contacts = document.querySelectorAll('.contacts');
        let firstcontact = [];
        contacts.forEach(contact => {
            if (contact.classList[1] !== `company_${company}`) {
                contact.disabled = true;
                contact.selected = false;
                contact.style.display = 'none'
            } else {
                firstcontact.push(contact.value);
                contact.disabled = false;
                contact.style.display = 'block'
            }
        })
        document.getElementById(firstcontact[0]).selected = true;
        firstcontact = [];
    }
    getCurrentCompany();

    // Add Row Product
    let id = 0;
    const addRowToTable = () => {
        // Count rows
        let rows = document.querySelector(`.product`).rows.length;
        // Get Table
        const table = document.querySelector('.product');
        // Create Tr
        const row = table.insertRow(rows);
        row.classList.add('tbl-row', `id-${id}`);
        row.id = `row-${id}`;
        row.setAttribute("draggable", "true");
        row.setAttribute("ondragstart", "pickUp()");
        row.setAttribute("ondragover", "moveRow()");

        // Create td columns
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        const cell5 = row.insertCell(4);

        // Create content of td columns
        cell1.classList.add("td-move");
        cell1.innerHTML = `<div class="td-first"><span class="iconify move-icon" data-icon="oi:move"></span></div>`;
        cell2.innerHTML = `<p>Product:</p>
                            <select name="product[]" id="product">
                                @foreach ($products as $p)
                                    <option class="customers" value="{{ $p->id }}">{{ $p->name }} (€ {{ $p->price }},-)</option>
                                @endforeach
                            </select>`;
        cell3.innerHTML = `<p>Aantal:</p><input name="amount[]" type="number" min="1" value="1">`;
        cell4.innerHTML = `<p>Korting:</p><input name="sale[]" type="number" min="0" value="0">`;
        cell5.innerHTML = `<a style="cursor: pointer" onclick="removeRowToTable('id-${id}');"><span class="iconify remove" data-icon="ant-design:minus-circle-filled"></span></a>`;
        id = id +1;
    }
    addRowToTable();

    // Remove Row Product
    const removeRowToTable = (row_nr) => {
        // Get all rows
        let rows = document.querySelector('.product').rows;
        // Check if there are more than one row
        if (rows.length > 1) {
            for (let row of rows) {
                // Check if classname is the same
                if (row.classList[1] == row_nr) {
                    // Removes row
                    row.remove();
                }
            }
        } else {
            alert('Je moet minimaal 1 product hebben in je factuur');
        }
    }

    // Set Date in hidden field
    const setDate = () => {
        let todayDate = new Date().toISOString().slice(0, 10);
        document.getElementById('date').value = todayDate
        // 1.209.600.000 = 14 days
        let ms = new Date().getTime() + 1209600000;
        document.getElementById('expiredate').value = new Date(ms).toISOString().slice(0, 10);
    }
    setDate();

    // Drag And Drop Functionaliteiten
    let row;
    const pickUp = () => {
        row = event.target;
    }

    const moveRow = () => {
        // Get event
        let e = event;
        e.preventDefault();

        // Get all rows
        let rows = Array.from(e.target.parentNode.parentNode.children);

        // Check if row goes up or down
        if (rows.indexOf(e.target.parentNode) > rows.indexOf(row)) {
            // Put row down
            e.target.parentNode.after(row);
        } else {
            // Put row up
            e.target.parentNode.before(row);
        }
    }

    // Company Modal
    const Companymodal = document.querySelector('.modal-company')
    const displayCompanyModal = () => {
        Companymodal.style.display = 'block';
        Companymodal.style.opacity = 1;
    }

    const closeCompanyModal = () => {
        Companymodal.style.display = 'none';
        Companymodal.style.opacity = 0;
    }

    window.onclick = (event) => {
        if (event.target == Companymodal) {
            Companymodal.style.display = "none";
            Companymodal.style.opacity = 0;
        }
    }

    const createslug = (value) => {
        var text = value.toLowerCase();
        text = text.replace(/\s+/g, '-');
        document.getElementById('slug').value = text;
    }
</script>
