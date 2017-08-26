@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-xs-12 col-sm-6 col-sm-offset-3">

            <div class="panel panel-default">

                <div class="panel-heading clearfix">
                    League - {{ $league->name }}
                </div>


                <div class="panel-body">

                    {{ Form::open(['method' => 'patch', 'route' => ['admins.leagues.update', $league->id]]) }}

                    @include('leagues._form')

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update League</button>
                    </div>

                    {{ Form::close() }}

                </div>

            </div>

        </div>

    </div>

@stop