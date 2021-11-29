let edit = false;
$(document).ready(function() {
    mostrarPacientes();
    mostrarCedulas();
    detectarCambio();
    
    $('#cedulas').val("-SELECCIONE-").change();

    $('#btn-agregar-examen').prop('disabled', true);
    
    $(document).on ("click", "#btn-edit-examen", function () {
      var currentRow=$(this).closest("tr"); 
      var id = currentRow.find("td:eq(0)").text();
      document.location.href = `edicion-examen.php?id=${id}`;
      $('#examen-cedula').text(id);
    });

    $(document).on ("click", "#btn-delete-examen", function () {
      if(confirm('Seguro que deseas eliminar el examen?')){
        var currentRow=$(this).closest("tr"); 
        //Obtener el id de la tarea que se quiere eliminar
           var id=currentRow.find("td:eq(0)").text(); 

           //Hacer la solicitud para eliminar la tarea
           $.post('eliminar-examen.php',{id},function(response){
            var cedula = $("#cedulas").find(':selected').text();
            console.log(cedula);
            mostrarExamenes(cedula);
           })
      }
    });

    $(document).on('click', '#btn-send-examen' , function (event) {
      var currentRow=$(this).closest("tr"); 
      var id=currentRow.find("td:eq(0)").text(); 
      console.log(id);
      $.ajax({
        url: `datos-correo.php?id=${id}`,
        type: 'GET',
        success: function(response){
          var examen = JSON.parse(response);
          var email = examen[0].correo;
          var subject = examen[0].examen;
          var emailBody = examen[0].contenido;
          window.open('mailto:' + email + '?subject=' + subject + '&body=' +   emailBody,'_blank');
        }
      })
    });
  

})

$('#menu-pacientes').click(function click(){
    console.log("hiciste click en pacientes");
    document.location.href = 'pacientes.html';
});

$('#menu-examenes').click(function click(){
    console.log("hiciste click en examenes");
    document.location.href = 'examenes.html';
});

$('#btn-agregar').click(function agregar(){
    $('#js--form-agregar').removeClass('no-visible');
    $('#js--form-agregar').addClass('active');
    setAction();
    console.log("mostrando form");
    
});
$('#btn-cancelar').click(function cancelar(){
    $('#js--form-agregar').addClass('no-visible');
    $('#form-agregar').reset;
    edit = false;
    $('#error-paciente').addClass('no-visible');
})


// CAPTURAR REGISTRO DE PACIENTE
$('#form-agregar').submit(function(e){
    const datos = {
        cedula: $('#cedula').val(),
        nombres: $('#nombres').val(),
        apellidos: $('#apellidos').val(),
        sexo: $("input[name='sexo']:checked").val(),
        edad: $('#edad').val(),
        telefono: $('#telefono').val(),
        correo: $('#correo').val()
    };

    console.log('enviando');
    console.log(datos);
    console.log(edit);
    let url = edit === false ? 'agregar-paciente.php' : 'editar-paciente.php';

    console.log(url);

    $.post(url, datos, function(response) {
        console.log(response);
        if (response == 'Exito'){
            edit = false;
            $('#js--form-agregar').addClass('no-visible');
            $('#error-paciente').addClass('no-visible');
            mostrarPacientes();
        }else{
          $('#error-paciente').removeClass('no-visible');
            edit = false;
        }
    });
    e.preventDefault();
    edit = false;
  })


 //MOSTRAR A LOS PACIENTES EN LA LISTA
 function mostrarPacientes() {
    $.ajax({
      url: 'mostrar-pacientes.php',
      type: 'GET',
      success: function(response){
        let pacientes = JSON.parse(response);
        let template ='';
        pacientes.forEach(paciente => {
          template += `
            <tr>
              <td>${paciente.cedula}</td>          
              <td>${paciente.nombres}</td> 
              <td>${paciente.apellidos}</td>
              <td>${paciente.sexo}</td>
              <td>${paciente.edad}</td>
              <td>${paciente.telefono}</td>
              <td>${paciente.correo}</td>
              <td class=""><i style="color: red; float: left" id='btn-delete' class="fas fa-trash btn-delete"></i><i id="btn-edit" style="float: right" class="fas fa-pencil-alt"></i></td>
            </tr>
          `;
        });
        $('#pacientes').html(template);
      }
  
    })
  }

 

     //Eliminar pacientes
  $(document).on('click','#btn-delete',function(){
    if(confirm('Seguro que deseas eliminar al paciente?')){
      var currentRow=$(this).closest("tr"); 
    
         var cedula=currentRow.find("td:eq(0)").text(); 
         var data='Cedula: ' + cedula ;
         console.log(data);

         $.post('eliminar-pacientes.php',{cedula},function(response){
           console.log(response);
           mostrarPacientes();
         })
    }
    
  });

  //Editar pacientes
  $(document).on('click','#btn-edit',function(){
    
    var currentRow=$(this).closest("tr"); 

        

       $('#js--form-agregar').removeClass('no-visible');
       $('#cedula').val(currentRow.find("td:eq(0)").text());
       $('#nombres').val(currentRow.find("td:eq(1)").text());
       $('#apellidos').val(currentRow.find("td:eq(2)").text());
       $('#sexo').val(currentRow.find("td:eq(3)").text());
       $('#edad').val(currentRow.find("td:eq(4)").text());
       $('#telefono').val(currentRow.find("td:eq(5)").text());
       $('#correo').val(currentRow.find("td:eq(6)").text());
       
        edit = true;

        setAction();
    
  });


  function setAction(){
    if(edit === true){
        $('#accion-texto').text('Editar paciente');
        $('#agregar').removeClass('btn-success');
        $('#agregar').addClass('btn-warning');
        $('#agregar').prop('value','Guardar edicion');
        $('#cedula').prop('disabled',true);
        console.log(edit);
    }else{
        $('#accion-texto').text('Agregar paciente');
        $('#agregar').removeClass('btn-warning');
        $('#agregar').addClass('btn-success');
        $('#agregar').prop('value','Agregar');
        $('#cedula').prop('disabled',false);
        console.log(edit);
        $('#form-agregar')[0].reset();
    }
  }


  //Mostrar solo las cedulas en el dropdown menu de la seccion de examenes
  function mostrarCedulas(){
    $.ajax({
        url: 'mostrar-pacientes.php',
        type: 'GET',
        success: function(response){
          let pacientes = JSON.parse(response);
          let template ='';
          pacientes.forEach(paciente => {
              console.log(paciente.cedula);
            $('#cedulas').append(`<option value="${paciente.cedula}">${paciente.cedula}</option>`);
          });
          
        }
    
      })
  }


  //Detectar cuando se cambie la cedula en la seccion de examenes
  function detectarCambio() {
    $('#cedulas').on('change', function (e) {
      if(!$('#cedulas').val() != "-SELECCIONE-"){
        console.log("holis");
        $('#btn-agregar-examen').prop('disabled', false);
      }
        var cedula = $("option:selected", this).text();
        mostrarExamenes(cedula);
    });
  }


  // OBTENER EXAMENES DE CADA PACIENTE
  function mostrarExamenes(cedula){
    if(cedula != '-SELECCIONE-' && cedula != ""){
      $.ajax({
        url: `obtener-examenes.php?cedula=${cedula}`,
        type: 'GET',
        success: function(response){
            if(!response === false){
                let examenes = JSON.parse(response);
                let template ='';
                examenes.forEach(examen => {
                  template += `
                    <tr>
                      <td>${examen.id}</td> 
                      <td>${examen.examen}</td>
                      <td class=""><i style="color: red; float: left" id='btn-delete-examen' class="fas fa-trash btn-delete"></i><i id='btn-send-examen' class="fas fa-envelope"></i><i id='btn-edit-examen' style="float: right" class="fas fa-pencil-alt"></i></td>
                    </tr>
                  `;
                });
                $('#examenes').html(template);
            }else{
                console.log('falso');
                $('#examenes').empty();
            }
          
        }
    
      })
    }
    
  }



  

  //GUARDAR EXAMEN
  $('#form-examen').submit(function(e){
    console.log($('#form-examen').serialize());
    $.ajax({
      type: 'POST',
      url: 'guardar-examen.php',
      data: $('#form-examen').serialize(),
      success: function(response){
        console.log(response)
        e.preventDefault();
      }
    })
  })


//AGREGAR UN NUEVO EXAMEN
$('#btn-agregar-examen').click(function(){
  $('#js--form-agregar-examen').removeClass('no-visible');
}) 

$('#btn-cancelar-examen').click(function(){
  $('#js--form-agregar-examen').addClass('no-visible');
  $('#form-agregar-examen')[0].reset();
})

$('#js--form-agregar-examen').submit(function(e){

  const datos = {
    'cedula' : $("#cedulas").find(':selected').text(),
    'examen' : $('#nombre-examen').val()
  }
  e.preventDefault();
  
  $.post('agregar-examen.php',datos, function(response){
    if (response == 'Exito'){
      edit = false;
      $('#js--form-agregar-examen').addClass('no-visible');
      $('#form-agregar-examen')[0].reset();
      mostrarExamenes(datos['cedula']);
  }else{
    console.log('error');
  }
  })

  e.preventDefault();
})

