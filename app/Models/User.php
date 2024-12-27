<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * Set the default guard for this model.
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id', 
        'user_code', 
        'users_name', 
        'users_photo', 
        'users_email', 
        'users_password', 
        'users_office_phone', 
        'users_personal_phone', 
        'users_join_date', 
        'users_level', 
        'users_company', 
        'users_homebase', 
        'users_division', 
        'users_department', 
        'users_shift', 
        'users_employee_status', 
        'users_join_date_employee_status', 
        'users_contract_period', 
        'users_notes',
        'users_gender',
        'users_place_date_of_birth',
        'users_education',
        'users_religion',
        'users_family_status',
        'users_address_of_domicile',
        'users_address_of_id',
        'users_family_card',
        'users_fb',
        'users_ig',
        'users_bpjs_tk_number',
        'users_bpjs_number',
        'users_ktp_number',
        'users_ktp_picture',
        'users_signature',
        'users_created_at',
        'users_created_by',
        'users_updated_at',
        'users_updated_by',
        'users_deleted_at',
        'users_deleted_by',
        'users_soft_delete',
        'users_permission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'users_password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->users_password; // Menggunakan kolom 'users_password'
    }

    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();
        return $permission_groups;
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }
}
