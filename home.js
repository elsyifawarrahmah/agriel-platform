class Home {
    static baseURL = 'backend/api/';

    static async loadFeaturedProducts() {
        try {
            const response = await fetch(this.baseURL + 'products.php');
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const result = await response.json();
            
            if (result.success) {
                this.displayFeaturedProducts(result.data);
            } else {
                throw new Error('Failed to load products');
            }
        } catch (error) {
            console.error('Error loading products:', error);
            this.showError('Error loading products. Pastikan server berjalan.');
        }
    }

    static displayFeaturedProducts(products) {
        const container = document.getElementById('featuredProducts');
        
        if (!container) return;

        const featuredProducts = products.slice(0, 4);
        
        if (featuredProducts.length === 0) {
            container.innerHTML = `
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Belum ada produk yang tersedia.
                    </div>
                </div>
            `;
            return;
        }

        container.innerHTML = featuredProducts.map(product => `
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="${product.foto || 'assets/img/default-product.jpg'}" 
                             class="card-img-top product-image" 
                             alt="${product.nama_produk}"
                             style="height: 150px; object-fit: cover;">
                        <span class="position-absolute top-0 start-0 badge bg-success m-2">
                            ${product.kategori}
                        </span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">${product.nama_produk}</h6>
                        <p class="card-text text-muted small flex-grow-1">
                            ${product.deskripsi ? product.deskripsi.substring(0, 80) + '...' : 'Tidak ada deskripsi'}
                        </p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price-tag">Rp ${this.formatPrice(product.harga)}</span>
                                <small class="text-muted">Stok: ${product.stok}</small>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>${product.farmer_name}
                                </small>
                            </div>
                            <button class="btn btn-success btn-sm w-100 mt-2" onclick="addToCart(${product.id})">
                                <i class="fas fa-cart-plus me-1"></i>Beli
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }

    static async loadLatestArticles() {
        try {
            const response = await fetch(this.baseURL + 'articles.php');
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const result = await response.json();
            
            if (result.success) {
                this.displayLatestArticles(result.data);
            } else {
                throw new Error('Failed to load articles');
            }
        } catch (error) {
            console.error('Error loading articles:', error);
            this.showError('Error loading articles.');
        }
    }

    static displayLatestArticles(articles) {
        const container = document.getElementById('latestArticles');
        
        if (!container) return;

        const latestArticles = articles.slice(0, 3);
        
        if (latestArticles.length === 0) {
            container.innerHTML = `
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Belum ada artikel yang tersedia.
                    </div>
                </div>
            `;
            return;
        }

        container.innerHTML = latestArticles.map(article => `
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card article-card h-100">
                    <img src="${article.gambar || 'assets/img/default-article.jpg'}" 
                         class="card-img-top" 
                         alt="${article.judul}"
                         style="height: 120px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">${article.kategori}</span>
                        <h6 class="card-title">${article.judul}</h6>
                        <p class="card-text small text-muted">
                            ${article.isi.substring(0, 100)}...
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i>${article.expert_name}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>${article.views} views
                            </small>
                        </div>
                        <a href="#" class="btn btn-outline-success btn-sm w-100 mt-2">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        `).join('');
    }

    static formatPrice(price) {
        return new Intl.NumberFormat('id-ID').format(price);
    }

    static showError(message) {
        const productsContainer = document.getElementById('featuredProducts');
        const articlesContainer = document.getElementById('latestArticles');
        
        if (productsContainer) {
            productsContainer.innerHTML = `
                <div class="col-12 text-center">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        ${message}
                    </div>
                </div>
            `;
        }
        
        if (articlesContainer) {
            articlesContainer.innerHTML = `
                <div class="col-12 text-center">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        ${message}
                    </div>
                </div>
            `;
        }
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    Home.loadFeaturedProducts();
    Home.loadLatestArticles();
});

// Temporary function for demo
function addToCart(productId) {
    if (!Auth.isAuthenticated()) {
        showAlert('Silakan login terlebih dahulu untuk membeli produk', 'warning');
        $('#loginModal').modal('show');
        return;
    }
    showAlert('Produk berhasil ditambahkan ke keranjang!', 'success');
}