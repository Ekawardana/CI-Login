<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="col-lg-6 mr-0">
        <?= $this->session->flashdata('message'); ?>
    </div>

    <!-- DataTales -->
    <div class="card shadow col-lg-4 mb-4">
        <div class="card-block">
            <center class="mt-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="rounded-circle" width="150" />
                <h4 class="card-title text-dark"><?= $user['name']; ?></h4>
            </center>
        </div>
        <hr class="mt-0">

        <table class="table table-bordered table-hover" id="dataTable" width="100%">
            <thead>
                <tr>
                    <th>Dibuat</th>
                    <th><?= date('d F Y', $user['date_created']); ?></th>
                </tr>
                <tr>
                    <th>Email</th>
                    <th><?= $user['email']; ?></th>
                </tr>
                <tr>
                    <th>Role</th>
                    <th>
                        <?php if ($user['role_id'] == 1) : ?>
                            <div class="badge badge-primary">
                                <?= $user['role_id'] = "Admin"; ?>
                            </div>
                        <?php else : ?>
                            <div class="badge badge-warning">
                                <?= $user['role_id'] = "Member"; ?>
                            </div>
                        <?php endif; ?>
                    </th>
                </tr>
            </thead>
        </table>

        <div class="btn mb-3">
            <a href="<?= base_url('user/editProfile') ?>" class="btn btn-primary">
                <i class="fas fa-user-edit"></i> Ubah Profil
            </a>
        </div>
    </div>

</div>
<!-- End Page Content -->

</div>
<!-- End Content -->