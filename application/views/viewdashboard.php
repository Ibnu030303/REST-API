<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible"="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">

    <!-- Lni Icons CSS -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>
    <?php
    // Dapatkan URL saat ini
    $current_url = current_url();
    ?>
    <div id="app" class="wrapper">

        <?php include 'template/sidebar.php' ?>

        <main id="main" class="main">
            <div class="header bg-primary" style="height: 200px; border-radius: 0 0 20px 20px;">
                <nav class="navbar navbar-expand border-bottom">
                    <button class="btn" id="sidebar-toggle" type="button">
                        <i class="lni lni-menu navbar-toggler-icon"></i>
                    </button>
                </nav>
                <section class="section dashboard" style="padding: 0 20px 30px;">
                    <div class="pagetitle">
                        <h1>Dashboard</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End Page Title -->
                    <div class="row">
                        <!-- Left side columns -->
                        <div class="col-lg-12">
                            <div class="row">
                                <!-- Users Card -->
                                <div class="col-xxl-4 col-md-4">
                                    <div class="card info-card sales-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Users</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="lni lni-cog"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ totalUsers }}</h6>
                                                    <span class="text-success small pt-1 fw-bold">Total Users</span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Users Card -->

                                <!-- Customers Card -->
                                <div class="col-xxl-4 col-md-4">
                                    <div class="card info-card customers-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Customers</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="lni lni-slack-line"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ totalCustomers }}</h6>
                                                    <span class="text-danger small pt-1 fw-bold">Total Customers</span>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Customers Card -->

                                <!-- Users Card -->
                                <div class="col-xxl-4 col-md-4">
                                    <div class="card info-card sales-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Matakuliah</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="lni lni-unlink"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ totalMatakuliah }}</h6>
                                                    <span class="text-success small pt-1 fw-bold">Total Matakuliah</span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Users Card -->

                            </div>
                        </div>
                        <!-- End Left side columns -->
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        new Vue({
            el: '#app',
            data: {
                totalUsers: 0,
                totalCustomers: 0, // Assuming you have a similar API endpoint for customers
                totalMatakuliah: 0 // Assuming you have a similar API endpoint for customers
            },
            mounted() {
                this.getUsers();
                this.getCustomers(); // Uncomment this line if you have a similar endpoint for customers
                this.getMatakuliah(); // Uncomment this line if you have a similar endpoint for customers
            },
            methods: {
                getUsers() {
                    axios.get('http://localhost/RestAPI/index.php/api/users')
                        .then(response => {
                            this.totalUsers = response.data.length; // Assuming response.data is an array of users
                        })
                        .catch(error => {
                            console.error('There was an error!', error);
                        });
                },
                getCustomers() {
                    // Uncomment and modify this method if you have a similar API endpoint for customers
                    axios.get('http://localhost/RestAPI/index.php/api/customers')
                        .then(response => {
                            this.totalCustomers = response.data.length; // Assuming response.data is an array of customers
                        })
                        .catch(error => {
                            console.error('There was an error!', error);
                        });
                },
                getMatakuliah() {
                    // Uncomment and modify this method if you have a similar API endpoint for customers
                    axios.get('http://localhost/RestAPI/index.php/api/matakuliah')
                        .then(response => {
                            this.totalMatakuliah = response.data.length; // Assuming response.data is an array of customers
                        })
                        .catch(error => {
                            console.error('There was an error!', error);
                        });
                }
            }

        });
    </script>
</body>

</html>