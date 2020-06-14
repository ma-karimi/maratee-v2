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
    $td = 'max-width:250px border-spacing: 10px; border-collapse: separate;';
@endphp
<table class="table">
    <thead>
    <tr>
        @if($keys['local_name'] ?? false)
            <th style="{{$th}}">Local/Persian Name</th>
        @endif
        @if($keys['scientific'] ?? false)
            <th style="{{$th}}">Scientific Name</th>
        @endif
        @if($keys['family'] ?? false)
            <th style="{{$th}}">Family</th>
        @endif
        @if($keys['genus'] ?? false)
            <th style="{{$th}}">Genus</th>
        @endif
        @if($keys['species'] ?? false)
            <th style="{{$th}}">Species</th>
        @endif
        @if($keys['order'] ?? false)
            <th style="{{$th}}">Order</th>
        @endif
        @if($keys['subspecies'] ?? false)>
        <th style="{{$th}}">Infra Specific</th>
        @endif
        @if($keys['type_status'] ?? false)>
        <th style="{{$th}}">Type Status</th>
        @endif
        @if($keys['division'] ?? false)>
        <th style="{{$th}}">Divisions</th>
        @endif
        @if($keys['sample'] ?? false)>
        <th style="{{$th}}">Samples</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @if($keys['scientific'] ?? false)
                <td style="{{$td}}">{{ $item->scientific_name ?? null }}</td>
            @endif
            @if($keys['local_name'] ?? false)
                <td style="{{$td}}">{{ $item->name ?? null }}</td>
            @endif
            @if($keys['family'] ?? false)
                <td style="{{$td}}">{{ $item->family->name ?? null }}</td>
            @endif
            @if($keys['genus'] ?? false)
                <td style="{{$td}}">{{ $item->genus->name ?? null }}</td>

            @endif
            @if($keys['species'] ?? false)
                <td style="{{$td}}">
                    {{ $item->species->name ?? null }} {{ $item->species_author ?? null }}
                </td>
            @endif
            @if($keys['subspecies'] ?? false)
                <td style="{{$td}}">{{ $item->infra_specific->name ?? null }}
                </td>
            @endif
            @if($keys['type_status'] ?? false)
                <td style="{{$td}}">{{ $item->type_status->name ?? null }}
                </td>
            @endif
            @if($keys['division'] ?? false)
                <td style="{{$td}}">{{ $item['division'] ?? null }}</td>
            @endif
            @if($keys['sample'] ?? false)
                <td style="{{$td}}">{{ $item['sample'] ?? null }}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
