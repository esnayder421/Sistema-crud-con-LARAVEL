<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facedes\Storage;
use App\Models\Empleado;
use Illuminate\Http\Request;



class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados']=Empleado::paginate(5);
        return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //-------------------------------------Insertar------------------------------------------------
    public function store(Request $request)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',
            'PrimerApellido'=>'required|string|max:100',
            'SegundoApellido'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje=[
            'required'=>'El :attribute es obligatorio',
            'Foto.required'=>'la Foto es obligatoria'
        ];
        $this->validate($request, $campos, $mensaje);




        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Empleado::insert($datosEmpleado);

        //return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje','Empleado agregado con Exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado=Empleado::findOrfail($id);

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'PrimerApellido'=>'required|string|max:100',
            'SegundoApellido'=>'required|string|max:100',
            'Correo'=>'required|email',
            //'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje=[
            'required'=>'El :attribute es obligatorio',
            //'Foto.required'=>'la Foto es obligatoria'
        ];
        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'la Foto es obligatoria'];
        }
        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->except('_token','_method');

        if($request->hasFile('Foto')){

            $empleado=Empleado::findOrfail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Empleado::where('id','=',$id)->update($datosEmpleado);

        $empleado=Empleado::findOrfail($id);

       // return view('empleado.edit', compact('empleado'));
       return redirect('empleado')->with('mensaje','Empleado Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado=Empleado::findOrfail($id);
        //if(Storage::delete('public/'.$empleado->Foto))
        Empleado::destroy($id);
        return redirect('empleado')->with('mensaje','Empleado Borrado');
    }
}
