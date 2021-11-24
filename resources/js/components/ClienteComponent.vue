<template>
<div>
 <h2>Enfermeros</h2>
  <div class="row">
    <div class="col">
    <label>DNI</label>
    <input v-model="dni" type="text" placeholder="DNI" class="form-control">
    </div>
    <div class="col">
    <label>Apellido y Nombre</label>
    <input v-model="ape_nom" type="text" placeholder="Apellido y Nombre" class="form-control">
    </div>
    <div class="col">
    <label>Celular</label>
    <input v-model="celular" type="text" class="form-control">
    </div>
     <div class="col-md-2">
    <label>sexo</label>
    <input v-model="sexo" type="text" class="form-control">
    </div>
<div class="col-md-12">
    <br>
        <div class="container-buttons">
        <a link rel="stylesheet" href="cliente-vue/descarga" class="btn btn-secondary">Descargar PDF</a>
    <button  class="btn btn-primary" @click="buscar()">Buscar</button>
                    <button v-if="update == 0" @click="saveTasks()" class="btn btn-success">Añadir</button>
                    <!-- Botón que modifica la tarea que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="updateTasks()" class="btn btn-warning">Actualizar</button>
                    <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="clearFields()" class="btn btn-danger">Atrás</button>
        </div>
</div>
            <div class="col-md-12">
                <br>
               
                <table class="table text-center"><!--Creamos una tabla que mostrará todas las tareas-->
                        <thead>
                            <tr>
                                <th scope="col">Apellido y Nombre</th>
                                <th scope="col">DNI</th>
                                 <th scope="col">Celular</th>
                                  <th scope="col">Sexo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task in arrayTasks" :key="task.id"> <!--Recorremos el array y cargamos nuestra tabla-->
                                <td v-text="task.ape_nom"></td>
                                 <td v-text="task.dni"></td>
                                 <td v-text="task.celular"></td>
                                 <td v-text="task.sexo"></td>
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
                ape_nom:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                celular:"",
                dni:"",
                sexo:"",
                
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
         
          this.ape_nom=res.data.data.nombre_completo;
          
         
          //this.txtdireccion="Ira el direccion";

         // this.txtemail="Ira el email";
            console.log(res.data.data);

            });

            //alert("Buscar:"+this.dni);

            },



            getTasks(){
                let me =this;
                let url = '/cliente' //Ruta que hemos creado para que nos devuelva todas las nombre
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
                let url = '/cliente/guardar' //Ruta que hemos creado para enviar una tarea y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la tarea
                    'ape_nom':this.ape_nom,
                    'celular':this.celular,
                    'dni':this.dni,
                    'sexo':this.sexo,
                   

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
                axios.put('/cliente/actualizar',{
                    'idcliente':this.update,
                    'ape_nom':this.ape_nom,
                    'nombre':this.nombre,
                    'dni':this.dni,
                    'celular':this.celular,
                    

                }).then(function (response) {
                   me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                   me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
                this.update = data.idcliente
                let me =this;
                let url = '/cliente/buscar?idcliente='+this.update;
                axios.get(url).then(function (response) {
                    me.ape_nom= response.data.ape_nom;
                    me.celular= response.data.celular;
                    me.dni= response.data.dni;
                    me.sexo= response.data.sexo;
                  

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                }); 
            },
            deleteTask(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegidclienteo
                let me =this;
                let task_id = data.idcliente
                if (confirm('¿Seguro que deseas borrar esta tarea?')) {
                    axios.delete('/cliente/borrar/'+task_id
                    ).then(function (response) {
                        me.getTasks();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){
                this.ape_nom = "";
                this.celular = "";
                this.dni = "";
                this.sexo = "";
          

                this.update = 0;
            }
        },
        mounted() {
           this.getTasks();
        }
    }
</script>