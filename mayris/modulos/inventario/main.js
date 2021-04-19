var url = "http://localhost/mayris_api/apis/inventario/crud_inventario.php";

var appInventario = new Vue({
  el: "#appInventario",
  data: {
    clientes: [],
    producto: "",
    precio: "",
    cantidad: "",
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
              item.producto.toLowerCase().includes(BusquedaLimpia)
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
          '<div class="row">'+
            '<label class="col-sm-3 col-form-label">producto</label><div class="col-sm-7">'+
            '<input id="producto" type="text" class="form-control"></div>'+
          '</div>'+
          '<div class="row">'+
            '<label class="col-sm-3 col-form-label">precio</label><div class="col-sm-7">'+
            '<input id="precio" type="number" class="form-control"></div>'+
          '</div>'+
          '<div class="row">'+
            '<label class="col-sm-3 col-form-label">cantidad</label><div class="col-sm-7">'+
            '<input id="cantidad" type="number"  class="form-control">'+

          '</div>',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Guardar",
        confirmButtonColor: "#1cc88a",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "Cancelar",

        preConfirm: () => {
          return [
            (this.producto = document.getElementById("producto").value),
            (this.precio = document.getElementById("precio").value),
            (this.cantidad = document.getElementById("cantidad").value),

          ];
        },
      });
      if (this.producto == "" || this.precio == "" || this.cantidad == "" ) {
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
          title: "producto Agregado!",
        });
      }
    },
    btnEditar: async function (id_inventario, producto, precio, cantidad ) {
      await Swal.fire({
        title: "Editar producto",
        html:
          '<div class="form-group">'+
          '<div class="row"><label class="col-sm-3 col-form-label">producto</label><div class="col-sm-7"><input id="producto" value="' + producto +'" type="text" class="form-control"></div></div>'+
          '<div class="row"><label class="col-sm-3 col-form-label">precio</label><div class="col-sm-7"><input id="precio" value="' + precio +'" type="number" class="form-control"></div></div>'+
          '<div class="row"><label class="col-sm-3 col-form-label">cantidad</label><div class="col-sm-7"><input id="cantidad" value="' + cantidad +'" type="number"  class="form-control"></div></div>'+
          '</div>',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Guardar",
        confirmButtonColor: "#1cc88a",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.value) {
          (producto = document.getElementById("producto").value),
            (precio = document.getElementById("precio").value),
            (cantidad = document.getElementById("cantidad").value),
        

            this.editarMovil(id_inventario, producto, precio, cantidad );
          Swal.fire(
            "¡Actualizado!",
            "El producto ha sido actualizado.",
            "success"
          );
        }
      });
    },

    btnBorrar: function (id_inventario) {
      Swal.fire({
        title: "¿Está seguro de dar de baja el producto Numero: " + id_inventario + " ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",

      }).then((result) => {
        if (result.value) {
          this.borrarMovil(id_inventario);
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
          "opcion": 1,
          "producto": this.producto,
          "precio": this.precio,
          "cantidad": this.cantidad,
      
        })
        .then((response) => {
          this.listarMoviles();
        });
      (this.producto = ""), (this.precio = ""), (this.cantidad = "");
    },
    //Procedimiento EDITAR.
    editarMovil: function (id_inventario, producto, precio, cantidad) {
      axios
        .post(url, {
          opcion: 2,
          id_inventario: id_inventario,
          producto: producto,
          precio: precio,
          cantidad: cantidad,
        })
        .then((response) => {
          this.listarMoviles();
        });
    },
    //Procedimiento BORRAR.
    borrarMovil: function (id_inventario) {
      axios.post(url, { opcion: 3, id_inventario: id_inventario }).then((response) => {
        this.listarMoviles();
      });
    },
  },
  created: function () {
    this.listarMoviles();
  },

});
