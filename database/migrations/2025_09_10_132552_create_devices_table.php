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
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('dvc_id');
            $table->string('dvc_name');
            $table->text('dvc_device');
            $table->string('dvc_token');
            $table->timestamps();
            $table->unsignedBigInteger('dvc_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('dvc_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('dvc_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('dvc_sys_note')->nullable();

            $table->foreign('dvc_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('dvc_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('dvc_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'dvc_updated_at');
            $table->renameColumn('created_at', 'dvc_created_at');
            $table->renameColumn('deleted_at', 'dvc_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
