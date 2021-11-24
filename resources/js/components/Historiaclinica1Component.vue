<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="content">
          <p>Hola este es un componente solo de lista</p>
          <table class="table">
            <thead>
            <td>ID Historia</td>
            <td>Fecha Entrada</td>
            <td>Fecha Alta</td>
            <td>Num Seguro</td>
            </thead>
            <tbody>
              <tr v-for="seleccion in historias" :key="seleccion.idproducto">
                <td>{{ seleccion.idhistoria }}</td>
                <td>{{ seleccion.fechaentrada }}</td>
                <td>{{ seleccion.fechaalta }}</td>
                <td>{{ seleccion.numseguro }}</td>
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
      historias: [],
    };
  },
  methods: {
    listar() {
      let me = this;
      let url = "/historiaclinica-vue/lista";
      axios
        .get(url)
        .then(function (response) {
          //creamos un array y guardamos el contenido
          console.log(response.data);
          me.historias = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
  },
  mounted() {
    this.listar();
    console.log("Component mounted." + this.historias);
  },
};
</script>