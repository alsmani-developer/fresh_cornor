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
                                    <th>الاسم</th>
                                    <th>رقم الهاتف</th>
                                    <th>البريد الالكتروني</th>
                                    <th>الحاله</th>
                                    <th>إلغاء التفعيل</th>
                                    did you register the component correctly?
                                    For recursive components,
                                </tr>

                                <tr
                                    v-for="(user, index) in users.data"
                                    :key="users.id"
                                >
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.phone }}</td>
                                    <td>{{ user.email }}</td>

                                    <td>
                                        <p
                                            class="badge badge-info"
                                            v-if="user.status_id == 1"
                                        >
                                            مفعل
                                        </p>
                                        <p
                                            class="badge badge-danger"
                                            v-if="user.status_id == 2"
                                        >
                                            غير مفعل
                                        </p>
                                    </td>
                                    <td>
                                        <button
                                            class="btn-danger"
                                            v-if="user.status_id == 1"
                                            @click="showDeleteAlert(user.id)"
                                        >
                                            إلغاء
                                        </button>
                                        <button
                                            type="button"
                                            v-if="user.status_id == 2"
                                            @click="activate(user.id)"
                                            class="btn-success"
                                        >
                                            تنشيط
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination
                            :data="users"
                            @pagination-change-page="loadusers"
                        ></pagination>
                        <br /><br />
                        <div class="container">
                            <div
                                class="row h-100 justify-content-center align-items-center"
                                v-if="isLoading"
                            >
                                <rotate-square2> </rotate-square2>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { RotateSquare2 } from "vue-loading-spinner";
export default {
    props: {
        routes: {
            type: Object
        }
    },
    components: {
        RotateSquare2
    },
    data() {
        return {
            isLoading: false,
            editMode: false,
            users: {},

            showModal: false
        };
    },
    methods: {
        loadusers(page = 1) {
            this.isLoading = true;
            axios.get(this.routes.users + "?page=" + page).then(data => {
                this.users = data.data;
                this.isLoading = false;
            });
            //pick data from controller and push it into users object
        },
        activate(id) {
            this.isLoading = true;
            axios
                .post(this.routes.activate, {
                    table_name: "users",
                    pk: "id",
                    id: id
                })
                .then(response => {
                    this.isLoading = false;
                    console.log(response.data);
                    this.loadusers();

                    Success.fire({
                        icon: response.data.status,
                        title: response.data.title
                    });
                });
        },

        deleteUsers(id) {
            this.isLoading = true;
            axios
                .post(this.routes.deActivate, {
                    table_name: "users",
                    pk: "id",
                    id: id
                })
                .then(response => {
                    this.isLoading = false;

                    console.log(response.data);
                    this.loadusers();

                    Success.fire({
                        icon: response.data.status,
                        title: response.data.title
                    });
                });
        },
        showDeleteAlert(id) {
            Swal.fire({
                title: "هل انت متاكد من مسح هذا الحقل?",
                text: "سوف يتم تحويل الحقل الى قائمه الحقول الغير نشطه!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "تاكيد"
            }).then(result => {
                if (result.value) {
                    this.deleteUsers(id);
                }
            });
        }
    },

    mounted() {
        this.loadusers();
    }
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
