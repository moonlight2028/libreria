<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lends', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('custumer_user_id')->unsigned();
			$table->bigInteger('owner_user_id')->unsigned();
			$table->bigInteger('book_id')->unsigned();
			$table->date('date_out');
			$table->date('date_in')->nullable();
			$table->enum('status', ['PRESTADO','REVISION','EN SALA'])->default('EN SALA');
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lends');
    }
};
