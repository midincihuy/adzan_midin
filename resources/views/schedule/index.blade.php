@extends('adminlte::page')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Schedule</div>
    <div class="panel-body">
      <table id="schedule">
        <thead>
          <tr>
            <th>City ID</th><th>Tanggal</th>
            <th>Imsyak</th><th>Shubuh</th><th>Terbit</th><th>Dhuha</th>
            <th>Dzuhur</th><th>Ashr</th><th>Maghrib</th><th>Isya</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>City ID</th><th>Tanggal</th>
            <th>Imsyak</th><th>Shubuh</th><th>Terbit</th><th>Dhuha</th>
            <th>Dzuhur</th><th>Ashr</th><th>Maghrib</th><th>Isya</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection

@push('js')
  <script type="text/javascript">
    $('#schedule').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('ajax_schedule') !!}',
      columns: [
        { data: 'city.name', name: 'city.name' },
        { data: 'tanggal', name: 'tanggal' },
        { data: 'imsyak', name: 'imsyak' },
        { data: 'shubuh', name: 'shubuh' },
        { data: 'terbit', name: 'terbit' },
        { data: 'dhuha', name: 'dhuha' },
        { data: 'dzuhur', name: 'dzuhur' },
        { data: 'ashr', name: 'ashr' },
        { data: 'maghrib', name: 'maghrib' },
        { data: 'isya', name: 'isya' },
      ]
    });
  </script>
@endpush
