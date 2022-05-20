<!DOCTYPE html>
<html>
<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        h1 {
            color: #04AA6D;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>

<h1>EMPLEADOS</h1>

<table id="customers">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($emplead as $empleado)
        <tr>
            <td>{{$empleado->nombre}}</td>
            <td>{{$empleado->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>


