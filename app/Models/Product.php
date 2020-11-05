<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

//use Spatie\Image\Manipulations;
//use Spatie\MediaLibrary\HasMedia\HasMedia;
//use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
//use Spatie\MediaLibrary\Models\Media;

class Product extends Model
{
    use Sluggable;
//    use HasMediaTrait {
//        getFirstMediaUrl as protected getFirstMediaUrlTrait;
//    }
    protected $fillable = [
        'category_id',
        'user_id',//store user
        'stock',
        'title',
        'slug',
        'title_en',
        'price',
        'discount',
        'description',
        'scoreCount',
        'commentCount',
        'viewCount',
        'saleCount',
        'status',
    ];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
//        'has_media',
//        'store',
        'rate',
    ];

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
    public function main_image()
    {
        return $this->images()->where('isMain',true);
    }

//    /**
//     * Add Media to api results
//     * @return bool
//     */
//    public function getHasMediaAttribute()
//    {
//        return $this->hasMedia('image') ? true : false;
//    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function property_values(){
        return $this->hasMany(ProductPropertyValue::class,'product_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function seller(){
        return $this->user()->select('id','name');
    }

    /**
     * Add Media to api results
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getStoreAttribute()
    {
        return $this->user;
    }


    /**
     * Add Media to api results
     * @return bool
     */
    public function getRateAttribute()
    {
        return $this->productReviews()
            ->where('status','=','1')
            ->select(DB::raw('round(AVG(product_reviews.rate),1) as rate'))
            ->first('rate')->rate;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productAdminReviews()
    {
        return $this->hasMany(ProductAdminReview::class, 'product_id');
    }

    public function isFavorite(){

        if (auth()->check()){
            if (auth()->user()->favorites()->whereProduct_id($this->id)->first()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function productQuestions(){
        return $this->hasMany(ProductQuestion::class,'product_id','id');
    }
}
