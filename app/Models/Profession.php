<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $table = 'Profession';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['Code', 'ActivityName', 'RiskValue', 'RiskLevel', 'HighRiskAutomatic'];
}
