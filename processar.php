<?php
// Verifica se a ação foi enviada via POST
if (isset($_POST["acao"])) {
    $acao = intval($_POST["acao"]);

    // Verifica se o arquivo de estado existe
    if (file_exists("estado.txt")) {
        $estado = json_decode(file_get_contents("estado.txt"), true);
    } else {
        $estado = ["contador" => 0, "piscar" => false];
    }

    // Atualiza o contador e a flag de piscar com base na ação
    if ($acao === 1) {  // Incrementar
        $estado["contador"]++;
        $estado["piscar"] = false;  // Reseta a flag de piscar
    } elseif ($acao === 2) {  // Decrementar
        if ($estado ["contador"] >= 0) {
            $estado["contador"]--;
            $estado["piscar"] = false;  // Reseta a flag de piscar
        }
    } elseif ($acao === 3) {  // Piscar
        $estado["piscar"] = true;
    }

    // Salva o estado em um arquivo temporário
    file_put_contents("estado.txt", json_encode($estado));

    echo "Contador atualizado: " . $estado["contador"];
} else {
    echo "Erro: Ação não recebida.";
}
?>