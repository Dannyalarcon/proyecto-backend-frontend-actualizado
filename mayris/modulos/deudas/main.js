
var url = "http://localhost/mayris_api/apis/deudas/crud_deudas.php";


var appAgenda = new Vue({
  el: "#appAgenda",
  data: {
    clientes: [],

    dpi: "",
    nombre: "",
    direccion: "",
    telefono: "",
    deuda: "",
    precio: "",
    fecha: "",
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
              item.dpi.toLowerCase().includes(BusquedaLimpia)||
              item.nombre.toLowerCase().includes(BusquedaLimpia)||
              item.direccion.toLowerCase().includes(BusquedaLimpia)||
              item.telefono.toLowerCase().includes(BusquedaLimpia)||
              item.deuda.toLowerCase().includes(BusquedaLimpia)



          
        );
      }
      
    },
  },
  methods: {
    //BOTONES
    btnAlta: async function () {
      const { value: formValues } = await Swal.fire({
        title: "Agregar nueva deuda",
        html:
        '<div class="form-row">'+
          '<div  class="form-group col-md-6">'+
            '<label class="">dpi</label>'+
            '<input id="dpi" type="number" class="form-control" autocomplete="off">'+
          '</div>'+

 
          '<div  class="form-group col-md-6">'+
            '<label >nombre</label>'+
            '<input id="nombre" type="text" class="form-control" autocomplete="off">'+
          '</div>'+
        '</div>'+

        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label >direccion</label>'+
            '<input id="direccion" type="text"  class="form-control" autocomplete="off">'+
          '</div>'+
          
          '<div class="form-group col-md-6">'+
            '<label >telefono</label>'+
            '<input id="telefono" type="number" class="form-control" autocomplete="off" >'+
          '</div>'+
        '</div>'+

        '<div class="form-row">'+
          '<div class="form-group col-md-12">'+
            '<label >deuda</label>'+
            '<input id="deuda" type="text"  class="form-control" autocomplete="off">'+
          '</div>'+
          '</div>'+
          
        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label>precio</label>'+
            '<input id="precio" type="number" class="form-control" autocomplete="off">'+
          '</div>'+
          '<div class="form-group col-md-6">'+
          '<label>fecha</label>'+
          '<input id="fecha" type="date" class="form-control" autocomplete="off">'+
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
            (this.dpi = document.getElementById("dpi").value),
            (this.nombre = document.getElementById("nombre").value),
            (this.direccion = document.getElementById("direccion").value),
            (this.telefono = document.getElementById("telefono").value),
            (this.deuda = document.getElementById("deuda").value),
            (this.precio = document.getElementById("precio").value),
            (this.fecha = document.getElementById("fecha").value),



          ];
        },
      });
      if (this.dpi == "" || this.nombre == "" || this.direccion == "" || this.telefono == ""  || this.deuda == ""|| this.precio =="" || this.fecha == "") {

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
    btnEditar: async function (id_deuda, dpi, nombre, direccion, telefono, deuda,precio, fecha) {
      await Swal.fire({
        title: "Editar deuda",
        html:
        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label >dpi</label>'+
            '<input id="dpi" value="' + dpi +'" type="number" class="form-control">'+
          '</div>'+

          '<div class="form-group col-md-6">'+
            '<label >nombre</label>'+
            '<input id="nombre" value="' + nombre +'" type="text" class="form-control">'+
          '</div>'+
        '</div>'+

        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label>direccion</label>'+
            '<input id="direccion" value="' + direccion +'" type="text"  class="form-control">'+
          '</div>'+
          '<div class="form-group col-md-6">'+
            '<label>telefono</label>'+
            '<input id="telefono" value="' + telefono +'" type="number"  class="form-control">'+
          '</div>'+
        '</div>'+
        '<div class="form-row">'+
          '<div class="form-group col-md-12">'+
            '<label>deuda</label>'+
            '<input id="deuda" value="' + deuda +'" type="text"  class="form-control">'+
          '</div>'+
        '</div>'+
        '<div class="form-row">'+
          '<div class="form-group col-md-6">'+
            '<label>precio</label>'+
            '<input id="precio" value="' + precio +'" type="number"  class="form-control">'+
          '</div>'+
          '<div class="form-group col-md-6">'+
          '<label>fecha</label>'+
          '<input id="fecha" value="' + fecha +'" type="date"  class="form-control">'+
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
          (dpi = document.getElementById("dpi").value),
          (nombre = document.getElementById("nombre").value),
            (direccion = document.getElementById("direccion").value),
            (telefono = document.getElementById("telefono").value),
            (deuda = document.getElementById("deuda").value),
            (precio = document.getElementById("precio").value),
            (fecha = document.getElementById("fecha").value),


            this.editarMovil(id_deuda,dpi, nombre,direccion,telefono,deuda, precio,fecha);
          Swal.fire(
            "¡Actualizado!",
            "La cita ha sido actualizado.",
            "success"
          );
        }
      });
    },

    btnBorrar: function (id_deuda) {
      Swal.fire({
        title: "¿Está seguro de finalizar la deuda Numero: " + id_deuda + " ?",
        type: "question",
        showCancelButton: true,
        confirmButtonColor: "#1cc88a",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si",
        cancelButtonText: "No",

      }).then((result) => {
        if (result.value) {
          this.borrarMovil(id_deuda);
          //y mostramos un msj sobre la eliminación
          Swal.fire("¡Eliminado!", "El registro ha sido borrado.", "success");
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
          dpi: this.dpi,
          nombre: this.nombre,
          direccion: this.direccion,
       
          telefono: this.telefono,
          deuda: this.deuda,
          precio: this.precio,
          fecha: this.fecha,

      
        })
        .then((response) => {
          this.listarMoviles();
        });
        (this.dpi = ""), (this.nombre = ""), (this.direccion = ""), (this.telefono = ""), (this.deuda = ""), (this.precio = ""), (this.fecha ="");
      },
    //Procedimiento EDITAR.
    editarMovil: function (id_deuda,dpi, nombre, direccion, telefono,deuda,precio,  fecha) {
      axios
        .post(url, {
          opcion: 2,
          id_deuda: id_deuda,
          dpi: dpi,
          nombre: nombre,
          direccion: direccion,
          telefono: telefono,
          deuda: deuda,
          precio: precio,
          fecha: fecha,
 
        
        })
        .then((response) => {
          this.listarMoviles();
        });
    },
    //Procedimiento BORRAR.
 
    borrarMovil: function (id_deuda) {
      axios.post(url, { opcion: 3, id_deuda: id_deuda }).then((response) => {
        this.listarMoviles();
      });
    },
   
  },
  created: function () {
    this.listarMoviles();
  },

});


