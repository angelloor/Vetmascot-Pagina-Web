function validarLogin(){
    
    var correo, clave, expresion;
    correo = document.getElementById("correo").value;
    clave = document.getElementById("clave").value;
    expresion = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/;
    
    if(correo == "" || clave =="" ){
        swal("Ingrese todos los Campos");
        return false;
    }else if(!expresion.test(correo)){
        swal("El correo no es válido")
        return false;
    } 
}
function validarRegister(){
    
    var nombre, direccion, telefono, correo, clave, expresion;
    nombre = document.getElementById("nombre").value;
    direccion = document.getElementById("direccion").value;
    telefono = document.getElementById("telefono").value;
    correo = document.getElementById("correo").value;
    clave = document.getElementById("clave").value;
    expresion = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/;
    
    if(nombre == "" || direccion =="" || telefono =="" || correo =="" || clave =="" ){
        swal("Ingrese todos los campos");
        return false;
    }else if(!expresion.test(correo)){
        swal("El correo no es válido")
        return false;
    }else if(telefono.length>10){
        swal("El telefono debe contener 10 números")
        return false;
    }else if(isNaN(telefono)){
        swal("El telefono ingresado no es un número")
        return false;
    }
}
function validarCorreo(){
    
    var correo, expresion;
    correo = document.getElementById("correo").value;
    expresion = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/;
    
    if(correo == ""){
        swal("Ingrese el correo electrónico");
        return false;
    }else if(!expresion.test(correo)){
        swal("El correo no es válido")
        return false;
    } 
}


