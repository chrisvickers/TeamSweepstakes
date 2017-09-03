@extends('layouts.app')


@section('title')
    Create Seasons
@stop

@section('scripts')
@stop

@section('content')


    <div class="row">

        <div class="col-xs-12 col-sm-offset-2 col-sm-8">

            <div class="panel panel-default">

                <div class="panel-heading clearfix">
                    Create Season
                </div>

                <div class="panel-body">

                    {{ Form::open(array('method' => 'post', 'route' => 'admins.seasons.store')) }}
                    @include('seasons._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Season</button>
                    </div>
                    {{ Form::close() }}

                </div>

            </div>

        </div>

    </div>

@stop