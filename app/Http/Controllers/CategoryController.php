<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Document;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $category = new Category();
        return view('category.create', compact('category','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['unique:categories']
        ]);
        $category = new Category();
        $category->name=$request['name'];
        $category->superCategory=$request['superCategory'];
        $category->save();
        return redirect()->route('categories.index')
            ->with('success', 'Categoria creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('category.edit', compact('category'));
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
        $category = Category::find($id);
        request()->validate(Category::$rules);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Categoria Editada Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $document = Document::where('categoryId',$id)->first();
        
        if ($document || $id<7 || $this->buscarSubCategoria($id)) {
            return redirect()->back()
            ->with('error', 'No se puede Eliminar porque existen libros que pertenecen a esta categoria');
        }
        $this->categoryDeleteRec($id);
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Categoria Eliminada Exitosamente');
    }

    public function categoryDeleteRec($categoryId){
        $categories = Category::where('superCategory',$categoryId)->get();
        foreach ($categories as $category) {
            $aux=Category::where('superCategory',$category->id)->first();
            if ($aux) {
                $this->categoryDeleteRec($category->id);
            }
            $category->delete();
        }
    }

    public function buscarSubCategoria($categoryId){
        $categories = Category::where('superCategory',$categoryId)->get();
        foreach ($categories as $category) {
            $document=Document::where('categoryId',$category->id)->first();
            if ($document) {
                return true;
            }
            $aux=Category::where('superCategory',$category->id)->first();
            if ($aux) {
                $x=$this->buscarSubCategoria($category->id);
                if ($x) {
                    return true;
                }
            }
        
        }
        return false;
    }
}
