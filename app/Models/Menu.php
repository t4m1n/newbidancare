<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Tambahan
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Menu extends Model
{
    use HasFactory; // <-- Tambahan

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ // <-- Tambahan
        'parent_id',
        'name',
        'route_name',
        'icon',
        'order',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_role');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
