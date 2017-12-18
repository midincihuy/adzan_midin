@extends('adminlte::page')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Schedule</div>
    <div class="panel-body">
      {{-- {{ $schedule[0]->city->name }} --}}
      City [Tanggal] : Shubuh | Dzuhur | Ashr | Maghrib | Isya
      @foreach ($schedule as $key => $value)
        <article class="">
          <div class="body">
            {{ $value->city->name }} [ {{ $value->tanggal }} ] : {{ $value->shubuh }} | {{ $value->dzuhur }} | {{ $value->ashr }} | {{ $value->maghrib }} | {{ $value->isya }}
          </div>
        </article>
      @endforeach
      {{ $schedule->links() }}
    </div>
  </div>
@endsection
