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
        <th style="{{$th}}">Herbarium Number</th>
        <th style="{{$th}}">Herbarium Index</th>
        @include('excels.partials.taxonomyHeader')
        @if($keys['location'] ?? false)
            <th style="{{$th}}">Location</th>
            <th style="{{$th}}">Alt</th>
            <th style="{{$th}}">N</th>
            <th style="{{$th}}">E</th>
        @endif
        @if($keys['collect'] ?? false)
            <th style="{{$th}}">Date</th>
            <th style="{{$th}}">Leg</th>
        @endif
        @if($keys['determine'] ?? false)
            <th style="{{$th}}">Det</th>
        @endif
        @if($keys['description'] ?? false)

            <th style="{{$th}}">Description</th>
        @endif

        @if($keys['herbarium'] ?? false)

            <th style="{{$th}}">Herbarium Name</th>
        @endif

        @if($keys['borrow'] ?? false)

            <th style="{{$th_transaction}}">Borrower's name (Last Lending)</th>
            <th style="{{$th_transaction}}">Organization or university</th>
            <th style="{{$th_transaction}}">Date received</th>
            <th style="{{$th_transaction}}">Return date</th>
        @endif

        @if($keys['visit'] ?? false)

            <th style="{{$th_transaction}}">Sample impression (Last Visit)</th>
            <th style="{{$th_transaction}}">Organization or university</th>
            <th style="{{$th_transaction}}">Service date</th>
            <th style="{{$th_transaction}}">Referred Name</th>
        @endif

        @if($keys['exchange'] ?? false)

            <th style="{{$th_transaction}}">Last Exchange Receive</th>
            <th style="{{$th_transaction}}">Last Exchange Send</th>
        @endif

        @if($keys['type_sample_image'] ?? false)

            <th style="{{$th}}">Type Sample</th>
        @endif

        @if($keys['consideration'] ?? false)

            <th style="{{$th}}">Consideration</th>
        @endif


    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item->herbarium_number ?? null }}</td>
            <td style="{{$td}}">{{ $item->herbarium_index ?? null }}</td>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item->taxonomy, 'keys'=>$keys])
            @if($keys['location'] ?? false)
                <td>{{ $item['location']['address_en']}} | {{$item['location']['address_fa']}}</td>
                <td style="{{$td}}">{{ $item['location']['min_altitude']}} - {{ $item['location']['max_altitude']}}</td>
                <td style="{{$td}}">{{ $item['location']['point']['DMS'][0] ?? null }}</td>
                <td style="{{$td}}">{{ $item['location']['point']['DMS'][1] ?? null }}</td>
            @endif
            @if($keys['collect'] ?? false)
                <td style="{{$td}}">{{$item['collect']['date'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['collect']['authors'] ?? null}}</td>
            @endif
            @if($keys['determine'] ?? false)
                <td style="{{$td}}">{{ $item['determine']['authors'] ?? null}}</td>
            @endif
            @if($keys['description'] ?? false)
                <td style="{{$td}}">{{$item['description'] ?? null}}</td>
            @endif
            @if($keys['herbarium'] ?? false)
                <td style="{{$td}}">{{$item['organization']['name'] ?? null}}</td>
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
            @if($keys['type_sample_image'] ?? false)
                <td style="{{$td}}">{{$item['type_sample_image'] ?? null}}</td>
            @endif
            @if($keys['consideration'] ?? false)
                <td style="{{$td}}">{{$item['consideration'] ?? null}}</td>
            @endif
        </tr>p
    @endforeach
    </tbody>
</table>
</body>
</html>
