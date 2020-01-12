<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .table td, .table th {
            min-width: 200px;

        }
        table td{
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
        <th style="{{$th}}">Family</th>
        <th style="{{$th}}">Genus</th>
        <th style="{{$th}}">Species</th>
        <th style="{{$th}}">SubSpecies</th>
        <th style="{{$th}}">Variety</th>
        <th style="{{$th}}">Local/Persian Name</th>
        <th style="{{$th}}">Scientific Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item->family->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->genus->name ?? null }}</td>
            <td style="{{$td}}">
                {{ $item->species->name ?? null }}
                @if (!empty($item->species->authors) && count($item->species->authors))
                    | {{$item->species->actors}}
                @endif
            </td>
            <td style="{{$td}}">{{ $item->subspecies->name ?? null }}
                @if (!empty($item->subspecies->authors) && count($item->subspecies->authors))
                    | {{$item->subspecies->actors}}
                @endif
            </td>
            <td style="{{$td}}">{{ $item->variety->name ?? null }}
                @if (!empty($item->variety->authors) && count($item->variety->authors))
                    | {{$item->variety->actors}}
                @endif
            </td>
            <td style="{{$td}}">{{ $item->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->scientific->name ?? null }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
