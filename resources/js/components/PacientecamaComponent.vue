<template>
<div>
 <h2>Paciente Cama</h2>
  <div class="row">
    <div class="col">
    <label>Nombres</label>
    <input v-model="nom_paciente" type="text" class="form-control">
    </div>
    <div class="col">
    <label>Apellidos</label>
    <input v-model="ap_paciente" type="text" class="form-control">
    </div>
    <div class="col">
    <label>DNI</label>
    <input v-model="dni" type="text" class="form-control">
    </div>
     <div class="col-md-2">
    <label>Nº Cama</label>
    <input v-model="num_cama" type="text" class="form-control">
    </div>
  <div class="col-md-2">
    <label>Fecha Ingreso</label>
    <input v-model="fecha_ingreso" type="text" class="form-control">
    </div>
     <div class="col-md-2">
    <label>Fecha Salida</label>
    <input v-model="fecha_salida" type="text" class="form-control">
    </div>
<div class="col-md-12">
    <br>
        <div class="container-buttons">
                     <button  class="btn btn-primary" @click="buscar()">Buscar</button>
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
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col"> DNI</th>
                                 <th scope="col">Nº Cama</th>
                                  <th scope="col">Fecha Ingreso</th>
                                   <th scope="col">Fecha Salida</th>
                                   <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task in arrayTasks" :key="task.id"> <!--Recorremos el array y cargamos nuestra tabla-->
                                 <td v-text="task.nom_paciente"></td>
                                <td v-text="task.ap_paciente"></td>
                                 <td v-text="task.dni"></td>
                                 <td v-text="task.num_cama"></td>
                                <td v-text="task.fecha_ingreso"></td>
                                 <td v-text="task.fecha_salida"></td>
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
                nom_paciente:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                ap_paciente:"",
                dni:"",
                num_cama:"",
                fecha_ingreso:"",
                fecha_salida:"",
                
                update:0, /*Esta variable contrarolará cuando es una nueva tarea o una modificación, si es 0 significará que no hemos seleccionado
                          ninguna tarea, pero si es diferente de 0 entonces tendrá el id de la tarea y no mostrará el boton guardar sino el modificar*/
                arrayTasks:[], //Este array contendrá las tareas de nuestra bd
            }
        },
        methods:{
buscar(){
            const TOKEN ='ea1febefd57fdfe7131ee616d30d58cf7a9ce413422d97fb31b073ffb10df462'
            const BASEURL = 'https://apiperu.dev/api/';
            const ENDPOINT = 'dni';
            //const dniB = { dni: this.dni };
            axios.create({
            baseURL: BASEURL,
            headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+TOKEN

            }

            })

            .get(ENDPOINT+'/'+this.dni+'?'+TOKEN)

            .then(res => {

            //ira la modificacion de los datos
         
          this.nom_paciente=res.data.data.nombres;
          this.ap_paciente=res.data.data.apellido_paterno+" "+res.data.data.apellido_materno;
          
         
          //this.txtdireccion="Ira el direccion";

         // this.txtemail="Ira el email";
            console.log(res.data.data);

            });

            //alert("Buscar:"+this.dni);

            },

            getTasks(){
                let me =this;
                let url = '/cama' //Ruta que hemos creado para que nos devuelva todas las ap_paciente
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
                let url = '/cama/guardar' //Ruta que hemos creado para enviar una tarea y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la tarea
                    'nom_paciente':this.nom_paciente,
                    'ap_paciente':this.ap_paciente,
                    'dni':this.dni,
                    'num_cama':this.num_cama,
                    'fecha_ingreso':this.fecha_ingreso,
                    'fecha_salida':this.fecha_salida,
                   

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
                axios.put('/cama/actualizar',{
                    'idpacientecama':this.update,
                    'nom_paciente':this.nom_paciente,
                    'ap_paciente':this.ap_paciente,
                    'dni':this.dni,
                    'num_cama':this.num_cama,
                    'fecha_ingreso':this.fecha_ingreso,
                    'fecha_salida':this.fecha_salida,
                    

                }).then(function (response) {
                   me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                   me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
                this.update = data.idpacientecama
                let me =this;
                let url = '/cama/buscar?idpacientecama='+this.update;
                axios.get(url).then(function (response) {
                    me.nom_paciente= response.data.nom_paciente;
                    me.ap_paciente= response.data.ap_paciente;
                    me.dni= response.data.dni;
                    me.num_cama= response.data.num_cama;
                    me.fecha_ingreso= response.data.fecha_ingreso;
                    me.fecha_salida= response.data.fecha_salida;
                  

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                }); 
            },
            deleteTask(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegidpacientecamao
                let me =this;
                let task_id = data.idpacientecama
                if (confirm('¿Seguro que deseas borrar esta tarea?')) {
                    axios.delete('/cama/borrar/'+task_id
                    ).then(function (response) {
                        me.getTasks();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){/*Limpia los campos e inicializa la variable update a 0*/
                this.nom_paciente = "";
                this.ap_paciente = "";
                this.dni = "";
                this.num_cama = "";
                this.fecha_ingreso = "";
                this.fecha_salida = "";
          

                this.update = 0;
            }
        },
        mounted() {
           this.getTasks();
        }
    }
</script>

