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
        
        ul {
            list-style-type: none; 
            padding: 0; 
            margin: 0; 
            display: flex;
            flex-direction: column; 
            gap: 10px; 
        }

        li {
            background-color: rgb(166, 121, 233); 
            padding: 12px 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); 
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
        }

        li:hover {
            background-color:rgb(198, 167, 243); 
            transform: scale(1.05); 
        }

        a {
            text-decoration: none; 
            color: black; 
            font-weight: bold; 
        }

        
        footer {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
            margin-top: 30px;
        }

        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
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
         * Función que obtiene los detalles de un Pokemon
         * 
         * con una solicitud HTTP a la API obtiene los detalles
         * de los primeros 30 Pokemon.
         *
         * @return array|false Devuelve un array con los datos de los Pokemon o false si hay un error.
         */
        function obtener_pokemon_lista() {
            $url = "https://pokeapi.co/api/v2/pokemon?limit=30"; // Se limita a 30 Pokemon

            // realiza la solicitud a la API
            $json_data = file_get_contents($url);

            // Verifica si la solicitud tuvo exito
            if ($json_data === FALSE) {
                return false;  // devuelve false si no tiene respuesta
            }

            // Decodifica el JSON obtenido a un array PHP
            return json_decode($json_data, true);
        }

        // Llama a la funcion para obtener la lista
        $data = obtener_pokemon_lista();

        // Verifica si los datos se obtienen correctamente
        if ($data === false) {
            echo "<p>No se pudieron obtener los datos de los Pokémon.</p>";
        } else {
            // Muestra  detalles de los Pokemon en formato HTML
            echo "<h2>Lista de Pokémon</h2>";
            echo "<ul>";
            foreach ($data['results'] as $pokemon) {
                echo "<li><a href='pokemon_detail.php?name=" . $pokemon['name'] . "'>" . ucfirst($pokemon['name']) . "</a></li>";
            }
            echo "</ul>";
            
           //muestra los datos en formato JSON
           echo "<h3>Datos en formato JSON:</h3>";
           echo "<pre>";
           echo json_encode($data, JSON_PRETTY_PRINT);  // datos en JSON en un formato legible
           echo "</pre>";
        }
        ?>
    </section>

    <footer>
        <p>DWES Tarea 9 - Alicia Nieto Juárez</p>
    </footer>

</body>
</html>
