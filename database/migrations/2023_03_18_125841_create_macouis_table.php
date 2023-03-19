<?php

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
        Schema::create('macouis', function (Blueprint $table) {
            $table->id();
            $table->string('registry', 4);
            $table->text('oui');
            $table->string('organization_name', 100);
            $table->text('organization_address', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('macouis_table1');
    }
};
