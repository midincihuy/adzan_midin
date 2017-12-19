@extends('adminlte::page')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">City</div>
    <div class="panel-body">
      <table id="city">
        <thead>
          <tr>
            <th>City ID</th><th>Name</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>City ID</th><th>Name</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection
@push('js')
  <script type="text/javascript">
    $('#city').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('ajax_city') !!}',
      columns: [
        { data: 'city_id', name: 'city_id' },
        { data: 'name', name: 'name' },
      ]
    });
  </script>
@endpush
