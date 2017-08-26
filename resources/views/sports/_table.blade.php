<table class="table table-striped">

    <thead>
    <tr>
        <th>ID</th>
        <th>Sport</th>
        <th>Leagues</th>
        <th></th>
    </tr>
    </thead>


    <tbody>
    @foreach($sports as $sport)
        <tr>
            <td>
                <a href="{{ route('admins.sports.edit',['id' => $sport->id]) }}">{{ $sport->id }}</a>
            </td>
            <td>{{ $sport->name }}</td>
            <td>{{ $sport->leagues->count() }}</td>
            <td>
                <a href="{{ route('admins.sports.edit',['id' => $sport->id]) }}" class="btn btn-primary">Edit</a>
                {{ Form::open(array('method' => 'delete', 'route' => array('admins.sports.destroy', $sport->id))) }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>