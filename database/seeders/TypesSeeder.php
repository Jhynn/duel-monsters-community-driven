<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    protected $types = [
        // Monsters
        [
            'name' => 'Normal Monster',
            'color' => '#DFFF00',   # Yellow
            'description' => 'Normal Monsters are used primarily to Attack or Defend,'
                . ' although they can also be used as Tributes (for Tribute Summon), to'
                . ' pay a cost (Ignition Effect), or as part of a Fusion (Fusion-Material Monsters).',
        ],
        [
            'name' => 'Fusion Monster',
            'color' => '#7F00FF',   # Violet
            'description' => '"Fusion" means using 2 or more Monster Cards together with the Spell'
                . ' Card "Polymerization" to create a new monster, represented by a Fusion Monster Card.'
                . "\n"
                . 'During your turn, if you have the Spell Card "Polymerization" and the'
                . ' Fusion-Material Monsters required to form a Fusion Monster, either'
                . ' on the field or in your hand, you can perform a Fusion Summon by'
                . ' activating "Polymerization".'
                . "\n"
                . 'The Fusion-Material Monsters that have been fused, as well as the'
                . ' "Polymerization" Spell Card used to perform the Fusion, are sent to the Graveyard.'
                . "\n"
                . 'When a Fusion Summon is performed,'
                . ' the Fusion Monster are not randomly drawn, but selected from the'
                . ' Fusion Deck. The Fusion Deck should always be kept separate'
                . ' from the Main-Deck, and placed face-down in the Fusion Deck Zone'
                . ' of the Game Mat.',
        ],
        [
            'name' => 'Ritual Monster',
            'color' => '#87CEEB',   # Blue
            'description' => 'A Ritual Monster is a special monster that can be Summoned'
                . ' onto the field only when you have a designated Ritual Spell Card and'
                . ' the Monster Cards required to fulfill the conditions described on the'
                . ' Ritual Spell Card as a Tribute, either on the field or in your hand.'
                . "\n"
                . 'During your turn, if you have a Ritual Monster Card in your hand, and'
                . ' the specific Ritual Spell Card mentioned on the Ritual Monster Card'
                . ' (either on the field or in your hand), as well as the Monster Cards'
                . ' required as a Tribute, you can perform a Ritual Summon by activating'
                . ' the Ritual Spell Card. Follow the instructions printed on the Ritual Spell Card.'
                . "\n"
                . 'The Ritual Monster Card is then placed face-up on an open Monster'
                . ' Zone space on the field in either Attack or Defense Position. The'
                . ' Tribute monsters and the Ritual Spell Card used to perform the Ritual'
                . ' Summon are sent to the Graveyard.'
                . "\n"
                . 'A monster Summoned to the field in this manner is considered a'
                . ' Special Summon, and allows the player to conduct a Normal Summon'
                . ' or a Set in the same turn.',
        ],
        [
            'name' => 'Effect Monster',
            'color' => '#FFA500',   # Orange
            'description' => 'Monster Cards that possess magical effects are referred to as'
                . ' Effect Monster Cards. The broad range of Effects are divided into the following types:'
                . ' Flip Effect, Continuous Effect, Ignition Effect (Cost Effect), Trigger Effect and Multi-Trigger Effect.',
        ],
        [
            'name' => 'Flip Effect',
            'color' => '#FFA500',   # Orange
            'description' => 'The monster\'s effect is activated when the card is flipped from face-down to face-up.'
                . ' The effect is also activated if the card is flipped face-up as a result of a Spell or Trap Card, or'
                . ' another monster\'s attack. If a Flip Effect monster is destroyed after being'
                . ' activated in this way, the Flip Effect is applied BEFORE the card is sent to the Graveyard.'
                . "\n"
                . 'If a Flip Effect monster is Normal Summoned instead of Set, its effect IS NOT activated.',
        ],
        [
            'name' => 'Continuous Effect',
            'color' => '#FFA500',   # Orange
            'description' => 'As long as this Monster Card is face-up on the field, its effect remains active.'
                . ' When the monster is flipped face-down, its effect is no longer active.',
        ],
        [
            'name' => 'Ignition Effect (Cost Effect)',
            'color' => '#FFA500',   # Orange
            'description' => 'You can use this effect by declaring its activation. You can normally'
                . ' activate this effect during your Main Phase. There are some cards which need'
                . ' a cost to activate, such as discarding cards from your hand or Tributing a'
                . ' monster on your side of the field. Because you can choose when to'
                . ' activate this effect, it is easy to make a combo with it.',
        ],
        [
            'name' => 'Trigger Effect',
            'color' => '#FFA500',   # Orange
            'description' => 'These cards are activated when you have fulfilled a specific requirement.',
        ],
        [
            'name' => 'Multi-Trigger Effect',
            'color' => '#FFA500',   # Orange
            'description' => 'These are special Effect Monster Cards that you can activate even if it is your opponent\'s turn.',
        ],
        [
            'name' => 'Monster Token',
            'color' => '#FFFFFF',   # White
            'description' => 'Monster Tokens are used IN PLACE of Monster Cards.'
                . ' The tokens represent monsters that appear on the field as a result of a card being'
                . ' activated. These monsters are not included in a Deck.',
        ],
        // Spells
        [
            'name' => 'Spell',
            'color' => '#50C878',   # Green
            'description' => 'There are several types of Spell Cards. Spell Cards can only be'
                . ' activated or Set during Main Phases.'
                . ' The only exception to this rule are Quick-Play Spell Cards.',
        ],
        [
            'name' => 'Normal Spell',
            'color' => '#50C878',   # Green
            'description' => 'Once their effect is activated these cards are destroyed. Their effects are often very powerful.',
        ],
        [
            'name' => 'Continuous Spell',
            'color' => '#50C878',   # Green
            'description' => 'These cards remain on the field once they are activated and their spell'
                . ' effect continues as long as they are face-up on the field. There is often'
                . ' a cost involved to maintain the effect of this type of Spell Card.',
        ],
        [
            'name' => 'Equip Spell',
            'color' => '#50C878',   # Green
            'description' => 'These cards allow you to modify the strength of monsters'
                . ' that are face-up on the field. However, you may equip either your own or your opponent\'s'
                . ' Monster Cards with Equip Spell Cards. If the equipped monster is'
                . ' destroyed, its Equip Spell Cards are also destroyed. In some cases,'
                . ' certain monsters cannot be equipped with these cards.'
                . ' One monster can be equipped with several Equip Spell Cards.',
        ],
        [
            'name' => 'Field Spell',
            'color' => '#50C878',   # Green
            'description' => 'These cards are used to alter the conditions on the field and modify'
                . ' the Attack and Defense capabilities of all applicable monsters on the'
                . ' field controlled by either player.' 
                . "\n"
                . ' There can only be 1 active Field Spell Card on the field at any given'
                . ' time between both players. When a new Field Spell Card is activated,'
                . ' the previous active Field Spell Card is destroyed and sent to the'
                . ' Graveyard. Field Spell Cards can only be activated by a player, but never during an opponent\'s turn.',
        ],
        [
            'name' => 'Quick-Play Spell',
            'color' => '#50C878',   # Green
            'description' => 'This type of card can be activated during any phase of your turn.'
                . ' If you Set this card on the field, you can also activate it during your'
                . ' opponent\'s turn like a Normal Trap Card. However, if you set a Quick-'
                . 'Play Spell Card, you can not activate the card in the same turn that you'
                . ' Set it.',
        ],
        [
            'name' => 'Ritual Spell',
            'color' => '#50C878',   # Green
            'description' => 'These card are needed to Summon a Ritual Monster. After the Ritual'
                . ' Summon, it is destroyed and sent to the Graveyard together with the'
                . ' required Tribute monster(s)',
        ],
        // Traps
        [
            'name' => 'Trap',
            'color' => '#CF9FFF',   # Purple
            'description' => 'You can Set these cards on the field and activate them at any time after'
                . ' the start of the next turn providing the requirements for activation of the Trap Card',
        ],
        [
            'name' => 'Normal Trap',
            'color' => '#CF9FFF',   # Purple
            'description' => 'Normal Trap Cards have no icon. Once activated, this type of card is destroyed.',
        ],
        [
            'name' => 'Counter Trap',
            'color' => '#CF9FFF',   # Purple
            'description' => 'These Trap Cards are activated in response to the Summon of monsters'
                . ' or to negate the effects of Spell or Trap Cards. Once activated, this type'
                . ' of card is destroyed.',
        ],
        [
            'name' => 'Continuous Trap',
            'color' => '#CF9FFF',   # Purple
            'description' => 'These cards remain on the field once they are activated and their'
                . ' effect continues as long as they are face-up on the field. There is often'
                . ' a cost involved to maintain the effect of this type of Trap Card.',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();

        foreach ($this->types as &$record) {
            $record['created_at'] = $timestamp;
            $record['updated_at'] = $timestamp;
        }

        Type::insert($this->types);
    }
}
