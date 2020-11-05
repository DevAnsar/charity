<?php
namespace  App\Models;

use Illuminate\Database\Eloquent\Builder;

class SearchProduct{
    public $category=array();
    public $min_price=0;
    public $max_price=0;
    public $brands=null;
    public $attribute;
    protected $sort=21;
    protected $search_text=null;
    protected $has_product=0;
    protected $products_id=[];
    public function __construct($request)
    {
        $this->setMinAndMaxPrice($request->all());
        $this->attribute=$request->get('attribute',null);
        $this->sort=$request->get('sortby',21);
        $this->search_text=$request->get('string',null);
        $this->has_product=$request->get('has_product',0);
    }
    public function set_products_id($array)
    {
       $this->products_id=$array;
    }
    public function set_product_category($catList){
        $this->category[$catList->id]=$catList->id;
        foreach ($catList->children as $key=>$value)
        {
            $this->category[$value->id]=$value->id;
            foreach ($value->children as $key2=>$value2)
            {
                $this->category[$value2->id]=$value2->id;
            }
        }
    }
    public function set_brand_category($cat_id)
    {
        if(is_array($cat_id))
        {
            $j=0;
            foreach ($cat_id as $k=>$v){
                $this->category[$j]=$v;
                $j++;
            }
            $category=Category::whereIn('parent_id',$cat_id)->get();
            foreach ($category as $key=>$value)
            {
                $this->category[$j]=$value->id;
                $j++;
            }
        }
    }
    public function getProduct()
    {
        $product2=Product::orderBy('price','DESC')->where('status', '>=', '0');

        $product=Product::select(['id','title','slug','price','discount','status','category_id','stock'])
        ->with('category')
        ->with('main_image')
        ->where('status','>=','0');

        if(is_array($this->category) && sizeof($this->category)>0)
        {
            $product=$product->whereIn('category_id',$this->category);
            $product2=$product2->whereIn('category_id',$this->category);
        }

        if(sizeof($this->products_id))
        {
            $product = $product->whereIn('id', $this->products_id);
            $product2 = $product2->whereIn('id', $this->products_id);
        }

        if(is_array($this->attribute)){
            $products_id=$this->get_product_form_attribute();
            $product=$product->whereIn('id',$products_id);
        }

        if($this->search_text!=null){
            $searchValues = preg_split('/\s+/', $this->search_text);
            $product=$product->where(function ($query) use ($searchValues){
                foreach ($searchValues as $value){
                    $query->where('title','like','%'.$value.'%');
                }
            });
        }
        if($this->max_price!=0){
            $product=$product->whereRaw('CAST(`price` AS SIGNED) <= ?',[$this->max_price]);
        }
        if($this->min_price>0){
            $product=$product->whereRaw('CAST(`price` AS SIGNED) >= ?',[$this->min_price]);
        }
        if($this->has_product==1){
//            $product=$product->where('status',1);
            $product=$product->where('stock','>',0);
        }


        $sort=$this->get_sort();
        $product=$product->orderBy('status','DESC')->orderBy($sort[0],$sort[1]);

        $count=$product->count();

        $product=$product->paginate(12);

        $max_price=$product2->first();
        $max_price=$max_price ? $max_price->price : 0;


        return [
            'product'=>$product,
            'max_price'=>$max_price,
            'count'=>$count
        ];
    }
    public function setMinAndMaxPrice($data){
        if(array_key_exists('price',$data)){
            if(array_key_exists('min',$data['price']))
            {
                $this->min_price=$data['price']['min'];
            }
            if(array_key_exists('max',$data['price']))
            {
                $this->max_price=$data['price']['max'];
            }
        }
    }

    public function get_product_form_attribute(){

        $array_id=array();
        foreach ($this->attribute as $key=>$value){
//            dd($key);
//            $data=ProductFilter::whereIn('filter_value',$value)->pluck('product_id','id')->toArray();
            $data=ProductPropertyValue::whereIn('property_default_id',$value)->pluck('product_id','id')->toArray();
            $array_id[$key]=$data;
        }
        if(sizeof($array_id)>1){
           $products_id=call_user_func_array('array_intersect',$array_id);
        }
        else{
           $id=collect($array_id);
           $products_id=$id->values()->all()[0];
        }

        return $products_id;
    }
    public function get_sort()
    {
        $sort=array();
        $sort[21]=array('viewCount','DESC');
        $sort[22]=array('saleCount','DESC');
        $sort[23]=array('id','DESC');
        $sort[24]=array('price','ASC');
        $sort[25]=array('price','DESC');
        if(array_key_exists($this->sort,$sort)){
            return $sort[$this->sort];
        }
        else{
            return $sort[23];
        }
    }
}
