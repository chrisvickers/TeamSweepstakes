<table class="table table-striped">

    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Sport</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    @foreach($leagues as $league)
        <tr>
            <td>
                <a href="{{ route('admins.leagues.edit',['id' => $league->id]) }}">{{ $league->id }}</a>
            </td>
            <td>{{ $league->name }}</td>
            <td>{{ $league->sport != null ? $league->sport->name : 'N/A' }}</td>
            <td>
                <a href="{{ route('admins.leagues.edit',['id' => $league->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                {{ Form::open(array('method' => 'delete', 'route' => array('admins.leagues.destroy',$league->id))) }}
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>