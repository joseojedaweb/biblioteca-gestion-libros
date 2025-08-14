function eliminarLibro(id) {
    fetch('/eliminar-libro/' + id)
    
    .then(function(response) {
        return response.json();  // Espera la respuesta JSON
    })
    .then(function(data) {
        if (data.success) {
            // Si el préstamo se eliminó correctamente, eliminamos la fila de la tabla
            document.getElementById("file" + id).remove();
            document.getElementById("borrado").innerHTML = "Se ha borrado correctamente";
        } else {
            document.getElementById("borrado").innerHTML = data.message; // Mostrar el mensaje de error del controlador
        }
    })
    .catch(function(error) {
        console.log("Error:", error);
        document.getElementById("borrado").innerHTML = "Hubo un error al intentar borrar el préstamo";
    });
}