<template>
  <div class="content">
  <div class="input-group col-md-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">DNI</span>
    </div>
    <input type="text" class="form-control" v-model="dni" placeholder="DNI" aria-label="Username" aria-describedby="basic-addon1">
    <div class="col-md-3">
    <button  class="btn btn-primary" @click="buscar()">Buscar</button>
    </div>
  </div>
   <input placeholder="Apellidos y Nombres" v-model="txtape_nom" type="text">

  <input placeholder="Celular" v-model="txtcelular" type="text">

  <input placeholder="Sexo" v-model="txtsexo" type="text">
 
</div>
</template>
<script>
export default {
  data() {
    return {
        txtape_nom:"",
      txtcelular:"",
      txtsexo:"",
      dni:"",
      notas: [],
      modoEditar: false,
      nota: {nombre: '', descripcion: ''}
    }
  },
  created(){
    axios.get('/notas').then(res=>{
      this.notas = res.data;
    })
  },
  methods:{
    buscar(){
        const TOKEN ='e9972c7093ab1c11f069afd3d7f919ca2cfe18048a09f12aed9969916b6c6831'
            const BASEURL = 'https://vemasystem.com/api/';
            const ENDPOINT = 'dni';
            const dniB = { dni: this.dni };
            axios.create({
            baseURL: BASEURL,
            headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+TOKEN

            }

            })

            .post(ENDPOINT,dniB)

            .then(res => {

            //ira la modificacion de los datos
          this.txtape_nom=res.data.nombre_completo;

          //this.txtcelular="Ira el celular";

         // this.txtsexo="Ira el sexo";
            console.log(res.data);

            });

            alert("Buscar:"+this.dni);

            },
     
    cancelarEdicion(){
      this.modoEditar = false;
      this.nota = {nombre: '', descripcion: ''};
    }
  }
}
</script>