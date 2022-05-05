<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;

class Image extends Model
{
    use HasFactory;

    // recupérer un contact à partir d'une image
    public function contact() {
        return $this->belongsTo(Contacts::class);
    }
}




