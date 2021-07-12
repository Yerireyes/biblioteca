<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = Semester::paginate();

        return view('semester.index', compact('semesters'))
            ->with('i', (request()->input('page', 1) - 1) * $semesters->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semester = new Semester();
        return view('semester.create', compact('semester'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Semester::$rules);
        $semester = new Semester();
        $semester->management=$request['management'];
        $semester->save();
        

        // $semester = Semester::create($request->all());

        return redirect()->route('semesters.index')
            ->with('success', 'Semestre creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semester = Semester::find($id);

        return view('semester.show', compact('semester'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $semester = Semester::find($id);

        return view('semester.edit', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Semester $semester
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Semester $semester)
    public function update(Request $request, $id)
    {
        $semester = Semester::find($id);
        request()->validate(Semester::$rules);

        $semester->update($request->all());

        return redirect()->route('semesters.index')
            ->with('success', 'Semester updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $semester = Semester::find($id)->delete();

        return redirect()->route('semesters.index')
            ->with('success', 'Semester deleted successfully');
    }
}
