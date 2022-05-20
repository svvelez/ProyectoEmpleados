<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="le-edge">

    <style>
        body{

        }
        .titulo{
            text-align: center;
            margin: 0px auto;
            width: 1000px;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #61b969;
            color: #207428;
        }

        .informacion{
            text-align: left;
        }
        h3{
            color: #207428;
        }
        h4{
            color: #207428;
        }
        label{
            color: black;
        }
        .pie-pagina{
            width: 100%;
            background-color: white;
        }
        .pie-pagina .grupo-1{
            width: 100%;
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(2,1fr);
            grid-gap: 50px;
            padding: 45px 0px;
        }

        .box{
            background:#3cbf48;
            display: flex;

        }
        .box img {

            height: 100PX;
            width: 200px;
            border: solid 2px #3cbf48;

        }

        /*.pie-pagina .grupo-1 .box figure img{
            width: 200px;
            height: 100px;
            justify-content: center;
            align-items: center;

        }*/


    </style>

</head>

<body>
<div class="titulo">
    <h1>Bienvenido {{$empleado->nombre}}</h1>

    <div class="informacion">
        <label>Bienvenid@ a la Clínica neuro cardiovascular DIME, a sido registrado exitosamente con los siguientes datos</label>
        <strong>
            <h4>Nombre: {{$empleado->nombre}}</h4>
            <h4>Correo electronico: {{$empleado->email}}</h4>
            <h4>Descripción: {{$empleado->descripcion}}</h4>
        </strong>

    </div>

    <footer class="pie-pagina">
        <div class="grupo-1">

            <div class="box">

                <img style="padding: 0;margin: 0px; width: 200px;height: 100px;text-align: right"  src="https://acreditacionensalud.org.co/wp-content/uploads/2020/07/Logo-DIME.jpg">

            </div>
        </div>

    </footer>

</div>

</body>
</html>
