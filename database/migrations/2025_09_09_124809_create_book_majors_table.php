<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_majors', function (Blueprint $table) {
            $table->bigIncrements('bk_mjr_id');
            $table->enum('bk_mjr_class', ['1', '2', '3']);
            $table->string('bk_mjr_major');
            $table->timestamps();
            $table->unsignedBigInteger('bk_mjr_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_mjr_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_mjr_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('bk_mjr_sys_note')->nullable();

            $table->foreign('bk_mjr_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_mjr_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_mjr_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'bk_mjr_updated_at');
            $table->renameColumn('created_at', 'bk_mjr_created_at');
            $table->renameColumn('deleted_at', 'bk_mjr_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_majors');
    }
};
