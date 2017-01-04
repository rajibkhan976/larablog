<?php

namespace App;

use Backpack\CRUD\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;

class User extends Authenticatable
{
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this
    use Notifiable;
    
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
   * Send the password reset notification.
   *
   * @param  string  $token
   * @return void
   */
  public function sendPasswordResetNotification($token)
  {
      $this->notify(new ResetPasswordNotification($token));
  }
  
  /**
   * Get the unique identifier for the user.
   *
   * @return mixed
   */
   
   public function getAuthIdentifier()
   {
	   return $this->getKey();
		}
	
	/**
   * Get the password for the user.
   *
   * @return string
   */
   
   public function getAuthPassword()
   {
	   return $this->password;
	   }
	   
	   /**
   * Get the e-mail address where password reminders are sent.
   *
   * @return string
   */
   
   public function getReminderEmail() 
   {
	   return $this->email;
	   }
}
