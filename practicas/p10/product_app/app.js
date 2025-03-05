// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// SE INICIALIZA EL FORMULARIO CON LOS VALORES BASE
function init() {
    // Convierte el JSON a string para poder mostrarlo
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;

    // SE AGREGARÁ EL EVENTO DE 'input' AL CAMPO DE BÚSQUEDA
    document.getElementById('search').addEventListener('input', buscarProducto);
}

// FUNCIÓN DE BÚSQUEDA DINÁMICA
function buscarProducto(e) {
    e.preventDefault();

    // SE OBTIENE EL TÉRMINO DE BÚSQUEDA
    var searchTerm = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);

            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if (productos.length > 0) {
                let template = '';
                // SE ITERAN LOS PRODUCTOS Y SE CREAN LAS FILAS
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>precio: ' + producto.precio + '</li>';
                    descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>marca: ' + producto.marca + '</li>';
                    descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                    // SE CREA LA PLANTILLA DE LA FILA DEL PRODUCTO
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            } else {
                // SI NO SE ENCUENTRAN PRODUCTOS, SE MUESTRA UN MENSAJE
                document.getElementById("productos").innerHTML = '<tr><td colspan="3">No se encontraron productos.</td></tr>';
            }
        }
    };
    client.send("search=" + searchTerm);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try {
        objetoAjax = new XMLHttpRequest();
    } catch (err1) {
        try {
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

// FUNCIÓN PARA AGREGAR UN NUEVO PRODUCTO
function agregarProducto(event) {
    event.preventDefault(); // Prevenir el envío tradicional del formulario

    console.log("Formulario enviado"); // Para verificar que se dispara el evento

    // Obtener el valor del campo 'description' que contiene el JSON
    const description = document.getElementById('description').value;

    // Intentar convertir el JSON del campo description
    let producto;
    try {
        producto = JSON.parse(description); // Convertimos el JSON a un objeto
    } catch (error) {
        alert('El JSON ingresado no es válido.');
        return;
    }

    // Actualizamos el objeto producto con los datos del formulario
    producto.nombre = document.getElementById('name').value; // Nombre del producto

    // Validar que el JSON tenga todos los campos necesarios
    if (!producto.nombre || producto.precio <= 0 || producto.unidades <= 0 || !producto.modelo || !producto.marca) {
        alert('Por favor, complete todos los campos correctamente en el JSON.');
        return;
    }

    // Enviar los datos del producto al servidor (backend)
    fetch('./backend/create.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(producto),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Respuesta del servidor:', data);
        alert(data.message || data.error);
    })
    .catch(error => {
        console.error('Error en la petición:', error);
        alert('Error al conectar con el servidor.');
    });
}
