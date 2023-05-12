<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->integer('user_id');
			$table->string('image')->nullable();
			$table->integer('topic_id');
			$table->text('content');
			// $table->unsignedInteger('likes')->nullable();
			$table->boolean('is_published')->default(1);
			// $table->unsignedInteger('category_id')->nullable();
			// $table->index('category_id', 'post_category_idx');
			// $table->foreign('category_id', 'post_category_fk')->references('id')->on('categories');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('posts');
	}
};
