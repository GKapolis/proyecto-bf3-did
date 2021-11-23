<?php
<<<<<<< Updated upstream
=======
include_once "functions.php";


//  comienzan los paneles para mostar el debido contenido al usuario
//
//          _________
//         /#########\ 
//        /###########\
//       /####/   \####\
//      /####/      \##/
//     |####/
//     |####|        ______
//     |####|      _/######\_
//     |####|     |##########|
//     |####|       \#####/
//      \####\      /####/
//       \####\____/####/
//         \##########/
//           \######/         
//
//
// comienza seccion de paneles de uso general


/*
cartas que llevan a los grupos
*/
function listadegrupos($conn){
    $sql = "SELECT * FROM grupo ORDER BY idGrupo ASC"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultdata = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($resultdata) > 0) {
        while($row = mysqli_fetch_assoc($resultdata)){
            
            echo
            "	
			<div class=\"card-container\">
				<a href=\"tables.php?tabla=".$row["idGrupo"]."\" class=\"card-link\">
					<img src=\"Images/tarjeta.svg\" alt=\"\" class=\"card-image\">
					<p class=\"asignature\">".$row["nombredescriptivoGrupo"]."</p>
					<p class=\"group\">".$row["nombreGrupo"]."</p>
					<p class=\"schedules\">Ver Horarios</p>
				</a>
			</div>
            ";
        }

    }
    else {
        echo "<h1 class=\"text-info\"> no se encontraron grupos </h1>";
    }

    mysqli_stmt_close($stmt);
    
}
function drawtable($conn,$grupo){

    $ids = array();
    
    $sql = "SELECT * FROM clases WHERE idGrupo = ?"; 
    $stmt = mysqli_stmt_init($conn);
            
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: admin.php?error=wentwrong&panel=grupos&idGrupo=".$grupo);
        exit();
    }

            
    mysqli_stmt_bind_param($stmt, "i", $grupo);
    mysqli_stmt_execute($stmt);
            
    $resultdata = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($resultdata) > 0) {
        while($row = mysqli_fetch_assoc($resultdata)){
            $ids[] = $row['idClase'];
            $materias[] = $row['idMateria'];
            if($row['idProfesor']){
                $profesores[] = $row['idProfesor'];
            }
            else{
                $profesores[] = 0;
            }
        }
            
        }
        else {
            echo "<h1>no hay datos pertinentes en el sistema</h1>";
        }
            
    mysqli_stmt_close($stmt);

    $horasids = array();

    $horas = array();

    for($i = 0 ; $i < count($ids) ; $i++){

        $materiaexistance = revisarExistenciaDeLaMateriasPorID($conn,$materias[$i]);

        if($profesores[$i] != 0){
            $profesorexiste = revisarExistenciaDelProfesorPormedioDeID($conn,$profesores[$i]);
            
        }
        else {
            $profesorexiste['nombreProfesores']= " ";
            $profesorexiste['apellidoProfesores']= " ";
            $profesorexiste['asisteProfesores'] = -1;
        }
        echo "<h2>".$materiaexistance['NombreMateria']."</h2>".
        "<p>Profesor: ".$profesorexiste['nombreProfesores']." ".$profesorexiste['apellidoProfesores']." ".getasistencia($profesorexiste['asisteProfesores'])." </p><br>";
        writehorarios($conn,$materias[$i],$grupo);
        $horasids[] = gethorarios($conn,$materias[$i],$grupo);
    }
    foreach($horasids as $h) {
        if($h){
            foreach ($h as $k){
                $horas[] = revisarExistenciaDelHorarioID($conn,$k);
            }
        }
    }
    /*echo "<table class=\"teacher-list__teacher-table\">
            <thead>
                <tr>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sabado</th>
                </tr>
            </thead>";*/
    $index = 0;
    $day = 0;
    $hora45 = 0;
    /*while($index < count($horas)){
        if($day <= 6){
            $day++;
            if($hora45 <= 9){
                $hora45++;
                if(($horas[$index]["diaHorarios"] == $day)&&($horas[$index]["horaHorarios"] == $hora45)) {
                    
            /*echo "<tr class=\"teacher-table__rows\">";
            echo "<td>".$row['idProfesores']."</td>";
            echo "<td>".$row['nombreProfesores']."</td>";
            echo "<td>".$row['apellidoProfesores']."</td>";
            echo "<td colspan=\"1\"><a>".$row['asisteProfesores']."</a> ".modifylink($row['idProfesores'])." 
            <img src=\"Images/editar.png\" alt=\"\" class=\"teacher-table__icon\">
             ".deletelink($row['idProfesores'],($row['nombreProfesores']." ".$row['apellidoProfesores']))."
             <img src=\"Images/error.png\" alt=\"\"class=\"teacher-table__icon\"> </td>";
            echo "</tr>";*//*
                }
                else{

                }
            }
            else{
                $hora45 = 0;
            }
        }
        else {
            $day = 0;
        }
    }*/
}

function getasistencia($asiste){
    $hilo = "";
    switch($asiste){
        case 1:
            $hilo = "profesor asiste";
            break;
        case 0:
            $hilo = "profesor no asiste";
            break;
        case -1:
            $hilo = "no hay profesor para la materia";
            break;
    }
    return $hilo;
}

>>>>>>> Stashed changes

//  comienzan los paneles para mostar el debido contenido al usuario
//
//          ______________
//         /##############\
//         |####|      \###\_
//         |####|        \###\
//         |####|       _/###/
//         |####\______/###/
//         |##############/
//         |####/ 
//         |####|
//         |####|
//         |####|
//
//
// comienza seccion de paneles para editar profesores


// crea un panel para modificar al profesor
function modifyteacherform($id) {

    echo "<h2 class=\"text-info\">aqui podes modificar profesores</h2>
                <form action=\"include/modificarprofesores.inc.php\" method=\"post\" id=\"profform2\">
                    <input type=\"hidden\" name=\"id\" value=\"".$id."\" id=\"t\" form=\"profform2\">
                    <br>
                    <label for=\"t3\" class=\"text-info\">nombre/apellido Profesor :</label>
                    <input type=\"text\" name=\"data\" id=\"t3\" form=\"profform2\">
                    <br>
                    <select name=\"datatype\" id=\"t3\" form=\"profform2\">
                        <option value=\"nombreProfesores\">nombre</option>
                        <option value=\"apellidoProfesores\">apellido</option>
                    </select>
                    <br>
                    <button type=\"submit\" name=\"submit\" class=\"btn btn-secondary\">Actualizar</button>
                </form>";

}

//mensaje de confirmacion para eliminar un profesor
function deleteteacher($id,$nombre) {
    echo "<h2 class=\"text-info\">esta seguro que queire eleminar el profesor ".$nombre." de la lista</h2> <br>";
    echo "<a class=\"btn btn-warning\" href=\"admin.php?panel=profesores\">no</a>";
    echo "<form action=\"include/borrarprofesor.php\" method=\"post\" id=\"profform3\">
            <input type=\"hidden\" name=\"id\" value=\"".$id."\" id=\"t\" form=\"profform3\">
            <br>
            <button type=\"submit\" name=\"submit\" class=\"btn btn-danger\">Eliminar</button>
        </form>";
    
}

//genera un link para modificar un profesor
function modifylink($id) {
    $modificar = "<a class=\"text-info\" href=\"admin.php?panel=profesores&subpanel=modificar&id=".$id."\">modificar</a>";
    return $modificar;
}

//genera un link para eliminar un profesor
function deletelink($id/*,$nombre*/) {
    //este link lleva a una confirmacion
    //$borrar = "<a class=\"text-info\" href=\"admin.php?panel=profesores&subpanel=borrar&id=".$id."&nombre=".$nombre."\">borrar</a>";
    //este otro link elimina directamente al profesor sin pedir confirmacion
    $borrar = "<a class=\"text-info\" href=\"include\deleteteacher.inc.php?id=".$id."\">borrar</a>";
    return $borrar;
}

//crea el formulario para crear un profesor
function createteacherformexample() {
    
    echo "
    <section class=\"main-section flex-container col\">
				
				 	<p class=\"titles\">Añadir Profesor</p>
			
				<form action=\"include/crearprofesores.inc.php\" method=\"post\" class=\"form-container__form flex-container col\">
					
					<div class=\"inputs flex-container\">
						<label for=\"nombre\">Nombre:</label>
						<input type=\"text\" name=\"name\" required class=\"inputs__entry\">
					</div>
					
					<div class=\"inputs flex-container\">			
						<label for=\"apellido\">Apellido:</label>
						<input type=\"text\" name=\"surname\" required class=\"inputs__entry\">
					</div>
					
					<input type=\"submit\" name=\"submit\" value=\"Añadir\" class=\"form__send\">
				
				</form>
			
			</section>
	        ";
}

//genera la lista de profesores
function teacherslist($conn) {
    
    $sql = "SELECT * FROM profesores ORDER BY idProfesores ASC"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=profesores");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultdata = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($resultdata) > 0) {
        echo "
        <section class=\"main-section section__table\">
        <p class=\"titles\">Lista de profesores</p>

        <table class=\"teacher-list__teacher-table\">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th></th>
                </tr>
            </thead>";	
        while($row = mysqli_fetch_assoc($resultdata)){
            if($row["fecha_baja"]){

            }
            else{
            echo "<tr class=\"teacher-table__rows\">";
            echo "<td>".$row['idProfesores']."</td>";
            echo "<td>".$row['nombreProfesores']."</td>";
            echo "<td>".$row['apellidoProfesores']."</td>";
            echo "<td colspan=\"1\"><a>".$row['asisteProfesores']."</a> ".modifylink($row['idProfesores'])." 
            <img src=\"Images/editar.png\" alt=\"\" class=\"teacher-table__icon\">
             ".deletelink($row['idProfesores'],($row['nombreProfesores']." ".$row['apellidoProfesores']))."
             <img src=\"Images/error.png\" alt=\"\"class=\"teacher-table__icon\"> </td>";
            echo "</tr>";
            }
        }
        echo "</table>";

    }
    else {
        echo "<h1 class=\"text-info\"> no se encontro profesores </h1>";
    }

    mysqli_stmt_close($stmt);

}

//  comienzan los panes para mostar el debido contenido al usuario
//
//       _____         _____
//      /#####\       /#####\
//     |###|###|     |###|###|
//     /###|###\     /###|###\
//    |###| |###|   |###| |###|
//    |###| |###\   /###| |###|
//    |###|  \###\ /###/  |###|
//    |###|   \#######/   |###|
//    |###|    \_###_/    |###|
//    |###|               |###|
//
//
// comienza seccion de paneles para editar profesores

<<<<<<< Updated upstream
=======
    //forma para modificar materias
    function modifymateriaform($id) {

        echo "<h2 class=\"text-info\">aqui podes modificar profesores</h2>
                    <form action=\"include/modificarmateria2.inc.php\" method=\"post\" id=\"profform2\">
                        <input type=\"hidden\" name=\"id\" value=\"".$id."\">
                        <br>
                        <label for=\"t3\" class=\"text-info\">Nuevo Nombre:</label>
                        <input type=\"text\" name=\"name\" id=\"t3\" form=\"profform2\">
                        <br>
                        <button type=\"submit\" name=\"submit\" class=\"btn btn-secondary\">Actualizar</button>
                    </form>";

    }

    //confirmacion para eliminar materias
    function deletemateria($id,$nombre) {
        echo "<h2 class=\"text-info\">esta seguro que queire eleminar la materia ".$nombre." de la lista</h2>";
        echo "<a class=\"btn btn-warning\" href=\"admin.php?panel=profesores\">no</a>";
        echo "<form action=\"#\" method=\"post\" id=\"profform3\">
                <input type=\"hidden\" name=\"id\" value=\"".$id."\" id=\"t\" form=\"profform3\">
                
                <button type=\"submit\" name=\"submit\" class=\"btn btn-danger\">Eliminar</button>
            </form>";
        
    }

    //link para modificar materias
    function modifylinkmateria($id) {
        $modificar = "<a class=\"nav-link\" href=\"admin.php?panel=materias&subpanel=modificar&id=".$id."\">";
        return $modificar;
    }
    //link para eliminar materia
    function deletelinkmateria($id/*,$nombre*/) {
        //este link lleva a confirmacion
        //$borrar = "<a class=\"nav-link\" href=\"admin.php?panel=materias&subpanel=borrar&id=".$id."&nombre=".$nombre."\">borrar</a>";
        //este otro link elimina directamente al profesor sin pedir confirmacion
        $borrar = "<a class=\"text-info\" href=\"deletemateria.inc.php?id=".$id."\">borrar</a>";
        return $borrar;
    }



    //funcion para seleccion de horas // NOT WORKING|TODO: repensarla
    function selectordiahoraturno($iteration){
        echo "<label for=\"t5\" class=\"text-info\">dia:</label>
        <select name=\"dia".$iteration."\" id=\"t5\" form=\"subjform1\">
                            <option value=\"0\">No</option>
                            <option value=\"1\">Lunes</option>
                            <option value=\"2\">Martes</option>
                            <option value=\"3\">Miercoles</option>
                            <option value=\"4\">Jueves</option>
                            <option value=\"5\">Viernes</option>
                            <option value=\"6\">Sabado</option>
                        </select>";
        echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
        <select name=\"hora".($iteration)."\" id=\"t6\" form=\"subjform1\">
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora".($iteration*2)."\" id=\"t6\" form=\"subjform1\">
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora".($iteration*3)."\" id=\"t6\" form=\"subjform1\">
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora".($iteration*4)."\" id=\"t6\" form=\"subjform1\">
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>";
        echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
        <select name=\"turno".$iteration."\" id=\"t7\" form=\"subjform1\">
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                        </select>";
    }

    // crea el formulario para añadir materias
    function createmateriaformexample($conn) {
        //name / profesor / dia1-3 / hora 1-12 / turno 1-3
        echo "<form action=\"include/crearmateria.inc.php\" method=\"post\" id=\"subjform1\">";
        echo "<br>
        <label for=\"t3\" class=\"text-info\">Nombre:</label>
        <input type=\"text\" name=\"name\" id=\"t3\" form=\"subjform1\">";
        echo "<br>
        <label for=\"t2\" class=\"text-info\">Profesor:</label>
        <select name=\"profesor\" id=\"t2\" form=\"subjform1\">";
        echo "<option value=\"0\">sin profesor</option>";

        $sql = "SELECT idProfesores,nombreProfesores,apellidoProfesores FROM profesores ORDER BY idProfesores ASC"; 
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../admin.php?error=CouldNotConnect&panel=materias");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultdata = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($resultdata) > 0) {
            while($row = mysqli_fetch_assoc($resultdata)){
                echo "<option value=\"".$row['idProfesores']."\">".$row['nombreProfesores']." ".$row['apellidoProfesores']."</option>";
            }

        }
        else {
            echo "<option value=\"-1\">no hay profesores en el sistema</option>";
        }

        mysqli_stmt_close($stmt);
        echo "</select> <br>";


        //primer selector de dia / hora de la materia
        echo "<label for=\"t5\" class=\"text-info\">dia:</label>
        <select name=\"dia1\" id=\"t5\" form=\"subjform1\">
                            <option value=\"0\">No</option>
                            <option value=\"1\">Lunes</option>
                            <option value=\"2\">Martes</option>
                            <option value=\"3\">Miercoles</option>
                            <option value=\"4\">Jueves</option>
                            <option value=\"5\">Viernes</option>
                            <option value=\"6\">Sabado</option>
                        </select>";
        echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
        <select name=\"hora1\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora2\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora3\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora4\" id=\"t6\" form=\"subjform1\">  
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>";
        echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
        <select name=\"turno1\" id=\"t7\" form=\"subjform1\">
                            <option value=\"1\">Matutino</option>
                            <option value=\"2\">Matutino-Verspertino</option>
                            <option value=\"3\">Vespertino</option>
                            <option value=\"4\">Vespertino-Nocturno</option>
                            <option value=\"5\">Nocturno</option>
                        </select>";
        echo "<br>";









        // segundo selector de horas de la materia
        echo "<label for=\"t5\" class=\"text-info\">dia:</label>
        <select name=\"dia2\" id=\"t5\" form=\"subjform1\">
                            <option value=\"0\">No</option>
                            <option value=\"1\">Lunes</option>
                            <option value=\"2\">Martes</option>
                            <option value=\"3\">Miercoles</option>
                            <option value=\"4\">Jueves</option>
                            <option value=\"5\">Viernes</option>
                            <option value=\"6\">Sabado</option>
                        </select>";
        echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
        <select name=\"hora5\" id=\"t6\" form=\"subjform1\">            
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora6\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora7\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora8\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>";
        echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
        <select name=\"turno2\" id=\"t7\" form=\"subjform1\">
                            <option value=\"1\">Matutino</option>
                            <option value=\"2\">Matutino-Verspertino</option>
                            <option value=\"3\">Vespertino</option>
                            <option value=\"4\">Vespertino-Nocturno</option>
                            <option value=\"5\">Nocturno</option>
                        </select>";
        echo "<br>";
        








        // tercer selector de horas de la materia
        echo "<label for=\"t5\" class=\"text-info\">dia:</label>
        <select name=\"dia3\" id=\"t5\" form=\"subjform1\">
                            <option value=\"0\">No</option>
                            <option value=\"1\">Lunes</option>
                            <option value=\"2\">Martes</option>
                            <option value=\"3\">Miercoles</option>
                            <option value=\"4\">Jueves</option>
                            <option value=\"5\">Viernes</option>
                            <option value=\"6\">Sabado</option>
                        </select>";
        echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
        <select name=\"hora9\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora10\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora11\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora12\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>";
        echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
        <select name=\"turno3\" id=\"t7\" form=\"subjform1\">
                            <option value=\"1\">Matutino</option>
                            <option value=\"2\">Matutino-Verspertino</option>
                            <option value=\"3\">Vespertino</option>
                            <option value=\"4\">Vespertino-Nocturno</option>
                            <option value=\"5\">Nocturno</option>
                        </select>";
        echo "<br>";
        echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-danger\">Eliminar</button>";
        echo "</form>";


    }

    // crea el formulario para editar materias
    function editmateriahorario($conn,$materia,$grupo) {
        //materia / grupo / dia1-3 / hora 1-12 / turno 1-3
        $groupexist = revisarExistenciaDelGrupoID($conn,$grupo);

                if($groupexist == false){
                    header("location: admin.php?panel=grupos&error=classnotexist");
                    exit();
                }

                echo "<p>Grupo: ".$groupexist['nombreGrupo']." | ".$groupexist['nombredescriptivoGrupo']."</p> <br>";

                $materiaexistance = revisarExistenciaDeLaMateriasPorID($conn,$materia);

                if($materiaexistance == false){
                    header("location: admin.php?panel=grupos&error=classnotexist");
                    exit();
                }

                echo "<p>Materia: ".$materiaexistance['NombreMateria']."</p><br>";

        
        echo "<form action=\"include/modificarmateria.inc.php\" method=\"post\" id=\"subjform1\">";
        echo "<br>";
        echo "<input type=\"hidden\" name=\"idGrupo\" value=\"".$grupo."\">";
        echo "<input type=\"hidden\" name=\"idMateria\" value=\"".$materia."\">";
        echo "<br>";


        //primer selector de dia / hora de la materia//
        echo "<label for=\"t5\" class=\"text-info\">dia:</label>
        <select name=\"dia1\" id=\"t5\" form=\"subjform1\">
                            <option value=\"0\">No</option>
                            <option value=\"1\">Lunes</option>
                            <option value=\"2\">Martes</option>
                            <option value=\"3\">Miercoles</option>
                            <option value=\"4\">Jueves</option>
                            <option value=\"5\">Viernes</option>
                            <option value=\"6\">Sabado</option>
                        </select>";
        echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
        <select name=\"hora1\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora2\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora3\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora4\" id=\"t6\" form=\"subjform1\">  
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>";
        echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
        <select name=\"turno1\" id=\"t7\" form=\"subjform1\">
                            <option value=\"1\">Matutino</option>
                            <option value=\"2\">Matutino-Verspertino</option>
                            <option value=\"3\">Vespertino</option>
                            <option value=\"4\">Vespertino-Nocturno</option>
                            <option value=\"5\">Nocturno</option>
                        </select>";
        echo "<br>";



        // segundo selector de horas de la materia
        echo "<label for=\"t5\" class=\"text-info\">dia:</label>
        <select name=\"dia2\" id=\"t5\" form=\"subjform1\">
                            <option value=\"0\">No</option>
                            <option value=\"1\">Lunes</option>
                            <option value=\"2\">Martes</option>
                            <option value=\"3\">Miercoles</option>
                            <option value=\"4\">Jueves</option>
                            <option value=\"5\">Viernes</option>
                            <option value=\"6\">Sabado</option>
                        </select>";
        echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
        <select name=\"hora5\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora6\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora7\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora8\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>";
        echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
        <select name=\"turno2\" id=\"t7\" form=\"subjform1\">
                            <option value=\"1\">Matutino</option>
                            <option value=\"2\">Matutino-Verspertino</option>
                            <option value=\"3\">Vespertino</option>
                            <option value=\"4\">Vespertino-Nocturno</option>
                            <option value=\"5\">Nocturno</option>
                        </select>";
        echo "<br>";
        



        // tercer selector de horas de la materia
        echo "<label for=\"t5\" class=\"text-info\">dia:</label>
        <select name=\"dia3\" id=\"t5\" form=\"subjform1\">
                            <option value=\"0\">No</option>
                            <option value=\"1\">Lunes</option>
                            <option value=\"2\">Martes</option>
                            <option value=\"3\">Miercoles</option>
                            <option value=\"4\">Jueves</option>
                            <option value=\"5\">Viernes</option>
                            <option value=\"6\">Sabado</option>
                        </select>";
        echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
        <select name=\"hora9\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora10\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora11\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>
        <select name=\"hora12\" id=\"t6\" form=\"subjform1\">
                            <option value=\"0\">no</option>
                            <option value=\"1\">1°</option>
                            <option value=\"2\">2°</option>
                            <option value=\"3\">3°</option>
                            <option value=\"4\">4°</option>
                            <option value=\"5\">5°</option>
                            <option value=\"6\">6°</option>
                            <option value=\"7\">7°</option>
                            <option value=\"8\">8°</option>
                            <option value=\"9\">9°</option>
                        </select>";
        echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
        <select name=\"turno3\" id=\"t7\" form=\"subjform1\">
                            <option value=\"1\">Matutino</option>
                            <option value=\"2\">Matutino-Verspertino</option>
                            <option value=\"3\">Vespertino</option>
                            <option value=\"4\">Vespertino-Nocturno</option>
                            <option value=\"5\">Nocturno</option>
                        </select>";
        echo "<br>";
        echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-danger\">Eliminar</button>";
        echo "</form>";


    }

    function createmateriaformulario(){
        echo "
        <section class=\"main-section flex-container col\">
                    
                        <p class=\"titles\">Añadir Materias</p>
                
                    <form action=\"include/crearmateria2.inc.php\" method=\"post\" class=\"form-container__form flex-container col\">
                        
                        <div class=\"inputs flex-container\">
                            <label for=\"nombre\">Nombre:</label>
                            <input type=\"text\" name=\"name\" required class=\"inputs__entry\">
                        </div>
                        
                        <input type=\"submit\" name=\"submit\" value=\"Añadir\" class=\"form__send\">
                    
                    </form>
                
                </section>
                ";
    }

    function materiaslistadmin($conn) {
        
        $sql = "SELECT * FROM materias ORDER BY idMaterias ASC"; 
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../admin.php?error=CouldNotConnect&panel=grupos");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultdata = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($resultdata) > 0) {
            echo "
            <section class=\"main-section section__table\">
            <p class=\"titles\">Lista de materias</p>

            <table class=\"teacher-list__teacher-table\">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                    </tr>
                </thead>";	
            while($row = mysqli_fetch_assoc($resultdata)){
                
                echo "<tr class=\"teacher-table__rows\">";
                echo "<td>".$row['idMaterias']."</td>";
                echo "<td>".modifylinkmateria($row['idMaterias']).$row['NombreMateria']."</a></td>";
                echo "</tr>";
            }
            echo "</table>";

        }
        else {
            echo "<h1 class=\"text-info\"> no se encontro grupos </h1>";
        }

        mysqli_stmt_close($stmt);

    }

>>>>>>> Stashed changes
//  termina seccion de materias
//
//          _________
//         /#########\ 
//        /###########\
//       /####/   \####\
//      /####/      \##/
//     |####/
//     |####|        ______
//     |####|      _/######\_
//     |####|     |##########|
//     |####|       \#####/
//      \####\      /####/
//       \####\____/####/
//         \##########/
//           \######/         
//
//
// comienza seccion de grupos

<<<<<<< Updated upstream
=======

//genera el vinculo entre los grupos y las clases
function linktoclass($id){
    $vinculo = "<a class=\"text-info\" href=\"admin.php?panel=clases&idGrupo=".$id."\"><p>Ver mas</p>";
    return $vinculo;
}
//crea el formulario de grupo primer intento
function creategrupoformexample($conn) {
    //name / profesor / dia1-3 / hora 1-12 / turno 1-3
    echo "<form action=\"include/creargrupo.inc.php\" method=\"post\" id=\"subjform1\">";
    echo "<br>
    <label for=\"t3\" class=\"text-info\">Nombre:</label>
    <input type=\"text\" name=\"grupo\" id=\"t3\" form=\"subjform1\">";
    echo "<br>
    <label for=\"t3\" class=\"text-info\">Nombre descriptivo del grupo:</label>
    <input type=\"text\" name=\"fullgrupo\" id=\"t3\" form=\"subjform1\">";
    echo "<br>
    <label for=\"t3\" class=\"text-info\">Nombre de materia:</label>
    <input type=\"text\" name=\"name\" id=\"t3\" form=\"subjform1\">";
    echo "<br>
    <label for=\"t2\" class=\"text-info\">Profesor:</label>
    <select name=\"profesor\" id=\"t2\" form=\"subjform1\">";
    echo "<option value=\"0\">sin profesor</option>";

    $sql = "SELECT idProfesores,nombreProfesores,apellidoProfesores FROM profesores ORDER BY idProfesores ASC"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultdata = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($resultdata) > 0) {
        while($row = mysqli_fetch_assoc($resultdata)){
            echo "<option value=\"".$row['idProfesores']."\">".$row['nombreProfesores']." ".$row['apellidoProfesores']."</option>";
        }

    }
    else {
        echo "<option value=\"-1\">no hay profesores en el sistema</option>";
    }

    mysqli_stmt_close($stmt);
    echo "</select> <br>";


    //primer selector de dia / hora de la materia
    echo "<label for=\"t5\" class=\"text-info\">dia:</label>
    <select name=\"dia1\" id=\"t5\" form=\"subjform1\">
                        <option value=\"0\">No</option>
                        <option value=\"1\">Lunes</option>
                        <option value=\"2\">Martes</option>
                        <option value=\"3\">Miercoles</option>
                        <option value=\"4\">Jueves</option>
                        <option value=\"5\">Viernes</option>
                        <option value=\"6\">Sabado</option>
                    </select>";
    echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
    <select name=\"hora1\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora2\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora3\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora4\" id=\"t6\" form=\"subjform1\">  
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>";
    echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
    <select name=\"turno1\" id=\"t7\" form=\"subjform1\">
                        <option value=\"1\">Matutino</option>
                        <option value=\"2\">Matutino-Verspertino</option>
                        <option value=\"3\">Vespertino</option>
                        <option value=\"4\">Vespertino-Nocturno</option>
                        <option value=\"5\">Nocturno</option>
                    </select>";
    echo "<br>";









    // segundo selector de horas de la materia
    echo "<label for=\"t5\" class=\"text-info\">dia:</label>
    <select name=\"dia2\" id=\"t5\" form=\"subjform1\">
                        <option value=\"0\">No</option>
                        <option value=\"1\">Lunes</option>
                        <option value=\"2\">Martes</option>
                        <option value=\"3\">Miercoles</option>
                        <option value=\"4\">Jueves</option>
                        <option value=\"5\">Viernes</option>
                        <option value=\"6\">Sabado</option>
                    </select>";
    echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
    <select name=\"hora5\" id=\"t6\" form=\"subjform1\">            
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora6\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora7\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora8\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>";
    echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
    <select name=\"turno2\" id=\"t7\" form=\"subjform1\">
                        <option value=\"1\">Matutino</option>
                        <option value=\"2\">Matutino-Verspertino</option>
                        <option value=\"3\">Vespertino</option>
                        <option value=\"4\">Vespertino-Nocturno</option>
                        <option value=\"5\">Nocturno</option>
                    </select>";
    echo "<br>";
    








    // tercer selector de horas de la materia
    echo "<label for=\"t5\" class=\"text-info\">dia:</label>
    <select name=\"dia3\" id=\"t5\" form=\"subjform1\">
                        <option value=\"0\">No</option>
                        <option value=\"1\">Lunes</option>
                        <option value=\"2\">Martes</option>
                        <option value=\"3\">Miercoles</option>
                        <option value=\"4\">Jueves</option>
                        <option value=\"5\">Viernes</option>
                        <option value=\"6\">Sabado</option>
                    </select>";
    echo "<label for=\"t6\" class=\"text-info\">Hora:</label>
    <select name=\"hora9\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora10\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora11\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>
    <select name=\"hora12\" id=\"t6\" form=\"subjform1\">
                        <option value=\"0\">no</option>
                        <option value=\"1\">1°</option>
                        <option value=\"2\">2°</option>
                        <option value=\"3\">3°</option>
                        <option value=\"4\">4°</option>
                        <option value=\"5\">5°</option>
                        <option value=\"6\">6°</option>
                        <option value=\"7\">7°</option>
                        <option value=\"8\">8°</option>
                        <option value=\"9\">9°</option>
                    </select>";
    echo "<label for=\"t7\" class=\"text-info\">Turno:</label>
    <select name=\"turno3\" id=\"t7\" form=\"subjform1\">
                        <option value=\"1\">Matutino</option>
                        <option value=\"2\">Matutino-Verspertino</option>
                        <option value=\"3\">Vespertino</option>
                        <option value=\"4\">Vespertino-Nocturno</option>
                        <option value=\"5\">Nocturno</option>
                    </select>";
    echo "<br>";
    echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-danger\">Eliminar</button>";
    echo "</form>";


}

function creategrupoformulario(){
    echo "
    <section class=\"main-section flex-container col\">
				
				 	<p class=\"titles\">Añadir Grupos</p>
			
				<form action=\"include/creargrupo.inc.php\" method=\"post\" class=\"form-container__form flex-container col\">
					
					<div class=\"inputs flex-container\">
						<label for=\"nombre\">Nombre:</label>
						<input type=\"text\" name=\"grupo\" required class=\"inputs__entry\">
					</div>
					
					<div class=\"inputs flex-container\">			
						<label for=\"apellido\">Nombre Descriptivo:</label>
						<input type=\"text\" name=\"fullgrupo\" required class=\"inputs__entry\">
					</div>
					
					<input type=\"submit\" name=\"submit\" value=\"Añadir\" class=\"form__send\">
				
				</form>
			
			</section>
	        ";
}

function groupslistadmin($conn) {
    
    $sql = "SELECT * FROM grupo ORDER BY idGrupo ASC"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=grupos");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultdata = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($resultdata) > 0) {
        echo "
        <section class=\"main-section section__table\">
        <p class=\"titles\">Lista de grupos</p>

        <table class=\"teacher-list__teacher-table\">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>NombreDescriptivo</th>
                    <th></th>
                </tr>
            </thead>";	
        while($row = mysqli_fetch_assoc($resultdata)){
            
            echo "<tr class=\"teacher-table__rows\">";
            echo "<td>".$row['idGrupo']."</td>";
            echo "<td>".$row['nombreGrupo']."</td>";
            echo "<td>".$row['nombredescriptivoGrupo']."</td></a>";
            echo "<td colspan=\"1\">".linktoclass($row['idGrupo'])." 
            <img src=\"Images/editar.png\" alt=\"\" class=\"teacher-table__icon\"></a></td>";
            echo "</tr>";
        }
        echo "</table>";

    }
    else {
        echo "<h1 class=\"text-info\"> no se encontro grupos </h1>";
    }

    mysqli_stmt_close($stmt);

}

>>>>>>> Stashed changes
//  termina seccion de grupos
//
//
//          |##\              /##|
//          |###\            /###|
//          |###|            |###|
//          |###\            /###|
//          \####\_       __/####/
//            \####\_____/#####/
//              \##########/
//                \######/
//
//
// comienza seccion de usuarios

//panel para modificar usuarios
function modifyuserpanel($name){
    

    echo "<h2 class=\"text-info\">aqui podes modificar tus datos</h2>
                <form action=\"include/modificarprofesores.inc.php\" method=\"post\" id=\"profform2\">
                    <input type=\"hidden\" name=\"name\" value=\"".$name."\" id=\"t\" form=\"profform2\">
                    <br>
                    <label for=\"t3\" class=\"text-info\">nuevo dato:</label>
                    <input type=\"text\" name=\"new_data\" id=\"t3\" form=\"profform2\">
                    <br>
                    <label for=\"t4\" class=\"text-info\">nuevo dato:</label>
                    <select name=\"data_type\" id=\"t4\" form=\"profform2\">
                        <option value=\"CLAVEusuarios\">Contraseña</option>
                        <option value=\"CORREOusuarios\">Correo</option>
                    </select>
                    <br>
                    <label for=\"t5\" class=\"text-info\">su contraseña actual:</label>
                    <input type=\"text\" name=\"contraseña\" id=\"t5\" form=\"profform2\">
                    <br>
                    <button type=\"submit\" name=\"submit\" class=\"btn btn-secondary\">Actualizar</button>
                </form>";

}

//  termina seccion de usuarios
//
//          _________
//         /#########\ 
//        /###########\
//       /####/   \####\
//      /####/      \##/
//     |####/       
//     |####|        
//     |####|       
//     |####|       
//     |####|        __
//      \####\      /##\
//       \####\___/####/
//         \##########/
//           \######/         
//
//
// comienza seccion de clases

function createclassfirstmodel($conn){

    echo "
    <section class=\"main-section flex-container col\">
				
				 	<p class=\"titles\">Añadir Clases</p>
			
				<form action=\"include/crearclase.inc.php\" method=\"post\" class=\"form-container__form flex-container col\">";
				
                // selectro de grupos

                echo "<label for=\"t4\" class=\"text-info\">Grupo:</label>";
                echo "<select name=\"Grupo\" id=\"t3\">";
                $sql = "SELECT * FROM grupo ORDER BY idGrupo ASC"; 
                $stmt = mysqli_stmt_init($conn);
            
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../admin.php?error=CouldNotConnect&panel=clases");
                    exit();
                }
            
                mysqli_stmt_execute($stmt);
            
                $resultdata = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($resultdata) > 0) {
                    while($row = mysqli_fetch_assoc($resultdata)){
                        echo "<option value=\"".$row['idGrupo']."\">".$row['nombreGrupo']." ".$row['nombredescriptivoGrupo']."</option>";
                    }
            
                }
                else {
                    echo "<option value=\"-1\">no hay grupos en el sistema</option>";
                }
            
                mysqli_stmt_close($stmt);
                echo "</select> <br>";




                // selector de materias

                echo "<label for=\"t2\" class=\"text-info\">Materias:</label>";
                echo "<select name=\"materias\" id=\"t3\">";
                $sql = "SELECT * FROM materias ORDER BY idMaterias ASC"; 
                $stmt = mysqli_stmt_init($conn);
            
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../admin.php?error=CouldNotConnect&panel=clases");
                    exit();
                }
            
                mysqli_stmt_execute($stmt);
            
                $resultdata = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($resultdata) > 0) {
                    while($row = mysqli_fetch_assoc($resultdata)){
                        echo "<option value=\"".$row['idMaterias']."\">".$row['NombreMateria']."</option>";
                    }
            
                }
                else {
                    echo "<option value=\"-1\">no hay materias en el sistema</option>";
                }
            
                mysqli_stmt_close($stmt);
                echo "</select> <br>";
                

                // selectro de profesores


                echo "<br>
                <label for=\"t2\" class=\"text-info\">Profesor:</label>
                <select name=\"profesor\" id=\"t2\">";
                echo "<option value=\"0\">sin profesor</option>";
                $sql = "SELECT idProfesores,nombreProfesores,apellidoProfesores FROM profesores ORDER BY idProfesores ASC"; 
                $stmt = mysqli_stmt_init($conn);
            
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../admin.php?error=CouldNotConnect&panel=clases");
                    exit();
                }
            
                mysqli_stmt_execute($stmt);
            
                $resultdata = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($resultdata) > 0) {
                    while($row = mysqli_fetch_assoc($resultdata)){
                        echo "<option value=\"".$row['idProfesores']."\">".$row['nombreProfesores']." ".$row['apellidoProfesores']."</option>";
                    }
            
                }
                else {
                    echo "<option value=\"-1\">no hay profesores en el sistema</option>";
                }
            
                mysqli_stmt_close($stmt);
                echo "</select> <br>";
					
				echo "<input type=\"submit\" name=\"submit\" value=\"Añadir\" class=\"form__send\">
				
				</form>
			
			</section>
	        ";

}
function updateclassform($conn,$materia,$grupo){
    echo "
    <section class=\"main-section flex-container col\">
				
				 	<p class=\"titles\">Añadir Materias al Grupo</p>
			
				<form action=\"include/updateclase.inc.php\" method=\"post\" class=\"form-container__form flex-container col\">";
				
                // selector de grupos

                
                $groupexist = revisarExistenciaDelGrupoID($conn,$grupo);

                if($groupexist == false){
                    header("location: admin.php?panel=grupos&error=classnotexist");
                    exit();
                }

                echo "<p>Grupo: ".$groupexist['nombreGrupo']." | ".$groupexist['nombredescriptivoGrupo']."</p> <br>";
                echo "<input type=\"hidden\" name=\"Grupo\" value=\"".$grupo."\">";

                // selector de materias

                $materiaexistance = revisarExistenciaDeLaMateriasPorID($conn,$materia);

                if($materiaexistance == false){
                    header("location: admin.php?panel=grupos&error=classnotexist");
                    exit();
                }

                echo "<p>Materia: ".$materiaexistance['NombreMateria']."</p><br>";
                echo "<input type=\"hidden\" name=\"materia\" value=\"".$materia."\">";
                

                // selectro de profesores


                echo "<br>
                <label for=\"t2\" class=\"text-info\">Profesor:</label>
                <select name=\"profesor\" id=\"t2\">";
                echo "<option value=\"0\">sin profesor</option>";
                $sql = "SELECT * FROM profesores ORDER BY idProfesores ASC"; 
                $stmt = mysqli_stmt_init($conn);
            
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../admin.php?error=CouldNotConnect&panel=clases");
                    exit();
                }
            
                mysqli_stmt_execute($stmt);
            
                $resultdata = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($resultdata) > 0) {
                    while($row = mysqli_fetch_assoc($resultdata)){
                        if($row["fecha_baja"]){

                        }
                        else{
                            echo "<option value=\"".$row['idProfesores']."\">".$row['nombreProfesores']." ".$row['apellidoProfesores']."</option>";
                        }
                    }
            
                }
                else {
                    echo "<option value=\"-1\">no hay profesores en el sistema</option>";
                }
            
                mysqli_stmt_close($stmt);
                echo "</select> <br>";
					
				echo "<input type=\"submit\" name=\"submit\" class=\"form__send\">
				
				</form>
			
			</section>
	        ";
}
function createclase($conn,$grupo){

    echo "
    <section class=\"main-section flex-container col\">
				
				 	<p class=\"titles\">Añadir Materias al Grupo</p>
			
				<form action=\"include/crearclase.inc.php\" method=\"post\" class=\"form-container__form flex-container col\">";
				
                // selector de grupos

                
                $groupexist = revisarExistenciaDelGrupoID($conn,$grupo);

                if($groupexist == false){
                    header("location: admin.php?panel=grupos&error=classnotexist");
                    exit();
                }

                echo "<p>Grupo: ".$groupexist['nombreGrupo']." | ".$groupexist['nombredescriptivoGrupo']."</p> <br>";
                echo "<input type=\"hidden\" name=\"Grupo\" value=\"".$grupo."\">";

                // selector de materias

                echo "<label for=\"t2\" class=\"text-info\">Materias:</label>";
                echo "<select name=\"materias\" id=\"t3\">";
                $sql = "SELECT * FROM materias ORDER BY idMaterias ASC"; 
                $stmt = mysqli_stmt_init($conn);
            
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../admin.php?error=CouldNotConnect&panel=clases");
                    exit();
                }
            
                mysqli_stmt_execute($stmt);
            
                $resultdata = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($resultdata) > 0) {
                    while($row = mysqli_fetch_assoc($resultdata)){
                        echo "<option value=\"".$row['idMaterias']."\">".$row['NombreMateria']."</option>";
                    }
            
                }
                else {
                    echo "<option value=\"-1\">no hay materias en el sistema</option>";
                }
            
                mysqli_stmt_close($stmt);
                echo "</select> <br>";
                

                // selectro de profesores


                echo "<br>
                <label for=\"t2\" class=\"text-info\">Profesor:</label>
                <select name=\"profesor\" id=\"t2\">";
                echo "<option value=\"0\">sin profesor</option>";
                $sql = "SELECT * FROM profesores ORDER BY idProfesores ASC"; 
                $stmt = mysqli_stmt_init($conn);
            
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../admin.php?error=CouldNotConnect&panel=clases");
                    exit();
                }
            
                mysqli_stmt_execute($stmt);
            
                $resultdata = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($resultdata) > 0) {
                    while($row = mysqli_fetch_assoc($resultdata)){
                        if($row["fecha_baja"]){

                        }
                        else{
                            echo "<option value=\"".$row['idProfesores']."\">".$row['nombreProfesores']." ".$row['apellidoProfesores']."</option>";
                        }
                        
                    }
            
                }
                else {
                    echo "<option value=\"-1\">no hay profesores en el sistema</option>";
                }
            
                mysqli_stmt_close($stmt);
                echo "</select> <br>";
					
				echo "<input type=\"submit\" name=\"submit\" value=\"Añadir\" class=\"form__send\">
				
				</form>
			
			</section>
	        ";

            listamateriasengrupo($conn,$grupo);

}

function listamateriasengrupo($conn,$grupo){

    $sql = "SELECT idMateria,idProfesor FROM clases WHERE idGrupo = ?"; 
    $stmt = mysqli_stmt_init($conn);
            
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: admin.php?error=wentwrong&panel=grupos&idGrupo=".$grupo);
        exit();
    }

            
    mysqli_stmt_bind_param($stmt, "i", $grupo);
    mysqli_stmt_execute($stmt);
            
    $resultdata = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($resultdata) > 0) {
        while($row = mysqli_fetch_assoc($resultdata)){
            
            $materias[] = $row['idMateria'];
            if($row['idProfesor']){
                $profesores[] = $row['idProfesor'];
            }
            else{
                $profesores[] = 0;
            }
        }
            
        }
        else {
            echo "<h1>no hay datos pertinentes en el sistema</h1>";
        }
            
    mysqli_stmt_close($stmt);

    for($i = 0 ; $i < count($materias) ; $i++){
        printclasstable($conn,$materias[$i],$profesores[$i],$grupo);
    }

}

function printclasstable($conn, $materia, $profesor,$grupo){

    $materiaexistance = revisarExistenciaDeLaMateriasPorID($conn,$materia);

    if($profesor != 0){
        $profesorexiste = revisarExistenciaDelProfesorPormedioDeID($conn,$profesor);
    }
    else {
        $profesorexiste['nombreProfesores']= "-";
        $profesorexiste['apellidoProfesores']= "-";
    }

    echo "<h2>".$materiaexistance['NombreMateria']."</h2>".
    "<p>Profesor: ".$profesorexiste['nombreProfesores']." ".$profesorexiste['apellidoProfesores']."</p><br>";
    echo "<a href=\"admin.php?panel=materiaenclase&idGrupo=".$grupo."&idMateria=".$materia."&subpanel=profesor\"><p>Editar Profesor</p></a></br>";
    writehorarios($conn,$materia,$grupo);
    echo "<a href=\"admin.php?panel=materiaenclase&idGrupo=".$grupo."&idMateria=".$materia."&subpanel=horario\"><p>Editar Horario</p></a></br>";

}

function writehorarios($conn,$materia,$grupo){
    $horas = gethorarios($conn,$materia,$grupo) ?? false;
    if ($horas){
        foreach($horas as $k){
            $horarios[] = revisarExistenciaDelHorarioID($conn,$k);
        }
        writeeachhorario($horarios);
        
    }
    else {
        echo "no hay horarios en el sistema";
    }
}

function gethorarios($conn,$materia,$grupo){

    $classexists = revisarExistenciaDelaClase($conn,$grupo,$materia);
    
    $horasid = array();

    $sql = "SELECT * FROM clase_has_horarios WHERE idClase = ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: admin.php?error=wentwrongH&panel=grupos&idGrupo=".$grupo);
        exit();
    }

            
    mysqli_stmt_bind_param($stmt, "i", $classexists["idClase"]);
    mysqli_stmt_execute($stmt);
            
    $resultdata = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($resultdata) > 0) {
        while($row = mysqli_fetch_assoc($resultdata)){
            $horasid[] = $row["idHorario"];
        }
            
    }

    mysqli_stmt_close($stmt);
    
    return $horasid;

}

//escribe los horarios de forma en que escriba los horarios del dia de forma corrida y escriba cada dia aparte aparte
function writeeachhorario($array){

    /*Array ( [0] => Array ( [idHorarios] => 144 [inicioHorarios] => 07:30:00 [terminaHorarios] => 08:15:00 [turnoHorarios] => 1 [horaHorarios] => 1 [diaHorarios] => 3 )*/
    $i=0;
    while($i < count($array)){
        for ($j = count($array)-1; $j >= 0 ; $j--){
            if (($array[$i]["turnoHorarios"]==$array[$j]["turnoHorarios"])&&($array[$i]["diaHorarios"]==$array[$j]["diaHorarios"])){
                echo getstringdia($array[$i]["diaHorarios"]).": ".$array[$i]["inicioHorarios"]."-".$array[$j]["terminaHorarios"]." | ".getstringturno($array[$i]["turnoHorarios"]);
                echo "<br>";
                $i = $j+1;
                break;
            }
        }
    }


}

//  termina seccion de Clases
//
//          ____        ____
//         /####\      /####\
//         |####|      |####|
//         |####|      |####|
//         |####\______/####|
//         |################|
//         |################|
//         |####/      \####|
//         |####|      |####|
//         |####|      |####|
//         |####|      |####|
//
//
// comienza seccion de Horarios

function updatehorarios($conn,$grupó,$materia){

}

function getstringturno($turno){
    $result = "";
    switch($turno){
        case 1:
            $result = "Matutino";
            break;
        case 2:
            $result = "Matutino-Vespertino";
            break;
        case 3:
            $result = "Vespertino";
            break;
        case 4:
            $result = "Vespertino-Nocturno";
            break;
        case 5:
            $result = "Nocturno";
            break;
        }
    return $result;
}

function getstringdia($dia){
    $result = "";
    switch($dia){
        case 1:
            $result = "Lunes";
            break;
        case 2:
            $result = "Martes";
            break;
        case 3:
            $result = "Miercoles";
            break;
        case 4:
            $result = "Jueves";
            break;
        case 5:
            $result = "Viernes";
            break;
        case 6:
            $result = "Sabado";
            break;
        }
    return $result;
}


?>