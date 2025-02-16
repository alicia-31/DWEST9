<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pokémon</title>
    <style> 
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        header {
            background-color: #80deea;
            padding: 20px;
            text-align: center;
            color: black;
        }
        
        header h1 {
            margin: 0;
        }

        nav {
            background-color: #333;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        nav a:hover {
            color: #b2ebf2;
        }
        
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            justify-content: center;
        }
        
        footer {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
            margin-top: 30px;
        }

    </style>
</head>
<body>

    <header>
        <h1>Aplicación Pokémon</h1>
    </header>

    <nav>
        <a href="index.php">Inicio</a>
        <a href="about.php">Acerca de</a>
    </nav>
    
    <div class="container">

        <?php

        /* 
         * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
         * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
         */

        
        /**
         * Bloque de código para obtener y mostrar los detalles de un Pokémon.
         * 
         * Este bloque verifica si se ha proporcionado un nombre de Pokémon en la URL.
         * Si es así, realiza una solicitud a la API de Pokémon para obtener los detalles
         * del Pokémon especificado y los muestra en la página.
         * 
         * @return void No devuelve ningún valor, pero genera HTML para mostrar los detalles.
         */
        // Verificamos si el parámetro 'name' está presente en la URL
        if (isset($_GET['name'])) {
            $pokemon_name = $_GET['name'];

            // Construimos la URL de la API para obtener los detalles del Pokémon
            $url = "https://pokeapi.co/api/v2/pokemon/" . $pokemon_name;

            // Realizamos la solicitud a la API
            $json_data = file_get_contents($url);

            // Verificamos si la solicitud fue exitosa
            if ($json_data === FALSE) {
                echo "<p>Error al obtener los datos del Pokémon.</p>";
            } else {
                // Decodificamos el JSON obtenido a un arreglo PHP
                $data = json_decode($json_data, true);
                //mostramos los datos en json
                //echo json_encode($data);

                // Mostramos los detalles del Pokémon
                if ($data) {
                    echo "<h1>" . ucfirst($data['name']) . "</h1>";
                    echo "<img src='" . $data['sprites']['front_default'] . "' alt='" . $data['name'] . "' />";
                    echo "<p><strong>Altura:</strong> " . $data['height'] . " decímetros</p>";
                    echo "<p><strong>Peso:</strong> " . $data['weight'] . " hectogramos</p>";

                    // Mostrar habilidades
                    echo "<p><strong>Habilidades:</strong>";
                    foreach ($data['abilities'] as $ability) {
                        echo " " . $ability['ability']['name'] . ",";
                    }
                    echo "</p>";

                    // Mostrar tipos
                    echo "<p><strong>Tipos:</strong>";
                    foreach ($data['types'] as $type) {
                        echo " " . $type['type']['name'] . ",";
                    }
                    echo "</p>";
                } else {
                    echo "<p>No se pudieron obtener los detalles del Pokémon.</p>";
                }
            }
        } else {
            echo "<p>No se ha proporcionado el nombre del Pokémon.</p>";
        }
        ?>

    </div>

    <footer>
        <p> Aplicación Pokémon. Tarea 9 DWES.</p>
    </footer>

</body>
</html>

