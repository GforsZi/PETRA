<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('publishers', function (Blueprint $table) {
            $table->bigIncrements('pub_id');
            $table->string('pub_name');
            $table->string('pub_address');
            $table->timestamps();
            $table->unsignedBigInteger('pub_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('pub_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('pub_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('pub_sys_note')->nullable();

            $table->foreign('pub_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('pub_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('pub_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'pub_updated_at');
            $table->renameColumn('created_at', 'pub_created_at');
            $table->renameColumn('deleted_at', 'pub_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('publishers');
    }
};
