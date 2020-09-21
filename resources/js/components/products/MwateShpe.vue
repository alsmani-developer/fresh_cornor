<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" id="lable">عرض اشكال اللحوم</h3>

                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addNew" @click="openModalWindow">اضافه <i class="fas fa-shape-plus fa-fw"></i></button>
                </div>
              </div>
             
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>رقم شكل اللحمه</th>
                        <th>الاسم عربي</th>
                        <th>الاسم انجليزي</th>
                        
                  </tr> 

                   <tr
                      v-for="(shape, index) in shapes.data"
                      :key="shapes.id">
                                
                    <td>{{ shape.id }}</td>
                    <td>{{ shape.ar_name }}</td>
                    <td>{{ shape.en_name }}</td>
                   

                    <td>
                        <a href="#" data-id="shape.id" @click="editModalWindow(shape)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        |
                        <a href="#" @click="deleteshape(shape.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>
                </tbody>
                
                </table>
                <pagination
                    :data="shapes"
                    @pagination-change-page="loadshapes"
                ></pagination>
              </div>
            
              <div class="card-footer">
                 
              </div>
            </div>
           
          </div>
        </div>


            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">

                    <h5 v-show="!editMode" class="modal-title" id="addNewLabel">اضافه شكل لحمه جديد</h5>
                    <h5 v-show="editMode" class="modal-title" id="addNewLabel">تعديل بيانات الشكل</h5>

                    <button shape="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

<form @submit.prevent="editMode ? updateshape() : createshape()">
<div class="modal-body">
     <div class="form-group">
        <input v-model="form.ar_name" shape="text" name="ar_name"
            placeholder="الاسم عربي"
            class="form-control" :class="{ 'is-invalid': form.errors.has('ar_name') }">
        <has-error :form="form" field="ar_name"></has-error>
    </div>

     <div class="form-group">
        <input v-model="form.en_name" shape="text" name="en_name"
            placeholder="الاسم انجليزي"
            class="form-control" :class="{ 'is-invalid': form.errors.has('en_name') }">
        <has-error :form="form" field="en_name"></has-error>
    </div>
</div>
<div class="modal-footer">
    <button shape="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
    <button v-show="editMode" shape="submit" class="btn btn-primary">تعديل</button>
    <button v-show="!editMode" shape="submit" class="btn btn-primary">انشاء</button>
</div>

</form>

                </div>
            </div>
            </div>
    </div>

</template>

<script>
    export default {
      props :{
        routes :{
            shape:Object
        }
    },
        data() {
            return {
                editMode: false,
                shapes: {},
                form: new Form({
                    id: '',
                    ar_name : '',
                    en_name : '',

                })
            }
        },
        methods: {
        
        editModalWindow(shape){
           this.form.clear();
           this.editMode = true
           this.form.reset();
           $('#addNew').modal('show');
           this.form.fill(shape)
        },
        updateshape(){
           this.form.patch(this.routes.get+'/'+this.form.id)
               .then(response=>{

                   Success.fire({
                            icon: response.data.status,
                            title:response.data.title
                        })

                    

                   if(response.data.status =='success'){
                     $('#addNew').modal('hide');
                     this.loadshapes()
                   }
                        
               })
               .catch(()=>{
                  console.log("Error.....")
               })
        },
        openModalWindow(){
           this.editMode = false
           this.form.reset();
           $('#addNew').modal('show');
        },

        loadshapes() {

          axios.get(this.routes.get).then( data => (this.shapes = data.data));

          //pick data from controller and push it into shapes object

        },

        createshape(){
            this.form.post(this.routes.post)
                .then( response=> {
                   
                   

                        Success.fire({
                            icon: response.data.status,
                            title:response.data.title
                        })

                       if(response.data.status =='success'){
                          this.loadshapes()
                          $('#addNew').modal('hide');
                       }
                          
                        

                })
                .catch(() => {
                   console.log("Error......")
                })

     

            //this.loadshapes();
          },
          deleteshape(id) {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                
              if (result.value) {
                //Send Request to server
                this.form.delete(this.routes.post+'/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'shape deleted successfully',
                              'success'
                            )
                    this.loadshapes();

                    }).catch(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href>Why do I have this issue?</a>'
                        })
                    })
                }

            })
          }
        },

        mounted() { 
            this.loadshapes();
        }
    }
</script> 
<style>

    #form_button{
       margin-left: 100%;
    }
    .lable{
        text-align: center;
    }
    #text{
        text-align: center;
    }

</style>