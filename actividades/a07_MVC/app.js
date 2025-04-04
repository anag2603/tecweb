// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

$(document).ready(function(){
    let edit = false;

    $('#precio').val("0.0");
    $('#unidades').val("1");
    $('#modelo').val("XX-000");
    $('#marca').val("NA");
    $('#detalles').val("NA");
    $('#imagen').val("img/default.png");

    $('#product-result').hide();
    listarProductos();

    var productosExistentes = [];

    function listarProductos() {
        $.ajax({
            url: './backend/View/router.php?action=list',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);

                productosExistentes = productos;
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
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
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/View/router.php?action=search&search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
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
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();
        $('button.btn-primary').text("Agregar Producto");

        function validaciones(product){
            //console.log(product)
            if (!product.nombre || product.nombre.length > 100) {
                alert("Nombre obligatorio y no debe sobrepasar los 100 caracteres.");
                return false;
            }
        
            if (!product.marca || product.marca > 25) {
                alert("Debe seleccionar una marca.");
                return false;
            }
        
            if (!product.modelo || product.modelo.length > 25 || !/^[a-zA-Z0-9\s]+$/.test(product.modelo)) {
                alert("El modelo es obligatorio, alfanumérico y máximo 25 caracteres.");
                return false;
            }
        
            if (!product.precio || isNaN(product.precio) || parseFloat(product.precio) <= 99.99) {
                alert("El precio debe ser mayor a 99.99 y debe ser un número.");
                return false;
            }
        
            if (!product.unidades || isNaN(product.unidades) || parseInt(product.unidades) < 0) {
                alert("Las unidades deben ser un número mayor o igual a 0.");
                return false;
            }
        
            if (!product.imagen) {
                product.imagen = "img_2/imagen.png";
            }
        
            return true;
        }

        let postData = {
            nombre: $('#name').val(),
            precio: parseFloat($('#precio').val()),
            unidades: parseInt($('#unidades').val()),
            modelo: $('#modelo').val(),
            marca: $('#marca').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val() ? $('#imagen').val() : "img/default.png",
            id: $('#productId').val()  // Campo oculto para edición
        };
        
        if (!validaciones(postData)) {
            return;
        }

        const url = edit === false ? './backend/View/router.php?action=add' : './backend/View/router.php?action=edit';
        
        $.post(url, postData, (response) => {
            //console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#name').val('');
            $('#precio').val("0.0");
            $('#unidades').val("1");
            $('#modelo').val("XX-000");
            $('#marca').val("NA");
            $('#detalles').val("NA");
            $('#imagen').val("img/default.png");
            $('#product-result').show();
            $('#container').html(template_bar);
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
            $('button.btn-primary').text("Agregar Producto");
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/View/router.php?action=delete', {id}, (response) => {
                const respuesta = typeof response === "string" ? JSON.parse(response) : response;
                const template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $('#product-result').show();
                $('#container').html(template_bar);
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        $('button.btn-primary').text("Modificar Producto");
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/View/router.php?action=single', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#modelo').val(product.modelo);
            $('#marca').val(product.marca);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            $('#productId').val(product.id);
            edit = true;
            $('button.btn-primary').text("Modificar Producto");
        });
        e.preventDefault();
    });
    
    function actualizarEstado(mensaje, esValido) {
        let clase = esValido ? 'valid' : 'invalid';
        let template_bar = `<li style="list-style: none;" class="${clase}">${mensaje}</li>`;
        $('#product-result').show();
        $('#container').html(template_bar);
    }
    
    $('#name, #marca, #modelo, #precio, #detalles, #unidades').on('input', function () {
        let id = $(this).attr('id');
        let valor = $(this).val();
        let mensaje = '';
        let esValido = true;
        
    
        switch (id) {
            case 'name':
                if (valor === '' || valor.length > 100) {
                    mensaje = 'El nombre es obligatorio y debe tener máximo 100 caracteres.';
                    esValido = false;
                } else {
                    $.ajax({
                        url: './backend/View/router.php?action=name',
                        method: 'POST',
                        data: { nombre: valor },
                        dataType: 'json',
                        success: function (data) {
                            if (data.existe) {
                                mensaje = 'El nombre del producto ya existe en la base de datos :c';
                                esValido = false;
                            } else {
                                mensaje = 'Nombre válido =D';
                                esValido = true;
                            }
                            actualizarEstado(mensaje, esValido);  
                        },
                        error: function (xhr, status, error) {
                            console.error('Error al verificar el nombre D:', error);
                            mensaje = 'Hubo un error al verificar el nombre.';
                            esValido = false;
                            actualizarEstado(mensaje, esValido);  
                        }
                    });
                    return;  
                }
                break;
            case 'marca':
                if (valor === '') {
                    mensaje = 'Seleccione una marca.';
                    esValido = false;
                } else {
                    mensaje = 'Marca válida.';
                }
                break;
            case 'modelo':
                if (valor === '' || valor.length > 25 || !/^[a-zA-Z0-9]*$/.test(valor)) {
                    mensaje = 'El modelo debe ser alfanumérico y tener máximo 25 caracteres.';
                    esValido = false;
                } else {
                    mensaje = 'Modelo válido.';
                }
                break;
            case 'precio':
                if (isNaN(parseFloat(valor)) || parseFloat(valor) <= 99.99) {
                    mensaje = 'El precio debe ser mayor a 99.99.';
                    esValido = false;
                } else {
                    mensaje = 'Precio válido.';
                }
                break;
            case 'detalles':
                if (valor.length > 250) {
                    mensaje = 'Los detalles deben tener máximo 250 caracteres.';
                    esValido = false;
                } else {
                    mensaje = 'Detalles válidos.';
                }
                break;
            case 'unidades':
                if (isNaN(parseInt(valor)) || parseInt(valor) < 0) {
                    mensaje = 'Las unidades deben ser 0 o más.';
                    esValido = false;
                } else {
                    mensaje = 'Unidades válidas.';
                }
                break;
        }
    
        if (id !== 'name') {
            actualizarEstado(mensaje, esValido);
        }
    });
    
});