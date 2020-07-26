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
        @if($keys['collection_name'] ?? false)
            <th style="{{$th}}">Collection Name</th>
        @endif
        @include('excels.partials.taxonomyHeader')
        @if($keys['origin'] ?? false)
            <th style="{{$th}}">Origin</th>
        @endif
        @if($keys['habitat'] ?? false)
            <th style="{{$th}}">Habitat</th>
        @endif
        @if($keys['place'] ?? false)
            <th style="{{$th}}">Geographical Distribution</th>
        @endif
        @if($keys['life_form'] ?? false)
            <th style="{{$th}}">Life Form Wooden</th>
            <th style="{{$th}}">Life Form Cycle</th>
        @endif
        @if($keys['status'] ?? false)
            <th style="{{$th}}">Conversation Status</th>
        @endif
        @if($keys['height'] ?? false)
            <th style="{{$th}}">Height</th>
        @endif

        @if($keys['value'] ?? false)
            <th style="{{$th}}">Value</th>
        @endif

        @if($keys['usage'] ?? false)
            <th style="{{$th}}">Usage</th>
        @endif
        @if($keys['colors'] ?? false)
            <th style="{{$th}}">Flower Color</th>
            <th style="{{$th}}">Fruit Color</th>
            <th style="{{$th}}">Foliage Color</th>
        @endif
        @if($keys['garden'] ?? false)
            <th style="{{$th}}">Garden Name</th>
        @endif

        @if($keys['internal'] ?? false)
            <th style="{{$th}}">Internal Habitat</th>
        @endif
        @if($keys['entrance'] ?? false)
            <th style="{{$th}}">Entrance form to the Garden</th>
        @endif

        @if($keys['seeding_planting'] ?? false)
            <th style="{{$th}}">Seeding/Planting Place</th>
            <th style="{{$th}}">Seeding/Planting Date</th>
            <th style="{{$th}}">Seeding/Planting Number</th>
        @endif
        @if($keys['transfer'] ?? false)
            <th style="{{$th}}">Transfer Date</th>
            <th style="{{$th}}">Transfer Place</th>
            <th style="{{$th}}">Transfer Number</th>
        @endif
        @if($keys['seed_germination'] ?? false)
            <th style="{{$th}}">Seed Germination</th>
        @endif

        @if($keys['method'] ?? false)
            <th style="{{$th}}">Method</th>
        @endif
        @if($keys['planting_date'] ?? false)
            <th style="{{$th}}">Date of planting</th>
        @endif
        @if($keys['cutting_rooting'] ?? false)
            <th style="{{$th}}">Percent of cutting rooting</th>
        @endif
        @if($keys['treatment'] ?? false)
            <th style="{{$th}}">Treatment</th>
        @endif

        @if($keys['growth_rate'] ?? false)
            <th style="{{$th}}">Growth Rate</th>
        @endif
        @if($keys['first_flowering'] ?? false)
            <th style="{{$th}}">First Flowering</th>
        @endif
        @if($keys['flowering_period'] ?? false)
            <th style="{{$th}}">Flowering Period</th>
        @endif
        @if($keys['seed'] ?? false)
            <th style="{{$th}}">First Seeding date</th>
            <th style="{{$th}}">Seed Rate</th>
            <th style="{{$th}}">Seed Formation</th>
        @endif
        @if($keys['tolerances'] ?? false)
            <th style="{{$th}}">Winter Tolerance</th>
            <th style="{{$th}}">Summer Tolerance</th>
        @endif
        @if($keys['irrigation'] ?? false)
            <th style="{{$th}}">Irrigation method</th>
            <th style="{{$th}}">Irrigation Spring Time</th>
            <th style="{{$th}}">Irrigation Summer Time</th>
            <th style="{{$th}}">Irrigation Autumn Time</th>
            <th style="{{$th}}">Water Requirements</th>
            <th style="{{$th}}">appropriate irrigation time</th>
        @endif
        @if($keys['soil'] ?? false)
            <th style="{{$th}}">Soil</th>
        @endif
        @if($keys['planting_condition'] ?? false)
            <th style="{{$th}}">Planting Condition</th>
        @endif
        @if($keys['sensitivity'] ?? false)
            <th style="{{$th}}">Sensitivity to the conditions</th>
        @endif
        @if($keys['comment'] ?? false)
            <th style="{{$th}}">Comments</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @if($keys['collection_name'] ?? false)
                <td style="{{$td}}">{{ $item['collection']['name'] ?? null}}</td>
            @endif
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item->taxonomy, 'keys'=>$keys])
            @if($keys['origin'] ?? false)
                <td style="{{$td}}">{{ $item['origin'] ?? null}}</td>
            @endif
            @if($keys['habitat'] ?? false)
                <td style="{{$td}}">{{ $item['habitat'] ?? null}}</td>
            @endif
            @if($keys['place'] ?? false)
                <td style="{{$td}}">
                    @forelse($item['locations'] as $location)
                        {{$location['address_en'] ?? null}}
                        @if(!$loop->last)
                            &nbsp; & &nbsp;
                        @endif
                    @empty
                    @endforelse
                </td>
            @endif
            @if($keys['life_form'] ?? false)
                <td style="{{$td}}">{{ $item['wooden']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['cycle'] ?? null}}</td>
            @endif
            @if($keys['life_form'] ?? false)
                <td style="{{$td}}">{{ $item['wooden']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['cycle'] ?? null}}</td>
            @endif
            @if($keys['status'] ?? false)
                <td style="{{$td}}">{{ $item['protection']['name']['en'] ?? null}}</td>
            @endif
            @if($keys['height'] ?? false)
                <td style="{{$td}}">{{ $item['height'] ?? null}}</td>
            @endif
            @if($keys['value'] ?? false)
                <td style="{{$td}}">{{ $item['value'] ?? null}}</td>
            @endif
            @if($keys['usage'] ?? false)
                <td style="{{$td}}">{{ $item['usage'] ?? null}}</td>
            @endif
            @if($keys['colors'] ?? false)
                <td style="{{$td}}">{{ $item['flower_color'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['fruit_color'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['foliage_color'] ?? null}}</td>
            @endif
            @if($keys['garden'] ?? false)
                <td style="{{$td}}">{{ $item['garden'] ?? null}}</td>
            @endif
            @if($keys['internal_habitat'] ?? false)
                <td style="{{$td}}">{{ $item['internal_habitat'] ?? null}}</td>
            @endif
            @if($keys['entrance'] ?? false)
                <td style="{{$td}}">{{ $item['garden']['entrance'] ?? null}}
                    {{$item['garden']['entrance'] && $item['internal_habitat']['entrance'] ? ' | ' : null}}{{ $item['internal_habitat']['entrance'] ?? null}}</td>
            @endif
            @if($keys['seeding_planting'] ?? false)
                <td style="{{$td}}">{{ $item['planting']['place']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['planting']['date'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['planting']['number'] ?? null}}</td>
            @endif
            @if($keys['transfer'] ?? false)
                <td style="{{$td}}">{{ $item['transfer']['place']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['transfer']['date'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['transfer']['number'] ?? null}}</td>
            @endif
            @if($keys['seed_germination'] ?? false)
                <td style="{{$td}}">{{ $item['seed_germination']['name'] ?? null}}</td>
            @endif
            @if($keys['method'] ?? false)
                <td style="{{$td}}">{{ $item['propagation'] ?? null}}</td>
            @endif
            @if($keys['planting_date'] ?? false)
                <td style="{{$td}}">{{ $item['first_flowering'] ?? null}}</td>
            @endif
            @if($keys['cutting_rooting'] ?? false)
                <td style="{{$td}}">{{ $item['cutting_rooting'] ?? null}}</td>
            @endif
            @if($keys['treatment'] ?? false)
                <td style="{{$td}}">{{ $item['treatment'] ?? null}}</td>
            @endif
            @if($keys['growth_rate'] ?? false)
                <td style="{{$td}}">{{ $item['growth_rate']['name'] ?? null}}</td>
            @endif
            @if($keys['first_flowering'] ?? false)
                <td style="{{$td}}">{{ $item['first_flowering'] ?? null}}</td>
            @endif
            @if($keys['flowering_period'] ?? false)
                <td style="{{$td}}">{{ $item['flowering_period'] ?? null}}</td>
            @endif
            @if($keys['seed'] ?? false)
                <td style="{{$td}}">{{ $item['first_seeding'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['seed_rate']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['seed_formation'] ?? null}}</td>
            @endif
            @if($keys['tolerances'] ?? false)
                <td style="{{$td}}">{{ $item['winter_tolerance']['name'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['summer_tolerance']['name'] ?? null}}</td>
            @endif
            @if($keys['irrigation'] ?? false)
                <td style="{{$td}}">{{ $item['botanical_irrigation']['irrigation'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['botanical_irrigation']['spring_time'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['botanical_irrigation']['summer_time'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['botanical_irrigation']['autumn_time'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['botanical_irrigation']['requirement'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['botanical_irrigation']['irrigation_time'] ?? null}}</td>
            @endif
            @if($keys['soil'] ?? false)
                <td style="{{$td}}">{{ $item['soil']['name'] ?? null}}</td>
            @endif
            @if($keys['planting_condition'] ?? false)
                <td style="{{$td}}">{{ $item['plant_condition'] ?? null}}</td>
            @endif
            @if($keys['sensitivity'] ?? false)
                <td style="{{$td}}">{{ $item['sensitivity_conditions'] ?? null}}</td>
            @endif
            @if($keys['comment'] ?? false)
                <td style="{{$td}}">{{ $item['comments'] ?? null}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
