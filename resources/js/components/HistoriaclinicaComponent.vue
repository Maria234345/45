<template>
<div>
 <h2>Historia Clinica</h2>
  <div class="row">
    <div class="col">
    <label>ID Historia</label>
    <input v-model="idhistoria" type="text" class="form-control">
    </div>
    <div class="col">
    <label>Fecha Entrada</label>
    <input v-model="fechaentrada" type="text" class="form-control">
    </div>
    <div class="col">
    <label>Fecha Alta</label>
    <input v-model="fechaalta" type="text" class="form-control">
    </div>
     <div class="col-md-2">
    <label>Num Seguro</label>
    <input v-model="numseguro" type="text" class="form-control">
    </div>
<div class="col-md-12">
    <br>
        <div class="container-buttons">
                    <a link rel="stylesheet" href="http://127.0.0.1:8000/historiaclinica-vue/descarga" class="btn btn-secondary">Descargar PDF</a>
                    <button v-if="update == 0" @click="saveTasks()" class="btn btn-success">Añadir</button>
                    <!-- Botón que modifica la tarea que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="updateTasks()" class="btn btn-warning">Actualizar</button>
                    <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="clearFields()" class="btn btn-danger">Atrás</button>
        </div>
</div>
            <div class="col-md-12">     
                <table class="table text-center"><!--Creamos una tabla que mostrará todas las tareas-->
                        <thead>
                            <tr>
                                <th scope="col">ID Historia</th>
                                <th scope="col">Fecha Entrada</th>
                                 <th scope="col">Fecha Alta</th>
                                  <th scope="col">Num Seguro</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task in arrayTasks" :key="task.id"> <!--Recorremos el array y cargamos nuestra tabla-->
                                <td v-text="task.idhistoria"></td>
                                <td v-text="task.fechaentrada"></td>
                                 <td v-text="task.fechaalta"></td>
                                 <td v-text="task.numseguro"></td>  
                                <td>
                                  <button class="btn btn-info btn-sm" @click="loadFieldsUpdate(task)">Modificar</button>
                                    <!--Botón que borra la tarea que seleccionemos-->
                                    <button class="btn btn-danger btn-sm" @click="deleteTask(task)">Borrar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>

  </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                idhistoria:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                fechaentrada:"",
                fechaalta:"",
                numseguro:"",
                
                update:0, /*Esta variable contrarolará cuando es una nueva tarea o una modificación, si es 0 significará que no hemos seleccionado
                          ninguna tarea, pero si es diferente de 0 entonces tendrá el id de la tarea y no mostrará el boton guardar sino el modificar*/
                arrayTasks:[], //Este array contendrá las tareas de nuestra bd
            }
        },
        methods:{

            getTasks(){
                let me =this;
                let url = '/historiaclinica' //Ruta que hemos creado para que nos devuelva todas las fechaentrada
                axios.get(url).then(function (response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.arrayTasks = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            saveTasks(){
                let me =this;
                let url = '/historiaclinica/guardar' //Ruta que hemos creado para enviar una tarea y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la tarea
                    'idhistoria':this.idhistoria,
                    'fechaentrada':this.fechaentrada,
                    'fechaalta':this.fechaalta,
                    'numseguro':this.numseguro,
                   

                }).then(function (response) {
                    me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                    me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });   

            },
            updateTasks(){/*Esta funcion, es igual que la anterior, solo que tambien envia la variable update que contiene el id de la
                tarea que queremos modificar*/
                let me = this;
                axios.put('/historiaclinica/actualizar',{
                    'idhistoria_clinica':this.update,
                    'idhistoria':this.idhistoria,
                    'fechaentrada':this.fechaentrada,
                    'fechaalta':this.fechaalta,
                    'numseguro':this.numseguro,
                    

                }).then(function (response) {
                   me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                   me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
                this.update = data.idhistoria_clinica
                let me =this;
                let url = '/historiaclinica/buscar?idhistoria_clinica='+this.update;
                axios.get(url).then(function (response) {
                    me.idhistoria= response.data.idhistoria;
                    me.fechaentrada= response.data.fechaentrada;
                    me.fechaalta= response.data.fechaalta;
                    me.numseguro= response.data.numseguro;
                  

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                }); 
            },
            deleteTask(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegidhistoria_clinicao
                let me =this;
                let task_id = data.idhistoria_clinica
                if (confirm('¿Seguro que deseas borrar esta tarea?')) {
                    axios.delete('/historiaclinica/borrar/'+task_id
                    ).then(function (response) {
                        me.getTasks();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){/*Limpia los campos e inicializa la variable update a 0*/
                this.idhistoria = "";
                this.fechaentrada = "";
                this.fechaalta = "";
                this.numseguro = "";
          

                this.update = 0;
            }
        },
        mounted() {
           this.getTasks();
        }
    }
</script>

