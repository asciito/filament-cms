<?php

namespace Workbench\App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Workbench\Database\Factories\UserFactory;

class User extends Model implements FilamentUser
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected static function newFactory(): UserFactory
    {
        return new UserFactory;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
