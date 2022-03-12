<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('pesan'); ?>
            <!-- Form Ubah Password -->
            <form action="<?= base_url('user/changepassword'); ?>" method="post">

                <div class="form-group">
                    <label for="password_lama">Password Lama</label>
                    <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Masukan Password Lama...">
                    <small class="form-text text-danger">
                        <?= form_error('password_lama'); ?>
                    </small>
                </div>

                <div class="form-group">
                    <label for="password_baru1">Password Baru</label>
                    <input type="password" class="form-control" id="password_baru1" name="password_baru1" placeholder="Masukan Password baru...">
                    <small class="form-text text-danger">
                        <?= form_error('password_baru1'); ?>
                    </small>
                </div>

                <div class="form-group">
                    <label for="password_baru2">Confirm Password Baru</label>
                    <input type="password" class="form-control" id="password_baru2" name="password_baru2" placeholder="Confirm Password baru...">
                    <small class="form-text text-danger">
                        <?= form_error('password_baru2'); ?>
                    </small>
                </div>

                <button type="submit" class="btn btn-info float-right ml-2">Ubah Password</button>

                <a href="<?= base_url('user'); ?>" class="btn btn-danger float-right">Kembali</a>
            </form>
            <!-- End Form Ubah Password -->

        </div>
    </div>
    <!-- End Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->