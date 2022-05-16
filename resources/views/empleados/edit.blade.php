@extends('layouts.app')

@section('title','Edit')

@section('content')

    <div class="modal-content">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{route('empleados.index')}}" class="btn btn-primary me-md-2" type="button" id="agregar"><i
                    class="fas fa-eye"></i>
                </i>Empleados</a>
        </div>

        <div class="modal-content">
            <form action="{{ route('empleados.update',$empleados->id) }}" id="form" method="POST"
                  enctype="multipart/form-data"
                  class="bg-white w-1/3 p-4 border-gray-100 shadow-xl rounded-lg">

                @csrf
                @method('PATCH')
                <h2 class="text-2x1 text-center py-4 mb-4 font-semibold">Editar Empleado {{$empleados->nombre}}</h2>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo*</label>
                    <input type="text" id="nombre" name="nombre" class="form-control"
                           placeholder="Nombre completo del empleado" value="{{$empleados->nombre}}">
                </div>

                @error('nombre')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
        text-red-500 p-2 my-2"> {{$message}} </p>
                @enderror

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electronico*</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Correo electronico"
                           value="{{$empleados->email}}">
                </div>

                @error('email')
                <p class="border border-red-500 rounded-md bg-red-100 w-full
             text-red-500 p-2 my-2">* {{$message}}</p>
                @enderror

                <fieldset class="my-2">
                    <legend class="col-form-label col-sm-2 pt-0">Sexo*</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input type=radio name="sexo" value="M" {{ $empleados->sexo == 'M' ? 'checked' : ''}}>Masculino</option>

                        </div>
                        <div class="form-check">
                            <input type=radio name="sexo" value="F" {{ $empleados->sexo == 'F' ? 'checked' : ''}}>Femenino</option>
                        </div>
                    </div>
                </fieldset>

                <div class="mb-3">
                    <label for="area_id" class="form-label">Area*</label>
                    <select name="area_id" id="inputArea_id" class="form-select">

                        @foreach ($areas as $area )
                            <option value="{{$area->id}}"{{$area->id == $empleados->area_id ? 'selected': ''}}>
                                {{$area->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="descripcion" class="form-label">Descripcion*</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3">
                              {{$empleados->descripcion}}</textarea>
                </div>

                @error('descripcion')
                <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-500 p-2 my-2">
                    * {{$message}}</p>
                @enderror

                <div class="form-check">

                    <input type="hidden" name="boletin" id="boletin" value="1">

                    <input class="form-check-input" type="checkbox" name=""
                           id="boletinCheck" {{ $empleados->boletin == '1' ? 'checked' : ''}}>
                    <label class="form-check-label" for="boletin">
                        Deseo recibir boletin informativo
                    </label>
                </div>


                <fieldset>
                    <label for="roles" class="form-label" id="roles">Roles*</label>
                    @foreach($roles as $rol)

                        <div class="sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" value="{{$rol->id}}"
                                       @foreach($rolesEmpleado as $rolEmpleado)
                                       @if($rolEmpleado->rol_id ==$rol->id) checked @endif
                                    @endforeach>{{$rol->nombre}}
                            </div>
                        </div>

                    @endforeach
                </fieldset>
                <div class="mb-3">

                    <label for="archivo" class="form-label">Archivo*</label>
                    <input class="form-control form-control-file" name="archivo" type="file" id="archivo">
                    <iframe src="{{asset('storage').'/'.$empleados->archivo}}" alt="" Width="450" Height="400"></iframe>
                </div>

                @error('archivo')
                <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-500 p-2 my-2">
                    * {{$message}}</p>
                @enderror


                <button type="submit" id="enviarr"
                        class="my-3 w-full btn btn-outline-primary p-2 font-semibold rounded text-black hover:bg-600 ">
                    Modificar
                </button>


            </form>

            <script>
                $(document).ready(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $("#form").submit(function (e) {
                        e.preventDefault();

                        var formulario = new FormData(this);
                        var boletinCheck = document.getElementById('boletinCheck');
                        var boletin = document.getElementById('boletin');
                        //console.log(formulario);
                        if (boletinCheck.checked == false) {
                            boletin.value = 0;
                        }
                        $.ajax({

                            url: '{{route('empleados.update',$empleados->id)}}',
                            type: 'POST',
                            data: formulario,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);

                                if (data.success == 'true') {

                                    swal.fire(" ¡Empleado actualizado! ", " Empleado Actualizado correctamente ", "success").then(() => {
                                        window.location.href = "{{ route('empleados.index') }}"
                                    });
                                } else {
                                    swal.fire(" ¡Empleado no actualizado! " + data.mensaje,
                                        "Complete toda la información y valide los datos", "error");
                                }

                            },

                        });
                    });

                });

            </script>
@endsection
