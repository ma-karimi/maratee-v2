@if($keys['taxonomy'] ?? false)
    <td style="{{$td}}">{{ $taxonomy['family'] ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy['genus'] ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy['species'] ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy['subspecies'] ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy['variety'] ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy['persian_name'] ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy['local_name'] ?? null }}</td>
@endif
