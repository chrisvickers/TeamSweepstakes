@extends('layouts.app')


@section('title')
    Seasons
@stop

@section('scripts')
@stop

@section('content')

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-sm-offset-2">

            <div class="panel panel-default">

                <div class="panel-heading clearfix">
                    Seasons
                    <a href="{{ route('admins.seasons.create') }}" class="btn btn-sm btn-primary pull-right">
                        Add Season
                    </a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">

                        @include('seasons._table',['seasons' => $seasons])

                    </div>
                </div>

            </div>

        </div>

    </div>

@stop