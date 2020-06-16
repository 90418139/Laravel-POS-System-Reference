<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchandiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise', function (Blueprint $table) {
            $table->id();
            $table->string('status',1)->default('C');
            $table->string('class',20)->default(' ');
            $table->string('name',80)->default(' ');
            $table->string('introduction')->nullable();
            $table->string('photo',50)->nullable();
            $table->integer('price')->default(0);
            $table->timestamps();

            $table->index(['status'], 'merchandise_status_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandise');
    }
}
