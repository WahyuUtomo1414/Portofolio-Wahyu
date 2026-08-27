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
        Schema::create('journey', function (Blueprint $table) {
            $table->id();
            $table->string('key', 128);
            $table->string('title');
            $table->string('logo')->nullable();
            $table->string('institute');
            $table->string('description')->nullable();
            $table->string('date_range', 128);
            $table->unsignedInteger('sort')->default(0);
            $this->base($table);

            $table->index('key');
            $table->index('sort');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journey');
    }
};
