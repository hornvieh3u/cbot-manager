<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorridorDisinfectionTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corridor_disinfection_table', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('unit')->default('');
			$table->string('floor')->default('');
			$table->integer('corridor_number')->default(0);
			$table->integer('spots_count')->default(1);
			$table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('duration')->default(0);
			$table->boolean('is_completed')->default(1);
			$table->string('robot_serial')->default('')->comment('robots_info_table primary_key');
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
		Schema::drop('corridor_disinfection_table');
	}

}
