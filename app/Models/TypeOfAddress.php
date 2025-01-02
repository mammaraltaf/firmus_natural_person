<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfAddress extends Model
{
    use HasFactory;

    protected $table = 'type_of_address';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['ID', 'Type'];
}
