<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Images;


class ContactController extends Controller
{
    public $contacts;

    public function __construct()
    {
        $this->contacts = Contact::orderBy('created_at', 'desc')->paginate(2);  
    }

    public function listContact (Request $request) {
       
        $data;

        if($request->ajax() && !$request->type){

            $data = view('ajax-render.list-contact')->with('contacts', $this->contacts)->render();
            return response()->json(['code'=>1,'result'=>$data]);
        }

        if($request->ajax() && $request->type == "pagination"){

            $data = view('ajax-render.list-contact-pagination')->with('contacts', $this->contacts)->render();
            return response()->json(['code'=>1999,'result'=>$data]);
        }

        $lastPage =  $this->contacts->lastPage();
        $total =  $this->contacts->total();
        $currentPage =  $this->contacts->currentPage();

        return view('contacts.list', [
            "contacts" => $this->contacts,
            'lastPage' =>$lastPage,
            'total' => $total,
            'currentPage'=>$currentPage
        ]);
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
                $contact->membres     = $request->membres ;
            
                if($request->hasFile('avatar')) {
                  
                    $originalImage= $request->file('avatar');
                    $thumbnailImage = Images::make($originalImage);
                    $thumbnailAbolutePath = public_path().'/storage/thumbnails/';
                    // $originalAbsolutePath = public_path().'/storage/avatars/';
                    $nameFile = time().$originalImage->getClientOriginalName();
                    // $thumbnailImage->save($originalAbsolutePath.$nameFile);
                    $thumbnailImage->resize(200,200);
                    $thumbnailImage->save($thumbnailAbolutePath.$nameFile); 
                    $pathThumb = "thumbnails/".$nameFile;

                    // $pathImg = $request->file('avatar')->storeAs(
                    //     'avatars',
                    //     $fileName,
                    //     'public'
                    // );

                    $image->path = $pathThumb;

                }

                // je dois creer le contact avant de l'envoie dans la table image one to one
                $query = $contact->save();
                $queryImg = $contact->image()->save($image);

                if( $query && $queryImg){

                    $maxID = Contact::orderBy('id', 'desc')->value('id'); 
                    return response()->json([   
                        'status'=>1, 
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
                return response()->json(['result'=>$currentContact,'img'=>$currentContact->image->path]);
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
                $getContact->membres = $request->membres ;
            
                if($request->hasFile('avatar')) {

                    $originalImage= $request->file('avatar');
                    $thumbnailImage = Images::make($originalImage);
                    $thumbnailAbolutePath = public_path().'/storage/thumbnails/';
                    // $originalAbsolutePath = public_path().'/storage/avatars/';
                    $nameFile = time().$originalImage->getClientOriginalName();
                    // $thumbnailImage->save($originalAbsolutePath.$nameFile);
                    $thumbnailImage->resize(200,200);
                    $thumbnailImage->save($thumbnailAbolutePath.$nameFile); 
                    $pathThumb = "thumbnails/".$nameFile;
                

                    // delete old img 
                    if($getContact->image->path !== "images/default-avatar.jpg"){

                        $oldThumbnail = $getContact->image->path;

                        if(Storage::disk("public")->exists($oldThumbnail)){
                            Storage::disk("public")->delete($oldThumbnail);
                        }

                        // $nameOldThumb = substr($oldThumbnail, 11,strlen($oldThumbnail));
                           
                    }

                    // le contact existe déjà donc on procede à la mise a jour de l'img si une nouvelle a ete posté
                    $getContact->image->path = $pathThumb;
                    $queryImg = $getContact->image()->update([
                        'path' => $pathThumb,
                    ]);
                }

                $query = $getContact->save();
    
                if( $query ){

                    return response()->json([
                        'status'=>1,
                        'msg'=>'Mise à jour réussite !',
                        'contacts'=> $this->contacts->toArray(),
                        'update' => $getContact,
                        'img'=> $getContact->image->path
                    ]);
                }
            }
               
        }else{

            return view('errors.ajax');
        } 
    }

    public function deleteContact (Int $id, Request $request){

        $deleteContact = Contact::find($id);

        if($request->ajax()){

            $actionDelete = $deleteContact->delete();

            if($actionDelete){
                return response()->json(['msg'=> 'contact supprimé avec succès']);
            }else{
                return response()->json(["msg" => "Une erreur s'est produite"]);
            }

        }else{
            return view('errors.ajax');
        }
    }
}
