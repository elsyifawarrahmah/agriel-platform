let allArticles = [];
let allExperts = [];

async function loadArticles() {
    try {
        console.log('Loading articles...');
        const response = await fetch('backend/api/articles.php');
        const articles = await response.json();
        
        allArticles = articles;
        displayArticles(articles);
        await loadExperts();
        
    } catch (error) {
        console.error('Error loading articles:', error);
        showSampleArticles();
    }
}

async function loadExperts() {
    try {
        const response = await fetch('backend/api/experts.php');
        const experts = await response.json();
        allExperts = experts;
        displayExperts(experts);
    } catch (error) {
        console.error('Error loading experts:', error);
        displayExperts([
            {nama: 'Dr. Agus Pertanian', bidang: 'Pertanian Organik'},
            {nama: 'Dr. Nina Hama', bidang: 'Pengendalian Hama'}
        ]);
    }
}

function displayArticles(articles) {
    const grid = document.getElementById('articlesGrid');
    
    if (!articles || articles.length === 0) {
        grid.innerHTML = `
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Belum ada artikel tersedia. Silakan coba lagi nanti.
                </div>
            </div>
        `;
        return;
    }

    grid.innerHTML = '';
    
    articles.forEach(article => {
        const readTime = calculateReadTime(article.isi);
        const shortContent = article.isi.length > 150 ? 
            article.isi.substring(0, 150) + '...' : article.isi;
        
        const articleCard = `
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card article-card h-100">
                    <div class="card-body position-relative">
                        <span class="badge bg-success category-badge">${article.kategori}</span>
                        
                        <h5 class="card-title text-success">${article.judul}</h5>
                        <p class="card-text">${shortContent}</p>
                        
                        <div class="article-meta mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>${article.expert_name}
                                </small>
                                <small class="read-time">
                                    <i class="fas fa-clock me-1"></i>${readTime} menit
                                </small>
                            </div>
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-calendar me-1"></i>${formatDate(article.tanggal)}
                            </small>
                        </div>
                        
                        <button class="btn btn-success w-100 mt-3" onclick="readArticle(${article.id})">
                            <i class="fas fa-book-open me-2"></i>Baca Artikel
                        </button>
                    </div>
                </div>
            </div>
        `;
        grid.innerHTML += articleCard;
    });
}

function displayExperts(experts) {
    const expertsList = document.getElementById('expertsList');
    
    expertsList.innerHTML = '';
    
    experts.slice(0, 4).forEach(expert => {
        const expertCard = `
            <div class="col-md-3 col-6 mb-3">
                <div class="text-center">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-2" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-user-tie text-white fs-4"></i>
                    </div>
                    <h6 class="mb-1">${expert.nama}</h6>
                    <small class="text-muted">${expert.bidang}</small>
                </div>
            </div>
        `;
        expertsList.innerHTML += expertCard;
    });
}

function filterCategory(category) {
    document.querySelectorAll('.btn-outline-success').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    if (category === 'all') {
        displayArticles(allArticles);
    } else {
        const filtered = allArticles.filter(article => 
            article.kategori.toLowerCase().includes(category.toLowerCase())
        );
        displayArticles(filtered);
    }
}

function searchArticles() {
    const searchTerm = document.getElementById('searchArticles').value.toLowerCase();
    
    if (!searchTerm) {
        displayArticles(allArticles);
        return;
    }
    
    const filtered = allArticles.filter(article => 
        article.judul.toLowerCase().includes(searchTerm) ||
        article.isi.toLowerCase().includes(searchTerm) ||
        article.kategori.toLowerCase().includes(searchTerm)
    );
    
    displayArticles(filtered);
}

function readArticle(articleId) {
    const article = allArticles.find(a => a.id === articleId);
    if (article) {
        showArticleModal(article);
    }
}

function showArticleModal(article) {
    const readTime = calculateReadTime(article.isi);
    
    const modalHTML = `
        <div class="modal fade" id="articleModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${article.judul}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-success">${article.kategori}</span>
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>${readTime} menit baca
                            </small>
                        </div>
                        
                        <div class="article-meta mb-4 p-3 bg-light rounded">
                            <div class="row">
                                <div class="col-6">
                                    <small><strong>Penulis:</strong><br>${article.expert_name}</small>
                                </div>
                                <div class="col-6">
                                    <small><strong>Tanggal:</strong><br>${formatDate(article.tanggal)}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="article-content">
                            ${formatArticleContent(article.isi)}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-success" onclick="shareArticle('${article.judul}')">
                            <i class="fas fa-share me-2"></i>Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);

    const modal = new bootstrap.Modal(document.getElementById('articleModal'));
    modal.show();
 
    document.getElementById('articleModal').addEventListener('hidden.bs.modal', function () {
        this.remove();
    });
}

function calculateReadTime(content) {
    const wordsPerMinute = 200;
    const wordCount = content.split(' ').length;
    return Math.ceil(wordCount / wordsPerMinute);
}

function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

function formatArticleContent(content) {
    return content.split('\n').map(paragraph => 
        `<p class="mb-3">${paragraph}</p>`
    ).join('');
}

function shareArticle(title) {
    if (navigator.share) {
        navigator.share({
            title: title,
            text: 'Baca artikel menarik tentang pertanian di AgriEl',
            url: window.location.href
        });
    } else {
        alert(`Bagikan artikel: "${title}"\nURL: ${window.location.href}`);
    }
}

function showSampleArticles() {
    const sampleArticles = [
        {
            id: 1,
            judul: "Cara Menanam Padi yang Baik",
            isi: "Panduan lengkap menanam padi dari persiapan lahan hingga panen. Pelajari teknik terbaru untuk meningkatkan hasil panen Anda.",
            kategori: "Pertanian Organik",
            expert_name: "Dr. Agus Pertanian",
            tanggal: "2024-01-15",
            views: 150
        },
        {
            id: 2,
            judul: "Mengatasi Hama Wereng pada Tanaman",
            isi: "Wereng adalah hama yang sering menyerang tanaman padi. Pelajari cara mengidentifikasi dan mengendalikan hama ini secara efektif.",
            kategori: "Pengendalian Hama",
            expert_name: "Dr. Nina Hama",
            tanggal: "2024-01-10",
            views: 89
        }
    ];
    
    allArticles = sampleArticles;
    displayArticles(sampleArticles);
}

document.getElementById('searchArticles')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchArticles();
    }
});

document.addEventListener('DOMContentLoaded', loadArticles);