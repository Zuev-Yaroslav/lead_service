<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @mixin Builder
 */
class Lead extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $attributes = [
        'status_id' => 1
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
