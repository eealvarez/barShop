function cambiarCatSelect(){
    $.getJSON( "http://localhost:8000/api/listarCategorias", function( data ){
        var ultimaCategoria= data[data.length-1];   //json que devuelve nuestra api, y nos quedamos con el último elemento (es decir, data.length-1)
        //console.log(ultimaCategoria);
        $(tapa_categoria).append(new Option(ultimaCategoria["nombre"], ultimaCategoria["id"]));                            //utilizando jQuery. EN jQuery para agregar nuevo elemento se utiliza .append()       
        //la sintaxis de la sentencia Option() es esta:
        //var optionElementReference = new Option(text, value, defaultSelected, selected);, por eso es que primero se coloca el nombre porque el primer parámentro es text, y luego se coloca el id, porque el segundo parámetro es value
    });
}
function nuevaCatAdd(){
    var ejecutarNuevaCat = $.post( "http://localhost:8000/api/insertarCategoria/"+$(nuevaCat).val(), function(){
        $(nuevaCat).val("");
        cambiarCatSelect();
        alert("Nueva categoria insertada");        
    }) 
            .fail(function(){
                alert( "Se ha producido un error al añadir la nueva categoría" );
    });            
}