<?php
    $horas=array(1,2,0,0,2,0,0,0,0,0,0,0);
        $i =0;
            for($j = 0; $j <= 2; $j++){
                // 0 1 2 3 / 4 5 6 7 / 8 9 10 11
                for($ii = 0; $ii <= 3; $ii++){
                    if($horas[($i+$ii)] != 0){
                        echo $i." ".$ii."<br>";
                        echo $horas[($i+$ii)]."<br>";
                    }
                    if ($ii == 3) {
                        $i = $i+4;
                    }
                }
            }
                
          

?>