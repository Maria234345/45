<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="content"> 
        <div class="d-flex justify-content-end mb-4">       

        </div> 
        <table class="table table-bordered mb-5 table-primary">    
        <thead> 
        <tr class="table-primary"> 
            <th scope="col">#</th> 
            <th scope="col">ID Historia</th>
            <th scope="col">Fecha Entrada</th>
            <th scope="col">Fecha Alta</th>
            <th scope="col">Num Seguro</th>
        </tr>     
        </thead>   
        <tbody>  
        @foreach($historiaclinica ?? '' as $data)
        <tr>
            <td scope="row">{{ $data->idhistoria_clinica }}</td> 
            <td>{{ $data->idhistoria }}</td> 
            <td>{{ $data->fechaentrada }}</td> 
            <td>{{ $data->fechaalta }}</td> 
            <td>{{ $data->numseguro }}</td> 
        </tr>
        @endforeach 
        </tbody> 
        </table> 
        </div>
</body>
</html>