<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pokémon</title>
    <style> 
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        header {
            background-color:rgb(166, 121, 233);
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
            color: rgb(198, 167, 243); 
        }
        
        .container {
            max-width: 300px;
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
    </nav>
    
    <section class="container">

        <?php      
        /**
         * Bloque que obtiene y muestra detalles de un Pokemon.
         * 
         * Verifica si se ha proporcionado un nombre de Pokemon en la URL.
         * Si es asi, realiza una solicitud a la API para obtener los detalles
         * del Pokemon especificado y los muestra en la pagina.
         * 
         * @return void No devuelve ningún valor, pero genera HTML para mostrar los detalles.
         */

        // Verifica si el parametro 'name' está presente en la URL
        if (isset($_GET['name'])) {
            $pokemon_name = $_GET['name'];

            // URL de la API que obtiene los detalles del Pokemon
            $url = "https://pokeapi.co/api/v2/pokemon/" . $pokemon_name;

            // Realiza la solicitud a la API
            $json_data = file_get_contents($url);

            // Verifica la solicitud 
            if ($json_data === FALSE) {
                echo "<p>Error al obtener los datos del Pokémon.</p>";
            } else {
                // Decodifica el JSON obtenido a un array PHP
                $data = json_decode($json_data, true);
                //muestra los datos en JSON
                //echo json_encode($data);

                // muestra los detalles del Pokemon
                if ($data) {
                    echo "<h1>" . ucfirst($data['name']) . "</h1>";
                    echo "<img src='" . $data['sprites']['front_default'] . "' alt='" . $data['name'] . "' />";
                    echo "<p><strong>Altura:</strong> " . $data['height'] . " decímetros</p>";
                    echo "<p><strong>Peso:</strong> " . $data['weight'] . " hectogramos</p>";

                    // muestra las habilidades
                    echo "<p><strong>Habilidades:</strong>";
                    foreach ($data['abilities'] as $ability) {
                        echo " " . $ability['ability']['name'] . ",";
                    }
                    echo "</p>";

                    // muestra los tipos
                    echo "<p><strong>Tipos:</strong>";
                    foreach ($data['types'] as $type) {
                        echo " " . $type['type']['name'] . ",";
                    }
                    echo "</p>";
                } else {
                    echo "<p>No se han obtenido los detalles del Pokémon.</p>";
                }
            }
        } else {
            echo "<p>No se ha proporcionado el nombre del Pokémon.</p>";
        }
        ?>

    </section>

    <footer>
        <p> DWES Tarea 9 - Alicia Nieto Juárez</p>
    </footer>

</body>
</html>
