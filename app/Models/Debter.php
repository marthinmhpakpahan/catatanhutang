<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'fullname',
        'photo',
        'description',
        'created_at',
        'modified_at'
    ];

    protected $table = 'debter';

    protected $primaryKey = 'id';
    public $incrementing = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    public $timestamps = true;
}
