
<h1>{{$modo}} Empleado</h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
    </ul>
    </div>
@endif


<div class="form-group">
<label for="Nombre">Ingrese su nombre:</label>
<input type="text" class="form-control" name="Nombre" value="{{isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}" > <br>


<label for="PrimerApellido">Ingrese su Primer Apellido:</label>
<input type="text" class="form-control" name="PrimerApellido" value="{{isset($empleado->PrimerApellido)?$empleado->PrimerApellido:old('PrimerApellido')}}" ><br>

<label for="SegundoApellido">Ingrese su Segundo Apellido:</label>
<input type="text" class="form-control" name="SegundoApellido" value="{{isset($empleado->SegundoApellido)?$empleado->SegundoApellido:old('SegundoApellido')}}" ><br>

<label for="Correo">Ingrese su Correo Electronico:</label>
<input type="text" class="form-control" name="Correo" value="{{isset($empleado->Correo)?$empleado->Correo:old('Correo')}}" ><br>

<label for="foto">Ingrese su Foto(pocional):</label><br>
@if(isset($empleado->Foto))
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Foto}}" width="120" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" ><br>
</div>
<input class="btn btn-success" type="submit" name="" value="{{$modo}} datos">

<a class="btn btn-primary" href="{{url('empleado/')}}">Regresar</a>
