<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusAndRemovePivot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('statuses', function(Blueprint $table)
		{
			$table->integer('role_id');
		});
		Schema::drop('role_status');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('status', function(Blueprint $table)
		{
			//
		});
	}

}
