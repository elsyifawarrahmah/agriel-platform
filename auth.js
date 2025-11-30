class Auth {
    static baseURL = 'backend/auth/';

    // Generate unique email
    static generateUniqueEmail() {
        return 'user' + Date.now() + Math.floor(Math.random() * 1000000) + '@agriel.com';
    }

    // Register function
    static async register(userData) {
        try {
            console.log('📤 Sending registration data:', userData);
            
            const response = await fetch(this.baseURL + 'register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(userData)
            });
            
            console.log('📥 Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('📥 Register response:', result);
            return result;
            
        } catch (error) {
            console.error('🚨 Register error:', error);
            return { 
                success: false, 
                message: 'Network error: ' + error.message 
            };
        }
    }

    static async login(email, password) {
        try {
            console.log('🔐 Attempting login for:', email);
            
            const response = await fetch(this.baseURL + 'login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            });
            
            console.log('📥 Login response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('📥 Login response:', result);
            
            if(result.success && result.user) {
                return { 
                    success: true, 
                    user: result.user 
                };
            } else {
                return { 
                    success: false, 
                    message: result.message || 'Login gagal' 
                };
            }
        } catch (error) {
            console.error('🚨 Login error:', error);
            return { 
                success: false, 
                message: 'Network error: ' + error.message 
            };
        }
    }

    static logout() {
        console.log('🚪 Logging out...');
        window.location.href = 'backend/auth/logout.php';
    }

    static isAuthenticated() {
        return false;
    }

    static getUser() {
        return null;
    }
    static showAlert(message, type = 'info') {
        const existingAlerts = document.querySelectorAll('.custom-alert');
        existingAlerts.forEach(alert => alert.remove());
        
        const alertDiv = document.createElement('div');
        alertDiv.className = `custom-alert alert-${type}`;
        alertDiv.innerHTML = `
            <div class="alert-content">
                <span class="alert-message">${message}</span>
                <button class="alert-close" onclick="this.parentElement.parentElement.remove()">×</button>
            </div>
        `;
        
        if (!document.querySelector('#alert-styles')) {
            const styles = document.createElement('style');
            styles.id = 'alert-styles';
            styles.textContent = `
                .custom-alert {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 300px;
                    max-width: 500px;
                    background: white;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    border-left: 4px solid #007bff;
                    animation: slideIn 0.3s ease;
                }
                .alert-success { border-left-color: #28a745; }
                .alert-error { border-left-color: #dc3545; }
                .alert-warning { border-left-color: #ffc107; }
                .alert-info { border-left-color: #17a2b8; }
                .alert-content {
                    padding: 12px 16px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                .alert-message {
                    flex: 1;
                    margin-right: 10px;
                }
                .alert-close {
                    background: none;
                    border: none;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 0;
                    width: 20px;
                    height: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #666;
                }
                .alert-close:hover {
                    color: #000;
                }
                @keyframes slideIn {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
            `;
            document.head.appendChild(styles);
        }
        
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            if(alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Initializing Auth System...');
    
    const registerModal = document.getElementById('registerModal');
    if(registerModal) {
        registerModal.addEventListener('show.bs.modal', function() {
            const emailField = document.getElementById('regEmail');
            if(emailField && !emailField.value) {
                emailField.value = Auth.generateUniqueEmail();
            }
        });
    }
    const roleSelect = document.getElementById('regRole');
    if(roleSelect) {
        roleSelect.addEventListener('change', function() {
            const fieldSection = document.getElementById('fieldSection');
            if(fieldSection) {
                fieldSection.style.display = this.value === 'petani' ? 'block' : 'none';
            }
        });
    }

    const loginForm = document.getElementById('loginForm');
    if(loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            if (!email || !password) {
                Auth.showAlert('Harap isi email dan password!', 'error');
                return;
            }

            Auth.showAlert('Memproses login...', 'info');

            const result = await Auth.login(email, password);
            
            if(result.success) {
                // Close modal and reset form
                const modal = bootstrap.Modal.getInstance(loginForm.closest('.modal'));
                if (modal) modal.hide();
                loginForm.reset();
                
                Auth.showAlert('✅ Login berhasil! Mengarahkan...', 'success');
                
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
                
            } else {
                Auth.showAlert('❌ ' + result.message, 'error');
            }
        });
    }

    const registerForm = document.getElementById('registerForm');
    if(registerForm) {
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const userData = {
                nama: document.getElementById('regName').value.trim(),
                email: document.getElementById('regEmail').value.trim(),
                password: document.getElementById('regPassword').value,
                role: document.getElementById('regRole').value,
                no_hp: document.getElementById('regPhone')?.value || '',
                alamat: document.getElementById('regAddress')?.value || '',
                bidang: document.getElementById('regField')?.value || ''
            };
            
            console.log('📝 Form data:', userData);
            
            // Validation
            if (!userData.nama || !userData.email || !userData.password || !userData.role) {
                Auth.showAlert('Harap isi semua field yang wajib!', 'error');
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(userData.email)) {
                Auth.showAlert('Format email tidak valid!', 'error');
                return;
            }

            if (userData.password.length < 6) {
                Auth.showAlert('Password minimal 6 karakter!', 'error');
                return;
            }

            Auth.showAlert('Memproses pendaftaran...', 'info');

            try {
                const result = await Auth.register(userData);
                console.log('🎯 Register result:', result);
                
                if(result.success) {
                    Auth.showAlert('✅ Registrasi berhasil! Melakukan auto-login...', 'success');
                    
                    const loginResult = await Auth.login(userData.email, userData.password);
                    
                    if(loginResult.success) {
                        const modal = bootstrap.Modal.getInstance(registerForm.closest('.modal'));
                        if (modal) modal.hide();
                        registerForm.reset();
                        
                        Auth.showAlert('✅ Registrasi dan login berhasil!', 'success');
                        
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                        
                    } else {
                        Auth.showAlert('⚠️ Registrasi berhasil, tapi auto-login gagal: ' + loginResult.message, 'warning');
                        const modal = bootstrap.Modal.getInstance(registerForm.closest('.modal'));
                        if (modal) modal.hide();
                        registerForm.reset();
                    }
                } else {
                    Auth.showAlert('❌ ' + result.message, 'error');
                    
                    if(result.message && result.message.includes('sudah terdaftar')) {
                        const userChoice = confirm(
                            'Email sudah digunakan.\n\nKlik OK untuk generate email baru, atau Cancel untuk mengedit email manual.'
                        );
                        
                        if(userChoice) {
                            const newEmail = Auth.generateUniqueEmail();
                            document.getElementById('regEmail').value = newEmail;
                            Auth.showAlert('📧 Email baru telah digenerate: ' + newEmail, 'warning');
                        } else {
                            document.getElementById('regEmail').focus();
                        }
                    }
                }
            } catch (error) {
                Auth.showAlert('❌ Error: ' + error.message, 'error');
            }
        });
    }

    document.addEventListener('click', function(e) {
        const dashboardLink = e.target.closest('#dashboardLink') || e.target.closest('[href="dashboard.php"]');
        const profileLink = e.target.closest('[href="profile.php"]');
        
        if (dashboardLink || profileLink) {
            return true;
        }
    });
});
function logout() {
    if(confirm('Apakah Anda yakin ingin logout?')) {
        window.location.href = 'backend/auth/logout.php';
    }
}

function checkAuth() {
    return true;
}

function requireAuth(redirectUrl = 'index.php') {
    return true;
}