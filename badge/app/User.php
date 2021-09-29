<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.  *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function topics()
    {
        return $this->hasMany(Topic::class);

    }

    public function userStat()
    {
        return $this->hasOne(UserStat::class);
    }


    public function badges()
    {
        return $this->belongsToMany(Badge::class)->withTimestamps();
    }


    public function incrementXp($number = 1)
    {
        $this->userStat->xp += $number;
        $this->userStat->save();
    }

    public function incrementTopicCount()
    {
        $this->userStat->topic_count++;
        $this->userStat->save();
    }

    public function incrementReplyCount()
    {
        $this->userStat->reply_count++;
        $this->userStat->save();
    }






}
