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
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('rl_id');
            $table->string('rl_name');
            $table->text('rl_description')->nullable();
            $table->boolean('rl_admin')->default(false);
            $table->timestamps();
            $table->unsignedBigInteger('rl_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('rl_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('rl_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('rl_sys_note')->nullable();

            $table->foreign('rl_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rl_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('rl_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'rl_updated_at');
            $table->renameColumn('created_at', 'rl_created_at');
            $table->renameColumn('deleted_at', 'rl_deleted_at');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('usr_role_id')->references('rl_id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
