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
            <th style="{{$th}}">Project No.</th>
            <th style="{{$th}}">Project</th>
            <th style="{{$th}}">Project leader name</th>
        @endif
        @if($keys['research'] ?? false)
            <th style="{{$th}}">Research No.</th>
            <th style="{{$th}}">Research title</th>
            <th style="{{$th}}">Research leader name</th>
        @endif
        @include('excels.partials.taxonomyHeader')
        @if($keys['exchange'] ?? false)
            <th style="{{$th}}">Seed weight</th>
            <th style="{{$th}}">Delivery date</th>
            <th style="{{$th}}">Recipient name</th>
            <th style="{{$th}}">Recipient phone</th>
            <th style="{{$th}}">Request No.</th>
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
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item['seedCollection']['taxonomy'], 'keys'=>$keys])
            @if($keys['exchange'] ?? false)
                <td style="{{$td}}">{{ $item['weight'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['delivery_date'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['recipient_name'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['recipient_phone'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['request_no'] ?? null }}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
