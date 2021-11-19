<?php



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
panel de grupos
*/
function listadegrupos($conn){
    echo
    "<section class=\"card-section\">
		
			<div class=\"card-container\">
				<a href=\""."\" class=\"card-link\">
					<img src=\"Images/tarjeta.svg\" alt=\"\" class=\"card-image\">
					<p class=\"asignature\">Informática</p>
					<p class=\"group\">3BF</p>
					<p class=\"schedules\">Ver Horarios</p>
				</a>
			</div>

	</section>";
}

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

//forma para modificar materias
function modifymateriaform($id) {

    echo "<h2 class=\"text-info\">aqui podes modificar profesores</h2>
                <form action=\"#\" method=\"post\" id=\"profform2\">
                    <input type=\"hidden\" name=\"id\" value=\"".$id."\"> id=\"t\" form=\"profform2\">
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
    $modificar = "<a class=\"nav-link\" href=\"admin.php?panel=materias&subpanel=modificar&id=".$id."\">modificar</a>";
    return $modificar;
}
//link para eliminar materia
function deletelinkmateria($id/*,$nombre*/) {
    //este link lleva a confirmacion
    //$borrar = "<a class=\"nav-link\" href=\"admin.php?panel=materias&subpanel=borrar&id=".$id."&nombre=".$nombre."\">borrar</a>";
    //este otro link elimina directamente al profesor sin pedir confirmacion
    $borrar = "<a class=\"text-info\" href=\"deleteteacher.inc.php?id=".$id."\">borrar</a>";
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

function editmateriaformexample($conn) {
    //name / profesor / dia1-3 / hora 1-12 / turno 1-3
    echo "<form action=\"include/modificarmateria.inc.php\" method=\"post\" id=\"subjform1\">";
    echo "<br>
    <label for=\"t3\" class=\"text-info\">Nombre:</label>
    <input type=\"text\" name=\"id\" id=\"t3\" form=\"subjform1\">";
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
    /*
    $name = $_POST["username"];
    $datatype = $_POST["data_type"];
    $newname = $_POST["new_data"];
    $contraseña = $_POST["contraseña"]; */

    echo "<h2 class=\"text-info\">aqui podes modificar tus datos</h2>
                <form action=\"include/modifyuser.inc.php\" method=\"post\" id=\"profform2\">
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

?>