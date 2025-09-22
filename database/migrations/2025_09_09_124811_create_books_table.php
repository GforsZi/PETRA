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
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('bk_id');
            $table->string('bk_isbn')->nullable();
            $table->string('bk_title');
            $table->string('bk_description')->nullable();
            $table->string('bk_img_url')->nullable();
            $table->string('bk_img_public_id')->nullable();
            $table->enum('bk_type', ['1', '2'])->nullable();
            $table->string('bk_file_url')->nullable();
            $table->string('bk_file_public_id')->nullable();
            $table->integer('bk_unit_price')->nullable();
            $table->string('bk_edition_volume')->nullable();
            $table->year('bk_published_year')->nullable();
            $table->unsignedBigInteger('bk_publisher_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_major_id')->unsigned()->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('bk_created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_deleted_by')->unsigned()->nullable();
            $table->unsignedBigInteger('bk_updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->string('bk_sys_note')->nullable();

            $table->foreign('bk_created_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_updated_by')->references('usr_id')->on('users')->onDelete('cascade');
            $table->foreign('bk_deleted_by')->references('usr_id')->on('users')->onDelete('cascade');

            $table->renameColumn('updated_at', 'bk_updated_at');
            $table->renameColumn('created_at', 'bk_created_at');
            $table->renameColumn('deleted_at', 'bk_deleted_at');

            $table->foreign('bk_publisher_id')->references('pub_id')->on('publishers')->onDelete('cascade');
            $table->foreign('bk_major_id')->references('bk_mjr_id')->on('book_majors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
