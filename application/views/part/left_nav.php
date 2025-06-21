    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="thisIsSidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <!-- <img src="https://via.placeholder.com/30" alt="Logo"> -->
                    <span class="logo-text">AdminPanel</span>
                </div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-title">Main</div>
                <a href="<?=base_url('dashboard');?>" class="menu-item <?=$navg=='dashboard'?'active':'';?>">
                    <i class="fas fa-home"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="javascript:void(0);" onclick="inputPembayaran()" class="menu-item">
                    <i class="fas fa-credit-card"></i>
                    <span class="menu-text">Pembayaran</span>
                </a>
                <div class="has-submenu">
                    <a href="#" class="menu-item">
                        <i class="fas fa-shopping-basket"></i>
                        <span class="menu-text">Pesanan</span>
                        <i class="fas fa-chevron-right submenu-toggle"></i>
                    </a>
                    <div class="submenu">
                        <a href="#" class="submenu-item">Hari ini</a>
                        <a href="#" class="submenu-item">Selesai</a>
                    </div>
                </div>
                <div class="has-submenu">
                    <a href="#" class="menu-item">
                        <i class="fas fa-truck"></i>
                        <span class="menu-text">Pesan Antar</span>
                        <i class="fas fa-chevron-right submenu-toggle"></i>
                    </a>
                    <div class="submenu">
                <?php
                $dev = $this->data_model->get_byid('opsi_pengiriman',['id'=>1])->row("delivery_active");
                if($dev == TRUE){
                    ?><a href="javascript:void(0);" id="menuonoff" class="submenu-item"><span style="color:green;">ON</span>&nbsp;/&nbsp;<span >OFF</span></a><?php
                } else {
                    ?><a href="javascript:void(0);" id="menuonoff" class="submenu-item"><span>ON</span>&nbsp;/&nbsp;<span style="color:red;">OFF</span></a><?php
                }
                ?>
                        <a href="#" class="submenu-item">Atur Zona</a>
                    </div>
                </div>
                
                <a href="javascript:void(0);" onclick="inputPembayaran()" class="menu-item">
                    <i class="fas fa-list"></i>
                    <span class="menu-text">Daftar Menu</span>
                </a>
                <a href="javascript:void(0);" onclick="inputPembayaran()" class="menu-item">
                    <i class="fas fa-clock"></i>
                    <span class="menu-text">Jam Buka</span>
                </a>
                <?php if($sess_akses=="admin"){?>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span class="menu-text">Analytics</span>
                </a>
                
                <div class="menu-title">Management</div>
                <div class="has-submenu">
                    <a href="#" class="menu-item">
                        <i class="fas fa-users"></i>
                        <span class="menu-text">Users</span>
                        <i class="fas fa-chevron-right submenu-toggle"></i>
                    </a>
                    <div class="submenu">
                        <a href="#" class="submenu-item">All Users</a>
                        <a href="#" class="submenu-item active">Admins</a>
                        <a href="#" class="submenu-item">Customers</a>
                    </div>
                </div>
                <div class="has-submenu">
                    <a href="#" class="menu-item">
                        <i class="fas fa-box"></i>
                        <span class="menu-text">Products</span>
                        <i class="fas fa-chevron-right submenu-toggle"></i>
                    </a>
                    <div class="submenu">
                        <a href="#" class="submenu-item">All Products</a>
                        <a href="#" class="submenu-item">Categories</a>
                        <a href="#" class="submenu-item">Inventory</a>
                    </div>
                </div>
                <a href="#" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="menu-text">Orders</span>
                </a>
                
                <div class="menu-title">Settings</div>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span class="menu-text">Settings</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-question-circle"></i>
                    <span class="menu-text">Help</span>
                </a>
                <?php } ?>
                <a href="javascript:void(0);" onclick="logout()" class="menu-item">
                    <i class="fas fa-arrow-right-from-bracket"></i>
                    <span class="menu-text">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Konfirmasi kode unik" id="konfKodeUnik">
                </div>
                
            </div>
            <div class="header-right">
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <div class="user-menu">
                    <!-- <img src="https://via.placeholder.com/36" alt="User"> -->
                </div>
            </div>
        </header>
