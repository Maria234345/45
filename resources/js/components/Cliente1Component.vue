<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="content">
          <p>Hola este es un componente solo de lista</p>
          <table class="table">
            <thead>
            <td>Apellidos y Nombres</td>
            <td>Celular</td>
            <td>Sexo</td>
            <td>DNI</td>
            </thead>
            <tbody>
              <tr v-for="seleccion in clientes" :key="seleccion.idcliente">
                <td>{{ seleccion.ape_nom }}</td>
                <td>{{ seleccion.celular }}</td>
                <td>{{ seleccion.sexo }}</td>
                <td>{{ seleccion.dni }}</td>
              </tr>
            </tbody>
          </table>


        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      clientes: [],
    };
  },
  methods: {
    listar() {
      let me = this;
      let url = "/cliente-vue/lista";
      axios
        .get(url)
        .then(function (response) {
          //creamos un array y guardamos el contenido
          console.log(response.data);
          me.clientes = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
  },
  mounted() {
    this.listar();
    console.log("Component mounted." + this.clientes);
  },
};
</script>