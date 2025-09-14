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
        Schema::create('chat_notifications', function (Blueprint $table) {
            $table->bigIncrements('cht_notif_id');
            $table->unsignedBigInteger('cht_notif_device_id')->unsigned()->nullable();
            $table->unsignedBigInteger('cht_notif_user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('cht_notif_option_id')->unsigned()->nullable();
            $table->string('cht_notif_custom_message')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('cht_notif_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('cht_notif_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('cht_notif_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('cht_notif_sys_note')->nullable();

            $table->foreign('cht_notif_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('cht_notif_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('cht_notif_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'cht_notif_updated_at');
            $table->renameColumn('created_at', 'cht_notif_created_at');
            $table->renameColumn('deleted_at', 'cht_notif_deleted_at');

            $table->foreign('cht_notif_device_id')->references('dvc_id')->on('devices')->onDelete('cascade');
            $table->foreign('cht_notif_user_id')->references('usr_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_notifications');
    }
};
