<?php
namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    protected $model = Character::class;

    public function definition()
    {

        // Random Region und Realm
        $region = $this->faker->randomElement(Character::GetAllRegions());
        $realm = $this->faker->randomElement(Character::GetRealmsByRegion($region));
        $guild = $this->faker->randomElement(['Echo', 'Limit', 'Name in Progress', 'Paragon', 'Starlight']);

        $gender = $this->faker->randomElement(Character::getGenders());

        $faction = $this->faker->randomElement(Character::getFactions()); 
        $race = $this->faker->randomElement(Character::getRacesByFaction($faction)); 
        $class = $this->faker->randomElement(Character::getClassesByRace($race)); 
        $spec = $this->faker->randomElement(Character::getSpecsByClass($class));


        return [
            'user_id' => $this->faker->numberBetween(1, 1), // Generiert einen zufälligen Level zwischen 60 und 70
            'name' => $this->faker->unique()->firstName, // Generiert einen zufälligen Namen
            'race' => $race,
            'gender' => $gender,
            'class' => $class,
            'specialization' => $spec, // Spezialisierung passend zur Klasse
            'level' => $this->faker->numberBetween(60, 70), // Generiert einen zufälligen Level zwischen 60 und 70
            'faction' => $faction,
            'region' => $region,
            'realm' => $realm,
            'guild' => $guild,
        ];
    }
}
