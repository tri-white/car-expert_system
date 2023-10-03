<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Malfunction extends Model
{
    public function diagnosticRules()
    {
        return $this->belongsToMany('App\DiagnosticRule');
    }
    public function symptoms()
{
    return $this->belongsToMany(Symptom::class, 'diagnostic_rules', 'malfunction_id', 'symptom_id');
}
}