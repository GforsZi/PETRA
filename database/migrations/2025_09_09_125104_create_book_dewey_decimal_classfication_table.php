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
        Schema::create('book_dewey_decimal_classfication', function (Blueprint $table) {
            $table->bigIncrements('bk_ddc_id');
            $table->unsignedBigInteger('bk_ddc_book_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_ddc_classfication_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_ddc_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_ddc_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_ddc_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('bk_ddc_sys_note')->nullable();

            $table->foreign('bk_ddc_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_ddc_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_ddc_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('deleted_at', 'bk_ddc_deleted_at');

            $table->foreign('bk_ddc_book_id')->references('bk_id')->on('books')->onDelete('cascade');
            $table->foreign('bk_ddc_classfication_id')->references('ddc_id')->on('dewey_decimal_classfications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_dewey_decimal_classfication');
    }
};
