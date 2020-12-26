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
                                    <!-- <th>رقم المحزن</th> -->
                                    <!-- <th>رقم المنتج </th> -->
                                    <th>اسم المنتج</th>
                                    <th>الكميه</th>
                                    <th>السعر</th>
                                    <th>إضافه تالف</th>
                                    <th>إضافه وارد</th>
                                    <th>تعديل السعر</th>
                                </tr>

                                <tr
                                    v-for="stock in stocks.data"
                                    :key="stock.id"
                                >
                                    <!-- <td>{{ stock.id }}</td>
                                    <td>{{stock.meat_id}}</td> -->
                                    <td>{{ stock.meat.ar_name }}</td>
                                    <td>{{ stock.quantity }}</td>
                                    <td>{{ stock.price }}</td>
                                    <td>
                                        <button
                                            class="btn-warning"
                                            @click="editModalWindow(stock)"
                                        >
                                            إضافه تالف
                                            <i
                                                class="fas fa-aera-plus fa-fw"
                                            ></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button
                                            class="btn-success"
                                            data-toggle="modal"
                                            data-target="#addNew"
                                            @click="openModalWindow(stock)"
                                        >
                                            إضافه وارد
                                            <i
                                                class="fas fa-aera-plus fa-fw"
                                            ></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button
                                            class="btn-primary"
                                            @click="
                                                openEditPriceModel(
                                                    stock.price,
                                                    stock.id
                                                )
                                            "
                                        >
                                            <i class="fa fa-edit blue"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination
                            :data="stocks"
                            @pagination-change-page="loadstocks"
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
        <div
            class="modal"
            id="addNew"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addNewLabel"
            aria-hidden="true"
            :class="{ showModal: showModal }"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            v-show="editIcrMode"
                            class="modal-title"
                            id="addNewLabel"
                        >
                            اضافه وارد
                        </h5>
                        <h5
                            v-show="editDecMode"
                            class="modal-title"
                            id="addNewLabel"
                        >
                            اضافه تالف
                        </h5>

                        <h5
                            v-show="editPrice"
                            class="modal-title"
                            id="addNewLabel"
                        >
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

                    <form
                        @submit.prevent="editPrice ? edit_price() : editAmont()"
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                    v-model="form.increse"
                                    type="number"
                                    name="quantity"
                                    placeholder="ادخل الكميه"
                                    class="form-control"
                                    v-show="!editPrice"
                                />

                                <input
                                    v-model="form.increse"
                                    type="text"
                                    name="destroy_reason"
                                    placeholder="سبب التلف"
                                    class="form-control destroy-reason"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    v-model="price"
                                    type="number"
                                    name="quantity"
                                    placeholder="ادخل السعر"
                                    class="form-control"
                                    v-show="editPrice"
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="container">
                                <div
                                    class="row h-100 justify-content-center align-items-center"
                                    v-if="isLoading"
                                >
                                    <rotate-square2> </rotate-square2>
                                </div>
                            </div>
                            <button
                                aera="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                اغلاق
                            </button>
                            <button
                                v-show="editDecMode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                تالف
                            </button>
                            <button
                                v-show="editIcrMode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                وارد
                            </button>
                            <button
                                v-show="editPrice"
                                type="submit"
                                class="btn btn-primary"
                            >
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
            editPrice: false,
            addDestroy: false,
            editIcrMode: false,
            editDecMode: false,
            stocks: {},
            showModal: false,
            price: "",
            form: new Form({
                type: "",
                id: "",
                increse: "",
                admin: ""
            })
        };
    },
    methods: {
        editModalWindow(stock) {
            this.form.clear();
            this.editDecMode = true;
            this.editIcrMode = false;
            this.editPrice = false;
            this.form.reset();
            this.form.id = stock.id;

            this.form.type = "dec";
            this.form.admin = this.routes.admin_id;

            $("#addNew").modal("show");
        },
        openModalWindow(stock) {
            this.editIcrMode = true;
            this.editDecMode = false;
            this.editPrice = false;
            this.form.reset();
            this.form.id = stock.id;
            this.form.type = "inc";
            this.form.admin = this.routes.admin_id;
            //   $("#addNew").modal("show");
            this.showModal = true;
        },
        openEditPriceModel(price, id) {
            this.editIcrMode = false;
            this.editDecMode = false;
            this.editPrice = true;
            this.price = price;
            this.form.id = id;

            $("#addNew").modal("show");
        },
        editAmont() {
            this.isLoading = true;
            this.form
                .patch(this.routes.edit_quantity + "/" + this.form.id)
                .then(response => {
                    this.isLoading = false;
                    Success.fire({
                        icon: response.data.status,
                        title: response.data.title
                    });

                    if (response.data.status == "success") {
                        $("#addNew").modal("hide");
                        this.loadstocks();
                    }
                });
        },
        edit_price() {
            this.isLoading = true;
            axios
                .patch(this.routes.edit_price + "/" + this.form.id, {
                    price: this.price,
                    admin: this.routes.admin_id
                })
                .then(response => {
                    console.log(response.data);
                    this.isLoading = false;
                    Success.fire({
                        icon: response.data.status,
                        title: response.data.title
                    });
                    if (response.data.status == "success") {
                        $("#addNew").modal("hide");
                        this.loadstocks();
                    }
                });
        },
        loadstocks(page = 1) {
            this.isLoading = true;
            axios.get(this.routes.stocks + "?page=" + page).then(data => {
                this.stocks = data.data;
                this.isLoading = false;
            });

            //pick data from controller and push it into stocks object
        }
    },

    mounted() {
        this.loadstocks();
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

.showModal {
    display: block;
}

.destroy-reason {
    margin-top: 10px;
}
</style>
