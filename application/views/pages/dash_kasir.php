<!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <div class="page-title">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li>Dashboard</li>
                        <li>Pesanan</li>
                    </ul>
                </div>
                <div class="page-actions">
                    <button onclick="openModal('modalLarge')"><i class="fas fa-plus"></i> Buat Pesanan</button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="card-grid" id="cardGridView">
                <!-- <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Total Revenue</div>
                            <div class="card-value">$24,780</div>
                            <div class="card-change positive">
                                <i class="fas fa-arrow-up"></i> 12.5% from last month
                            </div>
                        </div>
                        <div class="card-icon blue">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">New Users</div>
                            <div class="card-value">1,254</div>
                            <div class="card-change positive">
                                <i class="fas fa-arrow-up"></i> 8.3% from last month
                            </div>
                        </div>
                        <div class="card-icon green">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Pending Orders</div>
                            <div class="card-value">56</div>
                            <div class="card-change negative">
                                <i class="fas fa-arrow-down"></i> 2.1% from last month
                            </div>
                        </div>
                        <div class="card-icon orange">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem fugiat aut nulla at illum dolore libero magnam, cumque iste voluptas alias rem voluptatum. Illum ut numquam nam corporis nostrum animi.
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Support Tickets</div>
                            <div class="card-value">18</div>
                            <div class="card-change positive">
                                <i class="fas fa-arrow-up"></i> 5.7% from last month
                            </div>
                        </div>
                        <div class="card-icon pink">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Support Tickets</div>
                            <div class="card-value">18</div>
                            <div class="card-change positive">
                                <i class="fas fa-arrow-up"></i> 5.7% from last month
                            </div>
                        </div>
                        <div class="card-icon pink">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>
                </div> -->
            </div>
            <div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;" id="loader">
                <div class="loader"></div>
                <span>Loading data ...</span>
            </div>
            <!-- Table Section -->
            <!-- <div class="table-container">
                <h2>Recent Orders</h2>
                
            </div> -->
            <input type="hidden" id="csrf_token_name" value="<?= $this->security->get_csrf_token_name(); ?>">
		    <input type="hidden" id="csrf_token_value" value="<?= $this->security->get_csrf_hash(); ?>">
        </main>
    </div>
    <!-- Large Modal -->
    <div id="modalLarge" class="modal">
        <div class="modal-dialog modal-large">
            <button class="modal-close" onclick="closeModal('modalLarge')">&times;</button>
            <h4>Konfirmasi Pembayaran</h4>
            <div class="form-container">
                <!-- <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda">
                </div> -->
                <div class="form-group">
                    <label for="tipeBayar">Jenis Pembayaran</label>
                    <select id="tipeBayar" name="tipe">
                        <option value="">-- Pilih --</option>
                        <option value="cash">Cash</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>
                <div class="form-group" style="display:none;" id="formCodeUnik">
                    <label for="kodeUnik">Kode Unik</label>
                    <input type="tel" id="kodeUnik" maxlength="3" name="kodeUnik" placeholder="Masukkan 3 Kode Unik" inputmode="numeric" pattern="[0-9]*">
                </div>
                <div class="form-group" style="display:none;" id="formCashOrder">
                    <label for="kodeOrder">Kode Pesanan</label>
                    <input type="text" id="kodeOrder" name="kodeOrder" placeholder="Masukkan Kode Pesanan">
                </div>
                <div style="width:100%;" id="tableDataOrder"></div>
                <div style="width:100%;display:flex;justify-content:flex-end;">
                    <button class="btn btn-red" id="batalPembayaran">Batalkan Pesanan Ini</button>&nbsp;
                    <button class="btn btn-blue" id="simpanPembayaran">Simpan</button>
                </div>
            </div>
        </div>
    </div>