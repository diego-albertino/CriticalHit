<?php

/**
 * Busca todos os jogos do banco de dados, ordenados pelo ID de forma decrescente.
 *
 * @param mysqli $conn A conexão com o banco de dados.
 * @return array Uma lista de jogos.
 */
function buscarTodosOsJogos($conn) {
    $sql = "SELECT * FROM jogo ORDER BY id DESC"; 
    $result = $conn->query($sql);
    $games = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $games[] = $row;
        }
    }
    
    return $games;
}
?>