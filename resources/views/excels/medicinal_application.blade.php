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
        @if($keys['part_used'] ?? false)
            <th style="{{$th}}">Has Aerial Part</th>
            <th style="{{$th}}">Has Underground Part</th>
            <th style="{{$th}}">Aerial Types</th>
            <th style="{{$th}}">Underground Parts</th>
        @endif
        @if($keys['plants_used'] ?? false)
            <th style="{{$th}}">Plants Used in Traditional Iranian Medicine</th>
            <th style="{{$th}}">Official Natural Drugs</th>
            <th style="{{$th}}">Food Industries</th>
            <th style="{{$th}}">Hygenic-Cosmetic industries</th>
            <th style="{{$th}}">Other industries</th>
            <th style="{{$th}}">Plants used inHerbal medicine store</th>
        @endif
        @if($keys['import_export'] ?? false)
            <th style="{{$th}}">Has Exporting</th>
            <th style="{{$th}}">Has Importing</th>
            <th style="{{$th}}">Exporting</th>
            <th style="{{$th}}">Importing</th>
        @endif
        @if($keys['cultivate'] ?? false)
            <th style="{{$th}}">The cultivated area in the country</th>
        @endif
        @if($keys['industrial'] ?? false)
            <th style="{{$th}}">Industrial Potential</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['taxonomy'], 'keys'=>$keys])

            @if($keys['part_used'] ?? false)
                <td style="{{$td}}">{{ $item['has_aerial_part'] == 1 }}</td>
                <td style="{{$td}}">{{ $item['has_ground_part'] == 1 }}</td>
                <td style="{{$td}}">{{ $item['aerial_type'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['underground_part'] ?? null }}</td>
            @endif
            @if($keys['plants_used'] ?? false)
                <td style="{{$td}}">{{ $item['traditional_iranian_medicine_name'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['natural_drug_name'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['foods'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['hygienic_cosmetic']['name'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['industries'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['inherbal_medicine_store_name'] ?? null }}</td>
            @endif
            @if($keys['import_export'] ?? false)
                <td>{{ $item['has_exporting']}} </td>
                <td>{{ $item['has_importing']}} </td>
                <td>{{ $item['exporting_name']}} </td>
                <td>{{ $item['importing_name']}} </td>
            @endif
            @if($keys['cultivate'] ?? false)
                <td style="{{$td}}">{{$item['cultivated_area'] ?? null}}</td>
            @endif
            @if($keys['industrial'] ?? false)
                <td style="{{$td}}">{{$item['potentials'] ?? null}}</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
