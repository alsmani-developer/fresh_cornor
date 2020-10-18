<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" id="lable">عرض الطلبات</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>رقم الطلب</th>
                        <th> عنوان الطلب</th>
                        <th> اسم المستخدم</th>
                        <th> تاريخ الطلب</th>
                         <th> مواصفات الطلب</th>
                        <th>حاله الطلب</th>
                        <th>تفعيل الطلب</th>
                        <th>موصل الطلب</th>

                  </tr>

                   <tr
                      v-for="(order, index) in orders.data"
                      :key="orders.id">
                    <td>{{ order.id }}</td>
                    <td>{{ order.address }}</td>
                    <td>{{ order.user.name }}</td>
                    <td>{{ order.created_at}}</td>
                     <td>
                        <a href="#"
                        @click="openDataModel(order.orders_meats)"
                        >
                       <i class="fa fa-eye blue" aria-hidden="true"></i>
                      </a>
                      
                     </td>
                    <td>
                        <p v-if=" order.dellivery_status_id ==1">تم الطلب في انتظار التوصيل</p>
                        <p v-if="order.dellivery_status_id ==2">جاري التوصي</p>
                        <p v-if="order.dellivery_status_id ==3">تم التسليم</p>
                        <p v-if="order.dellivery_status_id ==4">الطلب تالف</p>
                        <p v-if="order.dellivery_status_id ==5">تم الغاء الطلب</p>

                    </td>
                    <td>
                         <p class="badge badge-info" v-if=" order.status_id ==1">مفعل</p>
                          <p class="badge badge-danger" v-if=" order.status_id ==2">غير مفعل</p>
                    </td>

                     <td>
                         <p class="badge badge-danger" v-if=" order.orders_transporter ==null">لايوجد سائق</p>
                          <p class="badge badge-info" v-if=" order.orders_transporter !=null"> {{order.orders_transporter.user.name}}</p>
                    </td>
                    <td>
                       <button
                       v-show="order.orders_transporter ==null"
                        class="btn-success"
                        @click="openModalWindow(order.id)"
                      >
                        إسناد سائق
                      </button>
                      <button
                       v-show="order.orders_transporter !=null"
                      class="btn-primary"
                      data-id="meat.id"
                      @click="editModalWindow(order.orders_transporter.transporter_id , order.id)"
                      >
                      <i class="fa fa-edit blue"></i>
                    </button>
                    </td>
                     <td>                                 
                        <button type="button" v-if="order.status_id==1" @click="showDeleteAlert(order.id)" class="btn-danger" >
                            الغاء
                        </button>
                        
                          <button type="button" v-if="order.status_id==2" @click="activate(order.id)" class="btn-success" >
                            تنشيط
                        </button>
                    </td>
                  </tr>
                </tbody>

                </table>
                <pagination
                    :data="orders"
                    @pagination-change-page="loadorders"
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
              إسناد الطلب ل سائق
            </h5>
             <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              تعديل بيانات اللحمه
            </h5>
            <button
              shape="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode ? editOrderToDriver() : addOrderToDriver()">
            <div class="modal-body">
              <div class="form-group">
                <label> السائق:</label>
                <select
                  class="form-control"
                  v-model="form.user_id"
                  id="exampleFormControlSelect1"
                >
                  <option v-for="driver in drivers" v-bind:value="driver.id">
                    {{ driver.name }}
                  </option>
                </select>
               
              </div>
            </div>
            <div class="modal-footer">
              <button
                shape="button"
                class="btn-danger"
                data-dismiss="modal"
              >
                اغلاق
              </button>
               <button v-show="editMode" type="submit" class="btn-primary">
                تعديل
              </button>
              <button  v-show="!editMode"  type="submit" class="btn-primary">
                إسناد
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="order_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"> معاينه الطلب </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            عدد المنتجات المطلوبه : {{order_details.length}}
            <br><br>
             <ul v-for="data in order_details">
              <li> المنتج : {{data.meat.ar_name}}</li>
              <li> السعر : {{data.price}}</li>
              <li> الكميه : {{data.quantity}}</li>
             
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
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
                order_details:[],
                editMode: false,
                drivers:[],
                orders: {},
                form: new Form({
                  order_id: "",
                  user_id: "",
                 
                }),
      showModal: false,
            }
        },
        
        methods: {
           openModalWindow(id) {
            this.form.order_id = id
            this.showModal = true
          //   $("#addNew").modal("show");
          },
           editModalWindow(user_id , order_id) {
             console.log(order_id)
           
            this.form.clear();
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.user_id = user_id
            this.form.order_id = order_id
          },
          openDataModel(data) {
             console.log(data)
             this.order_details =data
             $("#order_data").modal("show");
          },
          addOrderToDriver(){
             this.form
              .post(this.routes.add_order)

              .then((response) => {
                 console.log(response.data)
                Success.fire({
                  icon: response.data.status,
                  title: response.data.title,
                });

                if (response.data.status == "success") {
                 
                 this.loadorders();
                  this.showModal = false
                  $("#addNew").modal("hide");
                }
              })
            
            
          },
           editOrderToDriver(){
             this.form
              .patch(this.routes.edit_order)

              .then((response) => {
                 console.log(response.data)
                Success.fire({
                  icon: response.data.status,
                  title: response.data.title,
                });

                if (response.data.status == "success") {
                 
                 this.loadorders();
                  this.showModal = false
                  $("#addNew").modal("hide");
                }
              })
            
            
          },
          loadorders() {
              axios.get(this.routes.orders).then( data => (this.orders =data.data));
              //pick data from controller and push it into orders object

          },
          loadDrivers(){
             axios.get(this.routes.get_dirvers).then( data => (this.drivers =data.data));
          },
           activate(id){
               
             axios
                .post(this.routes.activate, {
                     table_name: 'orders',
                     pk:'id',
                     id:id
                   
                })
                .then(response => {
                  
                  
                   
                    console.log(response.data);
                    this.loadorders();

                    Success.fire({
                        icon: response.data.status,
                        title:response.data.title
                    })
                });
        },

        deleteorders (id){
          
             
            axios
                .post(this.routes.deActivate, {
                    table_name:'orders',
                    pk:'id',
                    id:id
                   
                })
                .then(response => {
                  
                  
                   
                    console.log(response.data);
                    this.loadorders();

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
                
                this.deleteorders(id);
                }
            })
        },


        },

        mounted() {
            this.loadorders();
            this.loadDrivers()
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
    .showModal {
    display: block
}

</style>
