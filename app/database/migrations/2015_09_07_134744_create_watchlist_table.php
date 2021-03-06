<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('watchlist', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index();
			$table->integer('item_id')->unsigned()->index();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

			$table->primary(array('user_id', 'item_id'));

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('watchlist');
	}

}
