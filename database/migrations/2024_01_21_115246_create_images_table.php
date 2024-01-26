<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Image;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('keyword');
            $table->text('prompt')->nullable();
            $table->text('path')->nullable();
            $table->enum('status', [Image::STATUS_PENDING, Image::STATUS_PROGRESS, Image::STATUS_COMPLETED, Image::STATUS_FAILED])
            ->default(Image::STATUS_PENDING);
            $table->integer('progress')->default(0);
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->softdeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
