@if($keys['taxonomy'] ?? false)
    <td style="{{$td}}">{{ $taxonomy->family->name ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy->genus->name ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy->species->name ?? null }}</td> {{$taxonomy->species_authors ?? null}}
    <td style="{{$td}}">{{ $taxonomy->subspecies->name ?? null }}</td> {{$taxonomy->subspecies_authors ?? null}}
    <td style="{{$td}}">{{ $taxonomy->variety->name ?? null }}</td> {{$taxonomy->variety_authors ?? null}}
    <td style="{{$td}}">{{ $taxonomy->scientific ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy->name ?? null }}</td>
    <td style="{{$td}}">{{ $taxonomy->authors ?? null }}</td>
@endif
