<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Models\ProductsCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\True_;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.components.Categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {



            $data = json_decode($_POST['data']);
            $name = $data['0']->name;
            $categories = $data['0']->categories;
            $photoPath =  $request->file('photo')->store('public');
            $photoName = (explode('/', $photoPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $location = "http://" . $host . "/storage/" . $photoName;



            $result = ProductsCategoryModel::insert([
                'name' => $name,
                'parent_id' => $categories,
                'banner_image' => $location

            ]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }

        } catch (\Throwable $th) {
            return response()->json(array('error',$th));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCategoriesData(){
        // $categories_result =json_decode( Productsparent_idModel::tree());

        try {
            $CategoryList = array();
            $Category = '';
            $this->GetcategoryHirarchy( $CategoryList, $Category);
            $Category = json_decode(json_encode((object)$CategoryList), True);
            return $Category;
        } catch (\Throwable $th) {
            return response()->json(array('status',$th));
        }
    }








    private function GetcategoryHirarchy( &$parent_idList, &$parent_id) {
        $categorys = DB::select("SELECT
                                        `parent`.`id`,
                                        `parent`.`name`,
                                        `parent`.`parent_id`,
                                        COUNT(`child`.`id`) AS `SectionCount`
                                    FROM
                                        `Products_category` `parent`
                                            LEFT JOIN
                                        `Products_category` `child` ON `parent`.`id` = `child`.`parent_id`
                                    WHERE
                                        `parent`.`parent_id` = '0'
                                    GROUP BY `parent`.`id`
                                    ORDER BY `parent`.`id`");
        $Level = 1;
        $parent_id .= '';
        foreach($categorys as $each_category) {
            $Currucilam_array = array(
                'id' => $each_category->id,
                'name' => $each_category->name,
                'parent_id' => $each_category->parent_id,
            );
            $ParentCategory = $each_category->name;

            if ($each_category -> SectionCount < 1) {
                array_push($parent_idList, $Currucilam_array);$parent_id=$each_category->name;

            }
            $this->GetCategoryRecursive( $each_category->id, $parent_idList, $Level, $ParentCategory);
        }
    }

    private function GetCategoryRecursive( $parent_category_id, &$parent_idList, $Level, $ParentCategory) {
        $category = DB::select("SELECT
                                `parent`.`id`,
                                `parent`.`name`,
                                `parent`.`parent_id`,
                                COUNT(`child`.`id`) AS `SectionCount`
                            FROM
                                `Products_category` `parent`
                                    LEFT JOIN
                                `Products_category` `child` ON `parent`.`id` = `child`.`parent_id`
                            WHERE
                                `parent`.`parent_id` = $parent_category_id
                            GROUP BY `parent`.`id`
                            ORDER BY `parent`.`id`
        ");
        $NextLevel = $Level + 1;
        $Spaces = '';
        for($I = 0; $I < $NextLevel; $I++) {
            $Spaces .= "&emsp;";
        }

        foreach($category as $each_category) {

            $category_arrey = array(
                'id' => $each_category->id,
                'name' =>$ParentCategory.'-> '. $each_category->name,
                'parent_id' => $each_category->parent_id,
            );
            $CategoryName_Recursive=$ParentCategory.'-> '. $each_category->name;

            array_push($parent_idList, $category_arrey);

            $this->GetCategoryRecursive( $each_category->id, $parent_idList, $NextLevel, $CategoryName_Recursive );
        }
    }
}
