<?php

namespace Ybinrain\Rbac\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'));
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function hasPermission($permissionId)
    {
        return in_array($permissionId, array_pluck($this->permissions, 'id'));
    }
}
