<?php

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Seeder;

class RacesSeeder extends Seeder
{
    protected $races = [
        [
            'name' => 'dragon',
            'description' => 'Is a race of Monster representing mythological serpentine, reptile or avian-like beings.'
                . ' These beings are typically fire-breathing creatures that symbolize chaos, brutality, fierceness and intimidation.',
        ],
        [
            'name' => 'spellcaster',
            'description' => 'Is a race consisting of beings that control magic, such as witches, wizards, and mages.'
                . ' The majority of these creatures contain effects and can be very versatile Monsters, used often with support of Spell Cards.',
        ],
        [
            'name' => 'zombie',
            'description' => 'Is a race of monster representing undead beings, including mummies, skeletons, vampires and often ghosts'
                . ' (though sometimes spirits fall under other races).',
        ],
        [
            'name' => 'warrior',
            'description' => 'Is a diverse, versatile, and popular race of Monster. There are Warriors of every Attribute,'
                . ' primarily EARTH, DARK and LIGHT. The Warrior-Type is the most human-like Type of monster,'
                . ' consisting of many human knights, brawlers, rogues, etc.',
        ],
        [
            'name' => 'beast-warrior',
            'description' => 'Is a race of monster that usually resembles anthropomorphic animals or other half-man, half-animal creatures '
                . ' such as centaurs. Their effects generally apply after destroying a monster, and help them destroy monsters more easily.'
                . ' Many of their effects also deal with Normal Monsters. However, a lot of their effects tend to give an advantage during battle.',
        ],
        [
            'name' => 'beast',
            'description' => 'Is a race of monster consisting mainly of wild animals. They are typically EARTH Attribute monsters,'
                . ' although LIGHT and FIRE monsters of this type are not uncommon. Beast-Type monsters are often overlooked,'
                . ' but often have great utility. Because they are relatively low in number compared to more popular monster types,'
                . ' there is not one specific theme or strategy common to them, though many have effects that assist them during the Battle Phase.',
        ],
        [
            'name' => 'winged beast',
            'description' => 'Winged Beasts monsters represent creatures of flight such as birds or bats. They commonly have effects related'
                . ' to removing cards from the field, especially cards in the Spell & Trap Card Zone, although some are designed instead'
                . ' to take advantage of an opponent without any cards in their Spell & Trap Card Zone once it has been cleared by the others.',
        ],
        [
            'name' => 'fiend',
            'description' => 'Is a monster race symbolizing darkness, wickedness, perniciousness, and diabolical horror.'
                . ' They are often demons, devils or ghosts, and are almost exclusively DARK-Attribute.',
        ],
        [
            'name' => 'fairy',
            'description' => 'Is a race of monster often represented by beings such as sprites, angels, or in some occasions,'
                . ' anything that represents organic and mechanical beings of advanced extraterrestrial origin.'
                . ' They\'re primarily LIGHT, although there are also those of all six common Attributes.',
        ],
        [
            'name' => 'insect',
            'description' => 'They are a versatile, and somewhat well-supported race of Monster that go hand-in-hand with Plant-Type monsters.'
                . ' The common attributes associated with them are EARTH and WIND. They typically act like their namesake by swarming the field,'
                . ' and can sometimes prove to be quite an annoyance to players by using their unique abilities.',
        ],
        [
            'name' => 'dinosaur',
            'description' => 'Is a race of monster that primarily relies on beatdown tactics and sometimes Monster effects,'
                . ' to help a Duelist prevail in a Duel. There are many high-level Dinosaur-Type monsters, so the general strategy'
                . ' for them is to Summon their high-Level monsters as quickly as possible, overpowering the opponent\'s weaker'
                . ' monsters before they have a chance to defend themselves.',
        ],
        [
            'name' => 'reptile',
            'description' => 'Reptile monsters were once one of the most overlooked and undersupported races.'
                . ' However, they have come into their own as a race that focuses on controlling the opponent with the use of Counters.',
        ],
        [
            'name' => 'fish',
            'description' => 'Generally, they have effects that require the presence or Tribute of another Fish to activate,'
                . ' or focus on manipulating advantage through banishing.',
        ],
        [
            'name' => 'sea serpent',
            'description' => 'Is a race of monster representing mythological, dragon-like creatures living in the sea.',
        ],
        [
            'name' => 'machine',
            'description' => 'Is a race of monster representing robots, transportation vehicles (including spacecraft) and'
                . ' other mechanical objects. Machine monsters are powerful, and in some cases, fearsome to face in battle.'
                . ' They rely on high ATK as well as a variety of powerful effects, and they have some of the strongest Fusion Monsters.',
        ],
        [
            'name' => 'thunder',
            'description' => 'Thunder monsters are generally LIGHT, although there are EARTH, WATER or WIND minorities as well.'
            . ' Thunder monsters usually represent beings with control over electricity. Many Thunder monsters\' card effects'
            . ' and support cards focus on destroying the opponent\'s monsters by effect.',
        ],
        [
            'name' => 'aqua',
            'description' => 'Is a monster race that has power over water or ice. They may also represent aquatic or amphibious'
                . ' creatures that do not fall under the category of Fish or Sea Serpent, like sea-borne mammals and amphibians.'
                . ' In the same respect, most Aqua-Type monsters are WATER monsters, though Aqua-Type monsters for almost every'
                . ' other Attribute do exist. Aqua-Type effects are varied, but many of the best focus on hand control.',
        ],
        [
            'name' => 'pyro',
            'description' => 'Is a race of monster that is almost always of the FIRE Attribute, and represent control over FIRE,'
                . ' or they may be an embodiment of fire itself. Their effects often involve the dealing of effect damage to the opponent.',
        ],
        [
            'name' => 'rock',
            'description' => 'Usually, Rock monsters belong to the EARTH Attribute and possess high DEF and defense-related card effects.'
                . ' A significant number of Rock monsters have effects related to Flip Summoning or have the ability to flip themselves face-down again.',
        ],
        [
            'name' => 'plant',
            'description' => 'They can go hand-in-hand with Insect-Types.',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();

        foreach ($this->races as &$record) {
            $record['created_at'] = $timestamp;
            $record['updated_at'] = $timestamp;
        }

        Race::insert($this->races);
    }
}
