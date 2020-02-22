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
        <th style="{{$th}}">Code</th>
        @include('excels.partials.taxonomyHeader')
        @if($keys['origin'] ?? false)
            <th style="{{$th}}">Origin</th>
        @endif
        @if($keys['part_used'] ?? false)
            <th style="{{$th}}">Aerial Parts</th>
            <th style="{{$th}}">Underground Part</th>
        @endif
        @if($keys['plants_used'] ?? false)
            <th style="{{$th}}">Plants Used in Traditional Iranian Medicine</th>
            <th style="{{$th}}">Official Natural Drugs</th>
            <th style="{{$th}}">Food Industries</th>
            <th style="{{$th}}">Hygenic-Cosmetic industries</th>
            <th style="{{$th}}">Other industries</th>
            <th style="{{$th}}">Plants used inHerbal medicine store</th>
        @endif
        @if($keys['import_export'] ?? false)
            <th style="{{$th}}">Exporting</th>
            <th style="{{$th}}">Importing</th>
        @endif
        @if($keys['cultivate'] ?? false)
            <th style="{{$th}}">The cultivated area in the country</th>
        @endif
        @if($keys['industrial'] ?? false)
            <th style="{{$th}}">Industrial Potential</th>
        @endif
        @if($keys['place'] ?? false)
            <th style="{{$th}}">Province</th>
            <th style="{{$th}}">Place of plant collection (address)</th>
            <th style="{{$th}}">Date of plant collection</th>
        @endif
        @if($keys['treatment'] ?? false)
            <th style="{{$th}}">Treatment</th>
        @endif
        @if($keys['phenology'] ?? false)
            <th style="{{$th}}">Stage of Phenology</th>
        @endif
        @if($keys['methods'] ?? false)
            <th style="{{$th}}">Distillation</th>
            <th style="{{$th}}">Extraction</th>
            <th style="{{$th}}">Analysis method</th>
        @endif
        @if($keys['metabolite'] ?? false)
            <th style="{{$th}}">Secondary metabolite</th>
        @endif
        @if($keys['efficiency'] ?? false)
            <th style="{{$th}}">Efficiency</th>
        @endif
        @if($keys['constituent'] ?? false)

            <th style="{{$th}}">Constituent</th>
        @endif
        @if($keys['article'] ?? false)
            <th style="{{$th}}">Authors</th>
            <th style="{{$th}}">Title</th>
            <th style="{{$th}}">Journal Title</th>
            <th style="{{$th}}">VOL. (NO. Pages)</th>
            <th style="{{$th}}">Year</th>
        @endif
        @if($keys['herbarium'] ?? false)
            <th style="{{$th}}">Herbarium</th>
        @endif
        @if($keys['habitat'] ?? false)
            <th style="{{$th}}">Habitat</th>
        @endif

        @if($keys['provinces'] ?? false)
            <th style="{{$th}}">Habitat</th>
        @endif

        @if($keys['herbaceous'] ?? false)
            <th style="{{$th}}">Wooden</th>
            <th style="{{$th}}">Herbaceous</th>
        @endif
        @if($keys['color'] ?? false)
            <th style="{{$th}}">Fruit Color</th>
            <th style="{{$th}}">flower Color</th>
        @endif

        @if($keys['height'] ?? false)

            <th style="{{$th_transaction}}">Height (cm)</th>
        @endif

        @if($keys['cycle'] ?? false)
            <th style="{{$th}}">Plant life cycle</th>
        @endif
        @if($keys['properties'] ?? false)
            <th style="{{$th}}">The most important medicinal properties</th>
        @endif
        @if($keys['presence'] ?? false)

            <th style="{{$th_transaction}}">Status of presence in the country</th>
        @endif
        @if($keys['material'] ?? false)

            <th style="{{$th_transaction}}">effective material</th>
        @endif
        @if($keys['pharmaceutical'] ?? false)

            <th style="{{$th_transaction}}">Pharmaceuticals</th>
        @endif

        @if($keys['product'] ?? false)

            <th style="{{$th_transaction}}">Other Products</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        {{\Illuminate\Support\Facades\Log::info($item['medicinal'])}}
        <tr>
            <td style="{{$td}}">{{ $item->code ?? null }}</td>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['medicinal']['taxonomy'], 'keys'=>$keys])
            @if($keys['origin'] ?? false)
                <td style="{{$td}}">{{ $item['medicinal']['origin']['name'] ?? null }}</td>
            @endif
            @if($keys['part_used'] ?? false)
                <td style="{{$td}}">{{ $item['medicinal']['aerial_type'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['medicinal']['ground_type']['name'] ?? null }}</td>
            @endif
            @if($keys['plants_used'] ?? false)
                <td style="{{$td}}">{{ $item['medicinal']['traditional_iranian_medicine_name'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['medicinal']['natural_drug_name'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['medicinal']['foods'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['medicinal']['hygienic_cosmetic']['name'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['medicinal']['industries'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['medicinal']['inherbal_medicine_store_name'] ?? null }}</td>
            @endif
            @if($keys['import_export'] ?? false)
                <td>{{ $item['medicinal']['exporting_name']}} </td>
                <td>{{ $item['medicinal']['importing_name']}} </td>
            @endif
            @if($keys['cultivate'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['cultivated_area'] ?? null}}</td>
            @endif
            @if($keys['industrial'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['potentials'] ?? null}}</td>
            @endif
            @if($keys['place'] ?? false)
                <td style="{{$td}}">{{$item['location']['province']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{$item['location']['address_en'] ?? null}}</td>
                <td style="{{$td}}">{{$item['collecting_year'] ?? null}}</td>
            @endif
            @if($keys['treatment'] ?? false)
                <td style="{{$td}}">{{$item['treatment']['name'] ?? null}}</td>
            @endif
            @if($keys['phenology'] ?? false)
                <td style="{{$td}}">{{$item['phenology']['name'] ?? null}}</td>
            @endif
            @if($keys['methods'] ?? false)
                <td style="{{$td}}">{{$item['distillation']['name'] ?? null}}</td>
                <td style="{{$td}}">{{$item['extraction']['name'] ?? null}}</td>
                <td style="{{$td}}">{{$item['analyse']['name'] ?? null}}</td>
            @endif
            @if($keys['metabolites'] ?? false)
                <td style="{{$td}}">{{$item['metabolites'] ?? null}}</td>
            @endif
            @if($keys['efficiency'] ?? false)
                <td style="{{$td}}">{{$item['efficiency'] ?? null}}</td>
            @endif
            @if($keys['constituent'] ?? false)
                <td style="{{$td}}">
                    @forelse($constituents as $constituent)
                        {{$constituent['constituent_type']['name_en'] ?? null}}:{{$constituent['value'] ?? null}}
                        @if(!$loop->last)
                            |
                        @endif
                    @empty
                    @endforelse
                </td>
            @endif
            @if($keys['article'] ?? false)
                <td style="{{$td}}">{{$item['article']['authors'] ?? null}}</td>
                <td style="{{$td}}">{{$item['article']['title'] ?? null}}</td>
                <td style="{{$td}}">{{$item['article']['journal_name'] ?? null}}</td>
                <td style="{{$td}}">{{$item['article']['page_no'] ?? null}}</td>
                <td style="{{$td}}">{{$item['article']['year'] ?? null}}</td>
            @endif
            @if($keys['herbarium'] ?? false)
                <td style="{{$td}}">{{$item['herbarium_number'] ?? null}}</td>
            @endif
            @if($keys['habitat'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['habitat']['name'] ?? null}}</td>
            @endif
            @if($keys['provinces'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['distributions'] ?? null}}</td>
            @endif
            @if($keys['herbaceous'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['wooden'] ?? null}}</td>
                <td style="{{$td}}">{{$item['medicinal']['herbaceous'] ?? null}}</td>
            @endif
            @if($keys['color'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['fruit_color'] ?? null}}</td>
                <td style="{{$td}}">{{$item['medicinal']['flower_color'] ?? null}}</td>
            @endif
            @if($keys['height'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['height'] ?? null}}</td>
            @endif
            @if($keys['cycle'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['cycle'] ?? null}}</td>
            @endif
            @if($keys['properties'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['medicinal_properties'] ?? null}}</td>
            @endif
            @if($keys['presence'] ?? false)
                <td style="{{$td}}">{{$item['presence_in_country_name'] ?? null}}</td>
            @endif
            @if($keys['material'] ?? false)
                <td style="{{$td}}">{{$item['materials'] ?? null}}</td>
            @endif
            @if($keys['pharmaceutical'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['pharmaceuticals'] ?? null}}</td>
            @endif
            @if($keys['product'] ?? false)
                <td style="{{$td}}">{{$item['medicinal']['other_products'] ?? null}}</td>
            @endif
        </tr>p
    @endforeach
    </tbody>
</table>
</body>
</html>
