<div class="form-group">
    {{ Form::label('year') }}
    {{ Form::number('year', old('year', isset($season) ? $season->year : null), array('class' => 'form-control')) }}
</div>