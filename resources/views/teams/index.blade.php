@extends('layouts.app')



@section('content')

    <div class="row">

        <div class="col-xs-12">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4 class="panel-title">Teams</h4>

                    @if(Auth::user()->can('add-teams'))
                        <div class="pull-right">
                            <a href="{{ route('teams.create') }}" class="btn btn-primary btn-sm">Add Team</a>
                        </div>
                    @endif

                </div>


                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table table-striped">

                            <thead>
                            <tr>
                                <th>Name</th>
                                <th></th>
                                <th>Last Game Played</th>
                                <th>Latest Score</th>
                                @if(Auth::user()->can('edit-teams'))
                                    <th></th>
                                @endif
                            </tr>
                            </thead>

                            @foreach($teams as $team)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @if(Auth::user()->can('edit-teams'))
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
