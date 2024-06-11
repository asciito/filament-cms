<?php

namespace Asciito\FilamentCms\Models;

use Asciito\FilamentCms\Models\Enumerables\Status;
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
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
