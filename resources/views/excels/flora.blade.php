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
        @if($keys['family'])
            <th style="{{$th}}">Family</th>
        @endif
        @if($keys['genus'])
            <th style="{{$th}}">Genus</th>
        @endif
        @if($keys['species'])
            <th style="{{$th}}">Species</th>
        @endif
        @if($keys['subspecies'])
            <th style="{{$th}}">SubSpecies</th>
        @endif
        @if($keys['variety'])
            <th style="{{$th}}">Variety</th>
        @endif
        @if($keys['scientific'])
            <th style="{{$th}}">Scientific Name</th>
        @endif
        @if($keys['local_name'])
            <th style="{{$th}}">Local/Persian Name</th>
        @endif
        @if($keys['author'])
            <th style="{{$th}}">Author</th>
        @endif
        @if($keys['georgaphical'])
            <th style="{{$th}}">Geographical Locations</th>
            <th style="{{$th}}">Distributions</th>
        @endif
        @if($keys['life_form'])
            <th style="{{$th}}">Life Form</th>
            <th style="{{$th}}">Phytogegrophical Region</th>
            <th style="{{$th}}">Flowering Time</th>
            <th style="{{$th}}">Ecology Conditions</th>
            <th style="{{$th}}">Status of Conversation</th>
            <th style="{{$th}}">Note</th>
        @endif
        @if($keys['dna'])
            <th style="{{$th}}">N</th>
            <th style="{{$th}}">2N</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($plants as $item)
        <tr>
            <td style="{{$td}}">{{ $item->id ?? null }}</td>
            @if($keys['family'])
                <td style="{{$td}}">{{ $item->taxonomy->family->name ?? null }}</td>
            @endif
            @if($keys['genus'])
                <td style="{{$td}}">{{ $item->taxonomy->genus->name ?? null }}</td>
            @endif
            @if($keys['species'])
                <td style="{{$td}}">{{ $item->taxonomy->species->name ?? null }}</td>
            @endif
            @if($keys['subspecies'])
                <td style="{{$td}}">{{ $item->taxonomy->subspecies->name ?? null }}</td>
            @endif
            @if($keys['variety'])
                <td style="{{$td}}">{{ $item->taxonomy->variety->name ?? null }}</td>
            @endif
            @if($keys['scientific'])
                <td style="{{$td}}">{{ $item->taxonomy->scientific_name ?? null }}</td>
            @endif
            @if($keys['local_name'])
                <td style="{{$td}}">{{ $item->taxonomy->name ?? null }}</td>
            @endif
            @if($keys['author'])
                <td style="{{$td}}">{{ $item->taxonomy->authors ?? null }}</td>
            @endif
            @if($keys['georgaphical'])
                <td>
                    @foreach($item->locations as $location)
                        {{$location['address_en']}} | {{$location['point']['UTM'][0]}}
                        - {{$location['point']['UTM'][1]}}
                        | {{$location['min_altitude']}} - {{$location['max_altitude']}}
                        <hr>
                    @endforeach
                </td>
                <td style="{{$td}}">{{ $item->plant_geographicals }}</td>
            @endif
            @if($keys['life_form'])
                <td style="{{$td}}">{{$item['life_form'] ?? null}}</td>
                <td style="{{$td}}">{{$item['general_phytogeography']['name'] ?? null}}</td>
                <td style="{{$td}}">{{$item['flowering_time'] ?? null}}</td>
                <td style="{{$td}}">{{$item['ecology_description'] ?? null}}</td>
                <td style="{{$td}}">{{$item['protection']['name']['en'] ?? null}}</td>
                <td style="{{$td}}">{{$item['description'] ?? null}}</td>
            @endif
            @if($keys['dna'])
                <td style="{{$td}}">{{$item['n_no'] ?? null}}</td>
                <td style="{{$td}}">{{$item['n2_no'] ?? null}}</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
