<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Image;


class ContactController extends Controller
{
    public $contacts;

    public function __construct()
    {
        $this->contacts = Contact::orderBy('created_at', 'desc')->get();  
    }


    public function fetchAllContacts () {

        $data = view('ajax-render.list-contact')->with('contacts', $this->contacts)->render();
        return response()->json(['code'=>1,'result'=>$data]);

    }

    public function addContact (Request $request) {

        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:100',
            'prenom' => 'required',
            'email' =>'required',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048'
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

                  
                    $originalImage= $request->file('avatar');
                    $thumbnailImage = Image::make($originalImage);
                    $thumbnailPath = public_path().'/storage/thumbnails/';
                    $originalPath = public_path().'/storage/avatars/';
                    $nameFile = time().$originalImage->getClientOriginalName();
                    $thumbnailImage->save($originalPath.$nameFile);
                    $thumbnailImage->resize(150,150);
                    $thumbnailImage->save($thumbnailPath.$nameFile); 
                    $pathThumb = "thumbnails/".$nameFile;

                    //fin thumb

                    // img normale
                    // $fileName = time(). '.' .$request->avatar->extension();

                    // $pathImg = $request->file('avatar')->storeAs(
                    //     'avatars',
                    //     $fileName,
                    //     'public'
                    // );

            
                    $contact->image_url = $pathThumb;


                }else{
                    
                    $contact->image_url = "avatars/default-avatar.jpg";
                }

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
                    
                    // delete old img 
                    if($getContact->image_url !== null){
                        // $oldPath = (Storage::url($getContact->image_url));
                        if(Storage::disk("public")->exists($getContact->image_url)){
                            Storage::disk("public")->delete($getContact->image_url);
                        }
                        
                    }

                    $fileName = time(). '.' .$request->avatar->extension();
                    $pathImg = $request->file('avatar')->storeAs(
                        'avatars',
                        $fileName,
                        'public'
                    );

                    $getContact->image_url  = $pathImg;

                }

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
