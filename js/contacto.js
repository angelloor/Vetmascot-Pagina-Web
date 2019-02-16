function validar(){
    
  var nombre, correo, telefono, mensaje, expresion;
  nombre = document.getElementById("nombre").value;
  correo = document.getElementById("correo").value;
  telefono = document.getElementById("telefono").value;
  mensaje = document.getElementById("mensaje").value;
  expresion = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/;
  
  if(correo == "" || correo == "" || correo == "" || correo == "" ){
      swal("Ingrese todos los Campos");
      return false;
  }else if(!expresion.test(correo)){
      swal("El correo no es válido")
      return false;
  }else if(nombre.length>100){
    swal("El nombre no debe superar a 100 caracteres")
    return false;
  }else if(correo.length>75){
    swal("El nombre no debe superar a 75 caracteres")
    return false;
  }else if(telefono.length>10){
    swal("El teléfono debe contener 10 numeros")
    return false;
  }else if(isNaN(telefono)){
    swal("El teléfono Ingresado no es un número")
    return false;
  }else if(mensaje.length>255){
    swal("El nombre no debe superar a 255 caracteres")
    return false;
  }
}