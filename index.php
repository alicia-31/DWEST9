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
        
        ul {
    list-style-type: none; /* Elimina los puntos de lista predeterminados */
    padding: 0; /* Elimina el padding por defecto */
    margin: 0; /* Elimina el margen por defecto */
    display: flex;
    flex-direction: column; /* Alinea los elementos de la lista de manera vertical */
    gap: 10px; /* Espacio entre los elementos */
}

li {
    background-color: #80deea; /* Fondo color suave */
    padding: 12px 20px; /* Relleno interno para los elementos de la lista */
    border-radius: 8px; /* Bordes redondeados */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Sombra sutil para los elementos */
    text-align: left; /* Alineación del texto a la izquierda */
    transition: background-color 0.3s, transform 0.2s; /* Transiciones suaves para hover */
}

li:hover {
    background-color: #4dd0e1; /* Cambia el color de fondo al pasar el cursor */
    transform: scale(1.05); /* Un ligero aumento de tamaño al pasar el ratón */
}

a {
    text-decoration: none; /* Elimina el subrayado del enlace */
    color: black; /* Color del texto */
    font-weight: bold; /* Negrita para destacar los nombres de los Pokémon */
}

a:hover {
    color: #004d40; /* Cambia el color del texto al pasar el ratón */
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
        <a href="about.php">Acerca de</a>
    </nav>
    
    <div class="container">

        <?php

        /**
         * Función para obtener los detalles de un Pokémon.
         * 
         * Realiza una solicitud HTTP a la API de Pokémon para obtener los detalles
         * de los primeros 20 Pokémon.
         *
         * @return array|false Devuelve un arreglo con los datos de los Pokémon o false si hubo un error.
         */
        function obtener_pokemon_lista() {
            $url = "https://pokeapi.co/api/v2/pokemon?limit=20"; // Limitamos a 20 Pokémon

            // Realizamos la solicitud a la API
            $json_data = file_get_contents($url);

            // Verificamos si la solicitud fue exitosa
            if ($json_data === FALSE) {
                return false;  // Retornamos false si no se pudo obtener la respuesta
            }

            // Decodificamos el JSON obtenido a un arreglo PHP
            return json_decode($json_data, true);
        }

        // Llamamos a la función para obtener la lista de Pokémon
        $data = obtener_pokemon_lista();

        // Verificamos si los datos fueron obtenidos correctamente
        if ($data === false) {
            echo "<p>No se pudieron obtener los datos de los Pokémon.</p>";
        } else {
            // Mostramos los detalles de los Pokémon en formato HTML
            echo "<h2>Lista de Pokémon</h2>";
            echo "<ul>";
            foreach ($data['results'] as $pokemon) {
                echo "<li><a href='pokemon_detail.php?name=" . $pokemon['name'] . "'>" . ucfirst($pokemon['name']) . "</a></li>";
            }
            echo "</ul>";
            
            // Mostrar los mismos datos en formato JSON
           //echo "<h3>Datos en formato JSON:</h3>";
           //echo "<pre>";
           //echo json_encode($data, JSON_PRETTY_PRINT);  // Mostramos los datos en JSON con formato legible
           //echo "</pre>";
        }
        ?>

    </div>

    <footer>
        <p>Aplicación Pokémon. Tarea 9 DWES.</p>
    </footer>

</body>
</html>
