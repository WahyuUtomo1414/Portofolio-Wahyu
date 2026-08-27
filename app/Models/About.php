<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'about';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'sosial_media' => 'array',
            'active' => 'boolean',
        ];
    }
}
