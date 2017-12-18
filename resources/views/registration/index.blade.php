@extends('adminlte::page')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">{{ $title }}</div>
    <div class="panel-body">
      {{-- {{ $schedule[0]->city->name }} --}}
      @foreach ($registration as $key => $value)
        <article class="">
          <div class="body">
            {{ $value->chat_id }} in [{{ $value->city_id }}] {{ $value->city->name }} with : {{ $value->alert }} minutes alert

          </div>
        </article>
      @endforeach
      {{ $registration->links() }}
    </div>
  </div>
@endsection
