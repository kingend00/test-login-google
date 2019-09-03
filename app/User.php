<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider','provider_id'
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
     * [editUser description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function editUser($request)
    {
        $email = $request->input('email');
        $checkEmail = DB::table('users')->where('email','=',$email)->get();
        if($checkEmail != null)
        {           
            if($request->hasfile('avatar'))
            {
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension();
                $filename =time().'.'.$extension; 
                $file->move('image', $filename);
            
                $data = [
                    'fullname' => $request ->input('fullName'),
                    'phone' => $request ->input('phone'),
                    'avatar' => $filename
                ];
                $check = DB::table('users')->where('email','=',$email)->update($data);
                if($check)
                    return DB::table('users')->where('email','=',$email)->get();
                else
                    return "Can't update, something wrong !";
            }
            else
            {
                $data = [
                    'fullname' => $request ->input('fullName'),
                    'phone' => $request ->input('phone')
                ];
                $check = DB::table('users')->where('email','=',$email)->update($data);
                if($check)
                    return DB::table('users')->where('email','=',$email)->get();
                else
                    return "Can't update, something wrong !";
            }
            return "file not is image or image maximum size";
        }
        return "Email not exists";
    }
}
