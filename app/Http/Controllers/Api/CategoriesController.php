<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;

class CategoriesController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        // $categories = Category::get();
        // return response()->json($categories);

        $categories = Category::select('id', 'name_'.app()->getLocale() . ' as name')->get(); //get the name of category from database depends on language

        return $this->returnData('categories', $categories);
    }

    public function getCategoryById(Request $request)
    {
        // $category = Category::selection()->find($request->id);

        $category = Category::select('id', 'name_'.app()->getLocale() . ' as name')->find($request->id);

        //Validation
        if (!$category)
        {
            return $this->returnError('001', 'This id does not here');
        }
        return $this->returnData('category', $category);
    }

    public function changeStatus(Request $request)
    {

        $category = Category::where('id', $request->id)->update(['active' => $request->active]);

        //Validation
        if (!$category)
        {
            return $this->returnError('001', 'This id does not here');
        }

        return $this->returnSuccessMessage('The status updated sucssefully');
    }
}
