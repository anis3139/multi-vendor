<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product_table;
use App\Models\ProductsBrandModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class allProductController extends Controller
{
    public function index(Request $request)
    {
        $allProducts=product_table::with('img')->where('product_active', 1)->paginate(12);
        return view('shop.shopPage')->with('allProducts',$allProducts);

    }



    public function index2(Request $request)
    {
        $allProducts=product_table::with('img')->where('product_active', 1)->where('feture_products',1)->paginate(12);
        return view('shop.flushproduct')->with('allProducts',$allProducts);

    }

    public function search(Request $request)
    {
        $key=$request->key;

        $CategoryList = array();
        $Category = 0;
        $this->GetcategoryHirarchy($CategoryList, $Category);
        $Category = json_decode(json_encode((object)$CategoryList), True);
        // dd($Category);

        $brand=ProductsBrandModel::all();


        if($key != ""){
            $searchProducts=product_table::with(['img'])->where('product_active', 1)->Where('product_title','LIKE',"%{$key}%")->orderBy('id', 'desc')->paginate(12);

            if(count($searchProducts)>0){
                return view('shop.search')
                ->with('key',$key)
                ->with('searchProducts',$searchProducts)
                ->with('Categorys',$Category)
                ->with('brands',$brand);
            }
        }
        return view('shop.search')
        ->with('key',$key)
        ->with('searchProducts',$searchProducts)
        ->with('Categorys',$Category)
        ->with('brands',$brand);


    }



    public function search2(Request $request)
    {
        $name=$request->name;
        $category=$request->category;
        $brand=$request->brand;
        $pricerange1=$request->pricerange1;
        $pricerange2=$request->pricerange2;
        $pdo = DB::connection()->getPdo();
        $CategoryList = array();
        $Category = 0;
        $this->GetcategoryHirarchy($CategoryList, $Category);
        $Category = json_decode(json_encode((object)$CategoryList), True);
        // dd($Category);

        $brands=ProductsBrandModel::all();


        $where_condition = "";
        if(!empty($name)) {
            if(empty($where_condition)) {
                $where_condition .= " WHERE product_tables.product_title LIKE ".$pdo->quote("%".$name."%")."";
            } else {
                $where_condition .= " AND product_tables.product_title LIKE ".$pdo->quote("%".$name."%")."";
            }
        }


        if(!empty($category)) {
            if(empty($where_condition)) {
                $where_condition .= " WHERE product_tables.product_category_id = $category ";
            } else {
                $where_condition .= " AND product_tables.product_category_id =$category ";
            }
        }

        if(!empty($brand)) {
            if(empty($where_condition)) {
                $where_condition .= " WHERE product_tables.product_brand_id = $brand ";
            } else {
                $where_condition .= " AND product_tables.product_brand_id = $brand ";
            }
        }


        if(!empty($pricerange1) && !empty($pricerange2)) {
            if(empty($where_condition)) {
                $where_condition .= " WHERE product_tables.product_selling_price BETWEEN $pricerange1 and $pricerange2";
            } else {
                $where_condition .= " AND product_tables.product_selling_price BETWEEN $pricerange1 and $pricerange2";
            }
        }

        $sql ="SELECT product_tables.id,product_tables.product_slug,product_tables.product_category_id,product_tables.product_brand_id, product_tables.product_title, product_tables.product_price, product_tables.product_selling_price, product_has_images.id, product_has_images.image_path  as img,products_brand.name as brandName FROM product_tables LEFT JOIN product_has_images ON product_tables.id = product_has_images.has_images_product_id  left join products_brand on product_tables.product_brand_id =products_brand.id ". $where_condition . " GROUP BY product_tables.product_title";


// dd($sql);

        $result =DB::select($sql);

        $searchProducts=json_decode(json_encode((object)$result), True);

        // dd($searchProducts);
// dd($name);

        return view('shop.search2')
        ->with('key',$name)
        ->with('searchProducts',$searchProducts)
        ->with('Categorys',$Category)
        ->with('brands',$brands);



    }



    private function GetcategoryHirarchy(&$parent_idList, &$parent_id)
    {
        $categorys = DB::select("SELECT
                                        `parent`.`id`,
                                        `parent`.`name`,
                                        `parent`.`status`,
                                        `parent`.`parent_id`,
                                        `parent`.`icon`,
                                        `parent`.`banner_image`,
                                        COUNT(`child`.`id`) AS `SectionCount`
                                    FROM
                                        `products_category` `parent`
                                            LEFT JOIN
                                        `products_category` `child` ON `parent`.`id` = `child`.`parent_id`
                                    WHERE
                                        `parent`.`parent_id` = $parent_id
                                    GROUP BY `parent`.`id`
                                    ORDER BY `parent`.`id`");
        $Level = 1;
        $parent_id .= '';
        foreach ($categorys as $each_category) {
            $Category_array = array(
                'id' => $each_category->id,
                'name' => $each_category->name,
                'status' => $each_category->status,
                'parent_id' => $each_category->parent_id,
                'icon' => $each_category->icon,
                'banner_image' => $each_category->banner_image,
            );
            $ParentCategory = $each_category->name;

            // if ($each_category -> SectionCount < 1) {
            array_push($parent_idList, $Category_array);
            $parent_id = $each_category->name;

            // }
            $this->GetCategoryRecursive($each_category->id, $parent_idList, $Level, $ParentCategory);
        }
    }

    private function GetCategoryRecursive($parent_category_id, &$parent_idList, $Level, $ParentCategory)
    {
        $category = DB::select("SELECT
                                `parent`.`id`,
                                `parent`.`name`,
                                `parent`.`status`,
                                `parent`.`parent_id`,
                                `parent`.`icon`,
                                `parent`.`banner_image`,
                                COUNT(`child`.`id`) AS `SectionCount`
                            FROM
                                `products_category` `parent`
                                    LEFT JOIN
                                `products_category` `child` ON `parent`.`id` = `child`.`parent_id`
                            WHERE
                                `parent`.`parent_id` = $parent_category_id
                            GROUP BY `parent`.`id`
                            ORDER BY `parent`.`id`
        ");
        $NextLevel = $Level + 1;
        $Spaces = '';
        for ($I = 0; $I < $NextLevel; $I++) {
            $Spaces .= "&emsp;";
        }

        foreach ($category as $each_category) {

            $category_arrey = array(
                'id' => $each_category->id,
                'name' => $ParentCategory . '-> ' . $each_category->name,
                'status' => $each_category->status,
                'parent_id' => $each_category->parent_id,
                'icon' => $each_category->icon,
                'banner_image' => $each_category->banner_image,
            );
            $CategoryName_Recursive = $ParentCategory . '-> ' . $each_category->name;

            array_push($parent_idList, $category_arrey);

            $this->GetCategoryRecursive($each_category->id, $parent_idList, $NextLevel, $CategoryName_Recursive);
        }
    }
}
