<table class="table table-striped">

    <thead>
    <tr>
        <th>ID</th>
        <th>Home Team</th>
        <th>Away Team</th>
        <th>Date</th>
        <th>Season</th>
    </tr>
    </thead>

    <tbody>
    @foreach($games as $game)
        <tr>
            <td>
                <a href="{{ route('admins.games.edit',array('id' => $games->id)) }}"{{ $game->id }}></a>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
    </tbody>

</table>