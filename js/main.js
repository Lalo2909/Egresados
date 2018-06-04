function bajaUniversidad(universidad){
    var r = confirm("Estas seguro que deseas eliminar " + universidad + "?");
    if(r == true){
      var cadena = "baja_universidad.php?uni=" + universidad;
        location.href=cadena;
    }
}

function bajaFacultad(facultad){
    var r = confirm("Estas seguro que deseas eliminar " + facultad + "?");
    if(r == true){
      var cadena = "baja_facultad.php?facultad=" + facultad;
        location.href=cadena;
    }
}


function bajaCarrera(carrera){
    var r = confirm("Estas seguro que deseas eliminar " + carrera + "?");
    if(r == true){
      var cadena = "baja_carrera.php?carrera=" + carrera;
        location.href=cadena;
    }
}

function agregaform(datos){
	d=datos.split('||');
	document.getElementById('inputEditarUniversidad').value = d[0];
  document.getElementById('inputEditarPais').value = d[2];
  document.getElementById('uniId').value = d[3];
  }

  function editarFacultad(datos){
  	d=datos.split('||');
  	document.getElementById('inputEditarFacultad').value = d[0];
    document.getElementById('inputEditarUniversidadFac').value = d[2];
    document.getElementById('facultadId').value = d[3];
    }

    function editarCarrera(datos){
      d=datos.split('||');
      document.getElementById('inputEditarCarrera').value = d[0];
      document.getElementById('inputEditarFacultadCar').value = d[2];
      document.getElementById('carreraId').value = d[3];
      }
