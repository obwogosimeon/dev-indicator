<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Mail;
use App\Mail\SendCodeMail;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name', 
        'email', 
        'password',
        'rawpassword',
        'organization_id',
        'domain_name',
        'country',
        'account_type',
        'created_by',
        'role',
        'organization_name',
        'password_change_at',
        'ruser',
        'kobouser',
        'jupyteruser',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];


    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }


    public function interventionContainer()
    {
        return $this->hasMany('App\InterventionContainer');
    }

    public function generateCode()
    {
        $code = rand(1000, 9999);
        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );
        try {
            $details = [
                'title' => 'DevIndicator',
                'code' => $code
            ];
            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
