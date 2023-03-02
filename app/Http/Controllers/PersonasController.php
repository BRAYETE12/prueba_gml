<?php

namespace App\Http\Controllers;

use App\Events\NuevaPersona;
use App\Models\Persona;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Persona::with('categoria')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonaRequest $request)
    {
        $persona = Persona::create($request->all());
        $persona->categoria = $persona->categoria;
        NuevaPersona::dispatch($persona, ["counter" => 0]);
        
        return ['success'=> true, 'registro'=> $persona ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonaRequest  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonaRequest $request, Persona $persona)
    {
        $persona->fill($request->all())->save();
        $persona->categoria = $persona->categoria;
        NuevaPersona::dispatch($persona);
        
        return ['success'=> true, 'registro'=> $persona ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        if($persona->delete()){
            return [ 'success'=>true ];
        }

        return [ 'success'=>false ];
    }
}
