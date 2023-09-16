<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'c_email',
        'team_id',
        'location_id',
        'customer_id',
        'depertment_id',
        'sex',
        'phone',
        'position',
        'created_by',
        'created_date',
        'approved_by',
        'approved_date',
        'approve_status',
        'is_active',
        'activated_by',
        'enable_date',
        'deactivated_by',
        'disable_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }


    public function Department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }



    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    public function requisition()
    {
        return $this->hasMany(requisitions::class, 'request_id', 'id');
    }



    public function returnfromport()
    {
        return $this->hasMany(ReturnedFromPort::class, 'user_id', 'id');
    }


    public function lease()
    {
        return $this->hasMany(Lease::class, 'tager_id', 'id');
    }
}
