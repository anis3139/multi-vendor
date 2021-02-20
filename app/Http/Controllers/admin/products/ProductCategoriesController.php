<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Models\ProductsCategoryModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $data = json_decode($_POST['data']);
        $name = $data['0']->name;
        $catStatus = $data['0']->catStatus;
        $categories = $data['0']->categories;
        $photoPath =  $request->file('photo')->store('public');
        $photoName = (explode('/', $photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $location = $protocol . $host . "/storage/" . $photoName;

        $iconPath =  $request->file('icon')->store('public');
        $iconName = (explode('/', $iconPath))[1];

        $iconHost = $_SERVER['HTTP_HOST'];
        $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $iconNameLocation = $protocol . $iconHost . "/storage/" . $iconName;


        $slug = Str::slug($name);
        $next = 2;
        while (ProductsCategoryModel::where('slug', '=', $slug)->first()) {
            $slug = $slug . "-" . $next;
            $next++;
        }

        $result = ProductsCategoryModel::insert([
            'name' => $name,
            'status' => $catStatus,
            'parent_id' => $categories,
            'banner_image' => $location,
            'icon' => $iconNameLocation,
            'slug' => $slug,
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
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
    public function edit(Request $req)
    {

        $id = $req->input('id');
        $result = json_encode(ProductsCategoryModel::where('id', '=', $id)->get());
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = json_decode($_POST['data']);
        $id = $data['0']->id;
        $name = $data['0']->name;
        $catEditStatus = $data['0']->catEditStatus;
        $products_category_id = $data['0']->products_category_id;


        if ($request->file('photo') && $request->file('icon')) {

            $delete_old_file = ProductsCategoryModel::where('id', '=', $id)->first();
            $delete_old_file_name = (explode('/', $delete_old_file->banner_image))[4];
            Storage::delete("public/" . $delete_old_file_name);
            $photoPath =  $request->file('photo')->store('public');
            $photoName = (explode('/', $photoPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
            $location = $protocol . $host . "/storage/" . $photoName;


            $delete_old_icon = ProductsCategoryModel::where('id', '=', $id)->first();
            $delete_old_icon_name = (explode('/', $delete_old_icon->icon))[4];
            Storage::delete("public/" . $delete_old_icon_name);
            $iconPath =  $request->file('icon')->store('public');
            $iconName = (explode('/', $iconPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
            $icon_location = $protocol . $host . "/storage/" . $iconName;



            $result = ProductsCategoryModel::where('id', '=', $id)->update(['name' => $name, 'status' => $catEditStatus, 'parent_id' => $products_category_id,  'icon' => $icon_location, 'banner_image' => $location]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($request->file('photo')) {

            $delete_old_file = ProductsCategoryModel::where('id', '=', $id)->first();
            $delete_old_file_name = (explode('/', $delete_old_file->banner_image))[4];
            Storage::delete("public/" . $delete_old_file_name);
            $photoPath =  $request->file('photo')->store('public');
            $photoName = (explode('/', $photoPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
            $location = $protocol . $host . "/storage/" . $photoName;


            $result = ProductsCategoryModel::where('id', '=', $id)->update(['name' => $name, 'status' => $catEditStatus, 'parent_id' => $products_category_id, 'banner_image' => $location]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($request->file('icon')) {


            $delete_old_icon = ProductsCategoryModel::where('id', '=', $id)->first();
            $delete_old_icon_name = (explode('/', $delete_old_icon->icon))[4];
            Storage::delete("public/" . $delete_old_icon_name);
            $iconPath =  $request->file('icon')->store('public');
            $iconName = (explode('/', $iconPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
            $icon_location = $protocol . $host . "/storage/" . $iconName;


            $result = ProductsCategoryModel::where('id', '=', $id)->update(['name' => $name, 'status' => $catEditStatus, 'parent_id' => $products_category_id, 'icon' => $icon_location]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            $result = ProductsCategoryModel::where('id', '=', $id)->update(['name' => $name, 'status' => $catEditStatus, 'parent_id' => $products_category_id]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {



        $id = $request->input('id');

        $CategoryList = array();
        $Category = $id;
        $this->GetcategoryHirarchy($CategoryList, $Category);
        $Categorys = json_decode(json_encode((object)$CategoryList), True);


        if (count($Categorys) > 0) {

            foreach ($Categorys as  $Categoryvalue) {
                $delete_old_file = ProductsCategoryModel::where('id', '=', $Categoryvalue['id'])->first();
                $delete_old_file_image = (explode('/', $delete_old_file->banner_image))[4];
                $delete_old_file_icon = (explode('/', $delete_old_file->icon))[4];
                Storage::delete("public/" . $delete_old_file_image);
                Storage::delete("public/" . $delete_old_file_icon);
                $result = $delete_old_file->delete();
            }
        }

        $delete_old_file = ProductsCategoryModel::where('id', '=', $id)->first();
        $delete_old_file_image = (explode('/', $delete_old_file->banner_image))[4];
        $delete_old_file_icon = (explode('/', $delete_old_file->icon))[4];
        Storage::delete("public/" . $delete_old_file_image);
        Storage::delete("public/" . $delete_old_file_icon);
        $result = $delete_old_file->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getCategoriesData()
    {
        // $categories_result =json_decode( Productsparent_idModel::tree());


        $CategoryList = array();
        $Category = 0;
        $this->GetcategoryHirarchy($CategoryList, $Category);
        $Category = json_decode(json_encode((object)$CategoryList), True);
        return $Category;
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
