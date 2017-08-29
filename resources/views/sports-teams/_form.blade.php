<div class="form-group">
    {{ Form::label('name') }}
    {{ Form::text('name',old('name',isset($sports_team->name) ? $sports_team->name : null), array('class' => 'form-control', 'required' => true)) }}
</div>


<div class="form-group">
    {{ Form::label('city') }}
    {{ Form::text('city',old('city', isset($sports_team->city) ? $sports_team->city : null), array('class' => 'form-control', 'required' => true)) }}
</div>


<div class="form-group">
    {{ Form::label('league') }}
    <select class="form-control" id="league_id" name="league_id" required>
        <option selected disabled>Select League</option>
        @foreach($sports as $sport)
            @if($sport->id != null)
                <optgroup label="{{ $sport->name }}">{{ $sport->name }}</optgroup>
                @foreach($leagues as $league)
                    @if(isset($league->sport->id) && $league->sport->id == $sport->id)
                        <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                    @endif
                @endforeach
            @endif

        @endforeach
    </select>
</div>