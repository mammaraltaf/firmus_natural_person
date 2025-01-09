<?php

namespace App\Http\Controllers;

use App\Models\AddressNaturalPerson;
use App\Models\CivilStatus;
use App\Models\ContactType;
use App\Models\CountryList;
use App\Models\IdentityDocumentNaturalPerson;
use App\Models\NationalityNaturalPerson;
use App\Models\NaturalPerson;
use App\Models\NaturalPersonContact;
use App\Models\Profession;
use App\Models\TypeOfAddress;
use App\Models\TypeOfIdentityDocument;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NaturalPersonController extends Controller
{
    public function dbSchema(){
        return view('db-schema');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $naturalPersons = NaturalPerson::with([
            'profession', 'civilStatus', 'country', 'nationalities.identifyDocumentNaturalPerson' , 'naturalPersonContacts' ,'addressNaturalPersons'
        ])->get();
        $countries = CountryList::all();
        $professions = Profession::all();
        $civilStatuses = CivilStatus::all();
        $addressType = TypeOfAddress::all();
        $typeOfIdentityDocuments = TypeOfIdentityDocument::all();
        $contactTypes = ContactType::all();
        return view('natural_persons.index', compact('naturalPersons', 'countries', 'professions', 'civilStatuses', 'addressType', 'typeOfIdentityDocuments', 'contactTypes'));
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
        try {
            $naturalPerson = NaturalPerson::create([
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
                'TaxNumber' => $request->taxNumber,
                'digitoVerificadorRUC' => $request->digitoVerificadorRUC,
                'codigoUbicacion' => $request->codigoUbicacion,
            ]);

            // Handle dynamic fields (Contacts, Addresses, Nationalities, and Nationality Documents)
            if ($request->has('contacts')) {
                foreach ($request->contacts as $contact) {
                    NaturalPersonContact::create([
                        'IDNaturalPerson' => $naturalPerson->id_natural_person,
                        'IDContactType' => $contact['type'],
                        'Data' => $contact['value'],
                        'Note' => $contact['description'],
                        'Authorized' => array_key_exists('authorized', $contact) ? 1 : 0,
                    ]);
                }
            }

            if ($request->has('nationality_documents')) {
                foreach ($request->nationality_documents as $document) {
                    $nationalityNaturalPerson = NationalityNaturalPerson::firstOrCreate(
                        [
                            'id_natural_person' => $naturalPerson->id_natural_person,
                            'id_country' => $document['country']
                        ],
                        []
                    );

                    IdentityDocumentNaturalPerson::create([
                        'id_nationality' => $nationalityNaturalPerson->id_nationality,
                        'type_of_identity_document' => $document['type'],
                        'reference_number' => $document['reference'],
                        'expiration_date' => $document['expiration'],
                    ]);
                }
            }

            if ($request->has('addresses')) {
                foreach ($request->addresses as $address) {
                    AddressNaturalPerson::create([
                        'id_natural_person' => $naturalPerson->id_natural_person,
                        'type' => $address['type'],
                        'street_name' => $address['street'],
                        'number' => $address['number'],
                        'apartment' => $address['apartment'],
                        'district' => $address['district'],
                        'postal_code' => $address['postal'],
                        'city' => $address['city'],
                        'province' => $address['province'],
                        'country' => $address['country'],
                    ]);
                }
            }

            if ($naturalPerson) {
                return redirect()->route('natural-person.index')->with('success', 'Natural person created successfully.');
            }
        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Error creating natural person: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the natural person. Please try again.');
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
        try {
            // Fetch the person with related models
            $person = NaturalPerson::with([
                'profession',
                'civilStatus',
                'country',
                'nationalities.identifyDocumentNaturalPerson.nationalityNaturalPerson.CountryList',
                'naturalPersonContacts',
                'addressNaturalPersons'
            ])->where('id_natural_person', $naturalPerson->id_natural_person)->first();

            // Fetch all required data
            $naturalPersons = NaturalPerson::with([
                'profession',
                'civilStatus',
                'country',
                'nationalities.identifyDocumentNaturalPerson',
                'naturalPersonContacts',
                'addressNaturalPersons'
            ])->get();
            $countries = CountryList::all();
            $professions = Profession::all();
            $civilStatuses = CivilStatus::all();
            $addressType = TypeOfAddress::all();
            $typeOfIdentityDocuments = TypeOfIdentityDocument::all();
            $contactTypes = ContactType::all();

            // Return the edit view
            return view('natural_persons.edit', compact(
                'naturalPersons',
                'countries',
                'professions',
                'civilStatuses',
                'addressType',
                'typeOfIdentityDocuments',
                'contactTypes',
                'person'
            ));
        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Error fetching data for edit view: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while fetching data for editing. Please try again.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Retrieve the NaturalPerson record
        $naturalPerson = NaturalPerson::findOrFail($id);

        // Update the NaturalPerson fields
        $naturalPerson->update([
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
            'TaxNumber' => $request->taxNumber,
            'digitoVerificadorRUC' => $request->digitoVerificadorRUC,
            'codigoUbicacion' => $request->codigoUbicacion,
        ]);

        // Update Contacts
        if ($request->has('contacts')) {
            // Delete existing contacts for this natural person
            NaturalPersonContact::where('IDNaturalPerson', $naturalPerson->id_natural_person)->delete();

            // Add updated contacts
            foreach ($request->contacts as $contact) {
                NaturalPersonContact::create([
                    'IDNaturalPerson' => $naturalPerson->id_natural_person,
                    'IDContactType' => $contact['type'],
                    'Data' => $contact['value'],
                    'Note' => $contact['description'],
                    'Authorized' => array_key_exists('authorized', $contact) ? 1 : 0,
                ]);
            }
        }
        else{
            NaturalPersonContact::where('IDNaturalPerson', $naturalPerson->id_natural_person)->delete();
        }

        // Update Nationality Documents
        if ($request->has('nationality_documents')) {
            $this->deleteNationalityAndDocuments($naturalPerson);
            foreach ($request->nationality_documents as $document) {
                $nationalityNaturalPerson = NationalityNaturalPerson::create(
                    [
                        'id_natural_person' => $naturalPerson->id_natural_person,
                        'id_country' => $document['country']
                    ]
                );

                IdentityDocumentNaturalPerson::create([
                    'id_nationality' => $nationalityNaturalPerson->id_nationality,
                    'type_of_identity_document' => $document['type'],
                    'reference_number' => $document['reference'],
                    'expiration_date' => $document['expiration'],
                ]);
            }
        }
        else{
            try {
                $this->deleteNationalityAndDocuments($naturalPerson);
            } catch (\Exception $e) {
                // Catch and handle any errors
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 500);
            }
        }

        // Update Addresses
        if ($request->has('addresses')) {
            // Delete existing addresses for this natural person
            AddressNaturalPerson::where('id_natural_person', $naturalPerson->id_natural_person)->delete();

            // Add updated addresses
            foreach ($request->addresses as $address) {
                AddressNaturalPerson::create([
                    'id_natural_person' => $naturalPerson->id_natural_person,
                    'type' => array_key_exists('type', $address) ? $address['type'] : null,
                    'street_name' => array_key_exists('street_name', $address) ? $address['street_name'] : null,
                    'number' => array_key_exists('number', $address) ? $address['number'] : null,
                    'apartment' => array_key_exists('apartment', $address) ? $address['apartment'] : null,
                    'district' => array_key_exists('district', $address) ? $address['district'] : null,
                    'postal_code' => array_key_exists('postal_code', $address) ? $address['postal_code'] : null,
                    'city' => array_key_exists('city', $address) ? $address['city'] : null,
                    'province' => array_key_exists('province', $address) ? $address['province'] : null,
                    'country' => array_key_exists('country', $address) ? $address['country'] : null,
                ]);
            }
        }
        else{
            AddressNaturalPerson::where('id_natural_person', $naturalPerson->id_natural_person)->delete();
        }

        // Redirect to the index page
        return redirect()->route('natural-person.index');
    }

    private function deleteNationalityAndDocuments($naturalPerson)
    {
        // Step 1: Retrieve all related nationalities for the natural person
        $nationalityIds = NationalityNaturalPerson::where('id_natural_person', $naturalPerson->id_natural_person)
            ->pluck('id_nationality');
        // Step 2: Delete dependent identity document records for all retrieved nationalities
        IdentityDocumentNaturalPerson::whereIn('id_nationality', $nationalityIds)->delete();
        // Step 3: Delete all related nationalities for the natural person
        NationalityNaturalPerson::where('id_natural_person', $naturalPerson->id_natural_person)->delete();
        return true;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NaturalPerson $naturalPerson)
    {
        $naturalPerson->delete();
        return redirect()->route('natural-persons.index')->with('success', 'Natural Person deleted successfully!');
    }

    public function saveDatabaseConfig(Request $request)
    {
        $request->validate([
            'DB_CONNECTION' => 'required|string',
            'DB_HOST' => 'required|string',
            'DB_PORT' => 'required|integer',
            'DB_DATABASE' => 'required|string',
            'DB_USERNAME' => 'required|string',
            'DB_PASSWORD' => 'nullable|string',
        ]);

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $str = preg_replace("/DB_CONNECTION=.*/", "DB_CONNECTION=" . $request->DB_CONNECTION, $str);
        $str = preg_replace("/DB_HOST=.*/", "DB_HOST=" . $request->DB_HOST, $str);
        $str = preg_replace("/DB_PORT=.*/", "DB_PORT=" . $request->DB_PORT, $str);
        $str = preg_replace("/DB_DATABASE=.*/", "DB_DATABASE=" . $request->DB_DATABASE, $str);
        $str = preg_replace("/DB_USERNAME=.*/", "DB_USERNAME=" . $request->DB_USERNAME, $str);
        $str = preg_replace("/DB_PASSWORD=.*/", "DB_PASSWORD=" . $request->DB_PASSWORD, $str);

        file_put_contents($envFile, $str);

        return redirect()->back()->with('success', 'Database configuration updated successfully!');
    }

    public function import()
    {
        $ff_apn_es_natural_persons = DB::table('FOR_FF_APN_ES')->select(
            'id','Contract_Type','Part_Rel','Part_Rel_Raison','E_Name','E_surname','E_Country','E_C_Status','E_ID_type','E_ID_No',
            'E_ID_Expire_Date','E_Birth_Date','E_Birth_Place','E_Email','E_Profession','E_Profession_Current','E_Home_Adress','E_Home_Adress_Number','E_Home_Postal_Adress','E_Home_Fax',
            'E_Office_Adress','E_Office_Number','E_Office_Postal_Adress','E_Office_Fax','E_Salary_Independ','account_number'
        )->get();

        return view('natural_persons.import-natural-person', compact('ff_apn_es_natural_persons'));
    }

    public function importNaturalPerson(Request $request)
    {
        $ff_apn_es_ids = $request->naturalPersons;

        foreach ($ff_apn_es_ids as $ff_apn_es_id) {
            try {
                // Fetch the record from the database
                $ff_apn_es_record = DB::table('FOR_FF_APN_ES')->select(
                    'id', 'Contract_Type', 'Part_Rel', 'Part_Rel_Raison', 'E_Name', 'E_surname', 'E_Country', 'E_C_Status', 'E_ID_type', 'E_ID_No',
                    'E_ID_Expire_Date', 'E_Birth_Date', 'E_Birth_Place', 'E_Email', 'E_Profession', 'E_Profession_Current', 'E_Home_Adress', 'E_Home_Adress_Number', 'E_Home_Postal_Adress', 'E_Home_Fax',
                    'E_Office_Adress', 'E_Office_Number', 'E_Office_Postal_Adress', 'E_Office_Fax', 'E_Salary_Independ', 'account_number'
                )->where('id', $ff_apn_es_id)->first();

                if (!$ff_apn_es_record) {
                    throw new \Exception("Record with ID {$ff_apn_es_id} not found.");
                }

                // Normalize the civil status
                $civilStatus = strtolower(trim($ff_apn_es_record->E_C_Status));
                $countryName = strtolower(trim($ff_apn_es_record->E_Country));
                $countryId = CountryList::where("country_smv",$countryName)?->first()?->id;
                //	dd($ff_apn_es_record,$countryId);


                // Update or create the NaturalPerson record
                NaturalPerson::updateOrCreate(
                    [
                        'first_name' => $ff_apn_es_record->E_Name,
                        'last_name' => $ff_apn_es_record->E_surname,
                        'date_of_birth' => $ff_apn_es_record->E_Birth_Date ?? null,
                        'town_of_birth' => $ff_apn_es_record->E_Birth_Place,
                        //      'country_of_birth' => $countryId ?? null,
                        //      'civil_status' => $civilStatus,
                        //     'Profession' => $ff_apn_es_record->E_Profession,
                    ],
                    [
                        'first_name' => $ff_apn_es_record->E_Name,
                        'last_name' => $ff_apn_es_record->E_surname,
                        'date_of_birth' => self::validateDate($ff_apn_es_record->E_Birth_Date) ? $ff_apn_es_record->E_Birth_Date : null,
                        'town_of_birth' => $ff_apn_es_record->E_Birth_Place,
                        //     'country_of_birth' => $ff_apn_es_record->E_Country,
                        //     'civil_status' => $civilStatus,
                        //     'Profession' => $ff_apn_es_record->E_Profession,
                    ]
                );
            } catch (\Exception $e) {
                dd($e->getMessage());
                // Log the error for debugging
                Log::error("Error importing natural person ID {$ff_apn_es_id}: " . $e->getMessage());

                // Optionally, continue to the next record or stop execution
                continue; // Continue with the next record
            }
        }

        return redirect()->route('natural-person.index')->with('success', 'Import completed with some errors (if any). Check logs for details.');
    }


    /**
     * Helper function to validate date format.
     *
     * @param string $date
     * @param string $format
     * @return bool
     */
    public static function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date && $date !== '0000-00-00';
    }
}
