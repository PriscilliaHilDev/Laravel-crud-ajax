<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Images;


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
                $image = new Image;
                
                $contact->nom         = $request->nom ;
                $contact->prenom      = $request->prenom ;
                $contact->email       = $request->email ;
               

                if($request->hasFile('avatar')) {
                  
                    $originalImage= $request->file('avatar');
                    $thumbnailImage = Images::make($originalImage);
                    $thumbnailAbolutePath = public_path().'/storage/thumbnails/';
                    $originalAbsolutePath = public_path().'/storage/avatars/';
                    $nameFile = time().$originalImage->getClientOriginalName();
                    $thumbnailImage->save($originalAbsolutePath.$nameFile);
                    $thumbnailImage->resize(150,150);
                    $thumbnailImage->save($thumbnailAbolutePath.$nameFile); 
                    $pathThumb = "thumbnails/".$nameFile;

                    // $pathImg = $request->file('avatar')->storeAs(
                    //     'avatars',
                    //     $fileName,
                    //     'public'
                    // );

                    $image->path = $pathThumb;

                }else{
                    $image->path = "thumbnails/default-avatar.jpg";
                }

                $query = $contact->save();
                $queryImg = $contact->image()->save($image);

                if( $query && $queryImg){

                    $maxID = Contact::orderBy('id', 'desc')->value('id'); 
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
