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
        @include('excels.partials.taxonomyHeader')
        @if($keys['project'] ?? false)
            <th style="{{$th}}">Project No./Project/Project leader name</th>
        @endif
        @if($keys['research'] ?? false)
            <th style="{{$th}}">Research No./Research title/Research leader name</th>
        @endif
        @if($keys['exchange'] ?? false)
            <th style="{{$th}}">Number of exchanged seeds</th>
        @endif
        @if($keys['treatment'] ?? false)
            <th style="{{$th}}">Dormancy breaking treatments</th>
        @endif
        @if($keys['germination_condition'] ?? false)
            <th style="{{$th}}">Light (hr)</th>
            <th style="{{$th}}">dark (hr)</th>
            <th style="{{$th}}">Light (°C)</th>
            <th style="{{$th}}">dark (°C)</th>
        @endif
        @if($keys['evaluation'] ?? false)
            <th style="{{$th}}">Date started test</th>
            <th style="{{$th}}">Date started germination counting</th>
            <th style="{{$th}}">Repeat</th>
            <th style="{{$th}}">Number of planted seeds</th>
            <th style="{{$th}}">Dormancy Termination (day)</th>
            <th style="{{$th}}">Germination period (day)</th>
            <th style="{{$th}}">Number of germinated seed</th>
            <th style="{{$th}}">Number of fresh non-germinated seed</th>
            <th style="{{$th}}">Number of Rotten seed</th>
            <th style="{{$th}}">Number of Abnormal seedling</th>
            <th style="{{$th}}">Germination%</th>
            <th style="{{$th}}">Viability%</th>
            <th style="{{$th}}">Number of seedling mortality%</th>
            <th style="{{$th}}">Mean fresh seedling weight (g, in analysed seedlings)</th>
            <th style="{{$th}}">Mean dry seedling weight (g, in 10 seedlings)</th>
            <th style="{{$th}}">Dry matter%</th>
            <th style="{{$th}}">Describe the dormancy breaking treatment</th>
            <th style="{{$th}}">Other details</th>
        @endif

        @if($keys['radical'] ?? false)
            <th style="{{$th}}">Min Radical</th>
            <th style="{{$th}}">Max Radical</th>
        @endif
        @if($keys['shoot'] ?? false)
            <th style="{{$th}}">Min Shoot</th>
            <th style="{{$th}}">Max Shoot</th>
        @endif
        @if($keys['seed'] ?? false)
            <th style="{{$th}}">Min Seed</th>
            <th style="{{$th}}">Max Seed</th>
        @endif
        @if($keys['seed_width'] ?? false)
            <th style="{{$th}}">Min Seed Width</th>
            <th style="{{$th}}">Max Seed Width</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            <td style="{{$td}}">{{ $item['seed_collection']['accession_code'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['specimen_type']['name'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['collection']['name'] ?? null}}</td>
            <td style="{{$td}}">{{ $item['regeneration_code'] ?? null}}</td>
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['seedCollection']['taxonomy'], 'keys'=>$keys])

            @if($keys['project'] ?? false)
                <td style="{{$td}}">{{ $item['project']['project_no'] ?? null}}/{{ $item['project']['title'] ?? null}}
                    /{{ $item['project']['project_leader_name'] ?? null}}</td>
            @endif
            @if($keys['research'] ?? false)
                <td style="{{$td}}">{{ $item['research']['research_no'] ?? null}}
                    /{{ $item['research']['research_title'] ?? null}}
                    /{{ $item['research']['research_leader_name'] ?? null}}</td>
            @endif
            @if($keys['exchange'] ?? false)
                <td style="{{$td}}">{{ $item['number_of_exchanged_seeds'] ?? null}}</td>
            @endif
            @if($keys['treatment'] ?? false)
                <td style="{{$td}}">{{ $item['dormancy_breaking']['name'] ?? null}}</td>
            @endif
            @if($keys['germination_condition'] ?? false)
                <td style="{{$td}}">{{ $item['light_hr'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['dark_hr'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['light_c'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['dark_c'] ?? null}}</td>
            @endif
            @if($keys['evaluation'] ?? false)
                <td style="{{$td}}">{{ $item['started_test'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['started_germination'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['repeat'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['planted_seeds'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['dormancy_termination'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['germination_period'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['germinated_seed_no'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['fresh_non_germinated'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['rotten_seed'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['abnormal'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['germination'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['viability'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['seedling_mortality'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['mean_fresh_seedling_weight'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['mean_dry_seedling_weight'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['dry_matter'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['describe_dormancy_treatment'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['description'] ?? null }}</td>
            @endif
            @if($keys['radical'] ?? false)
                <td style="{{$td}}">{{ $item['min_radical'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['max_radical'] ?? null}}</td>
            @endif
            @if($keys['shoot'] ?? false)
                <td style="{{$td}}">{{ $item['min_shoot'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['max_shoot'] ?? null}}</td>
            @endif
            @if($keys['seed'] ?? false)
                <td style="{{$td}}">{{ $item['min_seed'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['max_seed'] ?? null}}</td>
            @endif
            @if($keys['seed_width'] ?? false)
                <td style="{{$td}}">{{ $item['min_seed_width'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['max_seed_width'] ?? null}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
