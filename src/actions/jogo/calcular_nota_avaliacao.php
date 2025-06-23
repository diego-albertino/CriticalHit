<?php

/**
 * Calcula e atualiza a nota média de todos os jogos.
 *
 * @param mysqli $conn A conexão com o banco de dados.
 * @return bool Retorna true em caso de sucesso, false em caso de falha.
 */
function calcularNotaAvaliacao($conn) {
    $sql = "
        UPDATE jogo j
        LEFT JOIN (
            SELECT 
                id_jogo, 
                AVG(nota_avaliacao) AS nota_media
            FROM 
                comentario
            GROUP BY 
                id_jogo
        ) AS medias ON j.id = medias.id_jogo
        SET 
            j.nota = ROUND(COALESCE(medias.nota_media, 0))
    ";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Erro ao preparar a consulta de atualização de notas: " . $conn->error);
    }

    $result = $stmt->execute();
    if ($result === false) {
        error_log("Erro ao executar a consulta de atualização de notas: " . $stmt->error);
    }

    $stmt->close();
}
?>