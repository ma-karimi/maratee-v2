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
        <th style="{{$th}}">Class</th>
        @include('excels.partials.taxonomyHeader')
        @if($keys['reference'] ?? false)
            <th style="{{$th}}">Authors</th>
            <th style="{{$th}}">Title</th>
            <th style="{{$th}}">Year</th>
            <th style="{{$th}}">Journal_name</th>
            <th style="{{$th}}">Page_no</th>
        @endif
        @if($keys['n'] ?? false)
            <th style="{{$th}}">n</th>
            <th style="{{$th}}">2n</th>
        @endif
        @if($keys['v.number'] ?? false)
            <th style="{{$th}}">V.Number</th>
        @endif
        @if($keys['location'] ?? false)
            <th style="{{$th}}">Location</th>
        @endif
        @if($keys['information'] ?? false)
            <th style="{{$th}}">Additional Information</th>
        @endif


    </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
        <tr>
            @if($keys['class'] ?? false)
                <td style="{{$td}}">{{ $item['generalClass']['name'] ?? null}}</td>
            @endif
            @include('excels.partials.taxonomyRow', ['taxonomy'=>$item->taxonomy, 'keys'=>$keys])
            @if($keys['reference'] ?? false)
                <td>{{ $item['reference']['authors']}}</td>
                <td style="{{$td}}">{{ $item['reference']['title']}}</td>
                <td style="{{$td}}">{{ $item['reference']['year'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['reference']['journal_name'] ?? null }}</td>
                <td style="{{$td}}">{{ $item['reference']['page_no'] ?? null }}</td>
            @endif
            @if($keys['location'] ?? false)
                <td>
                    @foreach($item->locations as $location)
                        {{$location['address_en']}}
                    @endforeach
                </td>
            @endif
            @if($keys['n'] ?? false)
                <td style="{{$td}}">{{$item['n_no'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['n2_no'] ?? null}}</td>
            @endif
            @if($keys['v.number'] ?? false)
                <td style="{{$td}}">{{ $item['v_number'] ?? null}}</td>
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
