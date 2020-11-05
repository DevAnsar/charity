<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductReviewCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item){
            return[
              'user'=>$item->user,
              'review'=>$item->review,
              'rate'=>$item->rate,
              'created_at'=>\Hekmatinasser\Verta\Verta::instance($item->created_at)->format('Y/m/d'),
            ];
        });
    }
}
