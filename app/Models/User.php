<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;

//    public function getAuthPassword()
//    {
//        return 'loginCode';
//    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'family',
        'wallet',
        'needy',
        'store',
        'helper',
        'hasNeedy',
        'mobile',
        'login_code',
        'email',
        'password',
        'is_registered',
        'code_melli',
        'shaba_number',
        'bank_cart',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'login_code',
        'needy',
        'hasNeedy',
        'remember_token',
        'code_melli',
        'bank_cart',
        'shaba_number',
        'wallet',
        'mobile',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
//        'email_verified_at' => 'datetime',
        'wallet' => 'double',
    ];
    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [

    ];

    public function username()
    {
        return 'mobile';
    }

    // Rest omitted for brevity

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


    public function products(){
        return $this->hasMany(Product::class);
    }

    public function sponsored_order_fields(){
        return $this->hasMany(Sponsor::class,'user_id','id');
    }

    public function checkWallet($price){
        return $this->wallet >= $price ?true:false;
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }


    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }
    public function addresses()
    {
        return $this->hasMany('App\Models\UserAddress');
    }

    public function orders(){

        return $this->hasMany(Order::class,'user_id','id');
    }

    public function favorites(){
        return $this->hasMany(Favorite::class,'user_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'user_id');
    }


    public function product_questions(){
        return $this->hasMany(ProductQuestion::class,'user_id','id');
    }

    public function needyData(){
        return $this->hasOne(NeedyUser::class,'user_id','id');
    }
}
