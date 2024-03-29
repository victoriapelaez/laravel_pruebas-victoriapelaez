<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Models\Contacto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index-contacto');
        $datos = DB::table('contactos')
            ->where('deleted_at', null)
            ->where('user_id', Auth::id())
            ->orderBy('id', 'asc')
            ->get();

        return view('contactos.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $this->authorize('create', $user);
        return view('contactos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ContactoRequest $request)
    {
        $this->authorize('create', new User());

        //Raw
        /*$nombre = $request->nombre;
        $apellido = $request->apellido;
        $telefono = $request->telefono;
        $email = $request->email;
        $edad = $request->edad;
        $nacimiento = $request->nacimiento;
        $idioma = $request->idioma;
        $descripcion = $request->descripcion;
        $color = $request->color;
        $privacidad = $request->privacidad;
        $user_id = $request->user()->id;

        DB::insert('insert into contactos (nombre, apellido, telefono, email, edad, nacimiento, idioma, descripcion,color,privacidad, user_id)
        values ($nombre, $apellido, $telefono, $email, $edad, $nacimiento, $idioma, $descripcion,$color,$privacidad, $user_id)');
        */

        //Query Builder
        /*DB::table('contactos')->insert([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'edad' => $request->edad,
            'nacimiento' => $request->nacimiento,
            'idioma' => $request->idioma,
            'descripcion' => $request->descripcion,
            'color' => $request->color,
            'privacidad' => $request->privacidad,
            'user_id' => $request->user()->id
        ]);*/

        //Eloquent
        $contacto = Contacto::create($request->all());
        if ($request->hasFile('foto')) {
            $contacto['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        $contacto->user_id = Auth::id();
        $contacto->save();

        return redirect('contactos')->with('mensaje', __("message.agregado"));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {

        return view('contactos.show', compact('contacto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, User $user)
    {
        $this->authorize('update', $user);
        $datos = Contacto::findOrFail($id);
        return view('contactos.edit', compact('datos'));

        /*return view('contactos.edit', compact('contacto'));*///Poner Contacto$contacto como parámetro y cambiar $datos en index
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactoRequest $request, $id, User $user)
    {
        $this->authorize('update', $user);

        Contacto::where('id', '=', $id)->update($request->except(['_token', '_method']));

        return redirect('contactos')->with('mensaje', __("message.actualizado"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete-contacto')) {
            Abort(403);
        }
        /*$this->authorize('delete',$user);*/

        $contacto = Contacto::findOrFail($id);
        if (Storage::delete('public/' . $contacto->foto)) {
            Contacto::destroy($id);
        }


        return redirect('contactos')->with('mensaje', __("message.borrado"));
    }
}
