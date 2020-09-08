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
        <th style="{{$th}}">Accession Code</th>
        <th style="{{$th}}">Specimen type</th>
        <th style="{{$th}}">Collection name</th>
        <th style="{{$th}}">Regeneration and evaluation code</th>
        @include('excels.partials.taxonomyHeader')
        @if($keys['row&column'] ?? false)
            <th style="{{$th}}">Row</th>
            <th style="{{$th}}">Column</th>
        @endif
        @if($keys['humidity'] ?? false)
            <th style="{{$th}}">Fruit Relative humidity%</th>
            <th style="{{$th}}">Seed Relative humidity%</th>
        @endif
        @if($keys['purity'] ?? false)
            <th style="{{$th}}">Fruit Purity%</th>
            <th style="{{$th}}">Seed Purity%</th>
        @endif
        @if($keys['weight'] ?? false)
            <th style="{{$th}}">Mean number of seeds per fruit</th>
            <th style="{{$th}}">Range of seeds per fruit</th>
            <th style="{{$th}}">1000 fruits weight</th>
            <th style="{{$th}}">1000 seeds weight</th>
            <th style="{{$th}}">seed weight</th>
            <th style="{{$th}}">fruit weight</th>
        @endif

        @if($keys['banked'] ?? false)
            <th style="{{$th}}">Date banked</th>
        @endif
        @if($keys['other'] ?? false)
            <th style="{{$th}}">Other details</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item['accession_code'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['specimen_type']['name'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['collection']['name'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['regeneration_code'] ?? null}}</td>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['seedCollection']['taxonomy'], 'keys'=>$keys])

            @if($keys['row&column'] ?? false)
                <td style="{{$td}}">{{ $item['row'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['column'] ?? null}}</td>
            @endif
            @if($keys['humidity'] ?? false)
                <td style="{{$td}}">{{ $item['fruit_humidity'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['seed_humidity'] ?? null}}</td>
            @endif
            @if($keys['purity'] ?? false)
                <td style="{{$td}}">{{ $item['fruit_purity'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['seed_purity'] ?? null}}</td>
            @endif
            @if($keys['weight'] ?? false)
                <td style="{{$td}}">{{ $item['number_seeds_per_fruit'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['range_seeds_per_fruit'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['thousand_fruits_weight'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['thousand_seeds_weight'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['total_seed_weight'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['total_fruit_weight'] ?? null }}</td>
            @endif

            @if($keys['banked'] ?? false)
                <td style="{{$td}}">{{ $item['banked'] ?? null}}</td>
            @endif
            @if($keys['detail'] ?? false)
                <td style="{{$td}}">{{ $item['description'] ?? null}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
