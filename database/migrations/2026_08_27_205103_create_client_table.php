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
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 128)->nullable();
            $table->string('name', 128)->unique();
            $table->string('desc')->nullable();
            $this->base($table);

            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
