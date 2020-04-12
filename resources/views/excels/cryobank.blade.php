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
        @if($keys['genotype'] ?? false)
            <th style="{{$th}}">Genotype code</th>
        @endif
        @if($keys['conversation'] ?? false)
            <th style="{{$th}}">Conversation Status</th>
        @endif
        @if($keys['proposal'] ?? false)
            <th style="{{$th}}">Proposal/Thesis</th>
        @endif
        @if($keys['research'] ?? false)
            <th style="{{$th}}">Researcher name</th>
        @endif
        @if($keys['gathering'] ?? false)
            <th style="{{$th}}">Gathering location</th>
            <th style="{{$th}}">Longitude</th>
            <th style="{{$th}}">Latitude</th>
            <th style="{{$th}}">Altitude</th>
        @endif
        @if($keys['collect'] ?? false)
            <th style="{{$th}}">Collector</th>
        @endif
        @if($keys['year'] ?? false)
            <th style="{{$th}}">Year</th>
        @endif
        @if($keys['type_sample'] ?? false)
            <th style="{{$th}}">Type Sample</th>
        @endif
        @if($keys['treatment'] ?? false)
            <th style="{{$th}}">Treatment</th>
        @endif
        @if($keys['sample_number'] ?? false)
            <th style="{{$th}}">Sample Number</th>
        @endif
        @if($keys['repeat'] ?? false)
            <th style="{{$th}}">Repeat</th>
        @endif
        @if($keys['tank'] ?? false)
            <th style="{{$th}}">Tank</th>
        @endif
        @if($keys['row'] ?? false)
            <th style="{{$th}}">Row</th>
        @endif
        @if($keys['rack'] ?? false)
            <th style="{{$th}}">Rack</th>
        @endif
        @if($keys['cell'] ?? false)
            <th style="{{$th}}">Cell</th>
        @endif


    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item->taxonomy, 'keys'=>$keys])
            @if($keys['genotype'] ?? false)
                <td style="{{$td}}">{{ $item['genotype_code'] ?? null}}</td>
            @endif
            @if($keys['conversation'] ?? false)
                <td style="{{$td}}">{{ $item['protection']['name']['en'] ?? null}}</td>
            @endif
            @if($keys['proposal'] ?? false)
                <td style="{{$td}}">{{ $item['proposal_name'] ?? null}}</td>
            @endif
            @if($keys['research'] ?? false)
                <td style="{{$td}}">{{ $item['research']['authors'] ?? null}}</td>
            @endif
            @if($keys['gathering'] ?? false)
                <td>{{ $item['location']['address_en']}} | {{$item['location']['address_fa']}}</td>
                <td style="{{$td}}">{{ $item['location']['min_altitude'] ?? null}}}}</td>
                <td style="{{$td}}">{{ $item['location']['point']['DMS'][0] ?? null }}</td>
                <td style="{{$td}}">{{ $item['location']['point']['DMS'][1] ?? null }}</td>
            @endif
            @if($keys['collect'] ?? false)
                <td style="{{$td}}">{{ $item['collect']['authors'] ?? null}}</td>
            @endif
            @if($keys['year'] ?? false)
                <td style="{{$td}}">{{ $item['year'] ?? null}}</td>
            @endif
            @if($keys['type_sample'] ?? false)
                <td style="{{$td}}">{{ $item['sample_type'] ?? null}}</td>
            @endif
            @if($keys['treatment'] ?? false)
                <td style="{{$td}}">{{ $item['treatment']['name_en'] ?? null}}</td>
            @endif
            @if($keys['sample_number'] ?? false)
                <td style="{{$td}}">{{ $item['sample_number'] ?? null}}</td>
            @endif
            @if($keys['repeat'] ?? false)
                <td style="{{$td}}">{{$item['repeat'] ?? null}}</td>
            @endif
            @if($keys['tank'] ?? false)
                <td style="{{$td}}">{{$item['tank'] ?? null}}</td>
            @endif
            @if($keys['row'] ?? false)
                <td style="{{$td}}">{{$item['row'] ?? null}}</td>
            @endif
            @if($keys['rack'] ?? false)
                <td style="{{$td}}">{{$item['rack'] ?? null}}</td>
            @endif
            @if($keys['cell'] ?? false)
                <td style="{{$td}}">{{$item['cell'] ?? null}}</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
