<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaturalPersonContact extends Model
{
    use HasFactory;

    protected $table = 'Natural_Person_Contact';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ID',
        'IDNaturalPerson',
        'IDContactType',
        'Data',
        'Note',
        'Priority',
        'Authorized',
        'UserName',
        'ComputerName',
        'CreationDate',
        'UserNameLM',
        'ComputerNameLM',
        'DateModified'
    ];
}
