console.log('✅ consultation.js loaded with database support');

class Consultation {
    static baseURL = 'backend/api/';

    static async loadExperts() {
        try {
            console.log('🔄 Loading experts from database...');
            
            const response = await fetch(this.baseURL + 'experts.php');
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('📊 API Response:', result);
            
            if (result.success) {
                if (result.data && result.data.length > 0) {
                    this.displayExperts(result.data);
                    this.populateExpertDropdown(result.data);
                    console.log(`✅ Loaded ${result.data.length} experts from database`);
                } else {
                    console.log('⚠️ No experts in database, using demo data');
                    this.useDemoExperts();
                }
            } else {
                throw new Error(result.message || 'API returned error');
            }
            
        } catch (error) {
            console.error('❌ Database error:', error);
            console.log('🔄 Falling back to demo data...');
            this.useDemoExperts();
        }
    }

    static useDemoExperts() {
        const demoExperts = [
            {
                id: 1,
                nama: "Dr. Agus Wijaya",
                bidang: "Pertanian Organik",
                bio: "Spesialis pertanian organik dengan pengalaman 10 tahun",
                alamat: "Bandung, Jawa Barat",
                foto: "assets/img/default-avatar.jpg"
            },
            {
                id: 2, 
                nama: "Ir. Sari Handayani",
                bidang: "Hortikultura", 
                bio: "Ahli hortikultura spesialis sayuran dan buah-buahan",
                alamat: "Bogor, Jawa Barat",
                foto: "assets/img/default-avatar.jpg"
            },
            {
                id: 3,
                nama: "Prof. Budi Santoso",
                bidang: "Agronomi",
                bio: "Guru besar agronomi spesialis budidaya modern",
                alamat: "Yogyakarta", 
                foto: "assets/img/default-avatar.jpg"
            }
        ];
        
        this.displayExperts(demoExperts);
        this.populateExpertDropdown(demoExperts);
    }

    static displayExperts(experts) {
        const container = document.getElementById('expertsGrid');
        if (!container) {
            console.error('❌ expertsGrid not found');
            return;
        }

        container.innerHTML = experts.map(expert => `
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card expert-card h-100">
                    <div class="card-body text-center">
                        <img src="${expert.foto || 'assets/img/default-avatar.jpg'}" 
                             class="rounded-circle mb-3" 
                             alt="${expert.nama}"
                             style="width: 100px; height: 100px; object-fit: cover;">
                        <h5 class="card-title">${expert.nama}</h5>
                        <p class="card-text text-success">
                            <i class="fas fa-graduation-cap me-2"></i>${expert.bidang || 'Ahli Pertanian'}
                        </p>
                        <p class="card-text small text-muted">
                            ${expert.bio || 'Spesialis dalam bidang pertanian'}
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-primary">
                                <i class="fas fa-map-marker-alt me-1"></i>${expert.alamat || 'Indonesia'}
                            </span>
                        </div>
                        <button class="btn btn-success btn-sm mt-3" 
                                onclick="Consultation.selectExpert(${expert.id}, '${expert.nama}')">
                            <i class="fas fa-comment me-1"></i>Pilih Ahli
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    static populateExpertDropdown(experts) {
        const dropdown = document.getElementById('expertSelect');
        if (!dropdown) {
            console.error('❌ expertSelect not found');
            return;
        }
        
        dropdown.innerHTML = '<option value="">Pilih ahli pertanian...</option>';
        
        experts.forEach(expert => {
            const option = document.createElement('option');
            option.value = expert.id;
            option.textContent = `${expert.nama} - ${expert.bidang || 'Ahli Pertanian'}`;
            dropdown.appendChild(option);
        });
        
        console.log(`✅ Dropdown populated with ${experts.length} experts`);
    }

    static selectExpert(expertId, expertName) {
        const dropdown = document.getElementById('expertSelect');
        if (dropdown) {
            dropdown.value = expertId;
            this.showAlert(`✅ Ahli "${expertName}" dipilih!`, 'success');
        }
    }

    static async loadConsultations() {
        try {
            const response = await fetch(this.baseURL + 'consultations.php');
            const result = await response.json();
            
            if (result.success) {
                this.displayConsultations(result.data);
            } else {
                this.displayConsultations(this.getDemoConsultations());
            }
        } catch (error) {
            console.log('Using demo consultations');
            this.displayConsultations(this.getDemoConsultations());
        }
    }

    static displayConsultations(consultations) {
        const container = document.getElementById('consultationsList');
        if (!container) return;
        
        if (!consultations || consultations.length === 0) {
            container.innerHTML = `
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Belum ada konsultasi.
                    </div>
                </div>
            `;
            return;
        }

        container.innerHTML = consultations.map(consult => `
            <div class="card consult-card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="card-title mb-0">${consult.user_name || 'Petani'}</h6>
                        <span class="badge ${consult.status === 'answered' ? 'bg-success' : 'bg-warning'}">
                            ${consult.status === 'answered' ? '✅ Dijawab' : '⏳ Menunggu'}
                        </span>
                    </div>
                    <p class="card-text"><strong>Pertanyaan:</strong> ${consult.pertanyaan}</p>
                    ${consult.jawaban ? `
                        <div class="alert alert-success mt-3">
                            <strong>💡 Jawaban dari ${consult.expert_name || 'Ahli'}:</strong><br>
                            ${consult.jawaban}
                        </div>
                    ` : ''}
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            ${new Date(consult.created_at).toLocaleDateString('id-ID')}
                        </small>
                    </div>
                </div>
            </div>
        `).join('');
    }

    static getDemoConsultations() {
        return [
            {
                user_name: "Budi Petani",
                expert_name: "Dr. Agus Wijaya",
                pertanyaan: "Bagaimana cara mengatasi hama wereng?",
                jawaban: "Gunakan pestisida organik seperti larutan bawang putih.",
                status: "answered",
                created_at: "2024-01-15"
            },
            {
                user_name: "Sari Petani", 
                pertanyaan: "Kapan waktu terbaik memupuk cabai?",
                jawaban: null,
                status: "pending",
                created_at: "2024-01-16"
            }
        ];
    }

    static showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            if (alertDiv.parentNode) alertDiv.remove();
        }, 5000);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Consultation system starting...');
    Consultation.loadExperts();
    Consultation.loadConsultations();

    const form = document.getElementById('askQuestionForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!Auth.isAuthenticated()) {
                Consultation.showAlert('🔐 Silakan login terlebih dahulu', 'warning');
                return;
            }
            
            const expertSelect = document.getElementById('expertSelect');
            const questionText = document.getElementById('questionText');
            
            if (!expertSelect.value) {
                Consultation.showAlert('❌ Pilih ahli terlebih dahulu', 'warning');
                return;
            }
            
            if (!questionText.value.trim()) {
                Consultation.showAlert('❌ Tulis pertanyaan Anda', 'warning');
                return;
            }
            
            Consultation.showAlert('✅ Pertanyaan dikirim!', 'success');
            form.reset();
        });
    }
    
    console.log('🎉 Consultation system ready!');
});

function selectExpert(expertId, expertName) {
    Consultation.selectExpert(expertId, expertName);
}