<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" id="lable">سعر التوصيل</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>رقم المتجر</th>
                        <th>سعر التوصيل  </th>
                        <th>تعديل السعر</th>

                  </tr>

                   <tr
                      v-for="(store, index) in stores.data"
                      :key="stores.id">
                    <td>{{ store.id }}</td>
                    <td>{{store.delivery_price}}</td> 
                     
                <td>
                    <button
                      class="btn-primary"
                     
                      @click="openEditPriceModel(store)"
                    >
                      <i class="fa fa-edit blue"></i>
                    </button>   
                  </td>
                  </tr>
                </tbody>

                </table>
                <pagination
                    :data="stores"
                    @pagination-change-page="loadstores"
                ></pagination>
                 <br><br>
                  <div class="container">
                    <div class="row h-100 justify-content-center align-items-center" v-if="isLoading">
                      <rotate-square2  > </rotate-square2>
                    </div>
                  </div>
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
                    <h5 class="modal-title" id="addNewLabel">
                     تعديل السعر
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

          <form @submit.prevent="edit_price()">
          
              
               <div class="form-group">
                <input

                  v-model="form.delivery_price"
                  type="number"
                  name="delivery_price"
                  placeholder="ادخل السعر"
                  class="form-control"
                
                  
                 
                />
            </div>
           
            <div class="modal-footer">
            
             <div class="container">
               <div class="row h-100 justify-content-center align-items-center" v-if="isLoading">
                <rotate-square2  > </rotate-square2>
              </div>
            </div>
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                اغلاق
              </button>
              <button type="submit" class="btn btn-primary">
                تعديل
              </button>
            
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>

</template>

<script>
    import {RotateSquare2} from 'vue-loading-spinner'

    export default {
      props :{
        routes :{
            type:Object
        }
    },
    components :{
      RotateSquare2
    },
        data() {
            return {
                isLoading:false,
               
                stores: {},
                showModal: false,
               
                 form: new Form({
                     id : "",
                    delivery_price : "",
                }),
            }
        },
        methods: {
           
           
            openEditPriceModel(store){
            
              this.form.delivery_price =store.delivery_price
              this.form.id = store.id
             
              $("#addNew").modal("show");

            },
            
            edit_price(){
                 this.isLoading = true
                axios.patch(this.routes.get+ "/" + this.form.id, {
                     delivery_price: this.form.delivery_price,
                })
                .then(response => {
                  
                   console.log(response.data)
                    this.isLoading = false
                    Success.fire({
                        icon: response.data.status,
                        title: response.data.title,

                   
                });  
                if (response.data.status == "success") {
                    $("#addNew").modal("hide");
                     this.loadstores();
                }
                })
               
            },
            loadstores(page = 1) {
                this.isLoading = true
                  axios.get(this.routes.get+"?page=" + page).then((data) => {
                    this.stores = data.data
                    this.isLoading = false
                  });
                
                //pick data from controller and push it into stores object

            },

        },

        mounted() {
            this.loadstores();
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
