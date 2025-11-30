class Dashboard {
    static baseURL = 'backend/';

    // Load dashboard data
    static async loadDashboard() {
        if (!Auth.requireAuth()) return;

        await this.loadProducts();
        await this.loadArticles();
        await this.loadConsultations();
        this.loadStatistics();
        this.initCharts();
    }

    // PRODUCTS CRUD
    static async loadProducts() {
        try {
            const response = await fetch(this.baseURL + 'products/read.php');
            const result = await response.json();
            
            if (result.success) {
                this.renderProducts(result.data);
            }
        } catch (error) {
            console.error('Error loading products:', error);
        }
    }

    static renderProducts(products) {
        const tbody = document.getElementById('productsTable');
        tbody.innerHTML = '';

        products.forEach(product => {
            const row = `
                <tr>
                    <td>
                        <img src="${product.gambar || 'assets/img/default-product.jpg'}" 
                             alt="${product.nama}" 
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td>${product.nama}</td>
                    <td>${product.kategori}</td>
                    <td>Rp ${parseInt(product.harga).toLocaleString()}</td>
                    <td>${product.stok}</td>
                    <td>
                        <span class="badge ${product.status === 'active' ? 'bg-success' : 'bg-secondary'}">
                            ${product.status === 'active' ? 'Aktif' : 'Nonaktif'}
                        </span>
                    </td>
                    <td class="table-actions">
                        <button class="btn btn-sm btn-warning me-1" onclick="Dashboard.editProduct(${product.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="Dashboard.deleteProduct(${product.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });

        document.getElementById('totalProducts').textContent = products.length;
    }

    static async saveProduct() {
        const formData = new FormData();
        formData.append('nama', document.getElementById('productName').value);
        formData.append('harga', document.getElementById('productPrice').value);
        formData.append('stok', document.getElementById('productStock').value);
        formData.append('kategori', document.getElementById('productCategory').value);
        formData.append('deskripsi', document.getElementById('productDescription').value);
        formData.append('status', document.getElementById('productStatus').value);
        
        const productId = document.getElementById('productId').value;
        const imageFile = document.getElementById('productImage').files[0];
        
        if (imageFile) {
            formData.append('gambar', imageFile);
        }

        try {
            const url = productId ? 
                this.baseURL + 'products/update.php' : 
                this.baseURL + 'products/create.php';
            
            const response = await fetch(url, {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                showAlert('Produk berhasil disimpan!', 'success');
                $('#productModal').modal('hide');
                this.loadProducts();
            } else {
                showAlert(result.message, 'error');
            }
        } catch (error) {
            showAlert('Error: ' + error.message, 'error');
        }
    }

    static async editProduct(id) {
        try {
            const response = await fetch(`${this.baseURL}products/read.php?id=${id}`);
            const result = await response.json();
            
            if (result.success && result.data) {
                const product = result.data;
                document.getElementById('productId').value = product.id;
                document.getElementById('productName').value = product.nama;
                document.getElementById('productPrice').value = product.harga;
                document.getElementById('productStock').value = product.stok;
                document.getElementById('productCategory').value = product.kategori;
                document.getElementById('productDescription').value = product.deskripsi;
                document.getElementById('productStatus').value = product.status;
                
                document.getElementById('productModalTitle').textContent = 'Edit Produk';
                $('#productModal').modal('show');
            }
        } catch (error) {
            showAlert('Error loading product: ' + error.message, 'error');
        }
    }

    static async deleteProduct(id) {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
            try {
                const response = await fetch(`${this.baseURL}products/delete.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: id })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showAlert('Produk berhasil dihapus!', 'success');
                    this.loadProducts();
                } else {
                    showAlert(result.message, 'error');
                }
            } catch (error) {
                showAlert('Error: ' + error.message, 'error');
            }
        }
    }

    // ARTICLES CRUD (similar structure)
    static async loadArticles() {
        try {
            const response = await fetch(this.baseURL + 'articles/read.php');
            const result = await response.json();
            
            if (result.success) {
                this.renderArticles(result.data);
            }
        } catch (error) {
            console.error('Error loading articles:', error);
        }
    }

    static renderArticles(articles) {
        const tbody = document.getElementById('articlesTable');
        tbody.innerHTML = '';

        articles.forEach(article => {
            const row = `
                <tr>
                    <td>${article.judul}</td>
                    <td>${article.kategori}</td>
                    <td>${article.views || 0}</td>
                    <td>
                        <span class="badge ${article.status === 'published' ? 'bg-success' : 'bg-warning'}">
                            ${article.status === 'published' ? 'Published' : 'Draft'}
                        </span>
                    </td>
                    <td>${new Date(article.created_at).toLocaleDateString('id-ID')}</td>
                    <td class="table-actions">
                        <button class="btn btn-sm btn-warning me-1" onclick="Dashboard.editArticle(${article.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="Dashboard.deleteArticle(${article.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });

        document.getElementById('totalArticles').textContent = articles.length;
    }

    static async saveArticle() {
        const articleData = {
            judul: document.getElementById('articleTitle').value,
            kategori: document.getElementById('articleCategory').value,
            konten: document.getElementById('articleContent').value,
            status: document.getElementById('articleStatus').value
        };

        const articleId = document.getElementById('articleId').value;
        
        if (articleId) {
            articleData.id = articleId;
        }

        try {
            const url = articleId ? 
                this.baseURL + 'articles/update.php' : 
                this.baseURL + 'articles/create.php';
            
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(articleData)
            });
            
            const result = await response.json();
            
            if (result.success) {
                showAlert('Artikel berhasil disimpan!', 'success');
                $('#articleModal').modal('hide');
                this.loadArticles();
            } else {
                showAlert(result.message, 'error');
            }
        } catch (error) {
            showAlert('Error: ' + error.message, 'error');
        }
    }

    // SEARCHING & FILTERING
    static initSearch() {
        const searchInput = document.getElementById('searchProducts');
        if (searchInput) {
            searchInput.addEventListener('input', this.debounce(this.searchProducts.bind(this), 300));
        }
    }

    static debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    static async searchProducts() {
        const searchTerm = document.getElementById('searchProducts').value;
        const category = document.getElementById('filterCategory').value;
        const sortBy = document.getElementById('sortProducts').value;
        
        // Implement search logic here
        console.log('Searching:', { searchTerm, category, sortBy });
    }

    // CHARTS & REPORTING
    static initCharts() {
        // Products Chart
        const productsCtx = document.getElementById('productsChart').getContext('2d');
        new Chart(productsCtx, {
            type: 'bar',
            data: {
                labels: ['Beras', 'Sayuran', 'Buah', 'Jagung'],
                datasets: [{
                    label: 'Produk Terjual',
                    data: [65, 59, 80, 81],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Categories Chart
        const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
        new Chart(categoriesCtx, {
            type: 'pie',
            data: {
                labels: ['Padi & Beras', 'Sayuran', 'Buah-buahan', 'Jagung'],
                datasets: [{
                    data: [30, 25, 20, 25],
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0'
                    ]
                }]
            }
        });
    }

    static loadStatistics() {
        // Load statistics from API
        document.getElementById('totalConsultations').textContent = '5';
        document.getElementById('totalRevenue').textContent = 'Rp 2.500.000';
    }
}

// Global functions for HTML onclick
function saveProduct() {
    Dashboard.saveProduct();
}

function saveArticle() {
    Dashboard.saveArticle();
}

// Initialize dashboard when page loads
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('dashboard.html')) {
        Dashboard.loadDashboard();
        Dashboard.initSearch();
    }
    
    // Update auth UI
    Auth.updateUI();
});