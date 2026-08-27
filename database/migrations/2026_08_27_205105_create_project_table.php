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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('name', 128);
            $table->string('slug', 128)->unique();
            $table->foreignId('category_id')->constrained('category');
            $table->text('body');
            $table->foreignId('client_id')->constrained('client');
            $table->date('start_project')->nullable();
            $table->date('end_project')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_featured')->default(false);
            $this->base($table);

            $table->index(['category_id', 'active']);
            $table->index(['client_id', 'active']);
            $table->index(['is_featured', 'active']);
            $table->index('active');
            $table->index('start_project');
            $table->index('end_project');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
