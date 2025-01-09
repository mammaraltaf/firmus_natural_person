<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    use HasFactory;

    protected $table = 'ContactType';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['ID', 'Type'];
}
