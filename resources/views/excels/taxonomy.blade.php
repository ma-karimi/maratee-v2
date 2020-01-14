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
        @if($keys['family'] ?? false)
            <th style="{{$th}}">Family</th>
        @endif
        @if($keys['genus'] ?? false)
            <th style="{{$th}}">Genus</th>
        @endif
        @if($keys['species'] ?? false)
            <th style="{{$th}}">Species</th>
        @endif
        @if($keys['subspecies'] ?? false)
            <th style="{{$th}}">SubSpecies</th>
        @endif
        @if($keys['variety'] ?? false)>
        <th style="{{$th}}">Variety</th>
        @endif
        @if($keys['local_name'] ?? false)
            <th style="{{$th}}">Local/Persian Name</th>
        @endif
        @if($keys['scientific'] ?? false)
            <th style="{{$th}}">Scientific Name</th>
        @endif
        @if($keys['non_native'] ?? false)
            <th style="{{$th}}">Non Native</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @if($keys['family'] ?? false)
                <td style="{{$td}}">{{ $item->family->name ?? null }}</td>
            @endif
            @if($keys['genus'] ?? false)
                <td style="{{$td}}">{{ $item->genus->name ?? null }}</td>

            @endif
            @if($keys['species'] ?? false)
                <td style="{{$td}}">
                    {{ $item->species->name ?? null }}
                    @if (!empty($item->species->authors) && count($item->species->authors))
                        | {{$item->species->actors}}
                    @endif
                </td>
            @endif
            @if($keys['subspecies'] ?? false)
                <td style="{{$td}}">{{ $item->subspecies->name ?? null }}
                    @if (!empty($item->subspecies->authors) && count($item->subspecies->authors))
                        | {{$item->subspecies->actors}}
                    @endif
                </td>
            @endif
            @if($keys['variety'] ?? false)
                <td style="{{$td}}">{{ $item->variety->name ?? null }}
                    @if (!empty($item->variety->authors) && count($item->variety->authors))
                        | {{$item->variety->actors}}
                    @endif
                </td>
            @endif
            @if($keys['local_name'] ?? false)
                <td style="{{$td}}">{{ $item->name ?? null }}</td>

            @endif
            @if($keys['scientific'] ?? false)
                <td style="{{$td}}">{{ $item->scientific_name ?? null }}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
