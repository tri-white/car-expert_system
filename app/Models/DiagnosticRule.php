<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticRule extends Model
{
    public function symptom()
    {
        return $this->belongsTo('App\Symptom');
    }

    public function malfunction()
    {
        return $this->belongsTo('App\Malfunction');
    }
}