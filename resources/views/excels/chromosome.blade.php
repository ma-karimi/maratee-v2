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
                <td style="{{$td}}">{{$item['collect']['date'] ?? null}}</td>
                <td style="{{$td}}">{{ $item['collect']['authors'] ?? null}}</td>
            @endif
            @if($keys['v.number'] ?? false)
                <td style="{{$td}}">{{ $item['determine']['authors'] ?? null}}</td>
            @endif
            @if($keys['description'] ?? false)
                <td style="{{$td}}">{{$item['description'] ?? null}}</td>
            @endif
            @if($keys['herbarium'] ?? false)
                <td style="{{$td}}">{{$item['organization']['name'] ?? null}}</td>
            @endif
            @if($keys['borrow'] ?? false)
                <td style="{{$td}}">{{$item['borrow']['member_name'] ?? null}}</td>
                <td style="{{$td}}">{{$item['borrow']['start_time'] ?? null}}</td>
                <td style="{{$td}}">{{$item['borrow']['organization']['name_en'] ?? null}}</td>
                <td style="{{$td}}">{{!empty($item['borrow']['end_time']) ? $item['borrow']['end_time'] : null}}</td>
            @endif
            @if($keys['visit'] ?? false)
                <td style="{{$td}}">{{$item['visit']['sample_impression'] ?? null}}</td>
                <td style="{{$td}}">{{$item['visit']['start_time'] ?? null}}</td>
                <td style="{{$td}}">{{$item['visit']['member_name'] ?? null}}</td>
            @endif
            @if($keys['exchange'] ?? false)
                <td style="{{$td}}">{{$item['exchange_receive']['organization']['name_en'] ?? null}}{{$item['exchange_receive']['start_time'] ?? null}}</td>
                <td style="{{$td}}">{{$item['exchange_send']['organization']['name_en'] ?? null}}{{$item['exchange_send']['start_time'] ?? null}}</td>
            @endif
            @if($keys['type_sample_image'] ?? false)
                <td style="{{$td}}">{{$item['type_sample_image'] ?? null}}</td>
            @endif
            @if($keys['consideration'] ?? false)
                <td style="{{$td}}">{{$item['consideration'] ?? null}}</td>
            @endif
        </tr>p
    @endforeach
    </tbody>
</table>
</body>
</html>
