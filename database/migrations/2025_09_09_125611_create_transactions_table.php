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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('trx_id');
            $table->unsignedBigInteger('trx_user_id')->unsigned()->nullable();
            $table->dateTime('trx_borrow_date');
            $table->dateTime('trx_due_date')->nullable();
            $table->dateTime('trx_return_date')->nullable();
            $table->enum('trx_status', ['1', '2', '3', '4'])->default('1');
            $table->enum('trx_title', ['1', '2']);
            $table->text('trx_description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('trx_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('trx_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('trx_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('trx_sys_note')->nullable();

            $table->foreign('trx_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('trx_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('trx_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'trx_updated_at');
            $table->renameColumn('created_at', 'trx_created_at');
            $table->renameColumn('deleted_at', 'trx_deleted_at');

            $table->foreign('trx_user_id')->references('usr_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
