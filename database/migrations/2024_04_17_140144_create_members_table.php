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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('first_name'); 
            $table->string('last_name');  
            $table->text('summary')->nullable(); 
            $table->string('ds_division'); 
            $table->date('date_of_birth'); 
            $table->softDeletes(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Remove the foreign key constraint
            $table->dropColumn('user_id');   // Then drop the column
        });
        Schema::dropIfExists('members');
    }
};
