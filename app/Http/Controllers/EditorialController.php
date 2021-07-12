<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editorials = Editorial::paginate();

        return view('editorial.index', compact('editorials'))
            ->with('i', (request()->input('page', 1) - 1) * $editorials->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editorial = new Editorial();
        return view('editorial.create', compact('editorial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Editorial::$rules);


        $editorial = Editorial::create($request->all());

        return redirect()->route('editorials.index')
            ->with('success', 'Editorial creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editorial = Editorial::find($id);

        return view('editorial.show', compact('editorial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editorial = Editorial::find($id);

        return view('editorial.edit', compact('editorial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Editorial $editorial
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Editorial $editorial)
    public function update(Request $request, $id)
    {
        $editorial = Editorial::find($id);
        request()->validate(Editorial::$rules);

        $editorial->update($request->all());

        return redirect()->route('editorials.index')
            ->with('success', 'Editorial updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $editorial = Editorial::find($id)->delete();

        return redirect()->route('editorials.index')
            ->with('success', 'Editorial deleted successfully');
    }
}
