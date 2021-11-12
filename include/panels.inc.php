<?php

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

?>