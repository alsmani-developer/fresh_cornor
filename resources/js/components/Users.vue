<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" id="lable">عرض المستخدمين</h3>
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
                        
                  </tr> 

                   <tr
                      v-for="(user, index) in users.data"
                      :key="users.id">
                                
                    <td>{{ user.id }}</td>
                    <td> {{user.name}}  </td>
                    <td> {{user.phone}}  </td>
                    <td> {{user.email}}  </td>
                  
                    <td>
                         <p v-if=" user.status_id ==1">مفعل</p>
                          <p v-if=" user.status_id ==2">غير مفعل</p>
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
              
                users: {},
               
            }
        },
        methods: {
            loadusers() {
                axios.get(this.routes.users).then( data => (this.users =data.data));
                conso
                //pick data from controller and push it into users object

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