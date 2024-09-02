<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobotsInfoTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('robots_info_table', function(Blueprint $table)
		{
			$table->string('robot_serial')->default('')->primary();
			$table->string('robot_name')->default('');
			$table->string('robot_password')->default('');
			$table->string('robot_number')->default('');
			$table->integer('user_id');
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
		Schema::drop('robots_info_table');
	}

}
