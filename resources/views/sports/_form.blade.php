<div class="form-group">
    {{ Form::label('name') }}
    {{ Form::text('name',old('name',isset($sport) ? $sport->name : null), array('class' => 'form-control', 'required' => true)) }}
</div>