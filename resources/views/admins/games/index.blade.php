@extends('layouts.app')


@section('title')
@stop

@section('scripts')
@stop

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            Leagues
            <a href="{{ route('admins.games.create') }}" class="pull-right btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Add Game
            </a>
        </div>


        <div class="panel-body">

            <div class="table-responsive">

                @include('games._table',['games' => $games])

                {{ $games->links() }}

            </div>

        </div>
    </div>

@stop