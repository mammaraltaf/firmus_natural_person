<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfIdentityDocument extends Model
{
    use HasFactory;

    protected $table = 'type_of_identity_documents';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['id', 'type'];
}
