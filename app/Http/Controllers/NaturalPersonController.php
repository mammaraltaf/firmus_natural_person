<?php

namespace App\Http\Controllers;

use App\Models\CivilStatus;
use App\Models\CountryList;
use App\Models\NaturalPerson;
use App\Models\Profession;
use Illuminate\Http\Request;

class NaturalPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $naturalPersons = NaturalPerson::with(['profession', 'civilStatus', 'country'])->get();
        return view('natural_persons.index', compact('naturalPersons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professions = Profession::all();
        $civilStatuses = CivilStatus::all();
        $countries = CountryList::all();
        return view('natural_persons.create', compact('professions', 'civilStatuses', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            // Add more validation rules as needed
        ]);

        NaturalPerson::create($request->all());
        return redirect()->route('natural-persons.index')->with('success', 'Natural Person created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NaturalPerson $naturalPerson)
    {
        return view('natural_persons.show', compact('naturalPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NaturalPerson $naturalPerson)
    {
        $professions = Profession::all();
        $civilStatuses = CivilStatus::all();
        $countries = CountryList::all();
        return view('natural_persons.edit', compact('naturalPerson', 'professions', 'civilStatuses', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NaturalPerson $naturalPerson)
    {
        $request->validate([
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            // Add more validation rules as needed
        ]);

        $naturalPerson->update($request->all());
        return redirect()->route('natural-persons.index')->with('success', 'Natural Person updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NaturalPerson $naturalPerson)
    {
        $naturalPerson->delete();
        return redirect()->route('natural-persons.index')->with('success', 'Natural Person deleted successfully!');
    }
}
