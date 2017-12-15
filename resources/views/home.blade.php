@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
http://jadwalsholat.pkpu.or.id/monthly.php?type=2&id=67&m=12&y=2017
<br>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
