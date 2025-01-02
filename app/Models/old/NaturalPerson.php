<?php

namespace App\Models\old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaturalPerson extends Model
{
    use HasFactory;

    protected $table = 'natural_person';
    protected $primaryKey = 'id_natural_person';
    public $timestamps = false;

    protected $fillable = [
        'prefix', 'first_name', 'middle_name', 'last_name', 'other_last_name',
        'given_name', 'date_of_birth', 'town_of_birth', 'country_of_birth',
        'civil_status', 'Profession', 'TaxNumber', 'digitoVerificadorRUC',
        'codigoUbicacion'
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'Profession');
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class, 'civil_status');
    }

    public function country()
    {
        return $this->belongsTo(CountryList::class, 'country_of_birth');
    }
}
