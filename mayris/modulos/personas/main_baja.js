
var url = "http://localhost/mayris_api/apis/empleados/crud_personas.php";

var appInventario = new Vue({
  el: "#appInventario",
  data: {
    clientes: [],
    dpi: "",
    nombre: "",
    direccion: "",
    telefono: "",
    fecha: "",
    correo:"",
    salario: "",
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
              item.correo.toLowerCase().includes(BusquedaLimpia)


          
        );
      }
      
    },
  },
  methods: {
    //BOTONES
    btnAlta: async function () {
      const { value: formValues } = await Swal.fire({
        title: "Agregar nuevo producto",
        html:
        '<div class="form-row">'+
          '<div  class="form-group col-md-6">'+
            '<label class="">dpi</label>'+
            '<input id="dpi" type="text" class="form-control">'+
          '</div>'+
          '<div  class="form-group col-md-6">'+
          '<label class="">nombre</label>'+
            '<input id="nombre" type="text" class="form-control">'+
          '</div>'+
        '</div>'+
        '<div class="form-row">'+
          '<div  class="form-group col-md-6">'+
            '<label class="">salario</label>'+
            '<input id="salario" type="number"  class="form-control">'+
          '</div>'+ 
          '<div  class="form-group col-md-6">'+
            '<label class="">telefono</label>'+
            '<input id="telefono" type="text" class="form-control">'+
          '</div>'+
        '</div>'+
        '<div class="form-row">'+
          '<div  class="form-group col-md-6">'+
            '<label class="">fecha</label>'+
            '<input id="fecha" type="date" class="form-control">'+
          '</div>'+
          '<div  class="form-group col-md-6">'+
            '<label class="">correo</label>'+
            '<input id="correo" type="text"  class="form-control">'+
          '</div>'+
          '</div>'+

          '<div class="form-row">'+
          '<div  class="form-group col-md-12">'+
            '<label class="">direccion</label>'+
            '<input id="direccion" type="text" class="form-control">'+
          '</div>'+
        '</div>',
          
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Guardar",
        confirmButtonColor: "#1cc88a",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "Cancelar",
        
        preConfirm: () => {
          return [
            (this.dpi = document.getElementById("dpi").value),
            (this.nombre = document.getElementById("nombre").value),
            (this.direccion = document.getElementById("direccion").value),
            (this.telefono = document.getElementById("telefono").value),
            (this.fecha = document.getElementById("fecha").value),
            (this.correo = document.getElementById("correo").value),
            (this.salario = document.getElementById("salario").value),

          ];
        },
      });
      if (this.dpi == "" || this.nombre == "" || this.direccion == ""|| this.telefono == ""|| this.fecha == ""|| this.correo == ""|| this.salario == "" ) {
        Swal.fire({
     

          type: "warning",
          title: "Datos incompletos",
          timer: 3000,

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
          title: "producto Agregado!",
        });
      }
    },


 
    btnEditar: async function (id_empleados, dpi, nombre, salario, telefono, fecha, correo, direccion ) {
      await Swal.fire({
        title: "Editar empleado",
        html:
        '<div class="form-row">'+
        '<div class="form-group col-md-6">'+
          '<label>DPI</label>'+
          '<input id="dpi" value="' + dpi +'" type="text" class="form-control">'+
        '</div>'+
        '<div class="form-group col-md-6">'+
          '<label>Nombre</label>'+
          '<input id="nombre" value="' + nombre +'" type="text" class="form-control">'+
        '</div>'+
      '</div>'+
      '<div class="form-row">'+
        '<div class="form-group col-md-6">'+
          '<label>Salario</label>'+
          '<input id="salario" value="' + salario +'" type="text"  class="form-control">'+
        '</div>'+
        '<div class="form-group col-md-6">'+
          '<label>Teléfono</label>'+
          '<input id="telefono" value="' + telefono +'" type="text"  class="form-control">'+
        '</div>'+
      '</div>'+
      '<div class="form-row">'+
      '<div class="form-group col-md-6">'+
        '<label>Fecha</label>'+
        '<input id="fecha" value="' + fecha +'" type="date"  class="form-control">'+
      '</div>'+
      '<div class="form-group col-md-6">'+
        '<label>Correo</label>'+
        '<input id="correo" value="' + correo +'" type="text"  class="form-control">'+
      '</div>'+
    '</div>'+
    '<div class="form-row">'+
    '<div class="form-group col-md-12">'+
      '<label>Dirección</label>'+
      '<input id="direccion" value="' + direccion +'" type="text"  class="form-control">'+
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
            (salario = document.getElementById("salario").value),
            (telefono = document.getElementById("telefono").value),
            (fecha = document.getElementById("fecha").value),
            (correo = document.getElementById("correo").value),
            (direccion = document.getElementById("direccion").value),
        

            this.editarMovil(id_empleados, dpi, nombre, salario, telefono, fecha, correo, direccion );
          Swal.fire(
            "¡Actualizado!",
            "El producto ha sido actualizado.",
            "success"
          );
        }
      });
    },

    btnAtl: function (id_empleados) {
      Swal.fire({
        title: "¿Está seguro dar de alta al empleado Numero: " + id_empleados + " ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1cc88a",
        confirmButtonText:"Aceptar",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "Cancelar",     
       }).then((result) => {
        if (result.value) {
          this.borrarMovil(id_empleados);
          //y mostramos un msj sobre la eliminación
          Swal.fire("¡Eliminado!", "El registro ha sido borrado.", "success");
        }
      });
    },

    //PROCEDIMIENTOS para el CRUD
    //MOSTRAR TABLA
    listarMoviles: function () {
      axios.post(url, { opcion: 5 }).then((response) => {
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
          fecha: this.fecha,
          correo: this.correo,
          salario: this.salario,
      
        })
        .then((response) => {
          this.listarMoviles();
        });
      (this.dpi = ""), (this.nombre = ""), (this.direccion = ""), (this.telefono = ""), (this.fecha = ""), (this.correo = ""), (this.salario = "");
    },
    //Procedimiento EDITAR.
    editarMovil: function (id_empleados, dpi, nombre, salario, telefono, fecha, correo, direccion) {
      axios
        .post(url, {
          opcion: 2,
          id_empleados: id_empleados,
          dpi: dpi,
          nombre: nombre,
          salario: salario,
          telefono: telefono,
          fecha: fecha,
          correo: correo,
          direccion: direccion,

        })
        .then((response) => {
          this.listarMoviles();
        });
    },
    //Procedimiento BORRAR.
    borrarMovil: function (id_empleados) {
      axios.post(url, { opcion: 6, id_empleados: id_empleados }).then((response) => {
        this.listarMoviles();
      });
    },
  },
  created: function () {
    this.listarMoviles();
  },

});
