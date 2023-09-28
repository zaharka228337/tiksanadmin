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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->boolean('active');
            $table->string('title');
            $table->integer('sorting')->default(500);
            $table->date('date_publish');
            $table->string('preview_image');
            $table->string('detail_image')->nullable();
            $table->text('news_body');
            $table->json('images_gallery')->nullable();
            $table->string('youtube_video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
