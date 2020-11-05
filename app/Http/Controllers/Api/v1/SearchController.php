<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SearchProduct;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function product_getList(Request $request)
    {
        $searchProduct = new SearchProduct($request);

        $cat_id = $request->get('cat_id', null);
        $filterString = $request->get('filterString', "");

        $searchProduct->attribute = $this->get_attribute_from_string($filterString);
        if ($cat_id) {
            $category = Category::with('children.children')
                ->where('id', $cat_id)->firstOrFail();
            $searchProduct->set_product_category($category);
        }
        $searchProduct->min_price = $request->get('min_price', 0);
        $searchProduct->max_price = $request->get('max_price', 0);
        return $result = $searchProduct->getProduct();
    }

    function get_attribute_from_string($filterString)
    {
        $array = array();
        $filterString = explode('@', $filterString);
        foreach ($filterString as $filter) {
            if (!empty($filter)) {
                $filter = explode('attribute_', $filter);
                if (sizeof($filter) == 2) {
                    $keys = explode('_', $filter[1]);
                    $size = array_key_exists($keys[0], $array) ? sizeof($array[$keys[0]]) : 0;
                    $array[$keys[0]][$size] = $keys[1];
                }
            }
        }
        return sizeof($array) > 0 ? $array : null;
    }

    public function category_getFilter($cat_id)
    {
        if ($cat_id != '0') {
            $category = Category::with('parent.parent')
                ->with('children')
                ->where('id', $cat_id)->first();
            if ($category) {
                $filter = Category::getCatFilter($category);

                return [
                    'filter' => $filter,
                    'category' => $category
                ];
            }
        }
        return [
            "filter" => [],
            "category" => null
        ];

    }
}
