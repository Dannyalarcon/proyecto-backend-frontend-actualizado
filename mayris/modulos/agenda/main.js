var url = "http://localhost/mayris_api/apis/agenda/crud_agenda.php";

var appAgenda = new Vue({
  el: "#appAgenda",
  data: {
    clientes: [],
    nombre: "",
    descripcion: "",
    precio: "",
    telefono: "",
    fecha: "",
    hora: "",
    buscador: "",

  },
  computed: {
    Busqueda() {
      const BusquedaLimpia = this.buscador.toLowerCase().trim();
  
      if (!BusquedaLimpia) {
        return this.clientes;
      } else {
        return this.clientes.filter(
            (item) =>
              item.nombre.toLowerCase().includes(BusquedaLimpia)||
              item.descripcion.toLowerCase().includes(BusquedaLimpia)||
              item.telefono.toLowerCase().includes(BusquedaLimpia)
  
  
          
        );
      }
      
    },
  },
  methods: {
    //BOTONES
    btnAlta: async function () {
      const { value: formValues } = await Swal.fire({
        title: "Agregar nueva cita",
        html:
        '<div class="form-row">'+
          '<div class="form-group col-md-12">'+
            '<label class="">nombre</label>'+
            '<input id="nombre" type="text" class="form-control" autocomplete="off">'+
          '</div>'+
        '</div>'+
        '<div class="form-row">'+
          '<div class="form-group col-md-12">'+
            '<label>descripcion</label>'+
            '<input id="descripcion" type="text" class="form-control" autocomplete="off">'+
          '</div>'+
        '</div>'+
        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label >precio</label>'+
            '<input id="precio" type="number"  class="form-control" autocomplete="off">'+
          '</div>'+
          '<div class="form-group col-md-6">'+
            '<label >telefono</label>'+
            '<input id="telefono" type="text" class="form-control" autocomplete="off" >'+
          '</div>'+
        '</div>'+
        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label>fecha</label>'+
            '<input id="fecha" type="date" class="form-control" autocomplete="off">'+
          '</div>'+
          '<div class="form-group col-md-6">'+
            '<label>hora</label>'+
            '<input id="hora" type="time" class="form-control" autocomplete="off">'+
          '</div>'+
        '</div>',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonColor: "#1cc88a",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Guardar",
        cancelButtonText: "Cancelar",
        preConfirm: () => {
          return [
            (this.nombre = document.getElementById("nombre").value),
            (this.descripcion = document.getElementById("descripcion").value),
            (this.precio = document.getElementById("precio").value),
            (this.telefono = document.getElementById("telefono").value),
            (this.fecha = document.getElementById("fecha").value),
            (this.hora = document.getElementById("hora").value),



          ];
        },
      });
      if (this.nombre == "" || this.descripcion == "" || this.precio == "" || this.telefono == "" || this.fecha == "" || this.hora == "") {

        Swal.fire({
          type: "info",
          title: "Datos incompletos",
        });
      } else {
        this.altaMovil();
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          
          timer: 3000,
        });
        Toast.fire({
          type: "success",
          title: "Cita Agregado!",
        });
      }
    },
    btnEditar: async function (id_agenda, nombre, descripcion, precio, telefono, fecha, hora ) {
      await Swal.fire({
        title: "Editar producto",
        html:
        '<div class="form-row">'+
          '<div class="form-group col-md-12">'+
            '<label >nombre</label>'+
            '<input id="nombre" value="' + nombre +'" type="text" class="form-control">'+
          '</div>'+
        '</div>'+

        '<div class="form-row">'+
          '<div class="form-group col-md-12">'+
            '<label >descripcion</label>'+
            '<input id="descripcion" value="' + descripcion +'" type="text" class="form-control">'+
          '</div>'+
        '</div>'+

        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label>precio</label>'+
            '<input id="precio" value="' + precio +'" type="number"  class="form-control">'+
          '</div>'+
          '<div class="form-group col-md-6">'+
            '<label>telefono</label>'+
            '<input id="telefono" value="' + telefono +'" type="number"  class="form-control">'+
          '</div>'+
        '</div>'+
        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label>fecha</label>'+
            '<input id="fecha" value="' + fecha +'" type="date"  class="form-control">'+
          '</div>'+
          '<div class="form-group col-md-6">'+
            '<label>hora</label>'+
            '<input id="hora" value="' + hora +'" type="time"  class="form-control">'+
          '</div>'+
        '</div>',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Guardar",
        confirmButtonColor: "#1cc88a",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "Cancelar",


      }).then((result) => {
        if (result.value) {
          (nombre = document.getElementById("nombre").value),
            (descripcion = document.getElementById("descripcion").value),
            (precio = document.getElementById("precio").value),
            (telefono = document.getElementById("telefono").value),
            (fecha = document.getElementById("fecha").value),
            (hora = document.getElementById("hora").value),
        

            this.editarMovil(id_agenda, nombre,descripcion, precio, telefono, fecha, hora );
          Swal.fire(
            "¡Actualizado!",
            "La cita ha sido actualizado.",
            "success"
          );
        }
      });
    },

    btnBorrar: function (id_agenda) {
      Swal.fire({
        title: "¿Está seguro de finalizar la cita Numero: " + id_agenda + " ?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#1cc88a",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Finalizar",
        cancelButtonText: "Cancelar",

      }).then((result) => {
        if (result.value) {
          this.borrarMovil(id_agenda);
          //y mostramos un msj sobre la eliminación
          Swal.fire("¡Eliminado!", "El registro ha sido borrado.", "success");
        }
      });
    },
    btnBan: function (id_agenda) {
      Swal.fire({
        title: "¿Está seguro de cancelar la cita Numero: " + id_agenda + " ?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.value) {
          this.banMovil(id_agenda);
          //y mostramos un msj sobre la eliminación
          Swal.fire("Cancelado!", "El registro ha sido cancelado.", "success");
        }
      });
    },
    //PROCEDIMIENTOS para el CRUD
    //MOSTRAR TABLA
    listarMoviles: function () {
      axios.post(url, { opcion: 4 }).then((response) => {
        this.clientes = response.data;
      });
    },
    //Procedimiento CREAR.
    altaMovil: function () {
      axios
        .post(url, {
          opcion: 1,
          nombre: this.nombre,
          descripcion: this.descripcion,
          precio: this.precio,
          telefono: this.telefono,
          fecha: this.fecha,
          hora: this.hora,
      
        })
        .then((response) => {
          this.listarMoviles();
        });
        (this.nombre = ""), (this.descripcion = ""), (this.precio = ""), (this.telefono = ""), (this.fecha = ""), (this.hora = "");
      },
    //Procedimiento EDITAR.
    editarMovil: function (id_agenda, nombre, descripcion, precio, telefono, fecha, hora) {
      axios
        .post(url, {
          opcion: 2,
          id_agenda: id_agenda,
          nombre: nombre,
          descripcion: descripcion,
          precio: precio,
          telefono: telefono,
          fecha: fecha,
          hora: hora,
        
        })
        .then((response) => {
          this.listarMoviles();
        });
    },
    //Procedimiento BORRAR.
 
    borrarMovil: function (id_agenda) {
      axios.post(url, { opcion: 3, id_agenda: id_agenda }).then((response) => {
        this.listarMoviles();
      });
    },
    banMovil: function (id_agenda) {
      axios.post(url, { opcion: 7, id_agenda: id_agenda }).then((response) => {
        this.listarMoviles();
      });
    },
  },
  created: function () {
    this.listarMoviles();
  },

});


