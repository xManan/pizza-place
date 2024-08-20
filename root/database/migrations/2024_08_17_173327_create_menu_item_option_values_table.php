<?php

use App\Models\MenuItemOption;
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
        Schema::create('menu_item_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MenuItemOption::class);
            $table->string('label');
            $table->string('value');
            $table->unsignedInteger('price');
            $table->boolean('is_default');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_option_values');
    }
};
