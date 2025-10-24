<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('authors', function (Blueprint $table) {
            $table->bigIncrements('athr_id');
            $table->string('athr_name');
            $table->timestamps();
            $table->unsignedBigInteger('athr_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('athr_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('athr_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('athr_sys_note')->nullable();

            $table->foreign('athr_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('athr_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('athr_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'athr_updated_at');
            $table->renameColumn('created_at', 'athr_created_at');
            $table->renameColumn('deleted_at', 'athr_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('authors');
    }
};
