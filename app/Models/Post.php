<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id';

    // public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamp = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $attribute = [
        'status' => 1,
    ];
}
