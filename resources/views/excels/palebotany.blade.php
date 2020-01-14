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
        @if($keys['information'] ?? false)
            <th style="{{$th}}">ID Number (Catalog Number)</th>
            <th style="{{$th}}">Specimen Number</th>
            <th style="{{$th}}">Field Number (Lab Number)</th>
            <th style="{{$th}}">Location in Collection</th>
        @endif
        @include('excels.partials.taxonomyHeader')
        @if($keys['taxonomy'] ?? false)
            <th style="{{$th}}">Order</th>
            <th style="{{$th}}">Type Status</th>
        @endif
        @if($keys['locality'] ?? false)
            <th style="{{$th}}">Country</th>
            <th style="{{$th}}">State/Prov</th>
            <th style="{{$th}}">Village</th>
            <th style="{{$th}}">Region Name</th>
            <th style="{{$th}}">Longitude</th>
            <th style="{{$th}}">Latitude</th>
            <th style="{{$th}}">Formation</th>
            <th style="{{$th}}">Layer</th>
            <th style="{{$th}}">Stratigraphy</th>
            <th style="{{$th}}">Lithology</th>
            <th style="{{$th}}">Associated current Flora/Fauna</th>
            <th style="{{$th}}">Detailed Locality Description</th>
        @endif
        @if($keys['geology'] ?? false)
            <th style="{{$th}}">Eon/Era</th>
            <th style="{{$th}}">Period</th>
            <th style="{{$th}}">Epoch</th>
            <th style="{{$th}}">Stage</th>
        @endif
        @if($keys['other'] ?? false)
            <th style="{{$th}}">Preservation</th>
            <th style="{{$th}}">Samples pieces</th>
            <th style="{{$th}}">Color</th>
            <th style="{{$th}}">Element</th>
            <th style="{{$th}}">Treatment History</th>
            <th style="{{$th}}">Last Citation</th>
            <th style="{{$th}}">Additional Info</th>
        @endif
        @if($keys['collect'] ?? false)
            <th style="{{$th}}">Collection Date</th>
            <th style="{{$th}}">Collectors</th>
        @endif
        @if($keys['determine'] ?? false)
            <th style="{{$th}}">Identifiers</th>
            <th style="{{$th}}">Date Identified</th>
        @endif


    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @if($keys['information'] ?? false)
                <td style="{{$td}}">{{ $item['catalog_no'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['specimen_no'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['field_no'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location_in_collection'] ?? null}}</td>
            @endif
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item->taxonomy, 'keys'=>$keys])
            @if($keys['taxonomy'] ?? false)
                <td style="{{$td}}">{{ $item['general_order']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['samples'] ?? null}}</td>
            @endif
            @if($keys['locality'] ?? false)
                <td style="{{$td}}">{{ $item['locality']['location']['village']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['location']['province']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['location']['village'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['location']['region_name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['location']['point']['dms'][0] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['location']['point']['dms'][1] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['formation'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['layer'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['stratigraphy'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['lithology'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['fauna'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['locality']['description'] ?? null}}</td>
            @endif
            @if($keys['geology'] ?? false)
                <td style="{{$td}}">{{ $item['geology_age_era']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['geology_age_period']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['geology_age_epoch']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['geology_age_stage']['name'] ?? null}}</td>
            @endif
            @if($keys['other'] ?? false)
                <td style="{{$td}}">{{ $item['preservations'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['pieces'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['color'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['element'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['treatment_history'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['additional_info'] ?? null}}</td>
            @endif
            @if($keys['collect'] ?? false)
                <td style="{{$td}}">{{ $item['collect']['date'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['collect']['authors'] ?? null}}</td>
            @endif
            @if($keys['determine'] ?? false)
                <td style="{{$td}}">{{ $item['determine']['authors'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['determine']['date'] ?? null}}</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
