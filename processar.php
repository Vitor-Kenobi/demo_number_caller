<?php
// Verifica se a ação foi enviada via POST
if (isset($_POST["acao"])) {
    $acao = intval($_POST["acao"]);

    // Verifica se o arquivo de estado existe
    if (file_exists("estado.txt")) {
        $estado = json_decode(file_get_contents("estado.txt"), true);
    } else {
        $estado = ["contador" => 0];
    }

    // Atualiza o contador com base na ação
    if ($acao === 1) {  // Incrementar
        $estado["contador"]++;
    } elseif ($acao === 2) {  // Decrementar
        $estado["contador"]--;
    }

    // Salva o estado em um arquivo temporário
    file_put_contents("estado.txt", json_encode($estado));

    echo "Contador atualizado: " . $estado["contador"];
} else {
    echo "Erro: Ação não recebida.";
}
?>