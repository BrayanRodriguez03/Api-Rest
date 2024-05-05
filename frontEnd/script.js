document.addEventListener("DOMContentLoaded", function () {
    $("#guardarHelado").on("click", function () {
      let datos = {
        nombre: $("#nombre").val(),
        sabor: $("#sabor").val(),
        precio: $("#precio").val(),
        stock: $("#stock").val(),
      };
      if ($("#id-helado").val() === "") {
        crearHelado(datos);
      } else {
        datos.id = $("#id-helado").val();
        editarHelado(datos);
      }
    });
  
    $("#agregarHelado").on("click", function () {
      $("#id-helado").val("");
    });
    $(".btn-warning").on("click", function () {
      let idHelado = $(this).data("id");
      $("#id-helado").val(idHelado);
    });
  
    $(".btnEliminar").on("click", function () {
      let idHelado = $(this).data("id");
      $("#id-helado").val(idHelado);
    });
  
    $("#btnEliminarHelado").click(function () {
      let id = $("#id-helado").val();
      eliminar(id);
    });
  });



  $("#helado").on("shown.bs.modal", function () {
  
  
    if ($("#id-helado").val() !== "") {
      $.ajax({
        type: "GET",
        url: "http://localhost/apirestbrayan/backEnd/get_id_helado.php",
        dataType: "JSON",
        data: { id: $("#id-helado").val() },
        success: function (respuesta) {
          $("#nombre").val(respuesta[0].nombre);
          $("#sabor").val(respuesta[0].sabor);
          $("#precio").val(respuesta[0].precio);
          $("#stock").val(respuesta[0].stock);
        },
        error: function (error) {
          // Manejar errores
          console.error("Error en la solicitud AJAX:", error);
          Swal.fire({
            title: "Error",
            text: "error:" + error,
            icon: "error",
          });
        },
      });
    }else{
      $("#nombre").val("");
          $("#sabor").val("");
          $("#precio").val("");
          $("#stock").val("");
    }
    
  });
  
  function crearHelado(datos = {}) {
    let errores = false;
  
    for (let campo in datos) {
      if (datos[campo].trim() === "") {
        $("#" + campo)
          .removeClass("is-valid")
          .addClass("is-invalid");
        errores = true;
      } else {
        $("#" + campo)
          .removeClass("is-invalid")
          .addClass("is-valid");
      }
    }
    if (errores) {
      Swal.fire({
        title: "Error",
        text: "error: porfavor llene los campos",
        icon: "error",
      });
      return;
    }
  
    $.ajax({
      type: "POST",
      url: "http://localhost/apirestbrayan/backEnd/create_helado.php",
      data: datos,
      dataType: "json",
      success: function (respuesta) {
        $("#helado").modal("hide");
  
        $("#nombre").val(""),
          $("#sabor").val(""),
          $("#precio").val(""),
          $("#stock").val(""),
          console.log(respuesta);
        Swal.fire({
          title: "Exito",
          text: respuesta.message,
          icon: "success",
          timer: 5000,
        }).then(() => {
          location.reload();
        });
      },
      error: function (error) {
        // Manejar errores
        console.error("Error en la solicitud AJAX:", error);
        Swal.fire({
          title: "Error",
          text: "error:" + error,
          icon: "error",
        });
      },
    });
  }
  
  function editarHelado(datos = {}) {
    let errores = false;
  
    for (let campo in datos) {
      if (datos[campo].trim() === "") {
        $("#" + campo)
          .removeClass("is-valid")
          .addClass("is-invalid");
        errores = true;
      } else {
        $("#" + campo)
          .removeClass("is-invalid")
          .addClass("is-valid");
      }
    }
    if (errores) {
      Swal.fire({
        title: "Error",
        text: "error: porfavor llene los campos",
        icon: "error",
      });
      return;
    }
  
    $.ajax({
      type: "PUT",
      url: "http://localhost/apirestbrayan/backEnd/update_helado.php",
      data: datos,
      dataType: "json",
      success: function (respuesta) {
        $("#helado").modal("hide");
  
        $("#nombre").val(""),
          $("#sabor").val(""),
          $("#precio").val(""),
          $("#stock").val(""),
          console.log(respuesta);
        Swal.fire({
          title: "Exito",
          text: respuesta.message,
          icon: "success",
          timer: 5000,
        }).then(() => {
          location.reload();
        });
      },
      error: function (error) {
        // Manejar errores
        console.error("Error en la solicitud AJAX:", error);
        Swal.fire({
          title: "Error",
          text: "error:" + error,
          icon: "error",
        });
      },
    });
  }
  
  function eliminar(id) {
    console.log(id);
    $.ajax({
      type: "DELETE",
      url: "http://localhost/apirestbrayan/backEnd/delete_helado.php?id=" + id,
      dataType: "json",
      success: function (respuesta) {
        console.log(respuesta);
        $('modalEliminar').modal('hide')
        Swal.fire({
          title: "Exito",
          text: respuesta.message,
          icon: "success",
          timer: 5000,
        }).then(() => {
          location.reload();
        });
      },
      error: function (error) {
        // Manejar errores
        console.error("Error en la solicitud AJAX:", error);
        Swal.fire({
          title: "Error",
          text: "error:" + error,
          icon: "error",
        });
      },
    });
  }

