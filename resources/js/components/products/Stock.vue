<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" id="lable">المخزن</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>رقم المحزن</th>
                        <th>رقم المنتج </th>
                        <th>الكميه</th>
                         <th>السعر</th>
                         <th>إضافه تالف</th>
                         <th>إضافه وارد</th>

                  </tr>

                   <tr
                      v-for="(stock, index) in stocks.data"
                      :key="stocks.id">
                    <td>{{ stock.id }}</td>
                    <td>{{stock.meat_id}}</td> 
                    <td>{{stock.quantity}}</td>
                    <td>{{stock.price}}</td>
                     <td>
                    <button
                        class="btn btn-warning"
                       
                        @click="editModalWindow(stock)"
                        >
                        إضافه تالف <i class="fas fa-aera-plus fa-fw"></i>
                    </button>
                     </td>
                     <td><button
                        class="btn btn-success"
                        data-toggle="modal"
                        data-target="#addNew"
                        @click="openModalWindow(stock)"
                    >
                        إضافه وارد <i class="fas fa-aera-plus fa-fw"></i>
              </button></td>
                  </tr>
                </tbody>

                </table>
                <pagination
                    :data="stocks"
                    @pagination-change-page="loadstocks"
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
                    اضافه وارد
                    </h5>
                    <h5 v-show="editMode" class="modal-title" id="addNewLabel">
                    اضافه تالف
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

          <form @submit.prevent="editMode ? addConsists() : addImport()">
            <div class="modal-body">
            
              <div class="form-group">
                <input
                  v-model="form.increse"
                  type="number"
                  name="quantity"
                  placeholder="ادخل الكميه"
                  class="form-control"
                 
                />
              </div>
               <div class="form-group">
                <input
                  v-model="form.price"
                  type="number"
                  name="quantity"
                  placeholder="ادخل الكميه"
                  class="form-control"
                 
                />
            </div>
            </div>
            <div class="modal-footer">
              <button aera="button" class="btn btn-danger" data-dismiss="modal">
                اغلاق
              </button>
              <button v-show="editMode" aera="submit" class="btn btn-primary">
                تالف
              </button>
              <button v-show="!editMode" aera="submit" class="btn btn-primary">
                وارد
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
                stocks: {},
                 showModal: false,
                 form: new Form({
                    type : "",
                    id:"",
                    increse: "",
                    price : "",
                    admin : ""
                }),
            }
        },
        methods: {
            editModalWindow(stock) {
                this.form.clear();
                this.editMode = true;
                this.form.reset();
                this.form.id = stock.id
                this.form.price = stock.price
                this.form.type = 'dec'
                this.form.admin = this.routes.admin_id

            $("#addNew").modal("show");
          
            },
            openModalWindow(stock) {
                this.editMode = false;
                this.form.reset();
                this.form.id =stock.id
                this.form.type = 'inc'
                this.form.price = stock.price
                this.form.admin = this.routes.admin_id
                //   $("#addNew").modal("show");
                this.showModal = true
            },
            addConsists(){
                this.form
                .patch(this.routes.edit_quantity + "/" + this.form.id)
                .then((response) => {
                    console.log(response.data)
                    Success.fire({
                        icon: response.data.status,
                        title: response.data.title,
                    });

                if (response.data.status == "success") {
                    $("#addNew").modal("hide");
                     this.loadstocks();
                }
                })
                
                
            },
            addImport(){
               
                 this.form
                .patch(this.routes.edit_quantity + "/" + this.form.id)
                .then((response) => {
                    console.log(response.data)
                    Success.fire({
                        icon: response.data.status,
                        title: response.data.title,
                    });

                if (response.data.status == "success") {
                    $("#addNew").modal("hide");
                     this.loadstocks();
                }
                })
                .catch(() => {
                console.log("Error.....");
                });
            },
            loadstocks() {
                axios.get(this.routes.stocks).then( data => (this.stocks =data.data));
                //pick data from controller and push it into stocks object

            },

        },

        mounted() {
            this.loadstocks();
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
