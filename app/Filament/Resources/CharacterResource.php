<?php

namespace App\Filament\Resources;


use App\Tables\Columns\CharacterNameInfo;
use App\Tables\Columns\CharacterGuildInfo;
use App\Tables\Columns\CharacterRealmInfo;

use App\Filament\Resources\CharacterResource\Pages;
use App\Filament\Resources\CharacterResource\RelationManagers;
use App\Models\Character;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;

class CharacterResource extends Resource
{
    protected static ?string $model = Character::class;

    protected static ?string $modelLabel = "Charakter";
    protected static ?string $pluralModelLabel = "Charaktere";
    protected static ?string $navigationGroup = "Charakterverwaltung";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
      
      
        $allSpecs = Character::getClassSpecs();
        $genders = Character::getGenders();

        $classes = Character::getClassesByRace('Dracthyr');

        return $form
            ->schema([
                Section::make('Character Information')
                    ->description('')
                    ->schema([
                        Select::make('user_id')
                            ->required()
                            ->label('Player')
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable()
                            ->columnSpan(8),
                        TextInput::make('name')->required()->placeholder('Enter Character Name')->columnSpan(4),
                        Select::make('region')
                            ->required()
                            ->label('Region')
                            ->options(collect(Character::GetAllRegions())->mapWithKeys(fn ($value) => [$value => ucfirst($value)])->toArray())
                            ->searchable()
                            ->placeholder('Region')
                            ->reactive() // Wichtig: Ermöglicht das Neuladen des Realms-Selects bei Änderung
                            ->afterStateUpdated(fn (callable $set) => $set('realm', null)) // Reset des Realm-Felds bei Änderung
                            ->columnSpan(1),
                        Select::make('realm')
                            ->required()
                            ->label('Realm')
                            ->searchable()
                            ->placeholder('Select Realm')
                            ->reactive() // Reaktivität aktivieren
                            ->options(function (callable $get) {
                                $selectedRegion = $get('region');
                                
                                // Überprüfen, ob eine Region ausgewählt wurde
                                if ($selectedRegion) {
                                    $realms = Character::getRealmsByRegion($selectedRegion);
                                    return collect($realms ?? [])->mapWithKeys(fn ($realm) => [$realm => ucfirst($realm)])->toArray();
                                }

                                // Wenn keine Region ausgewählt, gib ein leeres Array zurück
                                return [];
                            })
                            ->columnSpan(3),
                        ToggleButtons::make('gender')
                            ->required()
                            ->label('Gender')
                            ->options(collect($genders)->mapWithKeys(fn ($value) => [$value => ucfirst($value)])->toArray())
                            ->grouped()
                            ->reactive() // Wichtig: Ermöglicht das Neuladen des Realms-Selects bei Änderung
                            ->columnSpan(1),
                        ToggleButtons::make('faction')
                            ->required()
                            ->label('Faction')
                            ->options(collect(Character::getFactions())->mapWithKeys(fn ($value) => [$value => ucfirst($value)])->toArray())
                            ->grouped()
                            ->reactive() // Wichtig: Ermöglicht das Neuladen des Realms-Selects bei Änderung
                            ->columnSpan(1),
                        Select::make('race')
                            ->required()
                            ->label('race')
                            ->searchable()
                            ->placeholder('Select race')
                            ->reactive() // Reaktivität aktivieren
                            ->options(function (callable $get) {
                                $selectedFaction = $get('faction');
                                return $selectedFaction ? collect(Character::getRacesByFaction($selectedFaction) ?? [])->mapWithKeys(fn ($race) => [$race => ucfirst($race)])->toArray(): []; // Wenn keine Region ausgewählt, gib ein leeres Array zurück
                            })
                            ->columnSpan(2),
                        Select::make('class')
                            ->required()
                            ->label('class')
                            ->searchable()
                            ->placeholder('Select class')
                            ->reactive() // Reaktivität aktivieren
                            ->options(function (callable $get) {
                                $selectedFaction = $get('race');
                                return $selectedFaction ? collect(Character::getClassesByRace($selectedFaction) ?? [])->mapWithKeys(fn ($class) => [$class => ucfirst($class)])->toArray(): []; // Wenn keine Region ausgewählt, gib ein leeres Array zurück
                            })
                            ->columnSpan(2),
                        Select::make('specialization')
                            ->required()
                            ->label('Specialization')
                            ->searchable()
                            ->placeholder('Select specialization')
                            ->reactive() // Reaktivität aktivieren
                            ->options(function (callable $get) {
                                $selectedClass = $get('class');
                                return $selectedClass ? collect(Character::getSpecsByClass($selectedClass) ?? [])->mapWithKeys(fn ($spec) => [$spec => ucfirst($spec)])->toArray(): []; // Wenn keine Region ausgewählt, gib ein leeres Array zurück
                            })
                            ->columnSpan(2),
                        ])->columns(8),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CharacterNameInfo::make('Character'),
                CharacterGuildInfo::make('Guild'),
                CharacterRealmInfo::make('Realm'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }
}
