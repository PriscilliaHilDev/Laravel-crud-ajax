<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Note;


class Contact extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * allow mass assigment
     */
    protected $fillable = [
        'nom',
        'email',
        'prenom'
    ];

    // relation onetoone : un contact à une unique image et une image appartient à un unique contact
    
    public function image (){
        return $this->hasOne(Image::class);
    }

    public function notes (){
        return $this->hasMany(Note::class);
    }
}
