@extends('adminlte::page')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">{{ $title }}</div>
    <div class="panel-body">
      <table id="registration">
        <thead>
          <tr>
            <th>City</th><th>Type</th><th>Chat Title</th><th>Chat Username</th><th>First Name</th><th>Last Name</th><th>Alert (minutes)</th><th>Status</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>City</th><th>Type</th><th>Chat Title</th><th>Chat Username</th><th>First Name</th><th>Last Name</th><th>Alert (minutes)</th><th>Status</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection

@push('js')
  <script type="text/javascript">
    $('#registration').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('ajax_registration') !!}',
      columns: [
        { data: 'city.name', name: 'city.name' },
        { data: 'chat.type', name: 'chat.type' },
        { data: 'chat.title', name: 'chat.title' },
        { data: 'chat.username', name: 'chat.username' },
        { data: 'chat.first_name', name: 'chat.first_name' },
        { data: 'chat.last_name', name: 'chat.last_name' },
        { data: 'alert', name: 'alert' },
        { data: 'status', name: 'status' },
      ]
    });
  </script>
@endpush
