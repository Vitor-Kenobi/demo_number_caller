<?php
// Lê o estado do contador do arquivo temporário
if (file_exists("estado.txt")) {
    $estado = json_decode(file_get_contents("estado.txt"), true);
} else {
    $estado = ["contador" => 0];
}

// Retorna o estado como JSON
header("Content-Type: application/json");
echo json_encode($estado);
?>