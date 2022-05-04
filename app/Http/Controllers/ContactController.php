<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ContactController extends Controller
{
    public $contacts;

    public function __construct()
    {
        $this->contacts = Contact::orderBy('created_at', 'desc')->get();  
    }

    // public function index () {
    
    //     return view('contacts.list', [
    //         'contacts' => $this->contacts
    //     ]);
    // }

    public function fetchAllContacts () {

        $data = view('ajax-render.list-contact')->with('contacts', $this->contacts)->render();
        return response()->json(['code'=>1,'result'=>$data]);

    }


    public function addContact (Request $request) {

        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:100',
            'prenom' => 'required',
            'email' =>'required',
        ]);
       
        if($request->ajax()){

            if(!$validator->passes()){

                return response()->json(["status"=> 0, 'error'=> $validator->errors()->toArray()]);

            }else{
                $contact = new Contact;
                
                $contact->nom         = $request->nom ;
                $contact->prenom      = $request->prenom ;
                $contact->email       = $request->email ;

                if($request->hasFile('avatar')) {
                    
                    $fileName = time(). '.' .$request->avatar->extension();

                    $pathImg = $request->file('avatar')->storeAs(
                        'avatars',
                        $fileName,
                        'public'
                    );

                    $contact->image_url  = $pathImg;
                };

                $query = $contact->save();

                if( $query ){
                    $maxID = Contact::orderBy('id', 'desc')->value('id'); 
                    $oneContact = $contact;
                    return response()->json(['status'=>1, 
                                            'msg'=>'New Student has been successfully registered',
                                            'id'=>$maxID
                    ]);
                }
            }
        }else{
            return view('errors.ajax');
        }
    }

    public function detailContact (Int $id, Request $request){

        $currentContact = Contact::find($id);

        if($request->ajax()){

            if($currentContact){
                return response()->json($currentContact);
            }else{
                return response()->json(["msg" => "contact introuvable"]);
            }

        }else{
            return view('errors.ajax');
        }
    }

    public function editContact (Request $request, Int $id) {
        
        $getContact = Contact::find($id);
       
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:100',
            'prenom' => 'required',
            'email' =>'required'
        ]);
       
         if($request->ajax()){

            if(!$validator->passes()){

                return response()->json(["status"=> 0, 'error'=> $validator->errors()->toArray()]);
    
            }else{
        
                $getContact->nom = $request->nom;
                $getContact->prenom = $request->prenom;
                $getContact->email = $request->email;
            
                if($request->hasFile('avatar')) {
                    
                    $fileName = time(). '.' .$request->avatar->extension();

                    $pathImg = $request->file('avatar')->storeAs(
                        'avatars',
                        $fileName,
                        'public'
                    );

                    $getContact->image_url  = $pathImg;
                };

                $query = $getContact->save();
    
                if( $query ){

                    return response()->json(['status'=>1,
                                             'msg'=>'Mise à jour réussite !',
                                             'contacts'=> $this->contacts->toArray(),
                                             'update' => $getContact
                                            ]);
                }
            }
               
        }else{

            return view('errors.ajax');
        } 
    }
}
