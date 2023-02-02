<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Plant;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /** 
     * @index LISTA lista de contactos de una sucursal
      */
    public function index(Plant $plant){
        return response()->json($plant->contacts, 200);
    }

    /**
     * @store CREA un nuevo contacto
     */
    public function store(Request $request){
        $contact = Contact::create($request->all());
        return response()->json($contact, 201);
    }

    // public function update(Request $request, Contact $contact){
        
    // }
}
