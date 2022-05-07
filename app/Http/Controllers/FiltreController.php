<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class FiltreController extends Controller
{
    
    public function filtreContact (String $membre) {

        $contactFiltre;

        switch ($membre) {
            case 'famille':
                $contactFiltre = Contact::where('membres', "=", 'Famille')->orderBy('created_at', 'desc')->get();  
                break;
            
            case 'amis':
                $contactFiltre = Contact::where('membres', "=", 'Ami(e)s')->orderBy('created_at', 'desc')->get();  
                break;

            case 'collegues':
                $contactFiltre = Contact::where('membres', "=", 'Collegues')->orderBy('created_at', 'desc')->get();  
                break;

            case 'autres':
                $contactFiltre = Contact::where('membres', "=", NULL)->orderBy('created_at', 'desc')->get();  
                break;
            
            default:
                $contactFiltre = "inconnu";
                break;
        }

        return view('contacts.filtre', [
            'contacts' => $contactFiltre
        ]);

    }
}
