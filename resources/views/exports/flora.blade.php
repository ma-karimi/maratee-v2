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
        <th style="{{$th}}">Number</th>
        <th style="{{$th}}">Family</th>
        <th style="{{$th}}">Genus</th>
        <th style="{{$th}}">Species</th>
        <th style="{{$th}}">SubSpecies</th>
        <th style="{{$th}}">Variety</th>
        <th style="{{$th}}">Scientific Name</th>
        <th style="{{$th}}">Local/Persian Name</th>
        <th style="{{$th}}">Author</th>
        <th style="{{$th}}">Geographical Locations</th>
        <th style="{{$th}}">Distributions</th>
        <th style="{{$th}}">Life Form</th>
        <th style="{{$th}}">Phytogegrophical Region</th>
        <th style="{{$th}}">Flowering Time</th>
        <th style="{{$th}}">Ecology Conditions</th>
        <th style="{{$th}}">Status of Conversation</th>
        <th style="{{$th}}">Note</th>
        <th style="{{$th}}">N</th>
        <th style="{{$th}}">2N</th>
    </tr>
    </thead>
    <tbody>
    @foreach($plants as $item)
        <tr>
            <td style="{{$td}}">{{ $item->number ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->family->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->genus->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->species->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->subspecies->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->variety->name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->scientific_name ?? null }}</td>
            <td style="{{$td}}">{{ $item->taxonomy->name ?? null }}</td>
            <td style="{{$td}}">
                @if (!empty($item->taxonomy->genus) && count($item->taxonomy->genus->authors))
                    {{$item['taxonomy']['genus']['actors']}}
                @endif
                @if (!empty($item->taxonomy->species) && count($item->taxonomy->species->authors))
                     {{empty($item->taxonoomy->genus) ? '' : ' & '}}
                        {{$item['taxonomy']['species']['actors']}}
                    @endif
                @if (!empty($item->taxonomy->subspecies) && count($item->taxonomy->subspecies->authors))
                        {{empty($item->taxonoomy->species) ? '' : ' & '}}
                        {{$item['taxonomy']['subspecies']['actors']}}

                    @endif
            </td>
            <td>
                @foreach($item->locations as $location)
                    {{$location['address_en']}} | {{$location['point']['UTM'][0]}} - {{$location['point']['UTM'][1]}}
                    | {{$location['min_altitude']}} - {{$location['max_altitude']}}
                    <hr>
                @endforeach
            </td>
            <td style="{{$td}}">
                @forelse($item->geographicals  as $graphical)
                    {{$graphical->name}} {{!$loop->last ? ' & ' : null }}
                @empty
                @endforelse
            </td>
            <td style="{{$td}}">{{$item['life_form'] ?? null}}</td>
            <td style="{{$td}}">{{$item['general_phytogeography']['name'] ?? null}}</td>
            <td style="{{$td}}">{{$item['flowering_time'] ?? null}}</td>
            <td style="{{$td}}">{{$item['ecology_description'] ?? null}}</td>
            <td style="{{$td}}">{{$item['protection']['name']['en'] ?? null}}</td>
            <td style="{{$td}}">{{$item['description'] ?? null}}</td>
            <td style="{{$td}}">{{$item['n_no'] ?? null}}</td>
            <td style="{{$td}}">{{$item['n2_no'] ?? null}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
