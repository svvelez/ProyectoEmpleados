@extends('layouts.app')

@section('title','Home')

@section('content')
    <div class=" justify-center min-h-screen bg-white">
        <h2 class="modal-title" id="exampleModalLabel">Lista De Empleados</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{route('empleados.create')}}" class="btn btn-primary me-md-2" type="button" id="agregar"><i
                    class="fas fa-user-plus"></i>Agregar</a>
            <a href="/exportPdf" class="btn btn-danger me-md-2"><i class="fas fa-file-pdf"></i></a>
        </div>

        <div class="modal-content">
            <div class="overflow-auto lg:overflow-visible">
               <div class="text-center flex-auto">

                        <table id="tabemp" class="table table-striped display nowrap"  style="width:100%">
                        <thead class="bg-green-600 text-black">
                        <tr>
                           <th><i class="fas fa-user"></i>Nombre</th>
                            <th><i class="fas fa-envelope"></i>Correo</th>
                            <th><i class="fas fa-venus-mars"></i>Sexo</th>
                            <th><i class="fas fa-briefcase"></i>Area</th>
                            <th><i class="fas fa-inbox"></i>Boletin</th>
                            <th><i class="fas fa-file"></i>Archivo</th>
                            <th><i class=""></i>Modificar</th>
                            <th><i class=""></i>Eliminar</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach ($empleados as $emple)

                            <tr class="bg-green-100 lg:text-black">
                                <input type="hidden" class="serdelete_val_id" value="{{$emple->id}}">
                                {{-- <td class="p-3">{{$emple->id}}</td> --}}
                                <td class="p-3 ">{{$emple->nombre}}</td>
                                <td class="p-3">{{$emple->email}}</td>
                                <td class="p-3">{{$emple->sexo}}</td>
                                <td class="p-3">{{$emple->areas->nombre}}</td>
                                <td class="p-3">
                                    @if($emple->boletin==0)
                                      no
                                    @endif
                                        @if($emple->boletin==1)
                                            si
                                        @endif
                                </td>
                               <td class="p-3 flex justify-center">
                                   <a href="" class="text-black-400 hover:text-gray-100 mx-2" data-bs-toggle="modal" data-bs-target="{{"#exampleModal".$emple->id }}" data-bs-whatever="@getbootstrap">
                                       <i class="fas fa-eye"></i>
                                   </a>
                                   <div class="modal fade" id="{{"exampleModal".$emple->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-fullscreen-sm-down">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <h5 class="modal-title" id="exampleModalLabel">Archivo</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                               </div>

                                               <div class="modal-body">
                                               <iframe src="{{asset('storage').'/'.$emple->archivo}}" alt="" Width="450" Height="400">
                                               </iframe>

                                               </div>

                                           </div>
                                       </div>
                                   </div>
                               </td>

                                <td class="p-3 flex justify-center">
                                  <a href="{{ route('empleados.edit',$emple->id) }}"
                                       class="text-black-400 hover:text-gray-100 mx-2">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>
                                </td>

                                <td class="p-3 flex justify-center">
                                    <form action="{{ route('empleados.destroy',$emple->id)}}"
                                          class="d-inline formulario-eliminar" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="fas fa-trash-can"></button>
                                    </form>
                               </td>
                            </tr>
                       @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $('#tabemp').dataTable({
                "searching": false,
                "aLengthMenu": false,
                "paging": false,
                "Info": false,
                "scrollY":200,
                "scrollCollapse": true,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excel','print'
                ]

        /*  pageLength : 5,
          lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
          dom: '<"float-left"><"float-left">rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>'*/

      });
  });
</script>

    @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Ha sido eliminado correctamente.',
                'success'
            )
        </script>
    @endif

    <script>

        $('.formulario-eliminar').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Eliminar',
                text: "¿Deseas eliminar este dato?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,eliminarlo!'
            }).then((result) => {
                if (result.value) {
                    /*Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )*/

                    this.submit();
                }
            })
        });


    </script>
@endsection
