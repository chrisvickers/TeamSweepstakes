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
            <td>{{ $league->sport->name }}</td>
            <td>
                <a href="{{ route('admins.leagues.edit',['id' => $league->id]) }}" class="btn btn-primary">Edit</a>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>