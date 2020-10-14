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
        @if($keys['organization'] ?? false)
            <th style="{{$th}}">Organization/Department</th>
        @endif
        @if($keys['project'] ?? false)
            <th style="{{$th}}">Project No.</th>
            <th style="{{$th}}">Project</th>
            <th style="{{$th}}">Project leader name</th>
        @endif
        @if($keys['research'] ?? false)
            <th style="{{$th}}">Research No.</th>
            <th style="{{$th}}">Research title</th>
            <th style="{{$th}}">Research leader name</th>
        @endif
        @if($keys['accession_code'] ?? false)
            <th style="{{$th}}">Field code (encoded by collector)</th>
            <th style="{{$th}}">Field code (corrected by NRGB)</th>
            <th style="{{$th}}">Accession code (released by NRGB)</th>
            <th style="{{$th}}">Voucher No. (released by TARI)</th>
        @endif
        @include('excels.partials.taxonomyHeader')
        @if($keys['location'] ?? false)
            <th style="{{$th}}">Country</th>
            <th style="{{$th}}">Province/state</th>
            <th style="{{$th}}">City</th>
            <th style="{{$th}}">Region</th>
            <th style="{{$th}}">Village/road No. or name</th>
            <th style="{{$th}}">Latitude</th>
            <th style="{{$th}}">Longitude</th>
            <th style="{{$th}}">Altitude</th>
            <th style="{{$th}}">GPS used</th>
            <th style="{{$th}}">GPS datum</th>
        @endif
        @if($keys['plant_flowering'] ?? false)
            <th style="{{$th}}">Number of plants sampled</th>
            <th style="{{$th}}">area occupancy m2</th>
            <th style="{{$th}}">Flowering time (month)</th>
            <th style="{{$th}}">Fruit Type</th>
            <th style="{{$th}}">Date harvesting (month)</th>
            <th style="{{$th}}">Plant height (cm)</th>
            <th style="{{$th}}">Plant mother health</th>
            <th style="{{$th}}">Plant consumption value</th>
        @endif
        @if($keys['soil'] ?? false)
            <th style="{{$th}}">Soil depth</th>
            <th style="{{$th}}">Soil Texture</th>
            <th style="{{$th}}">Drainage</th>
            <th style="{{$th}}">Soil PH</th>
            <th style="{{$th}}">Soil Salinity</th>
            <th style="{{$th}}">Soil Lime</th>
            <th style="{{$th}}">Soil Erosion</th>
        @endif
        @if($keys['climate'] ?? false)
            <th style="{{$th}}">Land Form</th>
            <th style="{{$th}}">Slope Aspect</th>
            <th style="{{$th}}">Slope°</th>
            <th style="{{$th}}">Habitat</th>
            <th style="{{$th}}">Climate</th>
            <th style="{{$th}}">Community Type</th>
            <th style="{{$th}}">Associated Species</th>
            <th style="{{$th}}">Specimen Type</th>
            <th style="{{$th}}">Life Form</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @if($keys['organization'] ?? false)
                <td style="{{$td}}">{{ $item['organization']['name_en'] ?? null}}
                    /{{ $item['department_name'] ?? null}}</td>
            @endif
            @if($keys['project'] ?? false)
                <td style="{{$td}}">{{ $item['project_no'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['project_title'] ?? null}}
                </td>
                <td style="{{$td}}">{{ $item['project_leader_name'] ?? null}}</td>
            @endif
            @if($keys['research'] ?? false)
                <td style="{{$td}}">{{ $item['research_no'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['research_title'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['research_leader_name'] ?? null}}</td>
            @endif

            @if($keys['accession_code'] ?? false)
                <td style="{{$td}}">{{ $item['encoded_code_by_collector'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['encoded_code_by_collector'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['accession_code'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['voucher_no'] ?? null}}</td>
            @endif
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['seed_collection']['taxonomy'], 'keys'=>$keys])

            @if($keys['location'] ?? false)
                <td style="{{$td}}">{{ $item['location']['country']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location']['province']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location']['city']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location']['region_name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location']['village'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location']['DMS'][0] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location']['DMS'][1] ?? null}}</td>
                <td style="{{$td}}">{{ $item['location']['gps_used'] ?? 0}}</td>
                <td style="{{$td}}">{{ $item['location']['gps_datum'] ?? null}}</td>

            @endif
            @if($keys['plant_flowering'] ?? false)
                <td style="{{$td}}">{{ $item['plants_sampled_no'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['flowering_time'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['fruit_type']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['harvesting_time']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['plant_height'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['mother_health']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['consumption']['name'] ?? null}}</td>
            @endif
            @if($keys['soil'] ?? false)
                <td style="{{$td}}">{{ $item['soil_depth']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['soil_texture']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['drainage']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['soil_ph'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['soil_salinity']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['soil_lime']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['soil_erosion']['name'] ?? null}}</td>
            @endif
            @if($keys['climate'] ?? false)
                <td style="{{$td}}">{{ $item['land_form']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['slope_aspect']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['slope_degree'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['habitat']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['climate'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['community'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['associated_specie'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['specimen_type']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['life_form']['name'] ?? null}}</td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
