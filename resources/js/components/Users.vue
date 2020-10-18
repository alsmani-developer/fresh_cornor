<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" id="lable">عرض المستخدمين</h3>
                <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addNew"
                @click="openModalWindow"
              >
                اضافه <i class="fas fa-user-plus fa-fw"></i>
              </button>
              </div>
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>رقم المستخدم</th>
                        <th> الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>البريد الالكتروني</th>
                        <th>الحاله</th>
                        <th>نوع المستخدم</th>
                        <th>تعديل</th>
                        <th>إلغاء التفعيل</th>
                        
                  </tr> 

                   <tr
                      v-for="(user, index) in users.data"
                      :key="users.id">
                                
                    <td>{{ user.id }}</td>
                    <td> {{user.name}}  </td>
                    <td> {{user.phone}}  </td>
                    <td> {{user.email}}  </td>
                  
                    <td>
                         <p class="badge badge-info" v-if=" user.status_id ==1">مفعل</p>
                          <p class="badge badge-danger" v-if=" user.status_id ==2">غير مفعل</p>
                    </td>
                     <td>
                         <p class="badge badge-info" v-if=" user.user_type_id ==1">مستخدم عادي</p>
                          <p class="badge badge-warning" v-if=" user.user_type_id ==2">سائق</p>
                    </td>
                    <td>
                    <button
                    v-show="user.user_type_id==2"
                      class="btn-primary"
                      data-id="user.id"
                      @click="editModalWindow(user)"
                    >
                      <i class="fa fa-pen"></i>
                    </button>
                    </td>

                    <td>
                    <button class="btn-danger" v-if="user.status_id==1" @click="showDeleteAlert(user.id)">
                     إلغاء
                    </button>
                     <button type="button" v-if="user.status_id==2" @click="activate(user.id)" class="btn-success" >
                            تنشيط
                      </button>
                  </td>
                  </tr>
                </tbody>
                
                </table>
                <pagination
                    :data="users"
                    @pagination-change-page="loadusers"
                ></pagination>
              </div>
            
              <div class="card-footer">
                 
              </div>
            </div>
          </div>
        </div>
         <div
      class="modal"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
      :class="{showModal: showModal}"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editMode" class="modal-title" id="addNewLabel">
              اضافه سائق جديد
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              تعديل بيانات السائق
            </h5>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode ? updateUser() : createUser()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.name"
                  user="text"
                  name="name"
                  placeholder="الاسم "
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('ar_name') }"
                />
                <has-error :form="form" field="ar_name"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.phone"
                  user="text"
                  name=""
                  placeholder="رقم الهاتف"
                  class="form-control"
                 
                />
              </div>

               <div class="form-group">
                <input
                  v-model="form.email"
                  user="text"
                  name="رقم الهاتف"
                  placeholder="البريد الالكتروني"
                  class="form-control"
                  
                />
              </div>

               <div class="form-group">
                <input
                  v-show="!editMode"
                  v-model="form.password"
                  type="password"
                  name="password"
                  placeholder="كله السر"
                  class="form-control"
                 
                />
              </div>

            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-danger"
                data-dismiss="modal"
              >
                اغلاق
              </button>
              <button v-show="editMode" user="submit" class="btn btn-primary">
                تعديل
              </button>
              <button v-show="!editMode" user="submit" class="btn btn-primary">
                إضافه
              </button>
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
            type:Object
        }
    },
        data() {
            return {
              editMode: false,
              users: {},
              form: new Form({
                id: "",
                name: "",
                phone: "",
                email : "",
                password :"",
                user_type_id:"",
                code : "",
                dashbord :true
              }),

              showModal: false,
               
            }
        },
        methods: {
           editModalWindow(user) {
            this.form.clear();
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(user);
          },
          openModalWindow() {
            this.editMode = false;
            this.form.reset();
            this.showModal = true
            this.form.user_type_id = 2
            this.form.code = true
          //   $("#addNew").modal("show");
          },
           updateUser() {
            this.form
              .patch(this.routes.edit_user + "/" + this.form.id)
              .then((response) => {
                console.log(response.data)
                Success.fire({
                  icon: response.data.status,
                  title: response.data.title,
                });

                if (response.data.status == "success") {
                  $("#addNew").modal("hide");
                  this.loadusers();
                }
              })
           
          },
          createUser() {
            this.form
              .post(this.routes.add_user)
              .then((response) => {
                console.log(response.data)
                Success.fire({
                  icon: response.data.status,
                  title: response.data.title,
                });

                if (response.data.status == "success") {
                  this.loadusers();
                  this.showModal = false
                  $("#addNew").modal("hide");
                }
              })
              .catch(() => {
                console.log("Error......");
              });

            //this.loadusers();
          },
          loadusers() {
              axios.get(this.routes.users).then( data => (this.users =data.data));
              
              //pick data from controller and push it into users object

          },
          activate(id){   
             axios
                .post(this.routes.activate, {
                     table_name: 'users',
                     pk:'id',
                     id:id
                   
                })
                .then(response => {
                    console.log(response.data);
                    this.loadusers();

                    Success.fire({
                        icon: response.data.status,
                        title:response.data.title
                    })
                });
        },

        deleteUsers (id){
 
            axios
                .post(this.routes.deActivate, {
                    table_name:'users',
                    pk:'id',
                    id:id
                   
                })
                .then(response => {
                  
                  
                   
                    console.log(response.data);
                    this.loadusers();

                    Success.fire({
                        icon: response.data.status,
                        title:response.data.title
                    })
                });
            },
           showDeleteAlert(id){
            Swal.fire({
                title: 'هل انت متاكد من مسح هذا الحقل?',
                text: "سوف يتم تحويل الحقل الى قائمه الحقول الغير نشطه!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تاكيد'
            }).then((result) => {
                if (result.value) {
                
                this.deleteUsers(id);
                }
            })
        },
         
        },

        mounted() { 
            this.loadusers();
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