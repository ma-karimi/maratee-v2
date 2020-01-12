@if($keys['family'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->family->name ?? null }}</td>
@endif
@if($keys['genus'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->genus->name ?? null }}</td>
@endif
@if($keys['species'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->species->name ?? null }}</td>
@endif
@if($keys['subspecies'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->subspecies->name ?? null }}</td>
@endif
@if($keys['variety'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->variety->name ?? null }}</td>
@endif
@if($keys['scientific'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->scientific_name ?? null }}</td>
@endif
@if($keys['local_name'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->name ?? null }}</td>
@endif
@if($keys['author'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->authors ?? null }}</td>
@endif
