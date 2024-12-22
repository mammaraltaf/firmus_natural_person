<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    use HasFactory;

    protected $table = 'civil_status';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['type'];
}
