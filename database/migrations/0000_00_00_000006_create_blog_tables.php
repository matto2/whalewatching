<?php

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateBlogTables extends Migration {

	    /**
	     * Run the migrations.
	     *
	     * @return void
	     */
	    public function up() {

			Schema::create( 'blog', function( $table ) {
				$table->increments( 'id' );
				$table->string( 'name', 255 );
				$table->string( 'slug', 255 );
				$table->boolean( 'active' )->default( true );
				$table->boolean( 'hidden' )->default( false );
				$table->boolean( 'restricted' )->default( false );
				$table->boolean( 'allow_comments' )->default( false );
				$table->timestamps();
			});

			Schema::create( 'blog_category', function( $table ) {
				$table->increments( 'id' );
				$table->integer( 'blog_id' )->unsigned()->default( 1 );
				$table->string( 'name', 255 );
				$table->string( 'slug', 255 );
				$table->boolean( 'active' )->default( true );
				$table->timestamps();
				$table->unique([ 'blog_id', 'name' ]);
				$table->unique([ 'blog_id', 'slug' ]);
				$table->foreign( 'blog_id' )->references( 'id' )->on( 'blog' )->onDelete( 'cascade' );
			});

			Schema::create( 'blog_entry', function( $table ) {
				$table->increments( 'id' );
				$table->integer( 'blog_id' )->unsigned()->default( 1 );
				$table->integer( 'user_id' )->unsigned()->default( 0 );
				$table->string( 'name', 255 );
				$table->string( 'slug', 255 );
				$table->boolean( 'active' )->default( false );
				$table->boolean( 'hidden' )->default( false );
				$table->boolean( 'restricted' )->default( false );
				$table->boolean( 'allow_comments' )->default( false );
				$table->text( 'content' );
				$table->timestamps();
				$table->unique([ 'blog_id', 'slug' ]);
				$table->foreign( 'blog_id' )->references( 'id' )->on( 'blog' )->onDelete( 'cascade' );
			});

			Schema::create( 'blog_entry_category', function( $table ) {
				$table->increments( 'id' );
				$table->integer( 'blog_entry_id' )->unsigned();
				$table->integer( 'blog_category_id' )->unsigned();
				$table->timestamps();
				$table->foreign( 'blog_entry_id' )->references( 'id' )->on( 'blog_entry' )->onDelete( 'cascade' );
				$table->foreign( 'blog_category_id' )->references( 'id' )->on( 'blog_category' )->onDelete( 'cascade' );
			});

			Schema::create( 'blog_entry_comment', function( $table ) {
				$table->increments( 'id' );
				$table->integer( 'parent_comment_id' )->unsigned();
				$table->integer( 'blog_entry_id' )->unsigned();
				$table->integer( 'user_id' )->unsigned()->default( 0 );
				$table->text( 'comment' );
				$table->timestamps();
				$table->foreign( 'blog_entry_id' )->references( 'id' )->on( 'blog_entry' )->onDelete( 'cascade' );
			});

	    }

	    /**
	     * Reverse the migrations.
	     *
	     * @return void
	     */
	    public function down() {

	        Schema::dropIfExists( 'blog_entry_comment' );
	        Schema::dropIfExists( 'blog_entry_category' );
	        Schema::dropIfExists( 'blog_entry' );
	        Schema::dropIfExists( 'blog_category' );
	        Schema::dropIfExists( 'blog' );

	    }

	}

?>