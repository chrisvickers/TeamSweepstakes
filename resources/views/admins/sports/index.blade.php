@extends('layouts.app')


@section('content')

    <div class="panel panel-danger">

        <div class="panel-heading clearfix">
            Sports
            <a href="{{ route('admins.sports.create') }}" class="pull-right btn btn-default btn-sm">
                <i class="fa fa-plus"></i> Add Sport
            </a>
        </div>


        <div class="panel-body">

            <div class="table-responsive">

                @include('sports._table')

                {{ $sports->links() }}

            </div>

        </div>

    </div>

@stop