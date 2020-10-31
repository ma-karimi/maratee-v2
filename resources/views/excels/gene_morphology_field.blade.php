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
        @if($keys['name'] ?? false)
            <th style="{{$th}}">Name</th>
        @endif
        @if($keys['soil_ph'] ?? false)
            <th style="{{$th}}">Soil PH</th>
        @endif
        @if($keys['soil_ec'] ?? false)
            <th style="{{$th}}">Soil EC</th>
        @endif
        @if($keys['soil_depth'] ?? false)
            <th style="{{$th}}">Soil depth</th>
        @endif
        @if($keys['sand'] ?? false)
            <th style="{{$th}}">Sand</th>
        @endif
        @if($keys['loam'] ?? false)
            <th style="{{$th}}">Loam</th>
        @endif
        @if($keys['clay'] ?? false)
            <th style="{{$th}}">Clay</th>
        @endif
        @if($keys['soil_texture'] ?? false)
            <th style="{{$th}}">Soil texture</th>
        @endif
        @if($keys['n'] ?? false)
            <th style="{{$th}}">N</th>
        @endif
        @if($keys['p'] ?? false)
            <th style="{{$th}}">P</th>
        @endif
        @if($keys['k'] ?? false)
            <th style="{{$th}}">K</th>
        @endif
        @if($keys['soil_organic_matter'] ?? false)
            <th style="{{$th}}">Soil organic matter</th>
        @endif
        @if($keys['source_of_water'] ?? false)
            <th style="{{$th}}">Source of water</th>
        @endif
        @if($keys['irrigation_system'] ?? false)
            <th style="{{$th}}">Irrigation system</th>
        @endif
        @if($keys['irrigation_circuit'] ?? false)
            <th style="{{$th}}">Irrigation circuit</th>
        @endif
        @if($keys['irrigation_time'] ?? false)
            <th style="{{$th}}">Irrigation time</th>
        @endif
        @if($keys['flow_rate'] ?? false)
            <th style="{{$th}}">Flow rate</th>
        @endif
        @if($keys['water'] ?? false)
            <th style="{{$th}}">Water</th>
        @endif
        @if($keys['water_ec'] ?? false)
            <th style="{{$th}}">Water EC</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @if($keys['name'] ?? false)
                <td style="{{$td}}">{{$item->name ?? null}}</td>
            @endif
            @if($keys['soil_ph'] ?? false)
                <td style="{{$td}}">{{$item->soil_ph ?? null}}</td>
            @endif
            @if($keys['soil_ec'] ?? false)
                <td style="{{$td}}">{{$item->soil_ec ?? null}}</td>
            @endif
            @if($keys['soil_depth'] ?? false)
                <td style="{{$td}}">{{$item->soil_depth ?? null}}</td>
            @endif
            @if($keys['sand'] ?? false)
                <td style="{{$td}}">{{$item->sand ?? null}}</td>
            @endif
            @if($keys['loam'] ?? false)
                <td style="{{$td}}">{{$item->loam ?? null}}</td>
            @endif
            @if($keys['clay'] ?? false)
                <td style="{{$td}}">{{$item->clay ?? null}}</td>
            @endif
            @if($keys['soil_texture'] ?? false)
                <td style="{{$td}}">{{$item->soil_texture ?? null}}</td>
            @endif
            @if($keys['n'] ?? false)
                <td style="{{$td}}">{{$item->n ?? null}}</td>
            @endif
            @if($keys['p'] ?? false)
                <td style="{{$td}}">{{$item->p ?? null}}</td>
            @endif
            @if($keys['k'] ?? false)
                <td style="{{$td}}">{{$item->k ?? null}}</td>
            @endif
            @if($keys['soil_organic_matter'] ?? false)
                <td style="{{$td}}">{{$item->soil_organic_matter ?? null}}</td>
            @endif
            @if($keys['source_of_water'] ?? false)
                <td style="{{$td}}">{{$item->source_of_water ?? null}}</td>
            @endif
            @if($keys['irrigation_system'] ?? false)
                <td style="{{$td}}">{{$item->irrigation_system ?? null}}</td>
            @endif
            @if($keys['irrigation_circuit'] ?? false)
                <td style="{{$td}}">{{$item->irrigation_circuit ?? null}}</td>
            @endif
            @if($keys['irrigation_time'] ?? false)
                <td style="{{$td}}">{{$item->irrigation_time ?? null}}</td>
            @endif
            @if($keys['flow_rate'] ?? false)
                <td style="{{$td}}">{{$item->flow_rate ?? null}}</td>
            @endif
            @if($keys['water'] ?? false)
                <td style="{{$td}}">{{$item->water ?? null}}</td>
            @endif
            @if($keys['water_ec'] ?? false)
                <td style="{{$td}}">{{$item->water_ec ?? null}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
