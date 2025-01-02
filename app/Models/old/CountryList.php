<?php

namespace App\Models\old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryList extends Model
{
    use HasFactory;

    protected $table = 'country_list';
    protected $primaryKey = 'id_country';
    public $timestamps = false;

    protected $fillable = [
        'country_smv', 'region_smv', 'country_number_smv', 'risk_value',
        'risk_level', 'high_risk_default', 'country_name_iso_3166',
        'iso_3166_2digits', 'iso_3166_3digits', 'iso_3166_number',
        'DGI_reportable', 'modifiedon', 'modifiedby', 'uid',
        'SMV_Reconocidas', 'country_smv_en', 'value_riesgo_terrorismo',
        'riesgo_terrorismo', 'value_riesgo_armas_destruccion_masiva',
        'riesgo_armas_destruccion_masiva'
    ];
}
