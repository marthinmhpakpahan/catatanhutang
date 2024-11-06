<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'debter_id',
        'total',
        'status',
        'remarks',
        'created_at',
        'modified_at'
    ];

    protected $table = 'debt';

    protected $primaryKey = 'id';
    public $incrementing = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    public $timestamps = true;

    public function debter(): BelongsTo
    {
        return $this->belongsTo(Debter::class);
    }
}
