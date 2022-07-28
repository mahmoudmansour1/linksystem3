<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Employee;
use DB;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageCategory()
    {
        // $categories = DB::table('category')->where('parent_id', '=', 0)->get();
        // $allCategories = DB::table('category')->pluck('title','id');

        $categories = Category::where('parent_id', '=', 0)->get();
         $allCategories = Category::pluck('title','id')->all();
        return view('categoryTreeview',compact('categories','allCategories'));
    }
    public function manageReport()
    {
        // $categories = DB::table('category')->where('parent_id', '=', 0)->get();
        // $allCategories = DB::table('category')->pluck('title','id');

        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title','id')->all();
        return view('manageReport',compact('categories','allCategories'));

    }
    public function searchReport(Request $request)
    {
        $this->validate($request, [
        		'id' => 'required',
        	]);




        $input = $request->all();
        $id = empty($input['id']) ? 0 : $input['id'];

        $sections = Category::where('parent_id',$id)->pluck('id')->toArray();

        $sub_sections = Category::whereIn('parent_id',$sections)->pluck('id')->toArray();

        $all_parent_id = array_merge($sections,$sub_sections);

        //dd($all_parent_id);

        $employees = Employee::whereIn('category_id',$all_parent_id)->with('categories')->get();
       // $employees = Employee::find(1)->categories;

        //dd($employees);
        $allCategories = Category::pluck('title','id')->all();


        return view('manageReport',compact('allCategories','employees'));
    }        

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {
        $this->validate($request, [
        		'title' => 'required',
        	]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        
        Category::create($input);
        return back()->with('success', 'New Category added successfully.');
    }

    

}