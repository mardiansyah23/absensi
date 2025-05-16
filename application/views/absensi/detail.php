<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h4 class="fw-bold mb-0">Detail Absen</h4>
    </div>
    <div class="col-md-6">
        <form action="" method="get">
            <div class="row g-2">
                <div class="col-sm-4">
                    <select name="bulan" id="bulan" class="form-select shadow-sm">
                        <option value="" disabled selected>-- Pilih Bulan --</option>
                        <?php foreach($all_bulan as $bn => $bt): ?>
                            <option value="<?= $bn ?>" <?= ($bn == $bulan) ? 'selected' : '' ?>><?= $bt ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select name="tahun" id="tahun" class="form-select shadow-sm">
                        <option value="" disabled selected>-- Pilih Tahun --</option>
                        <?php for($i = date('Y'); $i >= (date('Y') - 5); $i--): ?>
                            <option value="<?= $i ?>" <?= ($i == $tahun) ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                        <i class="fa fa-filter me-2"></i>Tampilkan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <th class="border-0 ps-0 py-2 text-secondary" width="100">Nama</th>
                                        <th class="border-0 px-0 py-2" width="30">:</th>
                                        <td class="border-0 ps-0 py-2 fw-bold"><?= $karyawan->nama ?></td>
                                    </tr>
                                    <tr>
                                        <th class="border-0 ps-0 py-2 text-secondary" width="100">Divisi</th>
                                        <th class="border-0 px-0 py-2" width="30">:</th>
                                        <td class="border-0 ps-0 py-2"><?= $karyawan->nama_divisi ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary rounded-pill dropdown-toggle shadow-sm" type="button" id="droprop-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-file-export me-2"></i>
                                Export Laporan
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="droprop-action">
                                <a href="<?= base_url('absensi/export_excel/' . $this->uri->segment(3) . "?bulan=$bulan&tahun=$tahun") ?>" class="dropdown-item" target="_blank">
                                    <i class="fa fa-file-excel me-2 text-success"></i> Excel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-bold mb-0">Absen Bulan: <span class="text-primary"><?= bulan($bulan) . ' ' . $tahun ?></span></h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3" width="60">No</th>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Jam Masuk</th>
                                <th class="py-3">Jam Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($absen): ?>
                                <?php foreach($hari as $i => $h): ?>
                                    <?php
                                        $key = array_search($h['tgl'], array_column($absen, 'tgl'));
                                        $absen_harian = $key !== false ? $absen[$key] : '';
                                        
                                        $row_class = '';
                                        if(in_array($h['hari'], ['Sabtu', 'Minggu'])) {
                                            $row_class = 'table-secondary';
                                        } elseif($absen_harian == '') {
                                            $row_class = 'table-danger';
                                        }
                                    ?>
                                    <tr class="<?= $row_class ?>">
                                        <td class="fw-medium"><?= ($i+1) ?></td>
                                        <td>
                                            <div class="fw-medium"><?= $h['tgl'] ?></div>
                                            <small class="text-muted"><?= $h['hari'] ?></small>
                                        </td>
                                        <td>
                                            <?php if(is_weekend($h['tgl'])): ?>
                                                <span class="badge bg-secondary rounded-pill">
                                                    <i class="fa fa-calendar-weekend me-1"></i> Libur Akhir Pekan
                                                </span>
                                            <?php else: ?>
                                                <?php 
                                                    $jam_masuk = check_jam(@$absen_harian['jam_masuk'], 'Masuk');
                                                    $badge_class = strpos($jam_masuk, 'Tidak') !== false ? 'bg-danger' : 'bg-success';
                                                    $icon_class = strpos($jam_masuk, 'Tidak') !== false ? 'fa-times-circle' : 'fa-check-circle';
                                                ?>
                                                <span class="badge <?= $badge_class ?> rounded-pill">
                                                    <i class="fa <?= $icon_class ?> me-1"></i> 
                                                    <?= $jam_masuk ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(is_weekend($h['tgl'])): ?>
                                                <span class="badge bg-secondary rounded-pill">
                                                    <i class="fa fa-calendar-weekend me-1"></i> Libur Akhir Pekan
                                                </span>
                                            <?php else: ?>
                                                <?php 
                                                    $jam_pulang = check_jam(@$absen_harian['jam_pulang'], 'Pulang');
                                                    $badge_class = strpos($jam_pulang, 'Tidak') !== false ? 'bg-danger' : 'bg-success';
                                                    $icon_class = strpos($jam_pulang, 'Tidak') !== false ? 'fa-times-circle' : 'fa-check-circle';
                                                ?>
                                                <span class="badge <?= $badge_class ?> rounded-pill">
                                                    <i class="fa <?= $icon_class ?> me-1"></i> 
                                                    <?= $jam_pulang ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center py-4" colspan="4">
                                        <div class="py-3">
                                            <i class="fa fa-calendar-times fa-3x text-muted mb-3"></i>
                                            <p class="mb-0 text-muted">Tidak ada data absen</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 