<?php

use App\Models\{
    Style,
    User
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
        Schema::create('styles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name')->unique()->index();
            $table->text('code');
            $table->enum('type', ['deck', 'card', 'playmate', 'avatar']);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('style_user', function (Blueprint $table) {
            $table->foreignIdFor(Style::class);
            $table->foreignIdFor(User::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('styles');
        Schema::dropIfExists('style_user');
    }
};
