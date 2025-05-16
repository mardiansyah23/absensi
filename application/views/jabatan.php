<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-left">Jabatan Karyawan</h4>
                <div class="d-inline ml-auto float-right">
                    <a href="#" class="btn btn-success btn-sm btn-add-jabatan" data-toggle="modal" data-target="#modal-add-jabatan"><i class="fa fa-plus"></i> Tambah jabatan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>No.</th>
                            <th>Nama Jabatan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody id="tbody-jabatan">
                            <?php foreach($jabatan as $i => $d): ?>
                                <tr id="<?= 'jabatan-' . $d->id_jabatan ?>">
                                    <td><?= ($i+1) ?></td>
                                    <td class="nama-jabatan"><?= $d->nama_jabatan ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm btn-edit-jabatan" data-toggle="modal" data-target="#modal-edit-jabatan" data-jabatan="<?= base64_encode(json_encode($d)) ?>"><i class="fa fa-edit"></i> Edit</a> 
                                        <a href="<?= base_url('jabatan/destroy/' . $d->id_jabatan) ?>" class="btn btn-danger btn-sm btn-delete ml-2" onclick="return false"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-jabatan" tabindex="-1" role="dialog" aria-labelledby="modal-add-jabatan-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-jabatan" action="<?= base_url('jabatan/store') ?>" method="post" onsubmit="return false">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-add-jabatan-label">Tambah jabatan Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama-jabatan">Nama Jabatan :</label>
                        <input type="text" name="nama_jabatan" id="nama-jabatan" class="form-control" placeholder="Nama Jabatan" required="reuired" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-jabatan" tabindex="-1" role="dialog" aria-labelledby="modal-edit-jabatan-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-jabatan" action="<?= base_url('jabatan/update') ?>" method="post" onsubmit="return false">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-jabatan-label">Edit jabatan Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-nama-jabatan">Nama jabatan :</label>
                        <input type="hidden" name="id_jabatan" id="edit-id-jabatan">
                        <input type="text" name="nama_jabatan" id="edit-nama-jabatan" class="form-control" placeholder="Nama jabatan" required="reuired" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
