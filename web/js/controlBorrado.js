function controlBorrado(path, reserva) {
//swal("Hello world!");

    swal({
    title: "¿Estás seguro?",
            text: "Vas a borrar la reserva de la fecha "+reserva,
            icon: "warning",
            buttons: true,
            dangerMode: true,
    })
            .then((willDelete) => {
            if (willDelete) {
//                swal("Poof! Your imaginary file has been deleted!", {
//                    icon: "success",
//                });
            
                    window.location.replace(path);
            
            
            }
            });
            return false;
}
