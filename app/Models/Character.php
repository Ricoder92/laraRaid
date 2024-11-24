<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{

    use HasFactory;

    protected $guarded = [];

    public static function getRegionsRealms() {
        return [
            // HINWEIS: Servernamen mit ' im Namen versursachen Probleme. Lösung nötig!
            'US' => [
                'Aegwynn', 'Aerie Peak', 'Agamaggan', 'Aggramar', 'Akama', 'Alexstrasza',
                'Alleria', 'Altar of Storms', 'Alterac Mountains', 'Andorhal', 'Anetheron',
                'Antonidas', 'Anubarak', 'Anvilmar', 'Arathor', 'Archimonde', 'Area 52',
                'Argent Dawn', 'Arthas', 'Arygos', 'Auchindoun', 'Azgalor', 'Azjol-Nerub',
                'Azralon', 'Azshara', 'Azuremyst', 'Baelgun', 'Balnazzar', 'Barthilas',
                'Black Dragonflight', 'Blackhand', 'Blackrock', 'Blackwater Raiders', 
                'Blackwing Lair', 'Bladefist', 'Bleeding Hollow', 'Blood Furnace',
                'Bloodhoof', 'Bloodscalp', 'Bonechewer', 'Borean Tundra', 'Boulderfist',
                'Bronzebeard', 'Burning Blade', 'Burning Legion', 'Caelestrasz',
                'Cairne', 'Cenarion Circle', 'Cenarius', 'Chogall', 'Chromaggus',
                'Coilfang', 'Crushridge', 'Daggerspine', 'Dalaran', 'Dalvengyr', 
                'Dark Iron', 'Darkspear', 'Darrowmere', 'DathRemar', 'Dawnbringer',
                'Deathwing', 'Demon Soul', 'Dentarg', 'Destromath', 'Dethecus',
                'Detheroc', 'Doomhammer', 'Draenor', 'Dragonblight', 'Dragonmaw',
                'DrakTharon', 'Draktor', 'Drakkari', 'Drenden', 'Dunemaul',
                'Durotan', 'Duskwood', 'Earthen Ring', 'Echo Isles', 'Eitrigg',
                'EldreThalas', 'Elune', 'Emerald Dream', 'Eonar', 'Eredar',
                'Executus', 'Exodar', 'Farstriders', 'Feathermoon', 'Fenris', 'Firetree',
                'Fizzcrank', 'Frostmane', 'Frostmourne', 'Frostwolf', 'Galakrond', 
                'Gallywix', 'Garithos', 'Garona', 'Garrosh', 'Ghostlands',
                'Gilneas', 'Gnomeregan', 'Goldrinn', 'Gorefiend', 'Gorgonnash',
                'Greymane', 'Grizzly Hills', 'Guldan', 'Gundrak', 'Gurubashi',
                'Hakkar', 'Haomarush', 'Hellscream', 'Hydraxis', 'Hyjal', 'Icecrown',
                // Additional US realms can be added here...
            ],
            'EU' => [
                'Aegwynn', 'Aerie Peak', 'Agamaggan', 'Aggramar', 'AhnQiraj', 'AlAkir',
                'Alexstrasza', 'Alleria', 'Alonsus', 'AmanThul', 'Ambossar', 
                'Anachronos', 'Arathor', 'Archimonde', 'Area 52', 'Argent Dawn',
                'Arthas', 'Arygos', 'Ashenvale', 'Aszune', 'Auchindoun', 'Azjol-Nerub',
                'Azshara', 'Azuremyst', 'Baelgun', 'Balnazzar', 'Blackhand', 
                'Blackmoore', 'Blackrock', 'Bladefist', 'Bloodfeather', 'Bloodhoof',
                'Bloodscalp', 'Blutkessel', 'Borean Tundra', 'Bronze Dragonflight', 
                'Burning Blade', 'Burning Legion', 'Chamber of Aspects', 'Chants éternels',
                'Chogall', 'Chromaggus', 'Conseil des Ombres', 'Culte de la Rive noire',
                'Daggerspine', 'Dalaran', 'Dalvengyr', 'Darkmoon Faire', 'Darkspear',
                'Deathwing', 'Defias Brotherhood', 'Dentarg', 'Der Mithrilorden',
                'Der Rat von Dalaran', 'Dethecus', 'Die Aldor', 'Die Arguswacht',
                'Die Nachtwache', 'Die Silberne Hand', 'Die Todeskrallen', 
                'Doomhammer', 'Draenor', 'Dragonblight', 'DrakThul', 'DrekThar',
                // Additional EU realms can be added here...
            ],
            'KR' => [
                'Azshara', 'Burning Legion', 'Dalaran', 'Deathwing', 'Elune', 'Garona',
                'Hyjal', 'Illidan', 'Kaelthas', 'Kiljaeden', 'MalGanis', 
                'Nerzhul', 'Ragnaros', 'Rexxar', 'Stormrage', 'Tichondrius',
                'Zuljin',
                // Add Korean realms as needed...
            ],
            'TW' => [
                'Bleeding Hollow', 'Chillwind Point', 'Crystalpine Stinger', 'Dragonmaw',
                'Hellscream', 'Holy Ridge', 'Icecrown', 'Lights Hope',
                'Nightmare', 'Shadowmoon', 'Silverwing Hold', 'Skywall',
                'Stormscale', 'Whispering Wind', 'Windrunner', 'World Tree',
                // Add Taiwanese realms as needed...
            ],
            'CN' => [
                '奥妮克希亚', '布鲁', '死亡之翼', '黑石山', '红龙军团', '黄金之路',
                '寒冰皇冠', '基尔加丹', '火焰之树', '雷霆之怒', '雷斧堡垒',
                '狂热之刃', '玛里苟斯', '霜之哀伤', '燃烧军团', '血环',
                '遗忘海岸', '银松森林', '幽暗沼泽', '伊利丹', '月光林地'
                // Add Chinese realms as needed...
            ]
        ];
    }

    public static function getAllRegions(): array
    {
        $data = self::getRegionsRealms();
        return array_keys($data); // Gibt alle Regionennamen (z.B. 'US', 'EU', etc.) zurück
    }
    
    public static function getAllRealms(): array
    {
        $data = self::getRegionsRealms();
        $realms = [];

        // Iteration durch alle Regionen und alle Realms innerhalb dieser Regionen
        foreach ($data as $regionRealms) {
            $realms = array_merge($realms, $regionRealms);
        }

        return array_unique($realms); // Gibt eine Liste aller einzigartigen Realms zurück
    }

    public static function getRealmsByRegion(string $region): array
    {
        $data = self::getRegionsRealms();
        
        // Überprüfen, ob die angegebene Region existiert und deren Realms zurückgeben
        if (isset($data[$region])) {
            return $data[$region];
        }

        // Wenn die Region nicht gefunden wird, eine leere Liste zurückgeben
        return [];
    }



    public static function getFactionRaceClass() {

        return [
            'Horde' => [
                'Orc' => ['Warrior', 'Hunter', 'Rogue', 'Shaman', 'Warlock', 'Monk', 'Death Knight'],
                'Undead' => ['Warrior', 'Rogue', 'Priest', 'Mage', 'Warlock', 'Hunter', 'Monk', 'Death Knight'],
                'Tauren' => ['Warrior', 'Paladin', 'Hunter', 'Shaman', 'Druid', 'Monk', 'Death Knight'],
                'Troll' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Shaman', 'Druid', 'Monk', 'Death Knight'],
                'Blood Elf' => ['Warrior', 'Paladin', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Warlock', 'Monk', 'Death Knight', 'Demon Hunter'],
                'Goblin' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Shaman', 'Warlock', 'Monk', 'Death Knight'],
                'Pandaren' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Shaman', 'Monk'],
                'Nightborne' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Warlock', 'Monk'],
                'Highmountain Tauren' => ['Warrior', 'Hunter', 'Shaman', 'Druid', 'Monk', 'Death Knight'],
                'Zandalari Troll' => ['Warrior', 'Paladin', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Shaman', 'Druid', 'Monk', 'Death Knight'],
                'Vulpera' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Shaman', 'Warlock', 'Monk'],
            ],
            'Alliance' => [
                'Human' => ['Warrior', 'Paladin', 'Rogue', 'Priest', 'Mage', 'Warlock', 'Hunter', 'Monk', 'Death Knight'],
                'Dwarf' => ['Warrior', 'Paladin', 'Hunter', 'Rogue', 'Priest', 'Shaman', 'Mage', 'Monk', 'Death Knight'],
                'Night Elf' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Druid', 'Monk', 'Death Knight', 'Demon Hunter'],
                'Gnome' => ['Warrior', 'Rogue', 'Priest', 'Mage', 'Warlock', 'Hunter', 'Monk', 'Death Knight'],
                'Draenei' => ['Warrior', 'Paladin', 'Hunter', 'Priest', 'Mage', 'Shaman', 'Monk', 'Death Knight'],
                'Worgen' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Druid', 'Warlock', 'Death Knight'],
                'Pandaren' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Shaman', 'Monk'],
                'Void Elf' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Warlock', 'Monk', 'Death Knight'],
                'Lightforged Draenei' => ['Warrior', 'Paladin', 'Hunter', 'Priest', 'Mage', 'Monk', 'Death Knight'],
                'Kul Tiran' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Shaman', 'Druid', 'Monk', 'Death Knight'],
                'Dark Iron Dwarf' => ['Warrior', 'Paladin', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Shaman', 'Warlock', 'Monk', 'Death Knight'],
                'Mechagnome' => ['Warrior', 'Hunter', 'Rogue', 'Priest', 'Mage', 'Warlock', 'Monk'],
                'Dracthyr' => ['Evoker', "Warrior", "Mage", "Priest", "Rogue", "Warlock"],
            ]
        ];
    }

    public static function getClassSpecs() {

        return [
            'Warrior' => ['Arms', 'Fury', 'Protection'],
            'Paladin' => ['Holy', 'Protection', 'Retribution'],
            'Hunter' => ['Beast Mastery', 'Marksmanship', 'Survival'],
            'Rogue' => ['Assassination', 'Outlaw', 'Subtlety'],
            'Priest' => ['Discipline', 'Holy', 'Shadow'],
            'Death Knight' => ['Blood', 'Frost', 'Unholy'],
            'Shaman' => ['Elemental', 'Enhancement', 'Restoration'],
            'Mage' => ['Arcane', 'Fire', 'Frost'],
            'Warlock' => ['Affliction', 'Demonology', 'Destruction'],
            'Monk' => ['Brewmaster', 'Mistweaver', 'Windwalker'],
            'Druid' => ['Balance', 'Feral', 'Guardian', 'Restoration'],
            'Demon Hunter' => ['Havoc', 'Vengeance'],
            'Evoker' => ['Devastation', 'Preservation', 'Augmentation'],
        ];

    }

    public static function getAllFactions(): array
    {
        $data = self::getFactionRaceClass();
        return array_keys($data); // Gibt die Keys (Fraktionen) zurück
    }

    public static function getAllRaces(): array
    {
        $data = self::getFactionRaceClass();
        $races = [];

        foreach ($data as $faction => $factionRaces) {
            $races = array_merge($races, array_keys($factionRaces));
        }

        return array_unique($races); // Gibt eine Liste aller Rassen ohne Duplikate zurück
    }

    public static function getAllClasses(): array
    {
        $data = self::getFactionRaceClass();
        $classes = [];

        foreach ($data as $faction => $factionRaces) {
            foreach ($factionRaces as $race => $raceClasses) {
                $classes = array_merge($classes, $raceClasses);
            }
        }

        return array_unique($classes); // Gibt eine Liste aller Klassen ohne Duplikate zurück
    }

    public static function getAllSpecs(): array
    {
        $data = self::getClassSpecs();
        $specs = [];

        foreach ($data as $class => $classSpecs) {
            $specs = array_merge($specs, $classSpecs);
        }

        return array_unique($specs); // Gibt eine Liste aller Specs ohne Duplikate zurück
    }

    public static function getGenders() {
        return ['Male', 'Female'];
    }

    public static function getFactions(): array
    {
        // Hole die Daten aus der Funktion
        $factions = self::getFactionRaceClass();

        // Gib die Schlüssel (Fraktionen) zurück
        return array_keys($factions);
    }

    public static function getClassesByRace(string $race): array
    {
        // Hole alle Fraktionen und Rassen
        $factions = self::getFactionRaceClass();

        // Suche die Rasse in beiden Fraktionen
        foreach ($factions as $faction => $races) {
            if (array_key_exists($race, $races)) {
                return $races[$race]; // Gib die passende Klassenliste zurück
            }
        }

        // Falls die Rasse nicht gefunden wird, leeres Array zurückgeben
        return [];
    }

    public static function getRacesByFaction(string $faction): array
    {
        // Hole die Daten aus der Hauptfunktion
        $factions = self::getFactionRaceClass();

        // Prüfe, ob die Fraktion existiert
        if (array_key_exists($faction, $factions)) {
            // Gib die Rassen als Array zurück (die Schlüssel des entsprechenden Arrays)
            return array_keys($factions[$faction]);
        }

        // Wenn die Fraktion nicht existiert, leeres Array zurückgeben
        return [];
    }

    public static function getSpecsByClass(string $class): array
    {
        // Hole die Daten aus der Hauptfunktion
        $classes = self::getClassSpecs();

        // Prüfe, ob die Klasse existiert
        if (array_key_exists($class, $classes)) {
            // Gib die Specs der Klasse zurück
            return $classes[$class];
        }

        // Wenn die Klasse nicht existiert, leeres Array zurückgeben
        return [];
    }


    public function getRaceImageUrl(){
        $race = Str::slug($this->race);
        $gender = strtolower($this->gender);
        return asset('images/character-icons/races/64px-Charactercreate-races_'.$race.'-'.$gender.'.webp');
    }

    public function getClassImageUrl(){
        $class = Str::slug($this->class);
        return asset('images/character-icons/classes/64px-Charactercreate-class_'.$class.'.webp');
    }

    public function getSpecImageUrl(){
        $class = Str::slug($this->class);
        $spec = Str::slug($this->specialization);
        return asset('images/character-icons/specs/'.$class.'-'.$spec.'.webp');
    }

    //Fraktion Bilder abrufen
    public function getFractionImageUrl() {
        $fraction = $this->fraction;
        switch ($fraction) {
            case 'Allianz':
                return asset('images/fraction_images/Alliance.png');
            case 'Horde':
                return asset('images/fraction_images/Horde.png');
            default:
                return asset('images/fraction_images/default.png');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Ein Charakter gehört zu einem Benutzer
    }

    
    public function groups()
    {
        return $this->belongsToMany(CharacterGroup::class, 'character_groups_characters');
    }



}