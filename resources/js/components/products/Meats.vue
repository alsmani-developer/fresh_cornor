<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" id="lable">عرض المنتجات</h3>

            <div class="card-tools">
              <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addNew"
                @click="openModalWindow"
              >
                اضافه <i class="fas fa-meat-plus fa-fw"></i>
              </button>
            </div>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>رقم منتج</th>
                  <th>الاسم عربي</th>
                  <th>الاسم انجليزي</th>
                  <th>الوصف عربي</th>
                  <th>الوصف انجليزي</th>
                   <th>حاله المنتج</th>
                </tr>

                <tr v-for="(meat, index) in meats.data" :key="meats.id">
                  <td>{{ meat.id }}</td>
                  <td>{{ meat.ar_name }}</td>
                  <td>{{ meat.en_name }}</td>
                  <td>{{ meat.ar_description }}</td>
                  <td>{{ meat.en_description }}</td>
                   <td>
                         <p class="badge badge-info" v-if=" meat.status_id ==1">مفعل</p>
                          <p class="badge badge-danger" v-if=" meat.status_id ==2">غير مفعل</p>
                    </td>
                  <td>
                    <button
                      class="btn-primary"
                      data-id="meat.id"
                      @click="editModalWindow(meat)"
                    >
                      <i class="fa fa-edit blue"></i>
                    </button>   
                  </td>
                  
                  <td>
                     <button class="btn-danger" v-if="meat.status_id==1" @click="showDeleteAlert(meat.id)" >
                      <i class="fa fa-trash red"></i>
                  </button>
                     <button type="button" v-if="meat.status_id==2" @click="activate(meat.id)" class="btn-success">
                            تنشيط
                        </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination
              :data="meats"
              @pagination-change-page="loadmeats"
            ></pagination>
          </div>

          <div class="card-footer"></div>
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
              اضافه منتج جديد
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              تعديل بيانات منتج
            </h5>

            <button
              meat="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode ? updatemeat() : createmeat()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.ar_name"
                  meat="text"
                  name="ar_name"
                  placeholder="الاسم عربي"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('ar_name') }"
                />
                <has-error :form="form" field="ar_name"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.en_name"
                  meat="text"
                  name="en_name"
                  placeholder="الاسم انجليزي"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('en_name') }"
                />
                <has-error :form="form" field="en_name"></has-error>
              </div>

              <div class="form-group">
                <label> نوع الماشيه:</label>
                <select
                  class="form-control"
                  v-model="form.cattels_types_id"
                  id="exampleFormControlSelect1"
                >
                  <option v-for="type in types" v-bind:value="type.id">
                    {{ type.ar_name }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label> اصل الماشيه:</label>
                <select
                  class="form-control"
                  v-model="form.cattles_origins_id"
                  id="exampleFormControlSelect1"
                >
                  <option
                    v-for="(origin, index) in origins"
                    :key="index"
                    v-bind:value="origin.id"
                  >
                    {{ origin.ar_name }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label> مكان منتج:</label>
                <select
                  class="form-control"
                  v-model="form.meats_areas_id"
                  id="exampleFormControlSelect1"
                >
                  <option v-for="area in areas" v-bind:value="area.id">
                    {{ area.ar_name }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label> شكل منتج:</label>
                <select
                  class="form-control"
                  v-model="form.meats_shapes_id"
                  id="exampleFormControlSelect1"
                >
                  <option v-for="shape in shapes" v-bind:value="shape.id">
                    {{ shape.ar_name }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label> سعر المنتج:</label>
                <input
                  v-show="!editMode"
                  v-model="form.price"
                  meat="text"
                  name="price"
                  placeholder="سعر المنتج"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('price') }"
                />
                <has-error :form="form" field="en_name"></has-error>
              </div>
              <div class="form-group">
                <label> كميه المنتج:</label>
                <input
                  v-show="!editMode"
                  v-model="form.quantity"
                  meat="text"
                  name="quantity"
                  placeholder="كميه المنتج"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('quantity') }"
                />
                <has-error :form="form" field="en_name"></has-error>
              </div>
              <div class="form-group">
                <label> وصف عربي:</label>
                <textarea class="form-group" cols="30" v-model="form.ar_description"></textarea>
              </div>
              <div class="form-group">
                <label> وصف انجليزي:</label>
                <textarea class="form-group" cols="30" v-model="form.en_description"></textarea>
              </div>
              <div class="form-group">
                <label> صوره منتج:</label>
                <img :src="form.pic" width="100" height="100" />
                <input
                  type="file"
                  v-on:change="upload_image"
                  class="form-control"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button meat="button" class="btn btn-danger" data-dismiss="modal">
                اغلاق
              </button>
              <button v-show="editMode" type="submit" class="btn btn-primary">
                تعديل
              </button>
              <button v-show="!editMode" type="submit" class="btn btn-primary">
                أضافه
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
  props: {
    routes: {
      meat: Object,
    },
  },
  data() {
    return {
      editMode: false,
      meats: {},
      types: {},
      origins: {},
      areas: {},
      shapes: {},
      showModal: false,

      form: new Form({
        id: "",
        ar_name: "",
        en_name: "",
        cattels_types_id: "",
        cattles_origins_id: "",
        meats_areas_id: "",
        meats_shapes_id: "",
        ar_description: "",
        en_description: "",
        pic: "",
        img_name: "",
        quantity:'',
        price:''
      }),
    };
  },
  methods: {
    getData() {
      axios.get(this.routes.area).then((response) => {
        this.areas = response.data;
      });

      axios.get(this.routes.shape).then((response) => {
        this.shapes = response.data;
      });

      axios.get(this.routes.type).then((response) => {
        this.types = response.data;
      });

      axios.get(this.routes.origin).then((response) => {
        this.origins = response.data;
      });
    },
    upload_image(e) {
      let file = e.target.files[0];
      this.form.img_name = file["name"].substring(file["name"].indexOf("."));
      const reader = new FileReader();
      reader.onloadend = (file) => {
        this.form.pic = reader.result
          .substring(reader.result.indexOf(","))
          .substring(1);
        // console.log(reader.result)
      };
      reader.readAsDataURL(file);
    },
    //edit model
    editModalWindow(meat) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(meat);
    },
    updatemeat() {
      this.form
        .patch(this.routes.get + "/" + this.form.id)

        .then((response) => {
          console.log(response.data);
          Success.fire({
            icon: response.data.status,
            title: response.data.title,
          });
          if (response.data.status == "success") {
            $("#addNew").modal("hide");
            this.loadmeats();
          }
        })
        .catch(() => {
          console.log("Error.....");
        });
    },
    openModalWindow() {
      this.editMode = false;
      this.showModal= true,
      this.form.reset();
    //   $("#addNew").modal("show");
    },

    loadmeats() {
      axios.get(this.routes.get).then((data) => (this.meats = data.data));

      //pick data from controller and push it into meats object
    },

    createmeat() {
      this.form
        .post(this.routes.post)
        .then((response) => {
          console.log(response.data);
          Success.fire({
            icon: response.data.status,
            title: response.data.title,
          });
          if (response.data.status == "success") {
            $("#addNew").modal("hide");
            this.showModal= false,
            this.loadmeats();
          }
        })
        .catch(() => {
          console.log("Error.....");
        });
    },
    deletemeat(id) {
     
        axios.post(this.routes.deActivate, {
              table_name:'meats',
              pk:'id',
              id:id
              
          })
          .then(response => { 
              console.log(response.data);
              this.loadmeats();

              Success.fire({
                  icon: response.data.status,
                  title:response.data.title
              })
          });
    },
     activate(id){    
             axios.post(this.routes.activate, {
                  table_name: 'meats',
                  pk:'id',
                  id:id
                
            })
            .then(response => {
              
              
                
                console.log(response.data);
                this.loadmeats();

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
                
                this.deletemeat(id);
                }
            })
        },
  },

  mounted() {
    this.loadmeats();
    this.getData();
  },
};
</script>
<style>
#form_button {
  margin-left: 100%;
}
.lable {
  text-align: center;
}
#text {
  text-align: center;
}
.showModal {
  display: block;
}
</style>
