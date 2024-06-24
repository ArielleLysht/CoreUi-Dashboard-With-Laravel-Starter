<?php

namespace App\Http\Controllers;
use App\Models\Struct;
use App\Models\Role;
use App\Models\Type;
use App\Models\Schema;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function Affichage()
    {
        $type=Type::get();
        return view('admin.viewType',compact('type'));
    }

    public function studentAffichage()
    {
        $type=Type::get();
        return view('student.type',compact('type'));
    }


    public function Create()
    {
        return view('admin.addType');
    }

    public function CreateSchema()
    {
        $typeId = session('type_id');
        $structs = Struct::get();
        $roles = Role::get();
        return view('admin.addSchema', compact('structs','roles','typeId'));
    }


    public function storeType(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'pieces' => 'required|string',
        ]);

       // Création d'une nouvelle instance de modèle pour "Type" et sauvegarde des données des inputs
       $type = new Type();
       $type->nom = $validatedData['nom'];
       $type->pieces = $validatedData['pieces'];
       $type->save();

       
       // Redirection après l'enregistrement réussi
       return redirect()->route('createSchema')->with('type_id', $type->id);
    }

    public function storeSchema(Request $request)
    {
        try {
            $formData = $request->all();
            $typeId = $formData['type_id'];
            $order = $formData['order'];
            
            // Boucle sur les données soumises pour créer les schémas
            foreach ($formData['role_id'] as $roleId) {
                Schema::create([
                    'role_id' => $roleId,
                    'type_id' => $typeId, 
                    'Ordre' => $order,
                ]);
            }

            // Redirection vers la vue appropriée
            return redirect()->route('viewType');
        } catch (\Exception $e) {
            // Gérer les erreurs ici
            return back()->with('error', 'Une erreur s\'est produite lors de la création du schéma.');
        }
    }

    
   
}
