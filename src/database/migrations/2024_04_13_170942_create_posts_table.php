<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\PostStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('description')->nullable();
            $table->string('h1', 150);

            $table->string('intro');
            $table->text('content');

            $table->foreignId('section_id')->constrained('sections');
            $table->string('slug')->unique();
            $table->integer('status')->default(PostStatus::DRAFT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
