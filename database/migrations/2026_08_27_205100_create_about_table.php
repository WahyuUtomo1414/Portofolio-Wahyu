<?php

use App\Traits\BaseModelSoftDeleteDefault;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use BaseModelSoftDeleteDefault;

    public function up(): void
    {
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 128);
            $table->string('no_wa', 18);
            $table->json('sosial_media')->nullable();
            $table->text('description');
            $table->string('image_profile')->nullable();
            $table->string('tagline')->nullable();
            $table->string('address')->nullable();
            $this->base($table);

            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about');
    }
};
