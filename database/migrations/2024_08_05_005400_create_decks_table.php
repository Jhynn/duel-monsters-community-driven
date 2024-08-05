<?php

use App\Models\{
    Card,
    Deck,
    Style
};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('decks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Style::class, 'deck_artwork_id')->default(1);
            $table->foreignIdFor(Style::class, 'card_sleeve_id')->default(2);
            $table->string('name')->index();
            $table->text('description')->index();

            $table->unsignedInteger('main-deck-quantity')->default(0);
            $table->unsignedInteger('fusion-deck-quantity')->default(0);
            $table->unsignedInteger('additional-deck-quantity')->default(0);
            $table->timestamps();
        });

        Schema::create('card_deck', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Card::class);
            $table->foreignIdFor(Deck::class);
            $table->enum('deck', ['main', 'fusion', 'additional']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decks');
        Schema::dropIfExists('card_deck');
    }
};
