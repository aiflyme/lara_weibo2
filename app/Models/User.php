<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user){
            $user->activation_token = Str::random(10);
        });
    }

    public function gravatar($size = '100')
    {

        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    //获取粉丝关系列表
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //获取用户关注人列表
    public function followings()
    {
        return $this->belongsToMany(User::class,'followers', 'follower_id','user_id');
    }

    //关注某人
    public function follow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }

        $this->followings()->sync($user_ids, false);
    }

    //取消关注
    public function unfollow($user_ids)
    {
        if(! is_array($user_ids)){
            $user_ids = compact('user_ids');
        }

        $this->followings()->detach($user_ids);
    }

    public function isFollowing($user_id)
    {
        /*
         *
         * 1. 返回的是一个 HasMany 对象
         * $this->followings()
         * 2. 返回的是一个 Collection 集合
         * $this->followings
         * 3. 第2个其实相当于这样
         * $this->followings()->get()
         * 如果不需要条件直接使用 2 那样，写起来更短
        */
        return $this->followings->contains($user_id);
    }

    public function feed()
    {
        $user_ids = $this->followings->pluck('id')->toArray();

        //array_push($user_ids, $this->id);
        $user_ids[] = $this->id;
        return Status::whereIn('user_id',$user_ids)
            ->with('user')
            ->orderBy('created_at','desc');

    }

}
