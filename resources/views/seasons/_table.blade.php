<table class="table table-striped">

    <thead>
    <tr>
        <th>ID</th>
        <th>Year</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    @foreach($seasons as $season)
        <tr>
            <td>
                <a href="{{ route('admins.seasons.edit',array('id' => $season->id)) }}">{{ $season->id }}</a>
            </td>
            <td>{{ $season->year }}</td>
            <td>
                <a href="{{ route('admins.seasons.edit', array('id' => $season->id)) }}" class="btn btn-primary btn-sm">Edit</a>
                {{ Form::open(array('method' => 'delete', 'route' => array('admins.seasons.destroy', $season->id))) }}
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>