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
        <th style="{{$th}}">Family</th>
        <th style="{{$th}}">Genus</th>
        <th style="{{$th}}">Species</th>
        <th style="{{$th}}">SubSpecies</th>
        <th style="{{$th}}">Variety</th>
        <th style="{{$th}}">Scientific Name</th>
        <th style="{{$th}}">Local/Persian Name</th>
        <th style="{{$th}}">Author</th>
        <th style="{{$th}}">Location</th>
        <th style="{{$th}}">N</th>
        <th style="{{$th}}">E</th>
        <th style="{{$th}}">Collectors</th>
        <th style="{{$th}}">Height of gathering place</th>
        <th style="{{$th}}">Date of Collecting</th>
        <th style="{{$th}}">Substrate</th>
        <th style="{{$th}}">Discription</th>
        <th style="{{$th}}">Phytogeographical Region</th>
        <th style="{{$th}}">Determinator</th>
        <th style="{{$th}}">Habitat</th>
        <th style="{{$th}}">Borrower's name (Last Lending)</th>
        <th style="{{$th}}">Organization or university</th>
        <th style="{{$th}}">Date received</th>
        <th style="{{$th}}">Return date</th>
        <th style="{{$th}}">Sample impression (Last Lending)</th>
        <th style="{{$th}}">Organization or university</th>
        <th style="{{$th}}">Service date</th>
        <th style="{{$th}}">Referred Name</th>
        <th style="{{$th}}">Last Exchange Receive</th>
        <th style="{{$th}}">Last Exchange Send</th>

    </tr>
    </thead>
    <tbody>
    @foreach($plants as $item)
        <tr>
            <td style="{{$td}}">{{ $item->herbarium->herbarium_number ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->family->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->genus->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->species->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->subspecies->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->variety->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->scientific->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->name ?? null }}</td>
            <td style="{{$td}}">
                @if (!empty($item->taxonomy->genus) && count($item->taxonomy->genus->authors))
                    @foreach($item->taxonomy->genus->authors as $actor)
                        {{$actor->name}} {{!$loop->last ? ' & ' : null }}
                    @endforeach
                @endif
                @if (!empty($item->taxonomy->species) && count($item->taxonomy->species->authors))
                    {{empty($item->taxonoomy->genus) ? '' : ' & '}}
                    @foreach($item->taxonomy->species->authors as $actor)
                        {{$actor->name}} {{!$loop->last ? ' & ' : null }}
                    @endforeach
                @endif
                @if (!empty($item->taxonomy->subspecies) && count($item->taxonomy->subspecies->authors))
                    {{empty($item->taxonoomy->species) ? '' : ' & '}}
                    @foreach($item->taxonomy->subspecies->authors as $actor)
                        {{$actor->name}} {{!$loop->last ? ' & ' : null }}
                    @endforeach
                @endif
            </td>
            <td>
                {{ $item['location']['address_en']}}
            </td>
            <td style="{{$td}}">{{ $item['location']['point']['UTM'][0] ?? null }}</td>
            <td style="{{$td}}">{{ $item['location']['point']['UTM'][1] ?? null }}</td>
            <td style="{{$td}}">
                @forelse ($item['herbarium']['collect']['actors'] as $actor)
                    {{$actor->name}} {{!$loop->last ? ' & ' : null }}
                @empty
                @endforelse
            </td>
            <td style="{{$td}}">{{ $item['location']['min_altitude']}} - {{ $item['location']['max_altitude']}}</td>

            <td style="{{$td}}">{{$item['herbarium']['collect']['date'] ?? null}}</td>
            <td style="{{$td}}">{{$item['general_substrate']['type'] ?? null}}
                | {{$item['general_substrate']['name'] ?? null}}</td>

            <td style="{{$td}}">{{$item['description'] ?? null}}</td>
            <td style="{{$td}}">{{$item['general_phytogeography']['name'] ?? null}}</td>
            <td style="{{$td}}">
                @forelse ($item['herbarium']['determine']['actors'] as $actor)
                    {{$actor->name}} {{!$loop->last ? ' & ' : null }}
                @empty
                @endforelse
            </td>
            <td style="{{$td}}">{{$item['general_habitat']['name'] ?? null}}</td>
            <td style="{{$td}}">{{$item['herbarium']['borrow']['member_name'] ?? null}}</td>
            <td style="{{$td}}">{{$item['herbarium']['borrow']['start_time'] ?? null}}</td>
            <td style="{{$td}}">{{$item['herbarium']['borrow']['organization']['name_en'] ?? null}}</td>
            <td style="{{$td}}">{{!empty($item['herbarium']['borrow']['end_time']) ? $item['herbarium']['borrow']['end_time'] : null}}</td>
            <td style="{{$td}}">{{$item['herbarium']['visit']['sample_impression'] ?? null}}</td>
            <td style="{{$td}}">{{$item['herbarium']['visit']['start_time'] ?? null}}</td>
            <td style="{{$td}}">{{$item['herbarium']['visit']['member_name'] ?? null}}</td>
            <td style="{{$td}}">{{$item['herbarium']['exchange_receive']['organization']['name_en'] ?? null}}{{$item['herbarium']['exchange_receive']['start_time'] ?? null}}</td>
            <td style="{{$td}}">{{$item['herbarium']['exchange_send']['organization']['name_en'] ?? null}}{{$item['herbarium']['exchange_send']['start_time'] ?? null}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
