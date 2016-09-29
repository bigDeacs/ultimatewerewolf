<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToGameRoleAgainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('player_status', function(Blueprint $table)
		{
			$table->integer('game_id');
		});
		Schema::table('game_player', function(Blueprint $table)
		{
			$table->string('status');
		});
		Schema::table('game_role', function(Blueprint $table)
		{
			$table->dropColumn(['total']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
