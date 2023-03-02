
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo GML</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 0.4rem 0.2rem;
        }
    </style>
</head>
<body>
    
    <h2>Reporte registros por países</h2>

    <table>

        <thead>
            <tr>
                <th>Pais</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPaises as $item)
                <tr>
                    <th>{{$item['pais']}}</th>
                    <td style="text-align: right;">{{$item['total']}}</td>
                </tr>
            @endforeach           
        </tbody>
    </table>

</body>
</html>