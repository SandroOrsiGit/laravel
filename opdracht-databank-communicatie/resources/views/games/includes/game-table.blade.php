<table class="w-full text-left shadow-2xl">
    <tr class="bg-gray-300">
        <th class="p-2 w-4"></th>
        <th class="p-2">Game</th>
        <th class="p-2">Publisher</th>
        <th class="p-2">Actions</th>
    </tr>

    @forelse ($games as $game)
        @include('games.includes.game-row')
    @empty
        <p>There are no games to display</p>
    @endforelse


</table>
