<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{

    public function index()
    {
        /*if (Gate::allows('index-agenda')) {
            return view('index');
        }
        Abort(403);*/
        /*  abort_unless(Gate::allows('index-agenda'), 403);
          return view('index');*/

        $this->authorize('index-agenda');
        //$datos=DB::table('agenda')->select('nombre','apellido','teléfono','email')->get();
        //$datos['agenda']=Contacto::paginate(5);
        $datos = Contacto::all();
        return view('agenda.index', compact('datos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosagenda = request()->all();
        $datosagenda = request()->except('_token');
        if ($request->hasFile('foto')) {
            $datosagenda['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Contacto::insert($datosagenda);
        //return response()->json($datosagenda);
        return redirect('agenda');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacto = Contacto::findOrFail($id);
        return view('agenda.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosagenda = request()->except(['_token', '_method']);

        if ($request->hasFile('foto')) {
            $contacto = Contacto::findOrFail($id);
            Storage::delete('public/' . $contacto->foto);
            $datosagenda['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Contacto::where('id', '=', $id)->update($datosagenda);

        $contacto = Contacto::findOrFail($id);
        //return view('agenda.edit', compact('contacto'));
        return redirect('agenda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);
        if (Storage::delete('public/' . $contacto->foto)) {
            Contacto::destroy($id);
        }

        return redirect('agenda');
    }
}
