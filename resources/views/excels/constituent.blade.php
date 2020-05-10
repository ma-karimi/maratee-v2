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

    $constituentTypes = [];
    foreach ($result as $index => $item) {
        foreach ($item->constituents as $constituent) {
            $constituentTypes[] = $constituent->constituentType->name;
        }
    }
    $constituentTypes = collect($constituentTypes)->unique();

@endphp


<table class="table">
    <thead>
    <tr>
        <th style="{{$th}}">Code</th>
        @include('excels.partials.taxonomyHeader')

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
        @foreach ($constituentTypes as $constituentType)
            <th style="{{$th}}">{{ $constituentType }}</th>
        @endforeach
        @if($keys['article'] ?? false)
            <th style="{{$th}}">Authors</th>
            <th style="{{$th}}">Title</th>
            <th style="{{$th}}">Journal Title</th>
            <th style="{{$th}}">VOL. (NO. Pages)</th>
            <th style="{{$th}}">Year</th>
        @endif
        @if($keys['description'] ?? false)
            <th style="{{$th}}">Description</th>
        @endif

    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item->code ?? null }}</td>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['taxonomy'], 'keys'=>$keys])

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
            @if($keys['metabolite'] ?? false)
                <td style="{{$td}}">{{$item['metabolites'] ?? null}}</td>
            @endif
            @if($keys['efficiency'] ?? false)
                <td style="{{$td}}">{{$item['efficiency'] ?? null}}</td>
            @endif

            @php
                $count = count($item['constituents']);
                $array = array_fill(0, 10 - $count, null);
                $constituents= collect($item['constituents'])->concat($array)->all();
            @endphp

            @if($keys['constituent'] ?? false)
                @foreach ($constituentTypes as $constituentType)
                    <td style="{{$td}}">
                        @foreach($constituents as $constituent)
                            @if($constituent['constituentType']['name'] == $constituentType)
                                {{!empty($constituent['value']) ? $constituent['value'] :  ''}}
                            @endif
                        @endforeach
                    </td>
                @endforeach
            @endif

            @if($keys['article'] ?? false)
                <td style="{{$td}}">{{$item['article']['authors'] ?? null}}</td>
                <td style="{{$td}}">{{$item['article']['title'] ?? null}}</td>
                <td style="{{$td}}">{{$item['article']['journal_name'] ?? null}}</td>
                <td style="{{$td}}">{{$item['article']['page_no'] ?? null}}</td>
                <td style="{{$td}}">{{$item['article']['year'] ?? null}}</td>
            @endif
            @if($keys['description'] ?? false)
                <td style="{{$td}}">{{$item['description'] ?? null}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
