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
                $contactFiltre = Contact::where('membres', "=", 'Famille')->orderBy('created_at', 'desc')->paginate(2);  
                break;
            
            case 'amis':
                $contactFiltre = Contact::where('membres', "=", 'Ami(e)s')->orderBy('created_at', 'desc')->paginate(2);  
                break;

            case 'collegues':
                $contactFiltre = Contact::where('membres', "=", 'Collegue')->orderBy('created_at', 'desc')->paginate(2);  
                break;

            case 'autres':
                $contactFiltre = Contact::where('membres', "=", NULL)->orderBy('created_at', 'desc')->paginate(2);  
                break;
            
            default:
                $contactFiltre = "inconnu";
                break;
        }

        $lastPage =  $contactFiltre->lastPage();
        $total =  $contactFiltre->total();
        $currentPage =  $contactFiltre->currentPage();


        return view('contacts.filtre', [
            'contacts' => $contactFiltre,
            'lastPage' =>$lastPage,
            'total' => $total,
            'currentPage'=>$currentPage
        ]);

    }
}
