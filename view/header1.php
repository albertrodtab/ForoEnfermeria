
<!DOCTYPE html>
<html lang="en">

<!--Cabecera de la actividad-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad de aprendizaje</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Nerko+One&family=Noto+Sans+JP:wght@300&family=Raleway:ital,wght@1,200&display=swap"
        rel="stylesheet">
</head>


<header>
    <!--Start header Diseño aplicado desde CodePen-->
    <div class="header">

        <!--Content before waves-->
        <div class="inner-header">

            <h1>Enfermería en Casa</h1>
        </div>

        <!-- Menu Container-->
        <div>
            <nav>
                <ul>
                    <li><a href="index2.php">Inicio</a>
                    <li><a href="index2.php?action=mostrarLogin&controller=controller_usuario">Unete</a>
                    <li><a href="index2.php?action=mostrarRegister&controller=controller_usuario">Registrate</a>
<!--                    <li><a href="index2.php?action=listarTemas&controller=controller_tema">Listado Temas</a>-->
                    <li><a href="index2.php?action=mostrarFormContacto&controller=controller_consulta">Contacto</a></li>
                    <li><a href="index2.php?action=cerrarSesion&controller=controller_usuario">Cerrar sesion</a>
                </ul>
            </nav>
        </div>
        <div>
            <p class = "sesion"> <?php if(isset($_SESSION['user'], $_SESSION['u_level']))
                if($_SESSION['u_level'] == 0) {
                    echo "Has iniciado sesión con: ", $_SESSION['user'], " como Administrador";
                } else{
                    echo "Has iniciado sesión con: ", $_SESSION['user'], " como usuario Básico";
                }
                ?>
            </p>
        </div>
        <!--Menu end-->

        <!--Waves Container-->
        <div class="waves">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
        <!--Waves end-->

    </div>
    <!--Header ends-->
</header>



