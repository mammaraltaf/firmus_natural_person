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
                // Save each contact data here, e.g., Contact model
                NaturalPersonContact::create([
                    'IDNaturalPerson' => $naturalPerson->id_natural_person,
                    'IDContactType' => $contact['type'],
                    'Data' => $contact['value'],
                    'Note' => $contact['description'],
                    'Authorized' => array_key_exists('authorized',$contact) ? 1 : 0,
                ]);
            }
        }

        if ($request->has('nationalities')) {
            foreach ($request->nationalities as $nationality) {
                // Save each nationality data here, e.g., Nationality model
               $nationalityNaturalPerson =  NationalityNaturalPerson::create([
                    'id_natural_person' => $naturalPerson->id_natural_person,
                    'id_country' => $nationality['country'],
                ]);

                if ($request->has('nationality_documents')) {
                    foreach ($request->nationality_documents as $document) {
                        // Save each nationality document data here, e.g., NationalityDocument model
                        IdentityDocumentNaturalPerson::create([
//                    'id_natural_person' => $naturalPerson->id_natural_person,
                            'id_nationality' => $nationalityNaturalPerson->id_nationality,
                            'type_of_identity_document' => $document['type'],
                            'reference_number' => $document['reference'],
                            'expiration_date' => $document['expiration'],
                        ]);
                    }
                }
            }
        }


        if ($request->has('addresses')) {
            foreach ($request->addresses as $address) {
                // Save each address data here, e.g., Address model
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
            return redirect()->route('natural-person.index');
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
        foreach($ff_apn_es_ids as $ff_apn_es_id){
            $ff_apn_es_record = DB::table('FOR_FF_APN_ES')->select(
                'id','Contract_Type','Part_Rel','Part_Rel_Raison','E_Name','E_surname','E_Country','E_C_Status','E_ID_type','E_ID_No',
                'E_ID_Expire_Date','E_Birth_Date','E_Birth_Place','E_Email','E_Profession','E_Profession_Current','E_Home_Adress','E_Home_Adress_Number','E_Home_Postal_Adress','E_Home_Fax',
                'E_Office_Adress','E_Office_Number','E_Office_Postal_Adress','E_Office_Fax','E_Salary_Independ','account_number'
            )->where('id',$ff_apn_es_id)->first();


            NaturalPerson::updateOrCreate(
                [
                    'first_name' => $ff_apn_es_record->E_Name,
                    'last_name' => $ff_apn_es_record->E_surname,
                    'date_of_birth' => $ff_apn_es_record->E_Birth_Date ?? null,
                    'town_of_birth' => $ff_apn_es_record->E_Birth_Place,
                    'country_of_birth' => $ff_apn_es_record->E_Country,
                    'civil_status' => $ff_apn_es_record->E_C_Status,
                    'Profession' => $ff_apn_es_record->E_Profession,
                ],
                [
                    'first_name' => $ff_apn_es_record->E_Name,
                    'last_name' => $ff_apn_es_record->E_surname,
                    'date_of_birth' => self::validateDate($ff_apn_es_record->E_Birth_Date) ? $ff_apn_es_record->E_Birth_Date : null,
                    'town_of_birth' => $ff_apn_es_record->E_Birth_Place,
                    'country_of_birth' => $ff_apn_es_record->E_Country,
                    'civil_status' => $ff_apn_es_record->E_C_Status,
                    'Profession' => $ff_apn_es_record->E_Profession,
                ]
            );
        }

        return redirect()->route('natural-person.index');
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
