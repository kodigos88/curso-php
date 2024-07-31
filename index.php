<?php 
const API_URL = "https://whenisthenextmcufilm.com/api";

// Inicializamos la sesión de cURL; ch = curl handle
$ch = curl_init(API_URL);

// Indicar que queremos recibir el resultado de la petición y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Ejecutar la peticion y Guardamos el resultado
$result = curl_exec($ch);

// Verificar si hubo errores en la petición cURL
if (curl_errno($ch)) {
    echo 'Error en cURL: ' . curl_error($ch);
} else {
    // Imprimir la respuesta cruda de la API
    echo 'Respuesta cruda de la API: ' . $result;
}

$data = json_decode($result, true);
curl_close($ch);

var_dump($data);

?>

<head>
    <title> La Proxima Pelicula de Marvel </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    >
</head>
<main>
    <section>
        <?php if ($data !== null): ?>
            <img src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de <?= $data["title"]; ?>" style="border-radius: 16px;"/>
        <?php else: ?>
            <p>Error al obtener los datos de la API.</p>
        <?php endif; ?>
    </section>

    <hgroup>
        <h3> <?= $data["title"];?> se estrena en <?= $data["days_until"]; ?> dias </h3>
        <p>Fecha de estreno:  <?= $data["release_date"]; ?></p>
        <p> La siguiente es: <?= $data["following_production"] ["title"]; ?></p>
    </hgroup>
</main>

<style>

    :root {
        color-scheme: light dark;
    }

    body {
        display: grid;
        place-content: center;
    }

    section {
        display: flex;
        justify-content: center;
        text-align: center;
    }

</style>