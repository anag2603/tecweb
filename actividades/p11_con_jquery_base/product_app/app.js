$(document).ready(function() {
    let edit = false;
    
    listarProductos();

    // FUNCIÓN PARA LISTAR PRODUCTOS
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);
                if (Object.keys(productos).length > 0) {
                    let template = '';
                    productos.forEach(producto => {
                        let descripcion = `
                            <li>Precio: ${producto.precio}</li>
                            <li>Unidades: ${producto.unidades}</li>
                            <li>Modelo: ${producto.modelo}</li>
                            <li>Marca: ${producto.marca}</li>
                            <li>Detalles: ${producto.detalles}</li>
                        `;
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        const productos = JSON.parse(response);
                        if(Object.keys(productos).length > 0) {
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            

                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            $('#product-result').show();
                            $('#container').html(template_bar);
                            $('#products').html(template);    
                        }
                    }
                }
            });
        } else {
            $('#product-result').hide();
        }
    });

    // VALIDAR CAMPOS AL CAMBIAR DE FOCO
    $("#name, #precio, #unidades, #modelo, #marca").blur(function() {
        validarCampo($(this));
    });

    function validarCampo(elemento) {
        let valor = elemento.val().trim();
        let mensaje = "";

        if (valor === "") {
            mensaje = `El campo ${elemento.attr('id')} es obligatorio.`;
        } else {
            switch (elemento.attr('id')) {
                case 'precio':
                    if (isNaN(valor) || valor <= 0) mensaje = "El Precio debe ser un número mayor que 0.";
                    break;
                case 'unidades':
                    if (!Number.isInteger(parseInt(valor)) || parseInt(valor) <= 0) mensaje = "Debe ser un número entero mayor que 0.";
                    break;
            }
        }

        mostrarEstado(mensaje, elemento);
    }

    function mostrarEstado(mensaje, elemento) {
        let estadoCampo = elemento.next('.status-bar');
        if (!estadoCampo.length && mensaje) {
            estadoCampo = $('<div class="status-bar" style="color:#ffe18b; font-size:12px;"></div>');
            elemento.after(estadoCampo);
        }
        
        if (mensaje) {
            estadoCampo.text(mensaje).show();
        } else {
            estadoCampo.remove();
        }
    }

    // VALIDAR IMAGEN
    function validarImagen(elemento) {
        let valor = elemento.val().trim();
        if (valor === "") {
            elemento.val("default-image.jpg");
            mostrarEstado("Se ha asignado una imagen por defecto.", elemento);
        }
    }

    $("#imagen").blur(function() {
        validarImagen($(this));
    });

    // AGREGAR O MODIFICAR UN PRODUCTO
    $('#product-form').submit(e => {
        e.preventDefault();
        $(".status-bar").remove();
        $('#error-message').hide();
        
        let postData = {
            nombre: $('#name').val(),
            precio: parseFloat($('#precio').val()),
            unidades: parseInt($('#unidades').val()),
            modelo: $('#modelo').val(),
            marca: $('#marca').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val(),
            id: $('#productId').val()
        };

        let camposValidos = true;
        $("#name, #precio, #unidades, #modelo, #marca").each(function() {
            if ($(this).val().trim() === "") {
                validarCampo($(this)); 
                camposValidos = false;
            }
        });
        $("#imagen").each(function() {
            if ($(this).val().trim() === "") {
                validarImagen($(this)); 
            }
        });

        if (camposValidos) {
            $.ajax({
                url: './backend/product-save.php',
                type: 'POST',
                data: postData,
                success: function(response) {
                    if (response) {
                        alert(response);
                    }
                }
            });
        }
    });

    // VALIDAR SI EL NOMBRE EXISTE EN LA BASE DE DATOS
    $('#name').keyup(function() {
        let search = $('#name').val();
        if (search.length > 0) {
            $.ajax({
                url: './backend/product-name.php?name=' + search,
                type: 'GET',
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.error) {
                        $('#name').addClass('invalid');
                        $('#error-message')
                            .text('Nombre inválido, ya existe un producto con ese nombre')
                            .show();
                    } else {
                        $('#error-message').hide();
                    }
                }
            });
        } else {
            $('#error-message').hide();
        }
    });
});


