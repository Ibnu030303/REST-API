<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Users</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- Lni Icons CSS -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body>
    <div id="app" class="wrapper">

        <?php $this->load->view('template/sidebar'); ?>

        <main id="main" class="main">
            <div class="header bg-primary" style="height: 200px; border-radius: 0 0 20px 20px;">
                <nav class="navbar navbar-expand border-bottom">
                    <button class="btn" id="sidebar-toggle" type="button">
                        <i class="lni lni-menu navbar-toggler-icon"></i>
                    </button>
                </nav>

                <section class="section dashboard" style="padding: 0 20px 30px;">
                    <div class="pagetitle">
                        <h1 class="mb-3">Data Users</h1>
                        <nav>
                            <ol class="breadcrumb ms-1 fs-6">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End Page Title -->
                    <div class="row">
                        <!-- Left side columns -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Users</h3>
                                        <button @click="TampilModal(null)" type="button" class="btn btn-primary mb-4 mt-3" data-bs-toggle="modal">
                                            Tambah
                                        </button>
                                    </div>
                                    <table id="dataTable" class="table table-hover text-dark">
                                        <thead>
                                            <tr class="">
                                                <th>No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Created</th>
                                                <th>Edited</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(row, index) in aData" :key="row.id">
                                                <td>{{index + 1}}</td>
                                                <td>{{row.first_name}}</td>
                                                <td>{{row.last_name}}</td>
                                                <td>{{row.email}}</td>
                                                <td>{{row.phone}}</td>
                                                <td>{{row.created}}</td>
                                                <td>{{row.modified}}</td>
                                                <td>{{row.status == 1 ? "Active" : "Non Active"}}</td>
                                                <td>
                                                    <button class="btn btn-outline-info btn-sm" @click="TampilModal(row)"> <i class="lni lni-pencil-alt"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm" @click="hapusData(row.id)"> <i class="lni lni-trash-can"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </main>
        <!-- End #main -->

        <!-- Modal -->
        <div class="modal modal-lg fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog text-white modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{judulModal}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="need-validation">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name" v-model="oData.first_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" v-model="oData.email" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" v-model="oData.phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name" v-model="oData.last_name">
                                    </div>
                                    <div class="mb-3" v-if="judulModal == 'Tambah'">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" v-model="oData.password">
                                    </div>
                                    <div class="mb-3" v-if="judulModal == 'Ubah'">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" v-model="oData.status">
                                            <option :value="1" :selected="oData.status == 1">Active</option>
                                            <option :value="0" :selected="oData.status == 0">Non Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="simpanData()">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Javascript -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vue.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/axios.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        document.querySelector("#sidebar-toggle").addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });

        var v = new Vue({
            el: "#app",
            data: {
                apiUrl: '',
                aData: [],
                pilihData: {},
                judulModal: 'Add',
                oData: {
                    id: '',
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    phone: '',
                    created: '',
                    modified: '',
                    status: '',
                    method: ''
                }
            },
            created() {
                this.tampildata();
            },
            updated() {
                $('#dataTable').DataTable();
            },
            methods: {
                tampildata() {
                    this.apiUrl = "<?php echo base_url(); ?>index.php/api/"
                    axios.get(this.apiUrl + 'users')
                        .then(response => {
                            this.aData = response.data;
                            this.$nextTick(function() {
                                $('#dataTable').DataTable();
                            });
                        })
                        .catch(error => console.log(error))
                },
                hapusData(id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete(this.apiUrl + 'users/' + id)
                                .then(response => {
                                    this.tampildata();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your data has been deleted.',
                                        'success'
                                    )
                                })
                                .catch(error => {
                                    console.log(error);
                                    Swal.fire(
                                        'Failed!',
                                        'There was a problem deleting your data.',
                                        'error'
                                    )
                                })
                        }
                    })
                },
                TampilModal(oRow) {
                    if (oRow == null) {
                        this.judulModal = 'Tambah';
                        this.oData.method = 'post';
                        this.oData.id = '';
                        this.oData.first_name = '';
                        this.oData.last_name = '';
                        this.oData.email = '';
                        this.oData.password = '';
                        this.oData.phone = '';
                    } else {
                        this.judulModal = 'Ubah'
                        this.oData.method = 'put';
                        this.oData.id = oRow.id;
                        this.oData.first_name = oRow.first_name;
                        this.oData.last_name = oRow.last_name;
                        this.oData.email = oRow.email;
                        this.oData.password = oRow.password;
                        this.oData.phone = oRow.phone;
                        this.oData.status = oRow.status;
                    }
                    $('#myModal').modal("show");
                },
                simpanData() {
                    var dt = this.oUrlEncode(this.oData);
                    if (this.oData.method == 'post') {
                        axios.post(this.apiUrl + "users", dt)
                            .then(response => {
                                this.tampildata();
                                Swal.fire(
                                    'Success!',
                                    'Data has been added.',
                                    'success'
                                )
                            })
                            .catch(error => {
                                console.log(error);
                                Swal.fire(
                                    'Failed!',
                                    'There was a problem adding your data.',
                                    'error'
                                )
                            })
                    } else {
                        axios.put(this.apiUrl + "users", dt, {
                                headers: {
                                    'content-type': 'application/x-www-form-urlencoded'
                                }
                            })
                            .then(response => {
                                this.tampildata();
                                Swal.fire(
                                    'Success!',
                                    'Data has been updated.',
                                    'success'
                                )
                            })
                            .catch(error => {
                                console.log(error);
                                Swal.fire(
                                    'Failed!',
                                    'There was a problem updating your data.',
                                    'error'
                                )
                            })
                    }
                    $('#myModal').modal("hide");
                },
                oUrlEncode(obj) {
                    var formData = new URLSearchParams();
                    for (var key in obj) {
                        formData.append(key, obj[key]);
                    }
                    return formData.toString();
                }
            }
        })
    </script>
</body>

</html>