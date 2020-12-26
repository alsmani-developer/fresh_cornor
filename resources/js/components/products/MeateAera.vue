<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" id="lable">عرض مكان المنتج</h3>

            <div class="card-tools">
              <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addNew"
                @click="openModalWindow"
              >
                اضافه <i class="fas fa-aera-plus fa-fw"></i>
              </button>
            </div>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>رقم مكان المنتج</th>
                  <th>الاسم عربي</th>
                  <th>الاسم انجليزي</th>
                   <th>الحاله</th>
                </tr>

                <tr v-for="(aera, index) in aeras.data" :key="aeras.id">
                  <td>{{ aera.id }}</td>
                  <td>{{ aera.ar_name }}</td>
                  <td>{{ aera.en_name }}</td>
                   <td>
                         <p class="badge badge-info" v-if=" aera.status_id ==1">مفعل</p>
                          <p class="badge badge-danger" v-if="aera.status_id ==2">غير مفعل</p>
                    </td>
                  <td>
                    <button
                      class="btn-primary"
                      data-id="aera.id"
                      @click="editModalWindow(aera)"
                      >
                      <i class="fa fa-edit blue"></i>
                    </button>
                   
                  </td>
                  <td>
                   
                    <button class="btn-danger" v-if="aera.status_id==1" @click="deleteaera(aera.id)">
                      <i class="fa fa-trash red"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination
              :data="aeras"
              @pagination-change-page="loadaeras"
            ></pagination>
            <br><br>
            <div class="container">
               <div class="row h-100 justify-content-center align-items-center" v-if="isLoading">
                <rotate-square2  > </rotate-square2>
              </div>
            </div>
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
              اضافه مكان المنتج 
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              تعديل بيانات المكان
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

          <form @submit.prevent="editMode ? updateaera() : createaera()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.ar_name"
                  type="text"
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
                  type="text"
                  name="en_name"
                  placeholder="الاسم انجليزي"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('en_name') }"
                />
                <has-error :form="form" field="en_name"></has-error>
              </div>
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
              <button v-show="editMode" type="submit" class="btn btn-primary">
                تعديل
              </button>
              <button v-show="!editMode" type="submit" class="btn btn-primary">
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
import {RotateSquare2} from 'vue-loading-spinner'
export default {
  props: {
    routes: {
      aera: Object,
    },
  
  },
  components: {
    RotateSquare2
  },
  data() {
    return {
      editMode: false,
      isLoading:false,
      aeras: {},
      form: new Form({
        id: "",
        ar_name: "",
        en_name: "",
      }),
      showModal: false,
    };


  },
  methods: {
    editModalWindow(aera) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(aera);
    },
    updateaera() {
      this.isLoading = true
      this.form
        .patch(this.routes.get + "/" + this.form.id)
        .then((response) => {
          this.isLoading = false
          Success.fire({
            icon: response.data.status,
            title: response.data.title,
          });

          if (response.data.status == "success") {
            $("#addNew").modal("hide");
            this.loadaeras();
          }
        })
        .catch(() => {
          console.log("Error.....");
        });
    },
    openModalWindow() {
      this.editMode = false;
      this.form.reset();
      this.showModal = true
    //   $("#addNew").modal("show");
    },

    loadaeras(page =1) {
      this.isLoading = true
       axios.get(this.routes.get+"?page=" + page).then((data) => {
        this.aeras = data.data
        this.isLoading = false
        });
     

      //pick data from controller and push it into aeras object
    },

    createaera() {
      this.isLoading = true
      this.form
        .post(this.routes.post)
        .then((response) => {
          console.log(response.data);
          this.isLoading = false
          Success.fire({
            icon: response.data.status,
            title: response.data.title,
          });

          if (response.data.status == "success") {
              this.showModal = false
            $("#addNew").modal("hide");
            this.loadaeras();
          }
        })
        .catch(() => {
          console.log("Error......");
        });

      //this.loadaeras();
    },
    deleteaera(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          //Send Request to server
          this.form
            .delete(this.routes.post + "/" + id)
            .then((response) => {
              Swal.fire("Deleted!", "aera deleted successfully", "success");
              this.loadaeras();
            })
            .catch(() => {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: "<a href>Why do I have this issue?</a>",
              });
            });
        }
      });
    },
  },

  mounted() {
    this.loadaeras();
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
</style>
