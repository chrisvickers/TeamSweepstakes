<table class="table table-striped">

    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>City</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
        @foreach($sports_teams as $sports_team)
            <tr>
                <td>
                    <a href="{{ route('admins.teams.edit', array('id' => $sports_team->id)) }}">{{ $sports_team->id }}</a>
                </td>
                <td>{{ $sports_team->name }}</td>
                <td>{{ $sports_team->city }}</td>
                <td>
                    <a href="{{ route('admins.teams.edit', array('id' => $sports_team->id)) }}" class="btn btn-primary btn-sm">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>