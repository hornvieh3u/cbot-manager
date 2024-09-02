<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalRoomsTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hospital_rooms_table', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('unit')->default('');
			$table->string('floor')->default('');
			$table->string('room_number')->default('');
			$table->integer('room_size')->default(1);
			$table->integer('user_id')->default(0);
			$table->timestamp('creation_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('last_edit_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps(6);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hospital_rooms_table');
	}

}
