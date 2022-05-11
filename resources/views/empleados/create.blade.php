@extends('layouts.app')

@section('title','Create')

@section('content')


    <div class="modal-content">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{route('empleados.index')}}" class="btn btn-primary me-md-2" type="button" id="agregar"><i
                    class="fas fa-users"></i>
                </i>Empleados</a>
        </div>
        <div class="modal-content">
            <form action="{{route('empleados.store')}}" id="formulario_enviar" method="POST"
                  class="bg-white w-1/3 p-4 border-gray-100 shadow-xl rounded-lg">
                <h2 class="modal-title" id="exampleModalLabel">Crear empleado</h2>

                @csrf


                <div class="alert alert-primary" role="alert">
                    Los campos con (*) son obligatorios
                </div>


                <div class="modal-body p-4 bg-light">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo*</label>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                               placeholder="Nombre completo del empleado">
                    </div>

                    @error('nombre')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-500 p-2 my-2"> {{$message}} </p>
                    @enderror

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electronico*</label>

                        <input type="email" id="email" name="email" class="form-control"
                               placeholder="Correo electronico">
                    </div>

                    @error('email')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-500 p-2 my-2">
                        * {{$message}}</p>
                    @enderror

                    <fieldset class="my-2">
                        <legend class="col-form-label col-sm-2 pt-0">Sexo*</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexof"
                                       value="F" checked>
                                <label class="form-check-label" for="sexof">
                                    Femenino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexom"
                                       value="M">
                                <label class="form-check-label" for="sexom">
                                    Masculino
                                </label>
                            </div>

                        </div>
                    </fieldset>


                    <div class="mb-3">
                        <label for="" class="form-label">Area*</label>


                        <select name="area_id" id="inputArea_id" class="form-select">

                            @foreach ($areas as $area)
                                <option value="{{$area['id']}}">{{$area['nombre']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="descripcion" class="form-label">Descripcion*</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>

                    @error('descripcion')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-500 p-2 my-2">
                        * {{$message}}</p>
                    @enderror

                    <div class="form-check">

                        <input type="hidden" name="boletin" value="1" id="boletin">
                        <input class="form-check-input" type="checkbox" name="boletin" value="1" id="boletinCheck">
                        <label class="form-check-label" for="boletin">
                            Deseo recibir boletin informativo
                        </label>
                    </div>

                    <fieldset class="row mb-3">
                        <label for="roles" class="form-label" id="roles">Roles*</label>
                        <div class="col-sm-10">

                            @foreach ($roles as $rol )

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="" name="roles[]"
                                           value="{{$rol->id}}">
                                    @if ($rol->id == 1)
                                        <label class="form-check-label" for="desarrollador">
                                            Profesional de proyectos-Desarrollador
                                        </label>
                                    @elseif ($rol->id == 2)
                                        <label class="form-check-label" for="auxiliar">
                                            Auxiliar Administrativo
                                        </label>
                                    @elseif ($rol->id == 3)
                                        <label class="form-check-label" for="auxiliar">
                                            Gerente estrategico
                                        </label>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </fieldset>

                    @error('roles')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-500 p-2 my-2">
                        * {{$message}}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="archivo" class="form-label">Archivo*</label>
                        <input class="form-control form-control-file" name="archivo" type="file" id="archivo" >
                    </div>

                    @error('archivo')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-500 p-2 my-2">
                        * {{$message}}</p>
                    @enderror

                    <button type="button" id="enviar"
                            class="my-3 w-full btn btn-outline-primary p-2 font-semibold rounded text-black hover:bg-600 ">
                        Guardar
                    </button>


            </form>


            <script>
                $(document).ready(function () {


                    $("#enviar").click(function () {

                        var boletinCheck = document.getElementById('boletinCheck');
                        var boletin = document.getElementById('boletin');

                        if (boletinCheck.checked == false) {
                            boletin.value = 0;
                        }

                        var formulario =$("#formulario_enviar").serialize();

                        $.ajax({
                            url: '{{ route('empleados.store') }}',
                            data: formulario,
                            type: 'POST',
                            dataType: 'json',
                            success: function (data) {
                                console.log(data);

                                if (data.success == 'true') {

                                    swal.fire(" ¡Empleado Registrado! ", " Empleado Registrado correctamente ", "success").then(() => {
                                        window.location.href = "{{ route('empleados.index') }}"
                                    });

                                } else {
                                    swal.fire(" ¡Empleado no registrado! " + data.mensaje,
                                        "Complete toda la información y valide los datos", "error");
                                }
                            },
                            error: function (json, xhr, status) {
                                swal.fire(" ¡Empleado no registrado! ",
                                    "Complete toda la informacion y valide los datos", "error");
                            },
                        });
                    });

                });

            </script>


@endsection
