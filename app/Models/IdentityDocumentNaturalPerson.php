<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentityDocumentNaturalPerson extends Model
{
    use HasFactory;

    protected $table = 'identity_document_natural_person';
    protected $primaryKey = 'id_identity_document';
    public $timestamps = false;

    protected $fillable = [
        'id_identity_document',
        'id_nationality',
        'type_of_identity_document',
        'reference_number',
        'expiration_date'
    ];
}
