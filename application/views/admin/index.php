<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="h3 mb-4 text-gray-800"> Selamat Datang <b><?= $user['name']; ?></b></h2>
    <div class="col-lg-6">
        <?= $this->session->flashdata('message'); ?>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->