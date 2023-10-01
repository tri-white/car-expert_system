<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    public function diagnosticRules()
    {
        return $this->belongsToMany('App\DiagnosticRule');
    }
}