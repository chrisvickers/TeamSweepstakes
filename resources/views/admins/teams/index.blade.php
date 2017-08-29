@extends('layouts.app')


@section('content')

    <div class="panel panel-danger">

        <div class="panel-heading clearfix">
            Sports Team
            <a href="{{ route('admins.teams.create') }}" class="pull-right btn btn-default btn-sm">
                <i class="fa fa-plus"></i> Add Sport Team
            </a>
        </div>


        <div class="panel-body">

            <div class="table-responsive">

                @include('sports-teams._table')

                {{ $sports_teams->links() }}

            </div>

        </div>

    </div>

@stop