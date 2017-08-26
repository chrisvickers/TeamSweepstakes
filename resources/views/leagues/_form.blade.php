<div class="form-group">
    {{ Form::label('name') }}
    {{ Form::text('name',old('name',isset($league->name) ? $league->name : null), array('class' => 'form-control', 'required' => true)) }}
</div>

<div class="form-group">
    {{ Form::label('sport') }}
    <select class="form-control" name="sport_id" id="sport_id" required>
        <option selected disabled="">Select Sport</option>
        @foreach($sports as $sport)
            <option {{ old('sport_id',isset($league->sport_id) ? $league->sport_id : null) == $sport->id ? 'selected' : '' }} value="{{ $sport->id }}">{{ $sport->name }}</option>
        @endforeach
    </select>
</div>