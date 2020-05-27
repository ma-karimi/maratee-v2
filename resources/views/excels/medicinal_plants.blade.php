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
        @if($keys['origin'] ?? false)
            <th style="{{$th}}">Origin</th>
        @endif
        @if($keys['part_used'] ?? false)
            <th style="{{$th}}">Aerial Parts</th>
            <th style="{{$th}}">Underground Part</th>
        @endif

        @if($keys['wooden'] ?? false)
            <th style="{{$th}}">Wooden</th>
        @endif

        @if($keys['properties'] ?? false)
            <th style="{{$th}}">The most important medicinal properties</th>
            <th style="{{$th}}">Properties Description</th>
        @endif
        @if($keys['metabolite'] ?? false)

            <th style="{{$th_transaction}}">Secondary Metabolite</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['taxonomy'], 'keys'=>$keys])
            @if($keys['origin'] ?? false)
                <td style="{{$td}}">{{ $item['origin']['name'] ?? null }}</td>
            @endif
            @if($keys['part_used'] ?? false)
                <td style="{{$td}}">{{ $item['aerial_type'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['ground_type']['name'] ?? null }}</td>
            @endif

{{--            @if($keys['wooden'] ?? false)--}}
{{--                <td style="{{$td}}">{{$item['wooden'] ?? null}}</td>--}}
{{--            @endif--}}
            @if($keys['properties'] ?? false)
                <td style="{{$td}}">{{$item['medicinal_properties'] ?? null}}</td>
                <td style="{{$td}}">{{$item['properties_description'] ?? null}}</td>
            @endif

            @if($keys['metabolite'] ?? false)
                <td style="{{$td}}">{{$item['metabolites'] ?? null}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
