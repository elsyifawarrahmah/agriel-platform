// Data produk
let allProducts = [];
let filteredProducts = [];

// Load produk dari API
async function loadProducts() {
    try {
        console.log('Loading products...');
        
        const response = await fetch('backend/api/products.php');
        const products = await response.json();
        
        allProducts = products;
        filteredProducts = products;
        
        displayProducts(products);
        updateStats(products);
        
    } catch (error) {
        console.error('Error loading products:', error);
        showSampleProducts();
    }
}

// Tampilkan produk
function displayProducts(products) {
    const grid = document.getElementById('productsGrid');
    const noProducts = document.getElementById('noProducts');
    
    if (!products || products.length === 0) {
        grid.innerHTML = '';
        noProducts.style.display = 'block';
        updateProductsCount(0);
        return;
    }
    
    noProducts.style.display = 'none';
    grid.innerHTML = '';
    
    products.forEach(product => {
        const productCard = createProductCard(product);
        grid.innerHTML += productCard;
    });
    
    updateProductsCount(products.length);
}

// Buat card produk
function createProductCard(product) {
    const stockClass = product.stok > 10 ? 'bg-success' : 
                      product.stok > 0 ? 'bg-warning' : 'bg-danger';
    const stockText = product.stok > 10 ? 'Stok Tersedia' : 
                     product.stok > 0 ? 'Stok Menipis' : 'Habis';
    
    return `
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card product-card h-100">
                <div class="position-relative">
                    <img src="assets/img/products/${product.foto}" 
                         class="card-img-top product-image" 
                         alt="${product.nama_produk}"
                         onerror="this.src='assets/img/default-product.jpg'">
                    <span class="badge ${stockClass} stock-badge">${stockText}</span>
                </div>
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">${product.nama_produk}</h5>
                    <p class="card-text text-muted small flex-grow-1">
                        ${product.deskripsi}
                    </p>
                    
                    <div class="product-meta mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="price-tag">Rp ${parseInt(product.harga).toLocaleString()}</span>
                            <small class="text-muted">Stok: ${product.stok}</small>
                        </div>
                        
                        <div class="farmer-info">
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i>
                                ${product.farmer_name}
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                ${product.farmer_address || 'Lokasi tidak tersedia'}
                            </small>
                        </div>
                    </div>
                    
                    <div class="mt-auto">
                        <button class="btn btn-success w-100" 
                                onclick="buyProduct(${product.id})"
                                ${product.stok === 0 ? 'disabled' : ''}>
                            <i class="fas fa-shopping-cart me-2"></i>
                            ${product.stok === 0 ? 'Stok Habis' : 'Beli Sekarang'}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Filter produk
function applyFilters() {
    const category = document.querySelector('.category-btn.active').getAttribute('onclick');
    const maxPrice = parseInt(document.getElementById('priceRange').value);
    const location = document.getElementById('locationFilter').value;
    
    let filtered = allProducts;
    
    // Filter kategori
    if (category && !category.includes('all')) {
        const categoryName = category.match(/'([^']+)'/)[1];
        filtered = filtered.filter(p => p.kategori === categoryName);
    }
    
    // Filter harga
    filtered = filtered.filter(p => p.harga <= maxPrice);
    
    // Filter lokasi
    if (location) {
        filtered = filtered.filter(p => 
            p.farmer_address && p.farmer_address.includes(location)
        );
    }
    
    filteredProducts = filtered;
    displayProducts(filtered);
}

// Filter by category
function filterCategory(category) {
    // Update active button
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    applyFilters();
}

// Search products
function searchProducts() {
    const searchTerm = document.getElementById('searchProducts').value.toLowerCase();
    
    if (!searchTerm) {
        displayProducts(filteredProducts);
        return;
    }
    
    const searched = filteredProducts.filter(product => 
        product.nama_produk.toLowerCase().includes(searchTerm) ||
        product.deskripsi.toLowerCase().includes(searchTerm) ||
        product.kategori.toLowerCase().includes(searchTerm)
    );
    
    displayProducts(searched);
}

// Sort products
function sortProducts(type) {
    let sorted = [...filteredProducts];
    
    switch(type) {
        case 'name':
            sorted.sort((a, b) => a.nama_produk.localeCompare(b.nama_produk));
            break;
        case 'price-low':
            sorted.sort((a, b) => a.harga - b.harga);
            break;
        case 'price-high':
            sorted.sort((a, b) => b.harga - a.harga);
            break;
        case 'newest':
            sorted.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            break;
    }
    
    displayProducts(sorted);
}

// Buy product
function buyProduct(productId) {
    const userRole = localStorage.getItem('user_role');
    
    if (!userRole) {
        alert('Silakan login terlebih dahulu untuk membeli produk');
        return;
    }
    
    if (userRole !== 'pembeli') {
        alert('Hanya pembeli yang dapat membeli produk');
        return;
    }
    
    const product = allProducts.find(p => p.id === productId);
    if (product) {
        showBuyModal(product);
    }
}

// Show buy modal
function showBuyModal(product) {
    const modalHTML = `
        <div class="modal fade" id="buyModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Beli ${product.nama_produk}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-4">
                                <img src="assets/img/products/${product.foto}" 
                                     class="img-fluid rounded" 
                                     alt="${product.nama_produk}"
                                     onerror="this.src='assets/img/default-product.jpg'">
                            </div>
                            <div class="col-8">
                                <h6>${product.nama_produk}</h6>
                                <p class="text-success h5 mb-2">Rp ${parseInt(product.harga).toLocaleString()}</p>
                                <small class="text-muted">Stok: ${product.stok}</small>
                                <br>
                                <small class="text-muted">Petani: ${product.farmer_name}</small>
                            </div>
                        </div>
                        
                        <form id="buyForm">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pembelian</label>
                                <input type="number" class="form-control" id="quantity" 
                                       value="1" min="1" max="${product.stok}" required>
                                <small class="text-muted">Maksimal: ${product.stok} unit</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Pengiriman</label>
                                <textarea class="form-control" id="shippingAddress" 
                                          rows="2" placeholder="Masukkan alamat lengkap..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Catatan (opsional)</label>
                                <textarea class="form-control" id="notes" 
                                          rows="2" placeholder="Catatan untuk penjual..."></textarea>
                            </div>
                            
                            <div class="total-section p-3 bg-light rounded">
                                <div class="d-flex justify-content-between">
                                    <strong>Total Pembayaran:</strong>
                                    <strong class="text-success" id="totalAmount">Rp ${parseInt(product.harga).toLocaleString()}</strong>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" onclick="confirmPurchase(${product.id})">
                            <i class="fas fa-credit-card me-2"></i>Konfirmasi Pembelian
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    const modal = new bootstrap.Modal(document.getElementById('buyModal'));
    modal.show();
    
    // Update total when quantity changes
    document.getElementById('quantity').addEventListener('input', function() {
        const quantity = parseInt(this.value) || 0;
        const total = quantity * product.harga;
        document.getElementById('totalAmount').textContent = `Rp ${total.toLocaleString()}`;
    });
    
    // Remove modal after hide
    document.getElementById('buyModal').addEventListener('hidden.bs.modal', function() {
        this.remove();
    });
}

// Confirm purchase
function confirmPurchase(productId) {
    alert('Fitur pembelian akan segera tersedia! Sistem pembayaran sedang dalam pengembangan.');
    // TODO: Implement purchase logic
}

// Update statistics
function updateStats(products) {
    document.getElementById('totalProducts').textContent = products.length;
    
    // Count unique farmers
    const farmers = [...new Set(products.map(p => p.farmer_name))];
    document.getElementById('totalFarmers').textContent = farmers.length;
}

// Update products count
function updateProductsCount(count) {
    document.getElementById('productsCount').textContent = `(${count} produk)`;
}

// Sample products for fallback
function showSampleProducts() {
    const sampleProducts = [
        {
            id: 1,
            nama_produk: "Beras Organik Premium",
            harga: 15000,
            stok: 100,
            deskripsi: "Beras organik berkualitas tinggi tanpa pestisida",
            kategori: "Padi",
            foto: "default-product.jpg",
            farmer_name: "Budi Santoso",
            farmer_address: "Desa Maju, Kec. Sejahtera",
            created_at: "2024-01-15"
        },
        {
            id: 2,
            nama_produk: "Jagung Manis Segar",
            harga: 8000,
            stok: 150,
            deskripsi: "Jagung manis segar hasil panen lokal",
            kategori: "Jagung",
            foto: "default-product.jpg",
            farmer_name: "Budi Santoso", 
            farmer_address: "Desa Maju, Kec. Sejahtera",
            created_at: "2024-01-14"
        }
    ];
    
    allProducts = sampleProducts;
    filteredProducts = sampleProducts;
    displayProducts(sampleProducts);
    updateStats(sampleProducts);
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    loadProducts();
    
    // Price range display
    const priceRange = document.getElementById('priceRange');
    if (priceRange) {
        priceRange.addEventListener('input', function() {
            document.getElementById('priceValue').textContent = 
                `Rp ${parseInt(this.value).toLocaleString()}`;
        });
    }
    
    // Enter key for search
    document.getElementById('searchProducts')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchProducts();
        }
    });
});