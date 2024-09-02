<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->default('');
			$table->string('password')->default('');
			$table->string('email')->default('');
			$table->boolean('is_admin')->default(0)->comment('0:general,1:admin');
			$table->boolean('status')->default(0)->comment('0:deactive,1:active');
			$table->string('token')->default('');
			$table->string('remember_token')->default('');
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
		Schema::drop('users');
	}

}
