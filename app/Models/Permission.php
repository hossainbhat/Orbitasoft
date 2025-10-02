<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use KawsarJoy\RolePermission\Models\Permission as kawsarJoyPermission;

class Permission extends kawsarJoyPermission
{
    public function parent_permission()
    { 
        return $this->whereNull('parent_id')->with('child')->get();
    }
    
    public function child()
    {
        return $this->hasMany('KawsarJoy\RolePermission\Models\Permission', 'parent_id');
    }
}
