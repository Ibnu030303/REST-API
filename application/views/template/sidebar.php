<aside id="sidebar" class="js-sidebar">
    <!-- Content For Sidebar -->
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#" class="text-dark">Admin Dashboard</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item <?php echo ($current_url == site_url('dashboard')) ? 'active' : ''; ?>">
                <a href="<?php echo site_url('dashboard'); ?>" class="sidebar-link">
                    <i class="lni lni-grid-alt"></i>
                    Dashboard
                </a>
            </li>
            <hr class="text-white">
            <li class="sidebar-item <?php echo ($current_url == site_url('data_mahasiswa')) ? 'active' : ''; ?>">
                <a href="<?php echo site_url('data_mahasiswa'); ?>" class="sidebar-link">
                <i class="lni lni-digitalocean"></i>
                    Data Mahasiswa
                </a>
            </li>
            <li class="sidebar-item <?php echo ($current_url == site_url('matakuliah')) ? 'active' : ''; ?>">
                <a href="<?php echo site_url('matakuliah'); ?>" class="sidebar-link">
                <i class="lni lni-unlink"></i>
                    Data Matakuliah
                </a>
            </li>
            <li class="sidebar-item <?php echo ($current_url == site_url('data_krs')) ? 'active' : ''; ?>">
                <a href="<?php echo site_url('data_krs'); ?>" class="sidebar-link">
                <i class="lni lni-customer"></i>
                    Data KRS
                </a>
            </li>
            <hr class="text-white">
            <li class="sidebar-item <?php echo ($current_url == site_url('users')) ? 'active' : ''; ?>">
                <a href="<?php echo site_url('users'); ?>" class="sidebar-link">
                <i class="lni lni-cog"></i>
                    Users
                </a>
            </li>
            <li class="sidebar-item <?php echo ($current_url == site_url('customers')) ? 'active' : ''; ?>">
                <a href="<?php echo site_url('customers'); ?>" class="sidebar-link">
                <i class="lni lni-slack-line"></i>
                    Customers
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <i class="lni lni-exit"></i>
                Logout
            </a>
        </div>
    </div>
</aside>
