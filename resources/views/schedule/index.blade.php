@extends('adminlte::page')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Schedule</div>
    <div class="panel-body">
      @foreach ($schedule as $key => $value)
        <article class="">
          <div class="body">
            [ {{ $value->city_id }} ] : {{ $value->tanggal }}
          </div>
        </article>
      @endforeach
      {{ $schedule->links() }}
    </div>
  </div>
@endsection
