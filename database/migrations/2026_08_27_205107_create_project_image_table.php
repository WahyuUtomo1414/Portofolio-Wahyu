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
        Schema::create('project_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('project')->cascadeOnDelete();
            $table->string('image');
            $table->string('description')->nullable();
            $this->base($table);

            $table->index(['project_id', 'active']);
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_image');
    }
};
