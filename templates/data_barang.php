<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url_for('static', filename='plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url_for('static', filename='plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url_for('static', filename='plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url_for('static', filename='plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url_for('static', filename='dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url_for('static', filename='plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url_for('static', filename='plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url_for('static', filename='plugins/summernote/summernote-bs4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            Sistem Manajemen Persediaan Barang
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/logout" role="button">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/dashboard" class="brand-link">
                <img src="{{ url_for('static', filename='images/admin.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="/dashboard" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/data_barang" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/pengelompokan" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pengelompokan Barang</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Barang</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Data barang</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                                        Tambah Data
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusSemuaModal">
                                        Hapus Semua Data
                                    </button>
                                </div>
                                <div class="modal fade" id="tambahDataModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form untuk menambahkan data -->
                                                <form method="post" action="/upload_excel" enctype="multipart/form-data">
                                                    <!-- Tambahkan input file untuk upload data -->
                                                    <div class="mb-3">
                                                        <label for="file_excel" class="form-label">File Excel</label>
                                                        <input type="file" class="form-control" id="file_excel" name="file">
                                                    </div>
                                                    <!-- Tombol untuk menutup modal -->
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="hapusSemuaModal" class="modal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus Semua Data</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus semua data?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <form action="{{ url_for('hapus_semua_data') }}" method="post" style="display:inline;">
                                                    <button type="submit" class="btn btn-danger">Hapus Semua Data</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Stok Awal</th>
                                                <th>Terjual/Bulan</th>
                                                <th>Stok Akhir</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th> <!-- Tambah kolom aksi -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {% for item in data_barang %}
                                            <tr>
                                                <td>{{ loop.index }}</td>
                                                <td>{{ item.nama_barang }}</td>
                                                <td>{{ item.harga }}</td>
                                                <td>{{ item.stok_awal }}</td>
                                                <td>{{ item.terjual }}</td>
                                                <td>{{ item.stok_akhir }}</td>
                                                <td>{{ item.kategori }}</td>
                                                <td>
                                                    <!-- Tombol untuk membuka modal edit -->
                                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editDataModal{{ item.id_barang }}">
                                                        Edit
                                                    </button>
                                                    <!-- Modal edit -->
                                                    <div class="modal fade" id="editDataModal{{ item.id_barang }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form untuk mengedit data -->
                                                                    <form method="post" action="/edit_barang/{{ item.id_barang }}">
                                                                        <!-- Input field untuk nama barang -->
                                                                        <div class="mb-3">
                                                                            <label for="edit_nama_barang" class="form-label">Nama Barang</label>
                                                                            <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang" value="{{ item.nama_barang }}">
                                                                        </div>
                                                                        <!-- Input field untuk harga -->
                                                                        <div class="mb-3">
                                                                            <label for="edit_harga" class="form-label">Harga</label>
                                                                            <input type="text" class="form-control" id="edit_harga" name="harga" value="{{ item.harga }}">
                                                                        </div>
                                                                        <!-- Input field untuk stok awal -->
                                                                        <div class="mb-3">
                                                                            <label for="edit_stok_awal" class="form-label">Stok Awal</label>
                                                                            <input type="text" class="form-control" id="edit_stok_awal" name="stok_awal" value="{{ item.stok_awal }}">
                                                                        </div>
                                                                        <!-- Input field untuk terjual -->
                                                                        <div class="mb-3">
                                                                            <label for="edit_terjual" class="form-label">Terjual/Bulan</label>
                                                                            <input type="text" class="form-control" id="edit_terjual" name="terjual" value="{{ item.terjual }}">
                                                                        </div>
                                                                        <!-- Input field untuk stok akhir -->
                                                                        <div class="mb-3">
                                                                            <label for="edit_stok_akhir" class="form-label">Stok Akhir</label>
                                                                            <input type="text" class="form-control" id="edit_stok_akhir" name="stok_akhir" value="{{ item.stok_akhir }}">
                                                                        </div>
                                                                        <!-- Tombol untuk menutup modal -->
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Tombol untuk menghapus data -->
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusDataModal{{ item.id_barang }}">
                                                        Hapus
                                                    </button>
                                                    <!-- Modal untuk konfirmasi penghapusan -->
                                                    <div class="modal fade" id="hapusDataModal{{ item.id_barang }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Anda yakin ingin menghapus data ini?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post" action="/hapus_barang/{{ item.id_barang }}">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            {% endfor %}
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between mt-3">
                                        <nav>
                                            <ul class="pagination">
                                                <li class="page-item {% if page == 1 %}disabled{% endif %}">
                                                    <a class="page-link" href="?page=1">First</a>
                                                </li>
                                                <li class="page-item {% if page == 1 %}disabled{% endif %}">
                                                    <a class="page-link" href="?page={{ page - 1 }}">Previous</a>
                                                </li>
                                                {% for p in range(1, total_pages + 1) %}
                                                <li class="page-item {% if page == p %}active{% endif %}">
                                                    <a class="page-link" href="?page={{ p }}">{{ p }}</a>
                                                </li>
                                                {% endfor %}
                                                <li class="page-item {% if page == total_pages %}disabled{% endif %}">
                                                    <a class="page-link" href="?page={{ page + 1 }}">Next</a>
                                                </li>
                                                <li class="page-item {% if page == total_pages %}disabled{% endif %}">
                                                    <a class="page-link" href="?page={{ total_pages }}">Last</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 Rini.</strong>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ url_for('static', filename='plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url_for('static', filename='plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ url_for('static', filename='plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ url_for('static', filename='plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ url_for('static', filename='plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ url_for('static', filename='plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ url_for('static', filename='plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ url_for('static', filename='plugins/moment/moment.min.js') }}"></script>
    <script src="{{ url_for('static', filename='plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ url_for('static', filename='plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ url_for('static', filename='plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url_for('static', filename='plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url_for('static', filename='dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>