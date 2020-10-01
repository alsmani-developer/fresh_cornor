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
                        <th>حاله الطلب</th>
                        <th>تفعيل الطلب</th>
                        
                  </tr> 

                   <tr
                      v-for="(order, index) in orders.data"
                      :key="orders.id">
                                
                    <td>{{ order.id }}</td>
                    <td>
                        <p v-if=" order.dellivery_status_id ==1">تم الطلب في انتظار التوصيل</p>
                        <p v-if="order.dellivery_status_id ==2">جاري التوصي</p>
                        <p v-if="order.dellivery_status_id ==3">تم التسليم</p>
                        <p v-if="order.dellivery_status_id ==4">الطلب تالف</p>
                        <p v-if="order.dellivery_status_id ==5">تم الغاء الطلب</p>

                    </td>
                    <td>
                         <p v-if=" order.status_id ==1">مفعل</p>
                          <p v-if=" order.status_id ==2">غير مفعل</p>
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
              
                orders: {},
               
            }
        },
        methods: {
            loadorders() {
                axios.get(this.routes.orders).then( data => (this.orders =data.data));
                //pick data from controller and push it into orders object

            },
         
        },

        mounted() { 
            this.loadorders();
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