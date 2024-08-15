<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Matakuliah</title>

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
                        <h1 class="mb-3">Data Matakuliah</h1>
                        <nav>
                            <ol class="breadcrumb ms-1 fs-6">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Matakuliah</li>
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
                                        <h3 class="card-title">Matakuliah</h3>
                                        <button @click="TampilModal(null)" type="button" class="btn btn-primary mb-4 mt-3" data-bs-toggle="modal">
                                            Tambah
                                        </button>
                                    </div>
                                    <table id="dataTable" class="table table-hover text-dark">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode MK</th>
                                                <th>Nama MK</th>
                                                <th>SKS</th>
                                                <th>Semester</th>
                                                <th>Program Studi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(row, index) in aData" :key="row.kode_mk">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ row.kode_mk }}</td>
                                                <td>{{ row.nama_mk }}</td>
                                                <td>{{ row.sks }}</td>
                                                <td>{{ row.semester }}</td>
                                                <td>{{ row.program_studi }}</td>
                                                <td>
                                                    <button class="btn btn-outline-info btn-sm" @click="TampilModal(row)">
                                                        <i class="lni lni-pencil-alt"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-sm" @click="hapusData(row.kode_mk)">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ judulModal }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="kode_mk" class="form-label">Kode MK</label>
                                        <input type="text" class="form-control" id="kode_mk" name="kode_mk" v-model="oData.kode_mk">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_mk" class="form-label">Nama MK</label>
                                        <input type="text" class="form-control" id="nama_mk" name="nama_mk" v-model="oData.nama_mk">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sks" class="form-label">SKS</label>
                                        <input type="text" class="form-control" id="sks" name="sks" v-model="oData.sks">
                                    </div>
                                    <div class="mb-3">
                                        <label for="semester" class="form-label">Semester</label>
                                        <input type="text" class="form-control" id="semester" name="semester" v-model="oData.semester">
                                    </div>
                                    <div class="mb-3">
                                        <label for="program_studi" class="form-label">Program Studi</label>
                                        <input type="text" class="form-control" id="program_studi" name="program_studi" v-model="oData.program_studi">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="simpanData()">{{ judulModal === 'Edit' ? 'Update' : 'Save changes' }}</button>
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
        var v = new Vue({
            el: "#app",
            data: {
                apiUrl: '<?php echo base_url(); ?>index.php/api/',
                aData: [],
                judulModal: 'Add',
                oData: {
                    kode_mk: '',
                    nama_mk: '',
                    sks: '',
                    semester: '',
                    program_studi: '',
                    method: 'post' // Initially set to 'post' for new data, will be 'put' for updates
                }
            },
            mounted() {
                this.tampildata();
            },
            methods: {
                hapusData(id) {
                    console.log("Deleting matakuliah with id:", id); // Add this line
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
                            axios.delete(this.apiUrl + 'matakuliah/' + id)
                                .then(response => {
                                    console.log(response); // Add this line
                                    this.tampildata();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your data has been deleted.',
                                        'success'
                                    )
                                })
                                .catch(error => {
                                    console.log(error); // Add this line
                                    Swal.fire(
                                        'Failed!',
                                        'There was a problem deleting your data.',
                                        'error'
                                    )
                                })
                        }
                    })
                },
                tampildata() {
                    axios.get(this.apiUrl + 'matakuliah')
                        .then(response => {
                            this.aData = response.data;
                            this.$nextTick(function() {
                                $('#dataTable').DataTable();
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                        });
                },
                TampilModal(row) {
                    if (!row) {
                        this.judulModal = 'Add';
                        this.oData.method = 'post'; // Set method to 'post' for adding new data
                        this.clearForm();
                    } else {
                        this.judulModal = 'Edit';
                        this.oData.method = 'put'; // Set method to 'put' for updating existing data
                        this.oData.kode_mk = row.kode_mk;
                        this.oData.nama_mk = row.nama_mk;
                        this.oData.sks = row.sks;
                        this.oData.semester = row.semester;
                        this.oData.program_studi = row.program_studi;
                    }
                    $('#myModal').modal("show");
                },
                simpanData() {
                    var dt = this.oUrlEncode(this.oData);
                    var endpoint = this.apiUrl + 'matakuliah';

                    // Determine request method based on this.oData.method ('post' or 'put')
                    var requestConfig = {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    };
                    if (this.oData.method == 'post') {
                        axios.post(endpoint, dt, requestConfig)
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
                        axios.put(endpoint + '/' + this.oData.kode_mk, dt, requestConfig)
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
                },

                clearForm() {
                    this.oData.nama_mk = '';
                    this.oData.sks = '';
                    this.oData.semester = '';
                    this.oData.program_studi = '';
                }
            }
        });
    </script>

</body>

</html>