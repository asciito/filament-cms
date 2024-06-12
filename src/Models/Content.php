<?php

namespace Asciito\FilamentCms\Models;

use Asciito\FilamentCms\Enumerables\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $table = 'contents';

    protected $fillable = [
        'title',
        'slug',
        'body',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
