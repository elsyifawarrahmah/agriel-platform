<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login ke AgriEl</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="backend/auth/login.php" method="POST">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>
                <div class="mt-3 text-center">
                    <p>Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Akun Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" action="backend/auth/register.php" method="POST">
                    <div class="mb-3">
                        <label for="regName" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control" id="regName" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="regEmail" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="regEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="regPassword" class="form-label">Password *</label>
                        <input type="password" class="form-control" id="regPassword" name="password" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label for="regPhone" class="form-label">Nomor HP</label>
                        <input type="tel" class="form-control" id="regPhone" name="no_hp" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="mb-3">
                        <label for="regAddress" class="form-label">Alamat</label>
                        <textarea class="form-control" id="regAddress" name="alamat" rows="2" placeholder="Alamat lengkap"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="regRole" class="form-label">Daftar sebagai *</label>
                        <select class="form-select" id="regRole" name="role" required>
                            <option value="">Pilih peran...</option>
                            <option value="petani">Petani</option>
                            <option value="pembeli">Pembeli</option>
                        </select>
                    </div>
                    <div class="mb-3" id="fieldSection" style="display: none;">
                        <label for="regField" class="form-label">Bidang Pertanian</label>
                        <input type="text" class="form-control" id="regField" name="bidang" placeholder="Contoh: Padi, Sayuran, dll">
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-user-plus me-2"></i>Daftar
                    </button>
                </form>
                <div class="mt-3 text-center">
                    <small class="text-muted">* Wajib diisi</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('regRole');
        if(roleSelect) {
            roleSelect.addEventListener('change', function() {
                const fieldSection = document.getElementById('fieldSection');
                if(fieldSection) {
                    fieldSection.style.display = this.value === 'petani' ? 'block' : 'none';
                }
            });
        }
    });
</script>