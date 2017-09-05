@extends('layouts.app')


@section('title')
    Season - {{ $season->year }}
@stop

@section('scripts')
@stop

@section('content')


    <div class="row">

        <div class="col-xs-12 col-sm-6">

            <div class="panel panel-primary">

                <div class="panel-heading clearfix">
                    Season - {{ $season->year }}
                </div>

                <div class="panel-body">
                    {{ Form::open(array('method' => 'patch', 'route' => array('admins.seasons.update', $season->id))) }}

                    @include('seasons._form')

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Season</button>
                    </div>

                    {{ Form::close() }}
                </div>

            </div>



        </div>

        <div class="col-xs-12 col-sm-6">

            <div class="panel panel-success">

                <div class="panel-heading clearfix">
                    Weeks
                </div>

                <div class="panel-body">



                </div>

            </div>

        </div>


    </div>


@stop