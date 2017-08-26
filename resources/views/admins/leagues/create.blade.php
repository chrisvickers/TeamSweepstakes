@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-xs-12 col-sm-6 col-sm-offset-3">

            <div class="panel panel-default">

                <div class="panel-heading">
                    Add League
                </div>


                <div class="panel-body">

                    {{ Form::open(['method' => 'post', 'route' => 'admins.leagues.store']) }}

                    <div class="form-group">
                        {{ Form::label('name') }}
                        {{ Form::text('name',old('name'), array('class' => 'form-control', 'required' => true)) }}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-right">Add League</button>
                    </div>

                    {{ Form::close() }}

                </div>

            </div>

        </div>

    </div>

@stop