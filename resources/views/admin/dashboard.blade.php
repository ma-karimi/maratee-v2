@extends('admin.app')
@section('title','صفحه اصلی')
@section('content')
    <h3 style="color: blue;text-align: center; margin: 15px auto;"><span
                class="dashboardTable-span">{{$auth->name}}</span></h3>
    <h4 style="text-align: center; margin: 15px auto;">به {{config('app-services.app.name')}} خوش آمدید</h4>
@endsection