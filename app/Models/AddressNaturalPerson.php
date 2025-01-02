<?php

namespace App\Models;

use App\Models\old\CountryList;
use App\Models\old\NaturalPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressNaturalPerson extends Model
{
    use HasFactory;

    protected $table = 'address_natural_person';
    protected $primaryKey = 'id_address';
    public $timestamps = false;

    protected $fillable = [
        'id_address',
        'id_natural_person',
        'type',
        'street_name',
        'number',
        'apartment',
        'district',
        'postal_code',
        'city',
        'province',
        'country',
        'UserName',
        'ComputerName',
        'CreationDate',
        'UserNameLM',
        'ComputerNameLM',
        'DateModified'
    ];

    public function NaturalPerson()
    {
        return $this->belongsTo(NaturalPerson::class, 'id_natural_person');
    }

    public function CountryList()
    {
        return $this->belongsTo(CountryList::class, 'country');
    }
}
