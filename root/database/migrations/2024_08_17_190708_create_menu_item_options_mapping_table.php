<?php

use App\Models\MenuItem;
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
        Schema::create('menu_item_options_mapping', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_item_id');
            $table->unsignedBigInteger('menu_item_option_id');
            $table->primary([ 'menu_item_id', 'menu_item_option_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_options_mapping');
    }
};
