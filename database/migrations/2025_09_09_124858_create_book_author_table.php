<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('book_author', function (Blueprint $table) {
            $table->bigIncrements('bk_athr_id');
            $table->unsignedBigInteger('bk_athr_book_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_athr_author_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_athr_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_athr_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_athr_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('bk_athr_sys_note')->nullable();

            $table->foreign('bk_athr_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_athr_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_athr_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('deleted_at', 'bk_athr_deleted_at');

            $table->foreign('bk_athr_book_id')->references('bk_id')->on('books')->onDelete('cascade');
            $table->foreign('bk_athr_author_id')->references('athr_id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('book_author');
    }
};
