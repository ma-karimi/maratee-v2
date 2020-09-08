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
        <th style="{{$th}}">Accession Code</th>
        <th style="{{$th}}">Specimen type</th>
        <th style="{{$th}}">Collection name</th>
        <th style="{{$th}}">Regeneration and evaluation code</th>
        @if($keys['organization'] ?? false)
            <th style="{{$th}}">Organization/Department</th>
        @endif
        @if($keys['project'] ?? false)
            <th style="{{$th}}">Project No./Project/Project leader name</th>
        @endif
        @if($keys['research'] ?? false)
            <th style="{{$th}}">Research No./Research title/Research leader name</th>
        @endif
        @include('excels.partials.taxonomyHeader')
        @if($keys['field'] ?? false)
            <th style="{{$th}}">Filed/Station</th>
            <th style="{{$th}}">Soil EC (dS/m)</th>
            <th style="{{$th}}">Soil depth (cm)</th>
            <th style="{{$th}}">Sand%</th>
            <th style="{{$th}}">Loam%</th>
            <th style="{{$th}}">Clay%</th>
            <th style="{{$th}}">Soil texture</th>
            <th style="{{$th}}">N%</th>
            <th style="{{$th}}">P%</th>
            <th style="{{$th}}">K%</th>
            <th style="{{$th}}">Soil organic matter%</th>
            <th style="{{$th}}">source of water</th>
            <th style="{{$th}}">Irrigation system</th>
            <th style="{{$th}}">Irrigation circuit</th>
            <th style="{{$th}}">Irrigation time</th>
            <th style="{{$th}}">Flow rate (L/h)</th>
            <th style="{{$th}}">Water pH</th>
            <th style="{{$th}}">Water EC (dS/m)</th>
        @endif
        @if($keys['other'] ?? false)
            <th style="{{$th}}">Replication or block number in experiment</th>
            <th style="{{$th}}">Observation No.</th>
            <th style="{{$th}}">Plant density per hectare</th>
            <th style="{{$th}}">Planting date</th>
            <th style="{{$th}}">Date of observation</th>
            <th style="{{$th}}">Days to start flowering</th>
            <th style="{{$th}}">Days to flowering</th>
            <th style="{{$th}}">Days to seed ripening</th>
        @endif
        @if($keys['quantity'] ?? false)
            <th style="{{$th}}">Quantitatives</th>
        @endif
        @if($keys['quality'] ?? false)
            <th style="{{$th}}">Qualititatives</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item['accession_code'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['specimen_type']['name'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['collection']['name'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['regeneration_code'] ?? null}}</td>
            @if($keys['organization'] ?? false)
                <td style="{{$td}}">{{ $item['organization']['name_en'] ?? null}}
                    /{{ $item['department_name'] ?? null}}</td>
            @endif
            @if($keys['project'] ?? false)
                <td style="{{$td}}">{{ $item['project']['project_no'] ?? null}}/{{ $item['project']['title'] ?? null}}
                    /{{ $item['project']['project_leader_name'] ?? null}}</td>
            @endif
            @if($keys['research'] ?? false)
                <td style="{{$td}}">{{ $item['research']['research_no'] ?? null}}
                    /{{ $item['research']['research_title'] ?? null}}
                    /{{ $item['research']['research_leader_name'] ?? null}}</td>
            @endif
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['seed_collection']['taxonomy'], 'keys'=>$keys])
            @if($keys['field'] ?? false)
                <td style="{{$td}}">{{ $item['field']['green_house']['name_en']}}</td>
                <td style="{{$td}}">{{ $item['field']['soil_ph']}}</td>
                <td style="{{$td}}">{{ $item['field']['soil_ec'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['soil_depth'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['sand'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['loam'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['clay'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['soil_texture'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['n'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['p'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['k'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['soil_organic_matter'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['source_of_water'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['irrigation_system'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['irrigation_circuit'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['irrigation_time'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['flow_rate'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['water'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['water_ec'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['field']['water_ec'] ?? null }}</td>
            @endif
            @if($keys['other'] ?? false)
                <td style="{{$td}}">{{ $item['replication_or_block_number'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['observation_no'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['plant_density'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['planting_date'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['observation_date'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['days_to_start_flowering'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['days_to_flowering'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['days_to_seed_ripening'] ?? null }}</td>
            @endif
            @if($keys['quantity'] ?? false)
                <td style="{{$td}}">
                    @forelse($item['quantitatives'] as $item)
                        {{$item['name']}}: {{$item['pivot']['name']}}
                        @if (!$loop->last)
                             /
                        @endif
                    @empty
                    @endforelse
                </td>
            @endif
            @if($keys['Quality'] ?? false)
                <td style="{{$td}}">
                    @forelse($item['qualititatives'] as $item)
                        {{$item['name']}}: {{$item['pivot']['name']}}
                        @if (!$loop->last)
                            /
                        @endif
                    @empty
                    @endforelse
                </td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
