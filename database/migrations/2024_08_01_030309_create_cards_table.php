<?php

use App\Models\{
    Attribute,
    Race,
    Type
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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Attribute::class)->nullable();
            $table->foreignIdFor(Race::class)->nullable();
            $table->foreignIdFor(Type::class);

            $table->string('name')->index();
            $table->text('description')->index();
            $table->integer('max_quantity')->default(3);
            $table->integer('level')->nullable();

            $table->integer('attack')->nullable();
            $table->integer('defense')->nullable();
            $table->boolean('tributable')->default(true);
            $table->boolean('immune')->default(false);


            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
