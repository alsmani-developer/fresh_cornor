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
                        <th>تاريخ بداية المنتج </th>
                        <th>تاريخ نهاية المنتج </th>
                        <th>العمليه</th>
                        <th>الكميه</th>
                        <th>الموظف</th>
                        <th>تاريخ العمليه</th>


                  </tr>

                   <tr
                      v-for="opration in oprations.data"
                      :key="opration.id">

                    <td>{{ opration.id }}</td>
                    <td>{{opration.stock_id}}</td>
                    <td>{{opration.meat_id}}</td>
                    <td> - </td>
                    <td> - </td>
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
                oprations: {},

            }
        },
        methods: {
            loadoprations(page=1) {
               this.isLoading = true
                axios.get(this.routes.oprations+"?page=" + page).then((data) => {
                  this.oprations = data.data
                  this.isLoading = false
                });
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
