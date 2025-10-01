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
        Schema::create('book_origins', function (Blueprint $table) {
            $table->bigIncrements('bk_orgn_id');
            $table->string('bk_orgn_name');
            $table->text('bk_orgn_description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('bk_orgn_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_orgn_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_orgn_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('bk_orgn_sys_note')->nullable();

            $table->foreign('bk_orgn_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_orgn_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_orgn_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'bk_orgn_updated_at');
            $table->renameColumn('created_at', 'bk_orgn_created_at');
            $table->renameColumn('deleted_at', 'bk_orgn_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_origins');
    }
};
