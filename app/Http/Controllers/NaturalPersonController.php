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
        $countries = CountryList::all();
        $professions = Profession::all();
        $civilStatuses = CivilStatus::all();
        return view('natural_persons.index', compact('naturalPersons', 'countries', 'professions', 'civilStatuses'));
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
        $results = NaturalPerson::create([
            'prefix' => $request->prefix,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'other_last_name' => $request->other_last_name,
            'given_name' => $request->given_name,
            'date_of_birth' => $request->date_of_birth,
            'town_of_birth' => $request->town_of_birth,
            'country_of_birth' => $request->country_of_birth,
            'civil_status' => $request->civil_status,
            'Profession' => $request->Profession,
            'TaxNumber' => $request->TaxNumber,
            'digitoVerificadorRUC' => $request->digitoVerificadorRUC,
            'codigoUbicacion' => $request->codigoUbicacion,
        ]);

        if ($results) {
            return redirect()->route('index');
        }
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
        $naturalPerson->update($request->all());
        return redirect()->route('natural-person.index')->with('success', 'Natural Person updated successfully!');
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
