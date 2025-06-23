<?php

/**
 * Busca todas as plataformas do banco de dados, ordenadas pelo ID de forma decrescente.
 * * @param mysqli $conn A conexão com o banco de dados.
 * @return array Uma lista de plataformas.
 */
function buscarTodasAsPlataformas($conn) {
    $sql = "SELECT * FROM plataforma ORDER BY id DESC";
    $result = $conn->query($sql);
    $plataformas = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $plataformas[] = $row;
        }
    }

    return $plataformas;
}

?>