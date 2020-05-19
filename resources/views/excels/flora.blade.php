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
        @include('excels.partials.taxonomyHeader')
        @if($keys['distribution'] ?? false)
            <th style="{{$th}}">Iran Distributions</th>
            <th style="{{$th}}">World Distributions</th>
            <th style="{{$th}}">Geographical direction</th>
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
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item->id ?? null }}</td>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item->taxonomy, 'keys'=>$keys])
            @if($keys['distribution'] ?? false)
                <td style="{{$td}}">{{ $item['iran_plant_geographicals'] }}</td>
                <td style="{{$td}}">{{ $item['plant_geographicals'] }}</td>
                <td style="{{$td}}">{{ $item['iran_direction_geographicals'] }}</td>
            @endif
            @if($keys['life_form'] ?? false)
                <td style="{{$td}}">{{$item['life_form'] ?? null}}</td>
                <td style="{{$td}}">{{$item['plant_phytogeographics'] ?? null}}</td>
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
