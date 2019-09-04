var tiposValidos =
        [
            'image/jpeg',
            'image/png'
        ];
        
        function validarTipos(file){
            for(var i=0; i<tiposValidos.length; i++){
                if(file.type === tiposValidos[i]){
                    return true;                    
                }                
            }
            return false;
        }

function onChange(event){
    //alert("Cambio producido");
    var file=event.target.files[0];
    //console.log(file);
    if(validarTipos(file)){
//        alert("Tipo Válido");
var tapaMiniatura=document.getElementById('tapaThumb');
tapaThumb.src=window.URL.createObjectURL(file);
    }
}
