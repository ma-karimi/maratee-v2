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
        <th style="{{$th}}">Family</th>
        <th style="{{$th}}">Scientific Name</th>
        <th style="{{$th}}">Location</th>
        <th style="{{$th}}">Date</th>
        <th style="{{$th}}">Alt</th>
        <th style="{{$th}}">N</th>
        <th style="{{$th}}">E</th>
        <th style="{{$th}}">Leg</th>
        <th style="{{$th}}">Det</th>
        <th style="{{$th}}">Description</th>
        <th style="{{$th}}">Herbarium Name</th>
        <th style="{{$th_transaction}}">Borrower's name (Last Lending)</th>
        <th style="{{$th_transaction}}">Organization or university</th>
        <th style="{{$th_transaction}}">Date received</th>
        <th style="{{$th_transaction}}">Return date</th>
        <th style="{{$th_transaction}}">Sample impression (Last Visit)</th>
        <th style="{{$th_transaction}}">Organization or university</th>
        <th style="{{$th_transaction}}">Service date</th>
        <th style="{{$th_transaction}}">Referred Name</th>
        <th style="{{$th}}">Type Sample</th>
        <th style="{{$th_transaction}}">Last Exchange Receive</th>
        <th style="{{$th_transaction}}">Last Exchange Send</th>
        <th style="{{$th}}">Consideration</th>

    </tr>
    </thead>
    <tbody>
    @foreach($herbariums as $item)
        <tr>
            <td style="{{$td}}">{{ $item->herbarium_number ?? null }}</td>
            <td style="{{$td}}">{{ $item->herbarium_index ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->family->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->scientific->name ?? null }}</td>
            <td>
                {{ $item['location']['address_en']}} | {{$item['location']['address_fa']}}
            </td>
            <td style="{{$td}}">{{$item['collect']['date'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['location']['min_altitude']}} - {{ $item['location']['max_altitude']}}</td>

            <td style="{{$td}}">{{ $item['location']['point']['UTM'][0] ?? null }}</td>
            <td style="{{$td}}">{{ $item['location']['point']['UTM'][1] ?? null }}</td>
            <td style="{{$td}}">
                @forelse ($item['collect']['actors'] as $actor)
                    {{$actor->name}} {{!$loop->last ? ' & ' : null }}
                @empty
                @endforelse
            </td>
            <td style="{{$td}}">
                @forelse ($item['determine']['actors'] as $actor)
                    {{$actor->name}} {{!$loop->last ? ' & ' : null }}
                @empty
                @endforelse
            </td>

            <td style="{{$td}}">{{$item['description'] ?? null}}</td>

            <td style="{{$td}}">{{$item['borrow']['member_name'] ?? null}}</td>
            <td style="{{$td}}">{{$item['borrow']['start_time'] ?? null}}</td>
            <td style="{{$td}}">{{$item['borrow']['organization']['name_en'] ?? null}}</td>
            <td style="{{$td}}">{{!empty($item['borrow']['end_time']) ? $item['borrow']['end_time'] : null}}</td>
            <td style="{{$td}}">{{$item['visit']['sample_impression'] ?? null}}</td>
            <td style="{{$td}}">{{$item['visit']['start_time'] ?? null}}</td>
            <td style="{{$td}}">{{$item['visit']['member_name'] ?? null}}</td>
            <td style="{{$td}}">{{$item['type_sample_image'] ?? null}}</td>
            <td style="{{$td}}">{{$item['exchange_receive']['organization']['name_en'] ?? null}}{{$item['exchange_receive']['start_time'] ?? null}}</td>
            <td style="{{$td}}">{{$item['exchange_send']['organization']['name_en'] ?? null}}{{$item['exchange_send']['start_time'] ?? null}}</td>
            <td style="{{$td}}">{{$item['consideration'] ?? null}}</td>
        </tr>p
    @endforeach
    </tbody>
</table>
</body>
</html>
