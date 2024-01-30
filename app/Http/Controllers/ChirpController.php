<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('chirps.index', [
            // PRECARGAMOS LOS USUARIOS PARA NO CREAR CONSULTAS INNECESARIAS (PROBLEMA N+1) 
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  VALIDACION
        $validate = $request->validate([
            'messege' => ['required', 'min:3'],
        ]);
        // INSERT INTO DATE BASE - CREANDO RELACION DE TRABLAS
        auth()->user()->chirps()->create($validate);
        // DOS METODOS DE MENSAJES VALIDADOS POR LA SESSION 
        // session()->flash('status','Chirp creado exitosamente');
        return to_route('chirps.index')->with('status','Chirp creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);
        return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        
        $this->authorize('update' , $chirp);
        //  VALIDACION
        $validate = $request->validate([
            'messege' => ['required', 'min:3'],
        ]);

        $chirp->update($validate) ;

        return to_route('chirps.index')->with('status', 'Chirp Actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete' , $chirp);

        $chirp->delete();

        return to_route('chirps.index')->with('status', 'Chirp Eliminado exitosamente');
    }
}
