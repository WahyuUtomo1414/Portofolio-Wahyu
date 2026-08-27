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
        Schema::create('project_tool', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('project')->cascadeOnDelete();
            $table->foreignId('tools_id')->constrained('tools')->cascadeOnDelete();
            $this->base($table);

            $table->index(['project_id', 'active']);
            $table->index(['tools_id', 'active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_tool');
    }
};
