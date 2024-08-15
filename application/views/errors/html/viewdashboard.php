<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
</head>
<body>
    <header class="navbar sticky-top bg-warning flex-md-nowrap p-0">
        <a href="#" class="navbar-brand text-white col-md-3 col-lg-2 px-3">MyUNPAM</a>
    </header>

    <div id="app" class="container-fluid">
        <div class="row">
            <!-- sidebar start here -->
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary col-md-3 col-lg-2">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Beranda</a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-body-emphasis">data mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-body-emphasis">data Matakuliah</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-body-emphasis">data KRS</a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-body-emphasis">Logout</a>
                    </li>
                </ul>
            </div>

           <main class="col-md-9 col-lg-10 px-4 py-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="card-header">Users data</h5>
                            <div class="card-body">
                                <button data-bs-target="#myModal" data-bs-toggle="modal" class="btn btn-sm btn-outline-primary">Tambah Data</button>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>UserID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="(row, index) in aData" :key="row.id">
                                                <tr>
                                                    <td>{{index + 1}}</td>
                                                    <td>{{row.username}}</td>
                                                    <td>{{row.nama}}</td>
                                                    <td>{{row.email}}</td>
                                                    <td>{{row.alamat}}</td>
                                                    <td>
                                                        <a href="#"  data-bs-target="#myModal" data-bs-toggle="modal" @click="showModal(row)" class="btn btn-sm btn-success">edit</a>
                                                        <a href="#" @click="hapusdata(row.id)" class="btn btn-sm btn-danger">delete</a>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

           </main>     
        </div>
		<!-- Buat Modal disini -->
		<!-- Vertically centered modal -->
		<div class="modal" id="myModal">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
				<form class="need-validation">
					<div class="modal-header bg-success text-white">
						<h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class=col-md-6>
								<label>Username</label>
								<input type="text" id="username" v-model="oData.username" class="form-control" required>
							</div>
							<div class=col-md-6>
								<label>Nama</label>
								<input type="text" id="nama" v-model="oData.nama" class="form-control" required>
							</div>
						</div>

						<div class="row">
							<div class=col-md-6>
								<label>Alamat</label>
								<input type="text" id="alamat" v-model="oData.alamat" class="form-control" required>
							</div>
							<div class=col-md-6>
								<label>TipeUser</label>
								<input type="text" id="tipeuser" v-model="oData.tipeuser" class="form-control" required>
							</div>
						</div>

						<div class="row">
							<div class=col-md-6>
								<label>Email</label>
								<input type="email" id="email" v-model="oData.email" class="form-control" required>
							</div>
							<div class=col-md-6>
								<label>Password</label>
								<input type="password" id="password" v-model="oData.password" class="form-control" required>
							</div>
						</div>
					</div>

						<div class="modal-footer">
							<button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
							<button type="button" @click="simpandata" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>

    </div>

    
    <!-- Javascript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/vue.js"></script>
    <script src="<?php echo base_url();?>assets/js/axios.min.js"></script>
	
	<script>
            var v = new Vue({
                el: "#app",
                data:{
                    apiUrl: '',
                    aData: [],
                    pilihData: {},
                    oData: {
                        idx: '',
                        nama: '', 
                        username: '',
                        email: '', 
                        password: '', 
                        alamat: '', 
                        tipeuser: '',
                        method: '',
                    }
                },
                created(){
                    this.showdata();
                },
                methods:{
                    showModal(oRow){
                        if(oRow == null) {
                            this.oData.method = 'post';
                            this.oData.nama = '';
                            this.oData.username = '';
                            this.oData.email = '';
                            this.oData.password = '';
                            this.oData.alamat = '';
                            this.oData.tipeuser = '';
                        }else{
                            this.oData.method = 'put';
                            this.oData.nama = oRow.nama;
                            this.oData.username = oRow.username;
                            this.oData.email = oRow.email;
                            this.oData.password = oRow.password;
                            this.oData.alamat = oRow.alamat;
                            this.oData.tipeuser = oRow.tipeuser;
                            this.oData.idx = oRow.id;
                        }
                        $('#myModal').modal('show');
                    },
                    
                    showdata(){
                        this.apiUrl = "<?php echo base_url();?>index.php/api/";
                        //console.log(this.apiUrl);

                        axios.get(this.apiUrl+'users')
                            .then(response => {
                                this.aData = response.data;
                                //console.log(response.data);
                            })
                            .catch(error=>{
                                console.log(error);
                            });
                    },

                    hapusdata(idx){
                        var konfirmasi = confirm("Apakah yakin data akan dihapus?");

                        if(konfirmasi)
                            axios.delete(this.apiUrl+'users/'+idx)
                                .then(response => {
                                    //console.log("Data Berhasil dihapus");
                                    this.showdata();
                                })
                                .catch(error=>{
                                    console.log(error);
                                });
                        else console.log("data gak jadi dihapus bro!");
                    },

                    oFormData(obj){
                        var formData = new FormData();
                        for(var key in obj){
                            formData.append(key, obj[key]);
                        }
                        return formData;
                    },

                    oUriFormData(obj) {
                        var formData = new URLSearchParams();
                        for (var key in obj) {
                            formData.append(key, obj[key]);
                        }
                        return formData.toString();
                    },

                    simpandata(){
                        var dt = this.oUriFormData(this.oData);
                        console.log(this.oData);
                        if(this.oData.method == 'post')
                            axios.post(this.apiUrl+'users', dt)
                                .then(response => {
                                    this.showdata();
                                    $('#myModal').modal('hide');
                                    console.log(response.data);
                                })
                                .catch(error=>{
                                    console.log(error);
                                });
                       else{
                            axios.put(this.apiUrl+'users', dt, {
                                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                .then(response => {
                                    this.showdata();
                                    $('#myModal').modal('hide');
                                    console.log(response);
                                })
                                .catch(error=>{
                                    console.log(error);
                                });
                        }

                    }
                }

            })
        </script>
    
   
</body>
</html>