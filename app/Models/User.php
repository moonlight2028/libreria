<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Lend;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles,HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'number_id',
		'name',
		'last_name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'created_at' => 'datetime:y-n-d',
		'updated_at' => 'datetime:y-n-d',
		//'is_enable' => 'boolean'
    ];

	public function getFullNAmeAttribute()
	{
		return "{$this->name} { $this->lastname}";
	}

	public function setPasswordAttribute($value){
		$this->attributes['password'] = bcrypt($value);
	}
	public function setRememberTokenAttribute(){
		$this->attributes['remember_token'] = Str::random(10);
	}


	public function customerLends()
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}

	public function ownerLends()
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}
}
