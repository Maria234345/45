<template>
<div>
 <h2>Detalle Atencion</h2>
  <div class="row">
    <div class="col">
    <label>ID Historia</label>
    <input v-model="idhistoria" type="text" class="form-control">
    </div>
    <div class="col">
    <label>Doctor</label>
    <input v-model="iddoctor" type="text" class="form-control">
    </div>
    <div class="col">
    <label>Fecha</label>
    <input v-model="fecha" type="text" class="form-control">
    </div>
     <div class="col-md-2">
    <label>Sintomas</label>
    <input v-model="sintomas" type="text" class="form-control">
    </div>
      <div class="col-md-2">
    <label>Tratamientos</label>
    <input v-model="tratamientos" type="text" class="form-control">
    </div>
<div class="col-md-12">
    <br>
        <div class="container-buttons">

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
                                <th scope="col">ID Doctor</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Sintomas</th>
                                <th scope="col">Tratamientos</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task in arrayTasks" :key="task.id"> <!--Recorremos el array y cargamos nuestra tabla-->
                                <td v-text="task.idhistoria"></td>
                                <td v-text="task.iddoctor"></td>
                                 <td v-text="task.fecha"></td>
                                 <td v-text="task.sintomas"></td>
                                <td v-text="task.tratamientos"></td> 
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
                iddoctor:"",
                fecha:"",
                sintomas:"",
                tratamientos:"",
                
                update:0, /*Esta variable contrarolará cuando es una nueva tarea o una modificación, si es 0 significará que no hemos seleccionado
                          ninguna tarea, pero si es diferente de 0 entonces tendrá el id de la tarea y no mostrará el boton guardar sino el modificar*/
                arrayTasks:[], //Este array contendrá las tareas de nuestra bd
            }
        },
        methods:{
            getTasks(){
                let me =this;
                let url = '/atencion' //Ruta que hemos creado para que nos devuelva todas las iddoctor
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
                let url = '/atencion/guardar' //Ruta que hemos creado para enviar una tarea y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la tarea
                    'idhistoria':this.idhistoria,
                    'iddoctor':this.iddoctor,
                    'fecha':this.fecha,
                    'sintomas':this.sintomas,
                    'tratamientos':this.tratamientos,
                   

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
                axios.put('/atencion/actualizar',{
                    'iddetalle_atencion':this.update,
                    'idhistoria':this.idhistoria,
                    'iddoctor':this.iddoctor,
                    'fecha':this.fecha,
                    'sintomas':this.sintomas,
                    'tratamientos':this.tratamientos,
                    

                }).then(function (response) {
                   me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                   me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
                this.update = data.iddetalle_atencion
                let me =this;
                let url = '/atencion/buscar?iddetalle_atencion='+this.update;
                axios.get(url).then(function (response) {
                    me.idhistoria= response.data.idhistoria;
                    me.iddoctor= response.data.iddoctor;
                    me.fecha= response.data.fecha;
                    me.sintomas= response.data.sintomas;
                    me.tratamientos= response.data.tratamientos;
                  

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                }); 
            },
            deleteTask(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegiddetalle_atenciono
                let me =this;
                let task_id = data.iddetalle_atencion
                if (confirm('¿Seguro que deseas borrar esta tarea?')) {
                    axios.delete('/atencion/borrar/'+task_id
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
                this.iddoctor = "";
                this.fecha = "";
                this.sintomas = "";
                this.tratamientos = "";
                this.update = 0;
            }
        },
        mounted() {
           this.getTasks();
        }
    }
</script>

