<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Actas CPIFP Los Enlaces</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="css/estilo.css" type="text/css">
    <link rel="stylesheet" href="css/tmp.css" type="text/css">
    <!-- Styles -->
</head>
<body>
<div class="cabecera">
    <div class='logo_left'>
        <a href='http://www.cpilosenlaces.com/'>
            <img height='100' width='300'
                 src='http://www.cpilosenlaces.com/wp-content/uploads/2014/11/logo_cpifp-300x116.png'
                 alt='CPIFP Los Enlaces'/>
        </a>
    </div>
    <div class='logo_right'>
        <a href="http://www.educaragon.org/" style="max-height: 120px; display:inline;">
            <img height='100' width='300'
                 src='http://www.cpilosenlaces.com/wp-content/uploads/2014/11/logo_educacion.png'
                 alt='Departamento de Educación'/>
        </a>
        <a href="http://www.cpilosenlaces.com/download/politica-de-calidad.pdf"
           style="max-height: 120px; display:inline;">
            <img id="logocalidad" class="logo2" height="100" width="300"
                 src="http://www.cpilosenlaces.com/wp-content/uploads/2014/11/logo_calidad.png"
                 style="max-height: 120px;">
        </a>
    </div>
</div>




@yield ('contendio')

        <footer class="page-footer font-small mdb-color lighten-3 pt-4">
@yield ('pie')
</footer>

</body>
</html>
