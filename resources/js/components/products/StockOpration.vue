<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
               
              </div>
             
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                       <th>رقم العمليه</th>
                        <th>رقم المحزن</th>
                        <th>رقم المنتج </th>
                        <th>العمليه</th>
                        <th>الكميه</th>
                        <th>الموظف</th>
                        <th>تاريخ العمليه</th>

                        
                  </tr> 

                   <tr
                      v-for="(opration, index) in oprations.data"
                      :key="oprations.id">
                                
                    <td>{{ opration.id }}</td>
                    <td>{{opration.stock_id}}</td>
                    <td>{{opration.meat_id}}</td> 
                    <td>{{opration.opration}}</td>
                    <td>{{opration.qty}}</td>
                    <td>{{opration.admin.name}}</td>
                    <td>{{opration.created_at}}</td>
                   
                  </tr>
                </tbody>
                
                </table>
                <pagination
                    :data="oprations"
                    @pagination-change-page="loadoprations"
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
              
                oprations: {},
               
            }
        },
        methods: {
            loadoprations() {
                axios.get(this.routes.oprations).then( data => (this.oprations =data.data));
              
                //pick data from controller and push it into oprations object

            },
         
        },

        mounted() { 
            this.loadoprations();
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