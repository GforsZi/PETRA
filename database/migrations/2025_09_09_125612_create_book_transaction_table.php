<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('book_transaction', function (Blueprint $table) {
            $table->bigIncrements('bk_trx_id');
            $table->unsignedBigInteger('bk_trx_book_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_trx_book_copy_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_trx_transaction_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('bk_trx_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_trx_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_trx_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('bk_trx_sys_note')->nullable();

            $table->foreign('bk_trx_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_trx_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_trx_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'bk_trx_updated_at');
            $table->renameColumn('created_at', 'bk_trx_created_at');
            $table->renameColumn('deleted_at', 'bk_trx_deleted_at');

            $table->foreign('bk_trx_book_id')->references('bk_id')->on('books')->onDelete('cascade');
            $table->foreign('bk_trx_book_copy_id')->references('bk_cp_id')->on('book_copies')->onDelete('cascade');
            $table->foreign('bk_trx_transaction_id')->references('trx_id')->on('transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('book_transaction');
    }
};
