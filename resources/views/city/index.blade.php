@extends('adminlte::page')

@section('content')
  {{-- <div class="container">
    <div class="row"> --}}
      {{-- <div class="col-md-8 col-md-offset-2"> --}}
        <div class="panel panel-default">
          <div class="panel-heading">City</div>
          <div class="panel-body">
            @foreach ($cities as $key => $value)
              <article class="">
                <div class="body">
                  [ {{ $value->city_id }} ] : {{ $value->name }}
                </div>
              </article>
            @endforeach
            {{ $cities->links() }}
          </div>
        </div>
      {{-- </div> --}}
    {{-- </div>
  </div> --}}
@endsection
