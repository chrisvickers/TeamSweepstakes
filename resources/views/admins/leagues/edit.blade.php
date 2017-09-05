@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-xs-12 col-sm-6">

            <div class="panel panel-default">

                <div class="panel-heading clearfix">
                    League - {{ $league->name }}
                </div>


                <div class="panel-body">

                    {{ Form::open(['method' => 'patch', 'route' => ['admins.leagues.update', $league->id]]) }}

                    @include('leagues._form')

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update League</button>
                    </div>

                    {{ Form::close() }}

                </div>

            </div>

        </div>


        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-success">

                <div class="panel-heading clearfix">
                    Seasons
                    {{ Form::open(array('method' => 'delete', 'route' => array('admins.leagues.seasons.destroy-all',$league->id))) }}
                    {{ Form::close() }}
                </div>


                <div class="panel-body">
                    {{ Form::open(array('method' => 'post', 'route' => array('admins.leagues.seasons.update', $league->id))) }}

                    <div class="form-group">
                        {{ Form::label('seasons') }}
                        <select class="form-control" multiple id="seasons" name="seasons[]">
                        @foreach($seasons as $season)
                            <option {{ in_array($season->id, $league->seasons->pluck('id')->toArray()) !== false ? 'selected' : '' }} value="{{ $season->id }}">{{ $season->year }}</option>
                        @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Seasons</button>
                    </div>

                    {{ Form::close() }}
                </div>

            </div>
        </div>

    </div>

@stop