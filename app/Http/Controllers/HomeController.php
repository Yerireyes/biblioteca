<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function index2()
    {
        $cateories=Category::
        whereNull('superCategory')->get();
        $categories=[];
        foreach ($cateories as $category) {
            $mySubCategories=Category::where('superCategory',$category->id)->get();
            $x=[];
            foreach ($mySubCategories as $mySubCategory) {
                $mymySubCategory=[
                    'id'=>$mySubCategory->id,
                    'name'=>$mySubCategory->name,
                    'subCategories'=>Category::where('superCategory',$mySubCategory->id)->get()
                ];
                array_push($x, $mymySubCategory);
            }
            
            $myCategory=[
                'id'=>$category->id,
                'name'=>$category->name,
                'subCategories'=>$x
            ];
            array_push($categories, $myCategory);
        }
        return view('home2',compact('categories'));
    }
    
    public function register(Request $request)
    {
        return $request->all();
    }

    
}
