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
        <th style="{{$th}}">Herbarium Number</th>
        <th style="{{$th}}">Herbarium Name</th>
        <th style="{{$th}}">Phylum</th>
        @include('excels.partials.taxonomyHeader')
        @if($keys['location'] ?? false)
            <th style="{{$th}}">Location</th>
            <th style="{{$th}}">N</th>
            <th style="{{$th}}">E</th>
            <th style="{{$th}}">Height of gathering place</th>
        @endif
        @if($keys['collect'] ?? false)
            <th style="{{$th}}">Collectors</th>
            <th style="{{$th}}">Date of Collecting</th>
        @endif
        @if($keys['substrate'] ?? false)
            <th style="{{$th}}">Substrate</th>
        @endif
        @if($keys['description'] ?? false)
            <th style="{{$th}}">Description</th>
        @endif
        @if($keys['phytogeography'] ?? false)
            <th style="{{$th}}">Phytogeographical Region</th>
        @endif
        @if($keys['determine'] ?? false)
            <th style="{{$th}}">Determinator</th>
        @endif
        @if($keys['habitat'] ?? false)
            <th style="{{$th}}">Habitat</th>
        @endif
        @if($keys['borrow'] ?? false)
            <th style="{{$th}}">Borrower's name (Last Lending)</th>
            <th style="{{$th}}">Organization or university</th>
            <th style="{{$th}}">Date received</th>
            <th style="{{$th}}">Return date</th>
        @endif
        @if($keys['visit'] ?? false)
            <th style="{{$th}}">Sample impression (Last Lending)</th>
            <th style="{{$th}}">Organization or university</th>
            <th style="{{$th}}">Service date</th>
            <th style="{{$th}}">Referred Name</th>
        @endif
        @if($keys['exchange'] ?? false)
            <th style="{{$th}}">Last Exchange Receive</th>
            <th style="{{$th}}">Last Exchange Send</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item->herbarium_number ?? null }}</td>
            <td style="{{$td}}">{{ $item->herbarium_name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->phylum['name'] ?? null }}</td>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item->taxonomy, 'keys'=>$keys])
            @if($keys['location'] ?? false)
                <td>{{ $item['location']['address_en'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location']['point']['DMS'][0] ?? null }}</td>
                <td style="{{$td}}">{{ $item['location']['point']['DMS'][1] ?? null }}</td>
                <td style="{{$td}}">{{ $item['location']['min_altitude']}} - {{ $item['location']['max_altitude']}}</td>
            @endif
            @if($keys['collect'] ?? false)
                <td style="{{$td}}">{{$item['collect']['date'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['collect']['authors'] ?? null}}</td>
            @endif

            @if($keys['substrate'] ?? false)
                <td style="{{$td}}">{{$item['substrate'] ?? null}}</td>
            @endif
            @if($keys['description'] ?? false)
                <td style="{{$td}}">{{$item['description'] ?? null}}</td>
            @endif
            @if($keys['phytogeography'] ?? false)
                <td style="{{$td}}">{{$item['general_phytogeography']['name'] ?? null}}</td>
            @endif
            @if($keys['determine'] ?? false)
                <td style="{{$td}}">{{ $item['determine']['authors'] ?? null}}</td>
            @endif
            @if($keys['habitat'] ?? false)
                <td style="{{$td}}">{{$item['general_habitat']['name'] ?? null}}</td>
            @endif
            @if($keys['borrow'] ?? false)
                <td style="{{$td}}">{{$item['borrow']['member_name'] ?? null}}</td>
                <td style="{{$td}}">{{$item['borrow']['start_time'] ?? null}}</td>
                <td style="{{$td}}">{{$item['borrow']['organization']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{!empty($item['borrow']['end_time']) ? $item['borrow']['end_time'] : null}}</td>
            @endif
            @if($keys['visit'] ?? false)
                <td style="{{$td}}">{{$item['visit']['sample_impression'] ?? null}}</td>
                <td style="{{$td}}">{{$item['visit']['start_time'] ?? null}}</td>
                <td style="{{$td}}">{{$item['visit']['member_name'] ?? null}}</td>
            @endif
            @if($keys['exchange'] ?? false)
                <td style="{{$td}}">{{$item['exchange_receive']['organization']['name_en'] ?? null}}{{$item['exchange_receive']['start_time'] ?? null}}</td>
                <td style="{{$td}}">{{$item['exchange_send']['organization']['name_en'] ?? null}}{{$item['exchange_send']['start_time'] ?? null}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
