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
        @if($keys['variety'] ?? false)
            <th style="{{$th}}">Variety</th>
        @endif
        @if($keys['scientific'] ?? false)
            <th style="{{$th}}">Scientific Name</th>
        @endif
        @if($keys['local_name'] ?? false)
            <th style="{{$th}}">Local/Persian Name</th>
        @endif
        @if($keys['author'] ?? false)
            <th style="{{$th}}">Author</th>
        @endif
        @if($keys['georgaphical'] ?? false)
            <th style="{{$th}}">Geographical Locations</th>
            <th style="{{$th}}">Distributions</th>
        @endif
        @if($keys['life_form'] ?? false)
            <th style="{{$th}}">Life Form</th>
            <th style="{{$th}}">Phytogegrophical Region</th>
            <th style="{{$th}}">Flowering Time</th>
            <th style="{{$th}}">Ecology Conditions</th>
            <th style="{{$th}}">Status of Conversation</th>
            <th style="{{$th}}">Note</th>
        @endif
        @if($keys['dna'] ?? false)
            <th style="{{$th}}">N</th>
            <th style="{{$th}}">2N</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($plants as $item)
        <tr>
            <td style="{{$td}}">{{ $item->id ?? null }}</td>
            @if($keys['family'] ?? false)
                <td style="{{$td}}">{{ $item->taxonomy->family->name ?? null }}</td>
            @endif
            @if($keys['genus'] ?? false)
                <td style="{{$td}}">{{ $item->taxonomy->genus->name ?? null }}</td>
            @endif
            @if($keys['species'] ?? false)
                <td style="{{$td}}">{{ $item->taxonomy->species->name ?? null }}</td>
            @endif
            @if($keys['subspecies'] ?? false)
                <td style="{{$td}}">{{ $item->taxonomy->subspecies->name ?? null }}</td>
            @endif
            @if($keys['variety'] ?? false)
                <td style="{{$td}}">{{ $item->taxonomy->variety->name ?? null }}</td>
            @endif
            @if($keys['scientific'] ?? false)
                <td style="{{$td}}">{{ $item->taxonomy->scientific_name ?? null }}</td>
            @endif
            @if($keys['local_name'] ?? false)
                <td style="{{$td}}">{{ $item->taxonomy->name ?? null }}</td>
            @endif
            @if($keys['author'] ?? false)
                <td style="{{$td}}">{{ $item->taxonomy->authors ?? null }}</td>
            @endif
            @if($keys['georgaphical'] ?? false)
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
            @if($keys['life_form'] ?? false)
                <td style="{{$td}}">{{$item['life_form'] ?? null}}</td>
                <td style="{{$td}}">{{$item['general_phytogeography']['name'] ?? null}}</td>
                <td style="{{$td}}">{{$item['flowering_time'] ?? null}}</td>
                <td style="{{$td}}">{{$item['ecology_description'] ?? null}}</td>
                <td style="{{$td}}">{{$item['protection']['name']['en'] ?? null}}</td>
                <td style="{{$td}}">{{$item['description'] ?? null}}</td>
            @endif
            @if($keys['dna'] ?? false)
                <td style="{{$td}}">{{$item['n_no'] ?? null}}</td>
                <td style="{{$td}}">{{$item['n2_no'] ?? null}}</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
