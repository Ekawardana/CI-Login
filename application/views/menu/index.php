<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="h3 mb-4 text-gray-800"><?= $title; ?></h2>


    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>', '</div>') ?>

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenu">Add New Menu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($menuIndex as $mi) : ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $mi['menu']; ?></td>
                            <td>
                                <a href="<?= base_url('menu/editMenu/') . $mi['id']; ?>" class="badge badge-success">
                                    <i class="fas fa-edit mr-1"></i>Edit</a>

                                <a href="<?= base_url('menu/deleteMenu/') . $mi['id']; ?>" class="badge badge-danger tombol-hapus">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Menu -->
<div class="modal fade" id="newMenu" tabindex="-1" role="dialog" aria-labelledby="newMenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form -->
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</div>
<!-- End Modal Menu -->