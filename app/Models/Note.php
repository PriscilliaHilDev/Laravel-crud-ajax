<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ["content"];


    // recupérer un contact à partir d'une note
    public function contact() {
        return $this->belongsTo(Contacts::class);
    }
}
