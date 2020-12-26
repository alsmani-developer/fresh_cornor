<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" id="lable">عرض انواع المنتجات</h3>

            <div class="card-tools">
              <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addNew"
                @click="openModalWindow"
              >
                اضافه <i class="fas fa-type-plus fa-fw"></i>
              </button>
            </div>
          </div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>رقم النوع</th>
                  <th>الاسم عربي</th>
                  <th>الاسم انجليزي</th>
                </tr>

                <tr v-for="(type, index) in types.data" :key="index">
                  <!-- Edited the key -->
                  <td>{{ type.id }}</td>
                  <td>{{ type.ar_name }}</td>
                  <td>{{ type.en_name }}</td>

                  <td>
                    <a
                      href="#"
                      data-id="type.id"
                      @click="editModalWindow(type)"
                    >
                      <i class="fa fa-edit blue"></i>
                    </a>
                    |
                    <a href="#" @click="deletetype(type.id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination
              :data="types"
              @pagination-change-page="loadtypes"
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
      ref="addNew"
      :class="{showModal: showModal}"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editMode" class="modal-title" id="addNewLabel">
              اضافه نوع جديد
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              تعديل بيانات النوع
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

          <form @submit.prevent="editMode ? updatetype() : createtype()">
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
      type: Object,
    },
  },
   components :{
      RotateSquare2
    },
  data() {
    return {
      isLoading : false,
      editMode: false,
      types: {},
      form: new Form({
        id: "",
        ar_name: "",
        en_name: "",
      }),
      showModal: false,
    };
  },
  methods: {
    hideModal() {
      $("#addNew").modal("hide");
    },
    editModalWindow(type) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(type);
    },
    updatetype() {
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
            this.loadtypes();
          }
        })
        .catch(() => {
          console.log("Error.....");
        });
    },
    openModalWindow() {
      this.editMode = false;
      this.form.reset();
    //   $("#addNew").modal("show");
      this.showModal = true
    },
    hideModalWindow() {
      $("#addNew").modal("hide");
    },
    loadtypes(page =1) {
    
       this.isLoading = true
        axios.get(this.routes.get+"?page=" + page).then((data) => {
          this.types = data.data
          this.isLoading = false
        });
      //pick data from controller and push it into types object
    },

    createtype() {
      this.isLoading = true
      this.form
        .post(this.routes.post)
        .then((response) => {
          this.isLoading = false
          Success.fire({
            
            icon: response.data.status,
            title: response.data.title,
          });

          if (response.data.status == "success") {
            $("#addNew").modal("hide");
            this.showModal = false
            this.loadtypes();
          }
        })
        .catch(() => {
          console.log("Error......");
        });

      //this.loadtypes();
    },
    deletetype(id) {
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
              Swal.fire("Deleted!", "type deleted successfully", "success");
              this.loadtypes();
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
    this.loadtypes();
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
    display: block
}
</style>
