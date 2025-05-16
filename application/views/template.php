<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <title>Attendance System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    
    <!-- CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/custom.css')?>" rel="stylesheet">

    
    <script>var BASEURL = '<?= base_url() ?>';</script>
    <?php check_absen_harian() ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <a href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/img/logo-Indoexpress.png') ?>" alt="Logo" class="img-fluid">
                </a>
            </div>
            
            <div class="digital-clock">
                <span id="hours"><?= date('H') ?></span>:<span id="minutes"><?= date('i') ?></span>:<span id="seconds"><?= date('s') ?></span>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= @$_active == 'dashboard' ? 'active' : '' ?>" href="<?= base_url() ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?= @$_active == 'profile' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                        <i class="fas fa-user-circle"></i>
                        <p>Profile</p>
                    </a>
                </li>
                
                <?php if(is_level('Manager')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= @$_active == 'jam' ? 'active' : '' ?>" href="<?= base_url('jam') ?>">
                            <i class="fas fa-clock"></i>
                            <p>Working Hours</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?= @$_active == 'divisi' ? 'active' : '' ?>" href="<?= base_url('divisi') ?>">
                            <i class="fas fa-sitemap"></i>
                            <p>Divisions</p>
                        </a>
                    </li>
                    

                    <li class="nav-item">
                        <a class="nav-link <?= @$_active == 'karyawan' ? 'active' : '' ?>" href="<?= base_url('karyawan') ?>">
                            <i class="fas fa-users"></i>
                            <p>Employees</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?= @$_active == 'absensi' ? 'active' : '' ?>" href="<?= base_url('absensi') ?>">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Attendance</p>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= @$_active == 'check_absen' ? 'active' : '' ?>" href="<?= base_url('absensi/check_absen') ?>">
                            <i class="fas fa-fingerprint"></i>
                            <p>
                                Attendance Check
                                <?php if($this->session->absen_warning == 'true'): ?>
                                    <span class="badge badge-danger"><i class="fas fa-exclamation"></i></span>
                                <?php endif; ?>
                            </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?= @$_active == 'detail_absensi' ? 'active' : '' ?>" href="<?= base_url('absensi/detail_absensi') ?>">
                            <i class="fas fa-calendar-check"></i>
                            <p>My Attendance</p>
                        </a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item mt-3">
                    <a class="nav-link logout-link" href="<?= base_url('dashboard/logout') ?>">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Main Content -->
        <div class="main-panel">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="d-flex align-items-center">
                    <button type="button" id="sidebarCollapse" class="nav-toggler mr-3">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h4>Attendance Management System</h4>
                </div>
                <div class="user-profile">
                    <img src="<?= base_url('assets/img/placeholder/user.png') ?>" alt="Profile" />
                    <span><?= $this->session->userdata('name') ?? 'User' ?></span>
                </div>
            </nav>
            
            <!-- Content -->
            <div class="content">
                <!-- Alert Messages -->
                <div id="alert">
                    <?php if(@$this->session->response): ?>
                        <div class="alert alert-<?= $this->session->response['status'] == 'error' ? 'danger' : $this->session->response['status'] ?> alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p class="mb-0"><?= $this->session->response['message'] ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Main Content -->
                <?= $content ?>
            </div>
            
            <!-- Footer -->
            <footer>
                <p>&copy; <?= date('Y') ?> Attendance Management System</p>
            </footer>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.bundle.min.js') ?>"></script>
    
    <!-- Plugins -->
    <script src="<?= base_url('assets/js/plugins/bootstrap-switch.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/bootstrap-notify.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/sweetalert.min.js') ?>"></script>
    
    <!-- Main JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Digital Clock
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            document.getElementById('hours').textContent = hours;
            document.getElementById('minutes').textContent = minutes;
            document.getElementById('seconds').textContent = seconds;
        }
        
        // Update the clock every second
        setInterval(updateClock, 1000);
        updateClock(); // Initial call
        
        // Sidebar Toggle for Mobile
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).click(function(e) {
                const container = $("#sidebar, #sidebarCollapse");
                if (!container.is(e.target) && container.has(e.target).length === 0 && $(window).width() < 992) {
                    $('#sidebar').removeClass('active');
                }
            });
            
            // Close alerts after 5 seconds
            setTimeout(function() {
                $(".alert").alert('close');
            }, 5000);
        });
        
        <?php if(@$this->session->absen_needed): ?>
            var absenNeeded = '<?= json_encode($this->session->absen_needed) ?>';
            <?php $this->session->sess_unset('absen_needed') ?>
        <?php endif; ?>
    </script>
</body>
</html>