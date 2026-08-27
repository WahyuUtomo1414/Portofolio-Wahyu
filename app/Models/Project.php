<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'project';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'start_project' => 'date',
            'end_project' => 'date',
            'is_featured' => 'boolean',
            'active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(Tools::class, 'project_tool', 'project_id', 'tools_id')
            ->withPivot(['active', 'deleted_at'])
            ->wherePivot('active', true)
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }
}
