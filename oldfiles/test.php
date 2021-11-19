<?php
include_once 'header.php'
?>

<section class="bg-dark">
                <h2 class="text-info">aqui podes ingresar horarios</h2>
                <form action="include/times.inc.php" method="post" id="testgroupform">
                    <label for="t" class="text-info">Hora de inicio :</label>
                    <input type="time" name="horario" id="t" form="testgroupform">
                    <br>
                    <label for="t4" class="text-info">Hora de final :</label>
                    <input type="time" name="horario2" id="t4" form="testgroupform">
                    <br>
                    <label for="t2" class="text-info">Choose a Turno:</label>
                    <select name="turno" id="t2" form="testgroupform">
                        <option value="1">1°</option>
                        <option value="2">2°</option>
                        <option value="3">3°</option>
                        <option value="4">4°</option>
                        <option value="5">5°</option>
                    </select>
                    <br>
                    <label for="t3" class="text-info">Choose a Hora:</label>
                    <select name="hora" id="t3" form="testgroupform">
                        <option value="1">1°</option>
                        <option value="2">2°</option>
                        <option value="3">3°</option>
                        <option value="4">4°</option>
                        <option value="5">5°</option>
                        <option value="6">6°</option>
                        <option value="7">7°</option>
                        <option value="8">8°</option>
                        <option value="9">9°</option>
                    </select>
                    <br>
                    <label for="t5" class="text-info">elegi dia:</label>
                    <select name="dia" id="t5" form="testgroupform">
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miercoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                        <option value="6">Sabado</option>
                    </select>
                    <br>
                    <label for="t4" class="text-info">Choose a Action:</label>
                    <select name="action" id="t4" form="testgroupform">
                        <option value="1">nuevo</option>
                        <option value="2">actualizar</option>
                        <option value="3">borrar</option>
                    </select>
                    <br>

                    <button type="submit" name="submit">Ingresar</button>
                </form>

                <hr>

                

<?php
include_once 'footer.php'
?>