<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" id="lable">عرض التخفيضات</h3>

                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addNew" @click="openModalWindow">اضافه <i class="fas fa-discount-plus fa-fw"></i></button>
                </div>
              </div>
             
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>رقم التخفيض</th>
                        <th>الاسم عربي</th>
                        <th>الاسم انجليزي</th>
                        <th>الوصف عربي</th>
                        <th>الوصف انجليزي</th>
                        <th>نوع التخفيض</th>
                        
                  </tr> 

                   <tr
                      v-for="(discount, index) in discounts.data"
                      :key="discounts.id">
                                
                    <td>{{ discount.id }}</td>
                    <td>{{ discount.ar_name }}</td>
                    <td>{{ discount.en_name }}</td>
                    <td>{{ discount.ar_description }}</td>
                    <td>{{ discount.en_description }}</td>
                    <td>
                        <p v-if="discount.discount_type_id==1">نوعي</p>
                         <p v-if="discount.discount_type_id==2">كمي</p>
                    </td>
                   

                    <td>
                        <button class="btn-primary" data-id="discount.id" @click="editModalWindow(discount)">
                            <i class="fa fa-edit blue"></i>
                        </button>
                        |
                        <button class="btn-danger"  @click="deletediscount(discount.id)">
                            <i class="fa fa-trash red"></i>
                        </button>

                    </td>
                  </tr>
                </tbody>
                
                </table>
                <pagination
                    :data="discounts"
                    @pagination-change-page="loaddiscounts"
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

                    <h5 v-show="!editMode" class="modal-title" id="addNewLabel">اضافه  لحمه جديد</h5>
                    <h5 v-show="editMode" class="modal-title" id="addNewLabel">تعديل بيانات اللحمه</h5>

                    <button discount="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

        <form @submit.prevent="editMode ? updatediscount() : creatediscount()">
            <div class="modal-body">
                <div class="form-group">
                    <input v-model="form.ar_name" discount="text" name="ar_name"
                        placeholder="الاسم عربي"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('ar_name') }">
                    <has-error :form="form" field="ar_name"></has-error>
                </div>

                <div class="form-group">
                    <input v-model="form.en_name" discount="text" name="en_name"
                        placeholder="الاسم انجليزي"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('en_name') }">
                    <has-error :form="form" field="en_name"></has-error>
                </div>
                
                <div class="form-group">
                     <label > تاريخ البدايه:</label>
                   <input class="form-control" type="date"  v-model="form.start_date">
                </div>
                <div class="form-group">
                     <label > تاريخ النهايه:</label>
                   <input class="form-control" type="date"  v-model="form.end_date">
                </div>
                <div class="form-group">
                     <label > قيمه التخفيض:</label>
                   <input class="form-control" type="number"  v-model="form.amount">
                </div>
                <div class="form-group">
                    <label > نوع التخفيض:</label>
                    <select class="form-control" v-model="form.discount_type_id" id="exampleFormControlSelect1">
                            <option  v-bind:value="1">نوعي</option>
                            <option  v-bind:value="2">كمي</option>
                    </select>
                </div>
                <div class="form-group" v-if="form.discount_type_id==2">
                     <label > ادخل الكميه:</label>
                    <input class="form-control" type="number"  v-model="form.qnt">
                </div>
                <div class="form-group"  v-show="!editMode">
                     <label > اختر المنتج:</label>
                      <select name="meat_id[]" id="meat_id" v-model="form.meat_id" class="form-control" multiple>
                            <option  v-for="meat in meats"  v-bind:value="meat.id">{{meat.ar_name}}</option>

                    </select>
                    
                </div>
                <div class="form-group">
                     <label >  وصف عربي:</label>
                    <textarea class="form-control" cols="30" v-model="form.ar_description"></textarea> 
                </div>
                <div class="form-group">
                     <label > وصف انجليزي:</label>
                   <textarea class="form-control" cols="30" v-model="form.en_description"></textarea>
                </div>
                <div class="form-group">
                     <label > صوره للتخفيض:</label>
                     <img :src="form.pic" width="100" height="100">
                    <input type="file" v-on:change="upload_image" class="form-control" >
                </div>
            </div>
            <div class="modal-footer">
                <button discount="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                <button v-show="editMode" discount="submit" class="btn btn-primary">تعديل</button>
                <button v-show="!editMode" discount="submit" class="btn btn-primary">اضافه</button>
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
            discount:Object
        }
    },
        data() {
            return {
                editMode: false,
                discounts: {},
                meats :{},
            
                form: new Form({
                    id: '',
                    ar_name : '',
                    en_name : '',
                    ar_description:'',
                    en_description:'',
                    discount_type_id:'',
                    pic:'',
                    start_date:'',
                    end_date:'',
                    qnt:'',
                    meat_id:[],
                    amount:'',
                    img_name:'',

                })
            }
        },
        methods: {
            getData(){
                 axios.get(this.routes.meats)
                    .then((response =>{
                        this.meats=response.data
                        
                } ))  
            },
            upload_image(e){
             
              let file = e.target.files[0];
              this.form.img_name = file['name'].substring(file['name'].indexOf("."))
              const   reader = new FileReader();  
              reader.onloadend = (file) => {   
                this.form.pic = reader.result.substring(reader.result.indexOf(",")).substring(1)
                // console.log(reader.result)
               
                
             }              
                reader.readAsDataURL(file);        
        },
            //edit model
            editModalWindow(discount){
            this.form.clear();
            this.editMode = true
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(discount)
            },
            updatediscount(){
            this.form.patch(this.routes.get+'/'+this.form.id)
           
                .then(response=>{
                    console.log(response.data)
                    Success.fire({
                        icon: response.data.status,
                        title:response.data.title
                    })
                    if(response.data.status =='success'){
                        $('#addNew').modal('hide');
                        this.loaddiscounts()
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

            loaddiscounts() {

            axios.get(this.routes.get).then( data => (this.discounts = data.data));

            //pick data from controller and push it into discounts object

            },

            creatediscount(){
                this.form.post(this.routes.post)
                    .then( response=> {
                    console.log(response.data)
                    
                            Success.fire({
                                icon: response.data.status,
                                title:response.data.title
                            })

                        if(response.data.status =='success'){
                           
                            $('#addNew').modal('hide');
                            $('.modal-backdrop fade show').modal('hide')
                             this.loaddiscounts()
                        }
                    })
                    .catch(() => {
                    console.log("Error......")
                    })
                //this.loaddiscounts();
            },
            deletediscount(id) {
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
                                'discount deleted successfully',
                                'success'
                                )
                        this.loaddiscounts();

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
            this.loaddiscounts();
            this. getData()
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