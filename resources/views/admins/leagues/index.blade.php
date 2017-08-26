@extends('layouts.app')


@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            Leagues
            <a href="{{ route('admins.leagues.create') }}" class="pull-right btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Add League
            </a>
        </div>

    </div>

@stop