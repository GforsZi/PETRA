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
        Schema::create('chat_options', function (Blueprint $table) {
            $table->bigIncrements('cht_opt_id');
            $table->string('cht_opt_message');
            $table->timestamps();
            $table->unsignedBigInteger('cht_opt_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('cht_opt_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('cht_opt_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('cht_opt_sys_note')->nullable();

            $table->foreign('cht_opt_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('cht_opt_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('cht_opt_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'cht_opt_updated_at');
            $table->renameColumn('created_at', 'cht_opt_created_at');
            $table->renameColumn('deleted_at', 'cht_opt_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_options');
    }
};
