<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/pdf.css">
</head>
<style>
    * {
        font-family: 'Poppins', sans-serif;
    }
    body {
        margin: 20px;
        /* color: #124085; */
    }
    .informatie table {
        width: 50%;
        float: left;
        margin-top: 20px;
    }
    .informatie table:first-child {
        /* border-right: 2px solid #eaeaea; */
    }
    .informatie table:first-child tr:first-child {
        font-weight: bold;
    }
    .producten {
        margin-top: 160px;
    }
    .producten table {
        width: 100%;
    }
    .producten table {
        border-collapse: collapse;
    }
    .producten table:first-child tr:first-child td {
        border-bottom: 1px solid black;
    }
    .producten h3 {
        margin: -20px 0px 20px 0px;
    }
    .flex  {
        width: 100%;
        float: left;
    }
    .factuur {
        border-bottom: 1px solid black;
    }
    .info {
        text-align: right;
        color: #124085;
    }
    .eindtekst {
        position: absolute;
        width: 100%;
        bottom: 0;
        margin-left: auto;
        margin-right: auto;
    }
    .details {
        font-weight: bold;
    }
    .producten table tr:nth-child(even) {
        /* background: #ececec; */
    }
    table.factuurinfo {
        border-collapse: collapse;
        width: 40%;
        float: right;
        /* border: 2px solid gray; */
    }
    .factuurinfo_text div {
        /* border-bottom: 1px solid gray */
    }
    .factuurinfo_text:last-child {
        background: #124085;
        color: white !important;
        /* border-bottom: none; */
    }
    .factuurdetails {
        text-align: right;
    }
    .opmerkingen {
        width: 100%;
        margin-top: -20px;
        margin-bottom: 50px;
    }
    .betaalmethode p {
        width: 49%;
    }
    .betaalmethode p:last-child {
        float: right;
        margin-top: -35px;
    }
</style>
<body>
    @php
        $discount = 0;
        $totaal = 0;
        $btw = 0;
        $bedrag = 0;
        $number = 1;
    @endphp
    @foreach ($details as $detail)
        @foreach ($products as $product)
            @if ($detail->product_id == $product->id)
                @php
                    $btw = $btw + ($product->price * 0.21);
                    $discount = $discount + $product->price * ($detail->discount / 100);
                    $bedrag = $bedrag + $product->price;
                    $totaal = $totaal + $product->price * ((100 - $detail->discount) / 100) * 1.21 * $detail->quantity;
                @endphp
            @endif
        @endforeach
    @endforeach
    <div class="flex">
        <div class="logo">
            <img src="./media/ezgif.com-gif-maker.png" width="110px" height="110px" style="position: absolute"/>
        </div>
        <div class="info">
            <h1>InspireWeb</h1>
            <span>Venbroek 24, 5527 BH Hapert</span><br>
            <span>+31(0)6-15583771 | www.inspireweb.nl | info@inspireweb.nl</span><br>
            <span>KvK - | BTW -</span>
        </div>
    </div>
    <div class="factuur">
        <h2>FACTUUR</h2>
        <span style="float: right; margin-top: -40px;">{{ $invoices->id }}</span>
    </div>
    <div class="informatie">
        <table>
            <tr><td>Aan:</td></tr>
            <tr><td>{{ $customer->name }}</td></tr>
            <tr><td>{{ $customer->address }}</td></tr>
            <tr><td>{{ $customer->postalcode }} {{ $customer->city }}</td></tr>
        </table>

        <table class="factuurinfo">
            <br>
            <tr class="factuurinfo_text">
                <td>Factuurdatum:</td>
                <td class="factuurdetails">{{ $invoices->created_at->format('d-m-Y') }}</td>
            </tr>
            <tr class="factuurinfo_text">
                <td>Betaaltermijn:</td>
                <td class="factuurdetails">14 dagen</td>
            </tr>
            <tr class="factuurinfo_text">
                <td>Vervaldatum:</td>
                <td class="factuurdetails">{{ $invoices->updated_at->format('d-m-Y') }}</td>
            </tr>
            <tr class="factuurinfo_text">
                <td>Totaal:</td>
                <td class="factuurdetails">€ {{ number_format($totaal, 2) }}</td>
            </tr>
        </table>
    </div>
    <div class="producten">
        <h3>Producten</h3>
        <table>
            {{-- Product Header --}}
            <tr>
                <td>*</td>
                <td>Omschrijving</td>
                <td>Aantal</td>
                <td>Prijs</td>
                <td>BTW</td>
                <td>Korting</td>
                <td>Bedrag</td>
            </tr>
            {{-- Products --}}
            @foreach ($details as $detail)
                <tr class="productsrow">
                    <td>{{ $number }}</td>
                    @foreach ($products as $product)
                        @if ($detail->product_id == $product->id)
                            <td>{{ $product->name }}</td>
                        @endif
                    @endforeach
                    <td>{{ $detail->quantity }}</td>
                    @foreach ($products as $product)
                        @if ($detail->product_id == $product->id)
                            <td>€ {{ $product->price }},-</td>
                            @php
                                $prijs = $product->price * ((100 - $detail->discount) / 100) * 1.21 * $detail->quantity;
                            @endphp
                        @endif
                    @endforeach
                    <td>21%</td>
                    <td>{{ $detail->discount }}%</td>
                    <td>€ {{ number_format($prijs, 2) }}</td>
                </tr>
                @php
                    $number = $number +1;
                @endphp
            @endforeach
            <br><br>
        </table>
        <table style="width: 40%; float: right;">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="details">Bedrag (exl. BTW)</td>
                <td style="text-align: right;">€ {{ number_format($bedrag, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="details">BTW</td>
                <td style="text-align: right;">€ {{ number_format($btw, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="details">Korting</td>
                <td style="text-align: right;">€ {{ number_format($discount, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="border-top: 2px solid black;" class="details">Totaalbedrag</td>
                <td style="text-align: right; border-top: 2px solid black;">€ {{ number_format($totaal, 2) }}</td>
            </tr>
        </table>
    </div>
    <div class="opmerkingen">
        <h3>Voorwaarden en Opmerkingen</h3>
        <p>{!! $invoices->text !!}</p>
    </div>
    <div class="betaalmethode">
        <p>Betaalgegevens: NL81RABO0302179496</p>
        <p style="text-align: right">Valuta EUR</p>
    </div>
    <div class="eindtekst">
        Powered by <a href="https://inspireweb.nl/">InspireWeb</a> 2022
    </div>
</body>
</html>
