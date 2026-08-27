<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tools extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'tools';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_tool', 'tools_id', 'project_id')
            ->withPivot(['active', 'deleted_at'])
            ->wherePivot('active', true)
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }
}
