<?php

namespace App\Http\Controllers;
use App\Models\Struct;
use App\Models\Role;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function AffichageStruct()
    {
        $elements = Struct::get();
        return view('admin.addStruct', compact('elements'));
    }

    public function AffichageRole()
    {
        $structs = Struct::get();
        $roles = Role::get();
        return view('admin.addRole', compact('structs','roles'));
    }

    private function generateRandomCode()
    {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 3; $i++) {
            if ($i == 0) {
                $code .= $chars[rand(10, 35)]; // Choisit une lettre
            } else {
                $code .= $chars[rand(0, 9)]; // Choisit un chiffre
            }
        }
        return $code;
    }

    public function store(Request $request)
    {
        $code = $this->generateRandomCode();
        $elements = Struct::create([
            'code' =>$code,
            'name' => $request->name,
        ]);
        return back()->with('structure_created', 'Le bureau a bien été enregistré !
        Le code de votre bureau est ');
    }

    public function storeRole(Request $request)
    {
        $elements = Role::create([
            'structure_id' =>$request->structure_id,
            'name' => $request->name,
        ]);
        return back()->with('structure_created', 'Le bureau a bien été enregistré !
        Le code de votre bureau est ');
    }

}
