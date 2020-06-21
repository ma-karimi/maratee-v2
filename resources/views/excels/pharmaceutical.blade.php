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
        @if($keys['product_name'] ?? false)
            <th style="{{$th}}">product in English</th>
            <th style="{{$th}}">product in Persian</th>
        @endif
        @if($keys['medicine_name'] ?? false)
            <th style="{{$th}}">Name of medicine in English</th>
            <th style="{{$th}}">Name of medicine in Persian</th>
        @endif
        @if($keys['company'] ?? false)
            <th style="{{$th}}">Company</th>
            <th style="{{$th}}">Telephone</th>
            <th style="{{$th}}">Address</th>
        @endif
        @if($keys['pharmaceutical'] ?? false)
            <th style="{{$th}}">Pharmaceutical form</th>
        @endif
        @if($keys['consumption'] ?? false)
            <th style="{{$th}}">Consumption</th>
        @endif
        @if($keys['component'] ?? false)
            <th style="{{$th}}">Components of the product</th>
        @endif
        @if($keys['compound'] ?? false)
            <th style="{{$th}}">Active compounds</th>
        @endif
        @if($keys['side_effect'] ?? false)
            <th style="{{$th}}">The most important side effects</th>
        @endif
        @if($keys['registration'] ?? false)
            <th style="{{$th}}">Registration status of the product</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['taxonomy'], 'keys'=>$keys])
            @if($keys['product_name'] ?? false)
                <td style="{{$td}}">{{ $item['drug_name_en'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['drug_name_fa'] ?? null }}</td>
            @endif
            @if($keys['medicine_name'] ?? false)
                <td style="{{$td}}">{{ $item['name_en'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['name_fa'] ?? null }}</td>
            @endif
            @if($keys['company'] ?? false)
                <td style="{{$td}}">{{ $item['company'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['telephone'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['address'] ?? null }}</td>
            @endif
            @if($keys['pharmaceutical'] ?? false)
                <td style="{{$td}}">{{ $item['pharmaceutical_form']['name'] ?? null }}</td>
            @endif
            @if($keys['consumption'] ?? false)
                <td style="{{$td}}">{{ $item['consumption'] ?? null }}</td>
            @endif
            @if($keys['component'] ?? false)
                <td style="{{$td}}">{{ $item['components'] ?? null }}</td>
            @endif
            @if($keys['compound'] ?? false)
                <td style="{{$td}}">{{ $item['active_compounds'] ?? null }}</td>
            @endif
            @if($keys['side_effect'] ?? false)
                <td style="{{$td}}">{{ $item['side_effects'] ?? null }}</td>
            @endif
            @if($keys['registration'] ?? false)
                <td style="{{$td}}">{{ $item['status_name'] ?? null }}</td>
            @endif


        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
