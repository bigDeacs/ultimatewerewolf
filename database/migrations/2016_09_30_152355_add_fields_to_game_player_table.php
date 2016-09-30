<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToGamePlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('game_player', function(Blueprint $table)
		{
			$table->dropColumn(['status']);
		});
		Schema::create('player_team', function(Blueprint $table)
		{
			$table->integer('player_id')->unsigned()->index();
			$table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');

			$table->integer('team_id')->unsigned()->index();
			$table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

			$table->integer('game_id');

			$table->timestamps();
		});
		Schema::table('players', function(Blueprint $table)
		{
			$table->dropColumn(['team_id']);
			$table->dropColumn(['role_id']);
			$table->dropColumn(['status']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('game_player', function(Blueprint $table)
		{
			//
		});
	}

}
