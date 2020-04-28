<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .table td, .table th {
            min-width: 200px;

        }

        table td {
            padding: 10px 5px;
        }
    </style>
</head>
<body>
@php
    $th = 'background: #DA9694; text-align: center; border-spacing: 10px; border-collapse: separate;';
    $th_transaction = 'background: #ccc; text-align: center; border-spacing: 10px; border-collapse: separate;';
    $td = 'max-width:250px border-spacing: 10px; border-collapse: separate;';
@endphp

<table class="table">
    <thead>
    <tr>
        @include('excels.partials.taxonomyHeader')

        <th style="{{$th}}">Medicinal product in English</th>
        <th style="{{$th}}">Medicinal product in Persian</th>
        <th style="{{$th}}">Product in English</th>
        <th style="{{$th}}">Product in Persian</th>
        <th style="{{$th}}">Company</th>
        <th style="{{$th}}">Telephone</th>
        <th style="{{$th}}">Address</th>
        <th style="{{$th}}">Pharmaceutical form</th>
        <th style="{{$th}}">Consumption</th>
        <th style="{{$th}}">Components of the product</th>
        <th style="{{$th}}">Active compounds</th>
        <th style="{{$th}}">The most important side effects</th>
        <th style="{{$th}}">Registration status of the product</th>
    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item->code ?? null }}</td>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['taxonomy'], 'keys'=>$keys])
            <td style="{{$td}}">{{ $item['drug_name_en'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['drug_name_fa'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['name_en'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['name_fa'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['company'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['telephone'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['address'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['pharmaceutical_form']['name'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['consumption'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['components'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['active_compounds'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['side_effects'] ?? null }}</td>
            <td style="{{$td}}">{{ $item['status_name'] ?? null }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
