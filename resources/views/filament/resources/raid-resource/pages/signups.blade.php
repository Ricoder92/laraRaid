<x-filament-panels::page>

    <div class="space-y-4">
        <h1 class="text-xl font-bold">Raid Encounters</h1>

        <table class="min-w-full overflow-scroll">
            <thead>
                <tr class="">
					<th class="py-2 px-4 ">Spieler</th>
                    @forelse ($raidEncounters as $encounter)
                        <th class="py-2 px-4 ">{{ $encounter->id }}</th>
                @empty
                        <th colspan="3" class="py-2 px-4 text-center">Keine RaidEncounters vorhanden.</th>
                   
                @endforelse
                </tr>
            </thead>
			<tbody>
				@for ($j = 0; $j < 20; $j++)
				<tr>
					
					<th class="py-2 px-4 b">Spieler {{$j}}</th>
					@for ($i = 0; $i < $raidEncounters->count(); $i++)
						<td class="py-2 px-4 ">
							<select>
								<option>gesetzt</otion>
								<option>bank</otion>
								<option>nicht dabei</otion>
							</select>
						</td>
					@endfor
				
				</tr>
				@endfor
						
            </tbody>
        </table>
    </div>

</x-filament-panels::page>
