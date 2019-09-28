@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">

                        converted row count :
                        <span style="float: right;">{{ $converts->count() }}</span>
                        <hr>

                        <form action="{{ route('convert.convert') }}" method="post">
                            @csrf
                            <h4>convert</h4>
                            <label for="count">count record :</label>
                            <input type="number" name="count" id="count" class="form-control" value="50">
                            <div class="text-center">
                                <input type="submit" value="convert" class="btn btn-success">
                            </div>
                        </form>
                        <hr>

                        <form action="{{ route('convert.rollback') }}" method="post">
                            @csrf
                            <h4>rollback</h4>
                            <label for="id">rollback to record :</label>
                            <input type="number" name="id" id="id" class="form-control">
                            <div class="text-center">
                                <input type="submit" value="rollback" class="btn btn-warning">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">convert logs</div>
                    <div class="card-body">
                        @if($converts->count())
                            <table style="width: 100%" class="text-center" border="1">
                                <tr>
                                    <td>id</td>
                                    <td>treeleaf</td>
                                    <td>taxonomy</td>
                                    <td>location</td>
                                    <td>plant_herbarium</td>
                                    <td>collect_action</td>
                                    <td>collect_actionHub</td>
                                    <td>collect_actors</td>
                                    <td>detect_action</td>
                                    <td>detect_actionHub</td>
                                    <td>detect_actors</td>
                                    <td>operations</td>
                                </tr>
                                @foreach($converts as $convert)
                                    <tr>
                                        <td>{{ $convert->id }}</td>
                                        <td>{{ $convert->treeleaf_id }}</td>
                                        <td>{{ $convert->taxonomy_id }}</td>
                                        <td>{{ $convert->location_id }}</td>
                                        <td>{{ $convert->plant_herbarium_id }}</td>

                                        <td>{{ $convert->collect_action_id }}</td>
                                        <td>{{ $convert->collect_actionHub_id }}</td>
                                        <td>{{ $convert->collect_actors_id }}</td>

                                        <td>{{ $convert->detect_action_id }}</td>
                                        <td>{{ $convert->detect_actionHub_id }}</td>
                                        <td>{{ $convert->detect_actors_id ?? '-' }}</td>

                                        <td>
                                            <form action="{{ route('convert.rollback') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $convert->id }}">
                                                <input type="submit" value="rollback" class="btn btn-warning">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
