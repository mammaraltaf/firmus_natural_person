<?php

namespace App\Models;

use App\Models\old\CivilStatus;
use App\Models\old\CountryList;
use App\Models\old\Profession;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NaturalPerson extends Model
{
    use HasFactory;

    protected $table = 'natural_person';
    protected $primaryKey = 'id_natural_person';
    public $timestamps = false;

    protected $fillable = [
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'other_last_name',
        'given_name',
        'date_of_birth',
        'town_of_birth',
        'country_of_birth',
        'civil_status',
        'Profession',
        'TaxNumber',
        'digitoVerificadorRUC',
        'codigoUbicacion'
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'Profession', 'ID');
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class, 'civil_status', 'id');
    }

    public function country()
    {
        return $this->belongsTo(CountryList::class, 'country_of_birth', 'id_country');
    }


    public function nationalities(): HasMany
    {
        return $this->hasMany(NationalityNaturalPerson::class,'id_natural_person','id_natural_person');
    }

    public function naturalPersonContacts(): HasMany
    {
        return $this->hasMany(NaturalPersonContact::class, 'IDNaturalPerson', 'id_natural_person');
    }

    public function addressNaturalPersons(): HasMany
    {
        return $this->hasMany(AddressNaturalPerson::class, 'id_natural_person' , 'id_natural_person');
    }
}
