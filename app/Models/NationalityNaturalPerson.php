<?php

namespace App\Models;

use App\Models\old\CountryList;
use App\Models\old\NaturalPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalityNaturalPerson extends Model
{
    use HasFactory;

    protected $table = 'nationality_natural_person';
    protected $primaryKey = 'id_nationality';
    public $timestamps = false;

    protected $fillable = ['id_nationality', 'id_natural_person', 'id_country'];

    public function NaturalPerson()
    {
        return $this->belongsTo(NaturalPerson::class, 'id_natural_person');
    }

    public function CountryList()
    {
        return $this->belongsTo(CountryList::class, 'id_country');
    }
}
