@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-xs-12 col-sm-6 col-sm-offset-3">

            <div class="panel panel-default">

                <div class="panel-heading">
                    Add Sports Team
                </div>


                <div class="panel-body">

                    {{ Form::open(['method' => 'post', 'route' => 'admins.teams.store']) }}

                    @include('sports-teams._form')

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-right">Add Sports Team</button>
                    </div>

                    {{ Form::close() }}

                </div>

            </div>

        </div>

    </div>

@stop