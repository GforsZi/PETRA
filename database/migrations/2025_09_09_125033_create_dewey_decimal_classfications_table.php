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
        Schema::create('dewey_decimal_classfications', function (Blueprint $table) {
            $table->bigIncrements('ddc_id');
            $table->string('ddc_code');
            $table->string('ddc_description');
            $table->timestamps();
            $table->unsignedBigInteger('ddc_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ddc_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('ddc_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('ddc_sys_note')->nullable();

            $table->foreign('ddc_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ddc_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('ddc_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'ddc_updated_at');
            $table->renameColumn('created_at', 'ddc_created_at');
            $table->renameColumn('deleted_at', 'ddc_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dewey_decimal_classfications');
    }
};
