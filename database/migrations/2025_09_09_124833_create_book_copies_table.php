<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('book_copies', function (Blueprint $table) {
            $table->bigIncrements('bk_cp_id');
            $table->unsignedBigInteger('bk_cp_book_id')->unsigned()->nullable();
            $table->string('bk_cp_number');
            $table->enum('bk_cp_status', ['1', '2', '3', '4']);
            $table->timestamps();
            $table->unsignedBigInteger('bk_cp_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_cp_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_cp_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('bk_cp_sys_note')->nullable();

            $table->foreign('bk_cp_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_cp_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_cp_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'bk_cp_updated_at');
            $table->renameColumn('created_at', 'bk_cp_created_at');
            $table->renameColumn('deleted_at', 'bk_cp_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('book_copies');
    }
};
