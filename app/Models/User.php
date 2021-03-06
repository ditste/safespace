<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\FeedPost;
use App\Models\Like;

class User extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'full_name','first_name','last_name','email','facebook_id','password','date_of_birth','visible_profile','orientation','relationship_status','looking_for','pets','meet_at','religious_views','children',
        'is_smoke','is_drink','is_canabis','about',
    ];

   
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password','updated_at','created_at','facebook_id'
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

     /**
     * Get the user's social identities.
     */

     public function likedFeedPosts()
     {
         return $this->belongsToMany(FeedPost::class,'likes','user_id','feed_post_id');
     }

     public function feedPostlikes()
     {
         return $this->hasMany(Like::class);
     }

     public function friends()
     {
         return $this->belongsToMany(User::class,'connections','user_id','friend_id');
     }

     public function profileImage()
     {
         return $this->hasMany(Image::class);
     }

     public function members()
     {
         return $this->hasMany(Member::class);
     }
   
}
