@extends('adminlte::page')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">Update</div>
    <div class="panel-body">
      <table id="update">
        <thead>
          <tr>
            <th>ID</th><th>Raw Updates</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th><th>Raw Updates</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection

@push('js')
  <script type="text/javascript">
    $('#update').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('ajax_update') !!}',
      columns: [
        { data: 'id', name: 'id' },
        { data: 'raw_updates', name: 'raw_updates' },
      ]
    });
  </script>
@endpush
