<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManager;

use App\Models\Type;
use App\Models\Compte;
use App\Models\Schema;
use App\Models\Salary;
use App\Models\Requete;
use App\Models\Piece;
use App\Models\Role;
use App\Models\Struct;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RequeteController extends Controller
{
    public function addReq(Request $request)
    {
        $id = $request->input('id'); 
        $user = auth()->user();
        $student = Compte::where('id',$user->compte_id)->get();
        $ref = $user->compte_id ;
        $types = Type::findOrFail($id);
        $office = Schema::where('type_id',$id)->where('Ordre','1')->value('role_id');
        $post = Salary::where('role_id',$office)->get();
        $role = Role::where('id',$office)->get();
        $role_id = Role::where('id',$office)->value('id');
        $struct = Struct::where('id',$role_id)->get(); 
        // dd($struct);  
        $phrase = $types->pieces; 
        $mots = explode(",", $phrase);
        return view('student.reqConstruction', compact('mots','id','student','types','ref','post','role','struct'));
    }

    public function allReq()
    {
        $user = auth()->user();
        $employe = Salary::get();
        $req = Requete::where('user_id',$user->compte_id)->get();
        $type = Type::get();
        $post = Role::get();
        $bureau = Struct::get();
        return view('student.allReq', compact('req','employe','type','post','bureau'));
    }

    public function Requete()
    {

        $user = auth()->user();
        $employe = Salary::where('email',$user->email)->value('role_id');
        $student = Compte::get();
        $req = Requete::where('role_id',$employe)->get();
        $type = Type::get();
        return view('salary.all', compact('req','type', 'student'));

    }

    public function Traitement(Request $request)
    {
        $user = auth()->user();
        $id = $request->input('id');
        $requete = Requete::find($id);  
        $req = Requete::where('id',$id)->get();
        $doc = Piece::where('requete_id',$requete->id)->get();
        $employe = Salary::where('email',$user->email)->get();
        $student = Compte::get();
        $type = Type::get();
        $piece = Piece::where('requete_id',$id)->get();

        // dd($piece);
        // Prepare image data for the view (optional)
        $processedImages = [];
        foreach ($piece as $image) {
            $processedImages[] = [
                'id' => $image->id,  // Optional: include ID for reference
                'nom' => $image->nom,
                'dataUri' => 'data:image/jpeg;base64,' . base64_encode($image->file_content)
            ];
        }

        return view('salary.traitement', compact('req', 'type', 'student', 'doc', 'employe', 'piece', 'processedImages'));
    }


    public function Valider(Request $request, $id){
        $requete = Requete::find($id); 
        $reqId = Requete::where('type_id',$requete->type_id)->value('type_id');
        $responsableActuel = Schema::where('role_id',$requete->role_id)->where('type_id',$requete->type_id)->value('Ordre');
        $bureau = $responsableActuel + 1;
        $responsableSuivant = Schema::where('Ordre',$bureau)->where('type_id',$requete->type_id)->value('role_id');
        $items = Schema::where('type_id', $reqId)->orderBy('Ordre')->get();
        $count = 0;

        foreach ($items as $item) {
            $count++;
        }

        if ($count === $items->count()) {
            $requete->statut = 'Acceptée';
            $responsableSuivant = $responsableActuel;
        }else{
            $requete->statut = 'En cours';
        }
        Requete::where('id', $id)->update([
            'statut' =>$requete->statut,
            'role_id' =>$responsableSuivant,
        ]);
        return redirect()->route('requete');
    }

    public function Refuser(Request $request, $id){

        $requete = Requete::find($id);
        Requete::where('id', $id)->update([
            'statut' =>'Refusée',
        ]);
        return redirect()->route('requete');
    }


    public function storeReq(Request $request) {
        $Ordre = 1;
        $user = $request->input('compte_id');
        $employeEnCharge = Schema::where('Ordre', $Ordre)
                                 ->where('type_id', $request->type_id)
                                 ->value('role_id');
        $requete = Requete::create([
            'user_id' => $user,
            'type_id' => $request->input('type_id'),
            'role_id'=> $employeEnCharge,
            'niveau'=> $request->input('niveau'),
            'annee'=> $request->input('annee'),
        ]);
    
        // Parcourir les noms des pièces jointes
        foreach ($request->input('nom') as $index => $nomPiece) {
            // Parcourir les fichiers pour chaque pièce jointe
            if ($request->hasFile('piece_jointe_' . $index)) {
                foreach ($request->file('piece_jointe_' . $index) as $file) {
                    // Vérifier si le fichier est valide
                    if ($file->isValid()) {
                        // Récupérer le nom d'origine du fichier
                        $fileName = $file->getClientOriginalName();
                        
                        // Stocker le fichier
                        $filePath = $file->store('piece_jointe');
    
                        // Lire le contenu du fichier
                        $fileContent = Storage::get($filePath);
                            
                        // Créer une nouvelle instance de modèle pour la pièce jointe
                        $piece = new Piece;
                        $piece->requete_id = $requete->id;
                        $piece->nom = $nomPiece;
                        $piece->file_name = $fileName;
                        $piece->file_content = $fileContent;
                        $piece->save();
                    }
                }
            }
        }
    
        return redirect()->route('allReq');    
    }


    
}
