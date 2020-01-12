@if($keys['family'] ?? false)
    <th style="{{$th}}">Family</th>
@endif
@if($keys['genus'] ?? false)
    <th style="{{$th}}">Genus</th>
@endif
@if($keys['species'] ?? false)
    <th style="{{$th}}">Species</th>
@endif
@if($keys['subspecies'] ?? false)
    <th style="{{$th}}">SubSpecies</th>
@endif
@if($keys['variety'] ?? false)
    <th style="{{$th}}">Variety</th>
@endif
@if($keys['scientific'] ?? false)
    <th style="{{$th}}">Scientific Name</th>
@endif
@if($keys['local_name'] ?? false)
    <th style="{{$th}}">Local/Persian Name</th>
@endif
@if($keys['author'] ?? false)
    <th style="{{$th}}">Author</th>
@endif
