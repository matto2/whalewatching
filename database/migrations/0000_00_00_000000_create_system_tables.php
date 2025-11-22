<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateSystemTables extends Migration {

		/**
		 * Run the migrations.
		 *
		 * @return void
		 */

		public function up() {

			Schema::create('session', function (Blueprint $table) {
				$table->string('id')->unique();
				$table->integer('user_id')->nullable();
				$table->string('ip_address', 45)->nullable();
				$table->text('user_agent')->nullable();
				$table->text('payload');
				$table->integer('last_activity');
			});

			Schema::create('jobs', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('queue');
				$table->longText('payload');
				$table->tinyInteger('attempts')->unsigned();
				$table->unsignedInteger('reserved_at')->nullable();
				$table->unsignedInteger('available_at');
				$table->unsignedInteger('created_at');
				$table->index(['queue', 'reserved_at']);
			});

			Schema::create('failed_jobs', function (Blueprint $table) {
				$table->increments('id');
				$table->text('connection');
				$table->text('queue');
				$table->longText('payload');
				$table->longText('exception');
				$table->timestamp('failed_at')->useCurrent();
			});

			Schema::create('setting', function($table) {
				$table->string('key')->unique();
				$table->text('value')->nullable();
				$table->primary('key');
			});

			Schema::create('country', function($table) {
				$table->increments( 'id' );
				$table->boolean( 'active' )->default( false );
				$table->string( 'code', 2 )->unique();
				$table->string( 'name' )->unique();
				$table->timestamps();
			});

			Schema::create('state', function($table) {
				$table->increments( 'id' );
				$table->integer( 'country_id' )->unsigned()->default( 0 );
				$table->string( 'abbreviation' )->unique();
				$table->string( 'name' )->unique();
				$table->double( 'tax', 10, 2 )->default( 0 );
				$table->timestamps();
			});

		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */

		public function down() {
			Schema::dropIfExists('state');
			Schema::dropIfExists('country');
			Schema::dropIfExists('setting');
			Schema::dropIfExists('failed_jobs');
			Schema::dropIfExists('jobs');
			Schema::dropIfExists('session');
		}

	}

?>