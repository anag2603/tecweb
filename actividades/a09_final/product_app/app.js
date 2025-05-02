// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "ANN:00",
    "marca": "NN",
    "detalles": "NN",
    "imagen": "img/default.png"
};

$(document).ready(function(){
    let edit = false;

    $('#precio').val("0.0");
    $('#unidades').val("1");
    $('#modelo').val("ANN_00");
    $('#marca').val("NN");
    $('#detalles').val("NN");
    $('#imagen').val("img/default.png");

    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.get('./backend/products', function(response) {
            const productos = typeof response === "string" ? JSON.parse(response) : response;

            if (Object.keys(productos).length > 0) {
                let template = '';

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
                });

                $('#products').html(template);
            }
        });
    }

    $('#search').keyup(function() {
        let search = $('#search').val();
        if (search) {
            $.get('./backend/products/' + search, function(response) {
                const productos = typeof response === "string" ? JSON.parse(response) : response;
                if (Object.keys(productos).length > 0) {
                    let template = '', template_bar = '';
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
                                    <button class="product-delete btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        `;
                        template_bar += `<li>${producto.nombre}</li>`;
                    });

                    $('#product-result').show();
                    $('#container').html(template_bar);
                    $('#products').html(template);
                }
            });
        } else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();
        const postData = {
            nombre: $('#name').val(),
            precio: parseFloat($('#precio').val()),
            unidades: parseInt($('#unidades').val()),
            modelo: $('#modelo').val(),
            marca: $('#marca').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val() || "img/default.png",
            id: $('#productId').val()
        };

        const method = edit ? 'PUT' : 'POST';
        $.ajax({
            url: './backend/product',
            type: method,
            data: JSON.stringify(postData),
            contentType: 'application/json',
            success: function(response) {
                const respuesta = typeof response === "string" ? JSON.parse(response) : response;
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message || ''}</li>
                `;
                $('#product-form')[0].reset();
                $('#product-result').show();
                $('#container').html(template_bar);
                listarProductos();
                edit = false;
                $('button.btn-primary').text("Agregar Producto");
            }
        });
    });

    $(document).on('click', '.product-delete', function () {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this).closest('tr');
            const id = element.attr('productId');
            $.ajax({
                url: './backend/product',
                type: 'DELETE',
                data: JSON.stringify({ id: parseInt(id) }),
                contentType: 'application/json',
                success: function(response) {
                    const respuesta = typeof response === "string" ? JSON.parse(response) : response;
                    const template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message || ''}</li>
                    `;
                    $('#product-result').show();
                    $('#container').html(template_bar);
                    listarProductos();
                }
            });
        }
    });

    $(document).on('click', '.product-item', function () {
        const element = $(this).closest('tr');
        const id = element.attr('productId');
        $.get('./backend/product/' + id, function(response) {
            const product = typeof response === "string" ? JSON.parse(response) : response;
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
    });
});