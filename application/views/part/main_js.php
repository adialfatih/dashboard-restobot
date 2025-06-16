<!-- Floating Menu Button -->
    <div class="floating-menu-btn" id="menuToggle">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li>
                <a href="<?=base_url('dashboard');?>" class="menu-item <?=$navg=='dashboard'?'active':'';?>">
                    <i class="fas fa-home"></i>
                    <span class="menu-text2">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="inputPembayaran()" class="menu-item">
                    <i class="fas fa-credit-card"></i>
                    <span class="menu-text2">Pembayaran</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="logout()" class="menu-item">
                    <i class="fas fa-truck"></i>
                    <span class="menu-text2">Pesan Antar</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="logout()" class="menu-item">
                    <i class="fas fa-list"></i>
                    <span class="menu-text2">Daftar Menu</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="logout()" class="menu-item">
                    <i class="fas fa-clock"></i>
                    <span class="menu-text2">Jam Buka</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="logout()" class="menu-item">
                    <i class="fas fa-arrow-right-from-bracket"></i>
                    <span class="menu-text2">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Overlay -->
    <div class="menu-overlay" id="menuOverlay"></div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Modal & DataTables init -->
    <script>
    
    $(document).ready(function () {
        $('table').DataTable({
        language: {
            search: "",
            searchPlaceholder: "Cari data...",
            lengthMenu: "Tampilkan _MENU_ baris",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
            previous: "<i class='fas fa-chevron-left'></i>",
            next: "<i class='fas fa-chevron-right'></i>"
            }
        }
        });

        // Tambahkan class biar konsisten styling
        $('.dataTables_filter input').addClass('form-control');
        $('.dataTables_length select').addClass('form-select');
    });

        // JavaScript will be placed here
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar
            const toggleSidebar = document.querySelector('.toggle-sidebar');
            const dashboardContainer = document.querySelector('.dashboard-container');
            const sidebar = document.querySelector('.sidebar');
            const sidebar2 = document.getElementById('thisIsSidebar');
            //console.log(sidebar);
            toggleSidebar.addEventListener('click', function() {
                // dashboardContainer.classList.toggle('sidebar-collapsed');
                // if (window.innerWidth <= 768) {
                //     console.log('bisa tambah show harusnya');
                //     sidebar.classList.toggle('show');
                //     console.log(sidebar.classList.toString());
                // }
                if (window.innerWidth <= 768) {
                    // Mobile behavior
                    sidebar.classList.toggle('show');
                    console.log(sidebar.classList.toString());
                    document.body.classList.toggle('menu-active');
                } else {
                    document.querySelector('.dashboard-container').classList.toggle('sidebar-collapsed');
                }
            });
            
            // Mobile sidebar toggle
            //const mobileToggle = document.querySelector('.toggle-sidebar');
            // mobileToggle.addEventListener('click', function() {
            //     console.log('click this '+window.innerWidth);
            //     // if (window.innerWidth <= 768) {
            //     //     console.log('bisa tambah show harusnya');
            //     //     sidebar.classList.toggle('show');
            //     // }
            // });
            
            // Submenu toggle
            const hasSubmenu = document.querySelectorAll('.has-submenu');
            hasSubmenu.forEach(item => {
                const menuItem = item.querySelector('.menu-item');
                const submenuToggle = item.querySelector('.submenu-toggle');
                const submenu = item.querySelector('.submenu');
                
                menuItem.addEventListener('click', function(e) {
                    if (window.innerWidth > 992 || !dashboardContainer.classList.contains('sidebar-collapsed')) {
                        e.preventDefault();
                        item.classList.toggle('active');
                        submenu.classList.toggle('show');
                    }
                });
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !sidebar.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            });
            
            // Responsive table
            function makeTableResponsive() {
                const tables = document.querySelectorAll('table');
                tables.forEach(table => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'table-responsive';
                    wrapper.style.overflowX = 'auto';
                    table.parentNode.insertBefore(wrapper, table);
                    wrapper.appendChild(table);
                });
            }
            
            makeTableResponsive();
            
            // Resize observer for responsive adjustments
            const resizeObserver = new ResizeObserver(entries => {
                entries.forEach(entry => {
                    if (entry.contentRect.width <= 768) {
                        sidebar.classList.remove('show');
                    }
                });
            });
            
            resizeObserver.observe(document.body);
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const menuOverlay = document.getElementById('menuOverlay');
            
            menuToggle.addEventListener('click', function() {
                document.body.classList.toggle('menu-active');
            });
            
            menuOverlay.addEventListener('click', function() {
                document.body.classList.remove('menu-active');
            });
        });
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.style.display = 'flex';
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.style.display = 'none';
        }
        function logout(){
            Swal.fire({
                title: "Anda yakin ?",
                text: "Anda akan keluar dari aplikasi.!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Logout"
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: "Berhasil logout",
                    text: "Anda telah keluar dari aplikasi",
                    icon: "success"
                    }).then((result) => {
                        window.location.href = "<?=base_url('login');?>";
                    });
                }
            });
        }

        // Klik di luar modal akan menutup
        window.addEventListener('click', function (e) {
            const modals = ['modalSmall', 'modalMedium', 'modalLarge'];
            modals.forEach(id => {
            const modal = document.getElementById(id);
            if (e.target === modal) modal.style.display = 'none';
            });
        });
<?php if($showData=="orderUser"){?>
        loadPesanan('all');
        function loadPesanan(tipe){
            $('#loader').show();
            $('#cardGridView').html('');
            var csrfName = $('#csrf_token_name').val();
            var csrfHash = $('#csrf_token_value').val();
            $.ajax({
				url: '<?=base_url('data/show_pesanan');?>',
				type: 'POST',
				dataType: 'json',
				data: {
					'tipe': tipe,
    				[csrfName]: csrfHash
				},
				success: function(response) {
                    setTimeout(() => {
                        $('#cardGridView').html(response.html);
                        $('#csrf_token_value').val(response.newCsrfHash);
                        $('#loader').hide();
                    }, 100);
                    
				}
            });
        }
        function inputPembayaran(){
            const modal = document.getElementById('modalLarge');
            if (modal) modal.style.display = 'flex';
            document.getElementById('formCashOrder').style.display = 'none';
            document.getElementById('formCodeUnik').style.display = 'none';
            document.getElementById('tipeBayar').value = '';
            document.getElementById('kodeOrder').value = '';
            document.getElementById('kodeUnik').value = '';
            $('#tableDataOrder').html('');
            document.body.classList.remove('menu-active');
        }
        document.getElementById('kodeUnik').addEventListener('input', function (e) {
            let value = this.value;
            value = value.replace(/\D/g, '');
            if (value.length > 3) {
                value = value.substring(0, 3);
            }

            this.value = value;
        });
        document.getElementById('tipeBayar').addEventListener('change', function (e) {
            var tipe = document.getElementById('tipeBayar').value;
            $('#tableDataOrder').html('');
            if(tipe=='qris'){
                document.getElementById('formCodeUnik').style.display = 'flex';
                document.getElementById('formCashOrder').style.display = 'none';
            }else{
                document.getElementById('formCashOrder').style.display = 'flex';
                document.getElementById('formCodeUnik').style.display = 'none';
            }
        });
        document.getElementById('simpanPembayaran').addEventListener('click', function (e) {
            var tipe = document.getElementById('tipeBayar').value;
            var csrfName = $('#csrf_token_name').val();
            var csrfHash = $('#csrf_token_value').val();
            if(tipe==''){
                //closeModal('modalLarge');
                Swal.fire('Error!', 'Anda harus memilih jenis pembayaran', 'error');
            } else {
                $('#simpanPembayaran').html('Loading...');
                if(tipe=='qris'){
                    var kodeUnik = document.getElementById('kodeUnik').value;
                    if(kodeUnik==''){
                        //closeModal('modalLarge');
                        Swal.fire('Error!', 'Anda harus mengisi kode unik', 'error');
                        $('#simpanPembayaran').html('Simpan');
                    } else {
                        $.ajax({
                            url: '<?=base_url('data/updatePembayaranQris');?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'kodeUnik': kodeUnik,
                                [csrfName]: csrfHash
                            },
                            success: function(response) {
                                if(response.status == 'success'){
                                    setTimeout(() => {
                                        $('#simpanPembayaran').html('Simpan');
                                        $('#csrf_token_value').val(response.newCsrfHash);
                                        closeModal('modalLarge');
                                        loadPesanan('all');
                                        Swal.fire('Berhasil!', response.message, 'success');
                                    }, 300);
                                    
                                } else {
                                    setTimeout(() => {
                                        $('#simpanPembayaran').html('Simpan');
                                        $('#csrf_token_value').val(response.newCsrfHash);
                                        //closeModal('modalLarge');
                                        console.log('tes oke sini');
                                        Swal.fire(response.status, response.message, response.status);
                                    }, 300);
                                }
                            }
                        }); 
                    }
                }else{
                    //jika pembayaran cash
                    var kodeOrder = document.getElementById('kodeOrder').value;
                    if(kodeOrder==''){
                        Swal.fire('Error!', 'Anda harus mengisi kode pesanan', 'error');
                        $('#simpanPembayaran').html('Simpan');
                    } else {
                        $.ajax({
                            url: '<?=base_url('data/simpanPembayaranCash');?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                'kodeOrder': kodeOrder,
                                [csrfName]: csrfHash
                            },
                            success: function(response) {
                                if(response.status == 'success'){
                                    setTimeout(() => {
                                        $('#simpanPembayaran').html('Simpan');
                                        $('#csrf_token_value').val(response.newCsrfHash);
                                        closeModal('modalLarge');
                                        loadPesanan('all');
                                        Swal.fire('Berhasil!', response.message, 'success');
                                    }, 300);
                                    
                                } else {
                                    setTimeout(() => {
                                        $('#simpanPembayaran').html('Simpan');
                                        $('#csrf_token_value').val(response.newCsrfHash);
                                        //closeModal('modalLarge');
                                        Swal.fire(response.status, response.message, response.status);
                                    }, 300);
                                }
                            }
                        }); 
                    }
                }
            }
        });
        document.getElementById('batalPembayaran').addEventListener('click', function (e) {
            var tipe = document.getElementById('tipeBayar').value;
            var csrfName = $('#csrf_token_name').val();
            var csrfHash = $('#csrf_token_value').val();
            if(tipe==''){
                closeModal('modalLarge');
                Swal.fire('Error!', 'Anda harus memilih jenis pembayaran', 'error');
            } else {
                if(tipe=='qris'){
                    var kodeUnik = document.getElementById('kodeUnik').value;
                    Swal.fire({
                        title: "Batalkan Pesanan",
                        text: "Anda yakin akan membatalkan pesanan ini ?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Batalkan"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?=base_url('data/batalkanPembayaranQris');?>',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    'kodeUnik': kodeUnik,
                                    [csrfName]: csrfHash
                                },
                                success: function(response) {
                                    if(response.status == 'success'){
                                        setTimeout(() => {
                                            $('#csrf_token_value').val(response.newCsrfHash);
                                            closeModal('modalLarge');
                                            loadPesanan('all');
                                            Swal.fire('Berhasil!', response.message, 'success');
                                        }, 300);
                                    } else {
                                        setTimeout(() => {
                                            $('#csrf_token_value').val(response.newCsrfHash);
                                            //closeModal('modalLarge');
                                            Swal.fire(response.status, response.message, response.status);
                                        }, 300);
                                    }
                                }
                            }); 
                        }
                    });
                    //end of pembatalan qris
                } else {
                    //#2424
                    var kodeOrder = document.getElementById('kodeOrder').value;
                    Swal.fire({
                        title: "Batalkan Pesanan",
                        text: "Anda yakin akan membatalkan pesanan ini ?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Batalkan"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?=base_url('data/batalkanPembayaranCash');?>',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    'kodeOrder': kodeOrder,
                                    [csrfName]: csrfHash
                                },
                                success: function(response) {
                                    if(response.status == 'success'){
                                        setTimeout(() => {
                                            $('#csrf_token_value').val(response.newCsrfHash);
                                            closeModal('modalLarge');
                                            loadPesanan('all');
                                            Swal.fire('Berhasil!', response.message, 'success');
                                        }, 300);
                                    } else {
                                        setTimeout(() => {
                                            $('#csrf_token_value').val(response.newCsrfHash);
                                            //closeModal('modalLarge');
                                            Swal.fire(response.status, response.message, response.status);
                                        }, 300);
                                    }
                                }
                            }); 
                        }
                    });
                }
            }
        });
        document.getElementById('kodeOrder').addEventListener('keyup', function (e) {
            var tipe      = document.getElementById('tipeBayar').value;
            var kodeOrder = document.getElementById('kodeOrder').value;
            var csrfName  = $('#csrf_token_name').val();
            var csrfHash  = $('#csrf_token_value').val();
            $('#tableDataOrder').html('Mengambil data pesanan...');
            if(tipe == "cash" && kodeOrder != ""){
                $.ajax({
                    url: '<?=base_url('data/lihatOrderByKode');?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'tipe': tipe,
                        'kodeOrder': kodeOrder,
                        [csrfName]: csrfHash
                    },
                    success: function(response) {
                        setTimeout(() => {
                            $('#tableDataOrder').html(response.html);
                            $('#csrf_token_value').val(response.newCsrfHash);
                            //$('#loader').hide();
                        }, 300);
                        
                    }
                });
            } else {
                $('#tableDataOrder').html('');
            }
        });
        function tandaiSedangDibuat(kode){
            console.log(''+kode);
            var csrfName  = $('#csrf_token_name').val();
            var csrfHash  = $('#csrf_token_value').val();
            Swal.fire({
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
                $.ajax({
                    url: '<?=base_url('data/updateSedangDibuat');?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'kode': kode,
                        [csrfName]: csrfHash
                    },
                    success: function(response) {
                        $('#csrf_token_value').val(response.newCsrfHash);
                        loadPesanan('all');
                        Swal.close();
                    }
                });
        }
        function tandaiSelesaiDibuat(kode){
            console.log(''+kode);
            var csrfName  = $('#csrf_token_name').val();
            var csrfHash  = $('#csrf_token_value').val();
            Swal.fire({
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
                $.ajax({
                    url: '<?=base_url('data/updateSelesaiDibuat');?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'kode': kode,
                        [csrfName]: csrfHash
                    },
                    success: function(response) {
                        $('#csrf_token_value').val(response.newCsrfHash);
                        loadPesanan('all');
                        Swal.close();
                    }
                });
        }
        function printStruk() {
            fetch('http://localhost:3031/print', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                url: 'http://localhost:8080/botresto/public/nota_124.pdf'
            })
            })
            .then(res => res.json())
            .then(res => console.log(res))
            .catch(err => console.error(err));
        }
<?php } ?>

    </script>
</body>
</html>