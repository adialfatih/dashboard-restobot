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
            <div class="card-grid" id="cardGridView">
            </div>
            <div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;" id="loader">
                <div class="loader"></div>
                <span>Loading data ...</span>
            </div>
            
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
    <!-- Large Modal 2-->
    <div id="modalLarge2" class="modal">
        <div class="modal-dialog modal-large">
            <button class="modal-close" onclick="closeModal('modalLarge2')">&times;</button>
            <h4>Detail Pesanan</h4>
            <div class="form-container" id="modalPesananBody">
                Loading...
            </div>
        </div>
    </div>