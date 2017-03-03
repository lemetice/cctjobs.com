<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'ln_id', 'fb_id','role_id', 'name', 'surname', 'email', 'password'];


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function abonnerInfos()
	{
		return $this->hasOne('App\Models\AbonnerInfo', 'user_id', 'id');
	}

	/*************
	 *
	//has many jobs offers
	public function jobs(){
	return $this->hasMany('App\Models\Jobs', 'author_id');
	}

	//User has one and only one role
	public  function role(){
	return $this->belongsTo('App\Models\Role', 'role_id');
	}

	//User has many jobs he applied for
	public  function jobsApplied(){
	return $this->hasMany('App\Models\JobsAppliedFor', 'user_id');
	}

	public function employerInfos()
	{
	return $this->hasOne('App\Models\EmployerInfo', 'user_id', 'id');
	}
	 * */

}
