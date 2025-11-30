class CustomDashboard {
    static currentUser = null;
    static baseURL = 'backend/';

    static init() {
        this.checkAuth();
        this.initEventListeners();
        this.loadDashboardData();
        this.initCharts();
    }

    static checkAuth() {
        const user = Auth.getUser();
        if (!user) {
            window.location.href = 'index.html';
            return;
        }
        this.currentUser = user;
        this.updateUserInfo();
    }

    static updateUserInfo() {
        if (this.currentUser) {
            document.getElementById('userName').textContent = this.currentUser.nama;
            document.getElementById('userRole').textContent = this.currentUser.role;
            
            // Set avatar initial
            const avatar = document.getElementById('userAvatar');
            const initial = this.currentUser.nama.charAt(0).toUpperCase();
            avatar.innerHTML = initial;
        }
    }

    static initEventListeners() {
        // Tab navigation
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const tab = link.getAttribute('data-tab');
                this.showTab(tab);
            });
        });

        // Quick actions
        document.querySelectorAll('.action-card').forEach(card => {
            card.addEventListener('click', (e) => {
                e.preventDefault();
                const tab = card.getAttribute('data-tab');
                this.showTab(tab);
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchProducts');
        if (searchInput) {
            searchInput.addEventListener('input', this.debounce(() => {
                this.searchProducts();
            }, 300));
        }
    }

    static showTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });

        // Remove active class from all nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });

        // Show selected tab
        const targetTab = document.getElementById(tabName);
        if (targetTab) {
            targetTab.classList.add('active');
        }

        // Activate corresponding nav link
        const activeLink = document.querySelector(`[data-tab="${tabName}"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        }

        // Load tab-specific data
        this.loadTabData(tabName);
    }

    static async loadTabData(tabName) {
        switch(tabName) {
            case 'products':
                await this.loadProducts();
                break;
            case 'articles':
                await this.loadArticles();
                break;
            case 'consultations':
                await this.loadConsultations();
                break;
            case 'reports':
                this.loadReports();
                break;
        }
    }

    static async loadDashboardData() {
        try {
            // Load products count
            const productsResponse = await fetch(this.baseURL + 'products/read.php');
            const productsData = await productsResponse.json();
            
            if (productsData.success) {
                document.getElementById('totalProducts').textContent = productsData.data.length;
                this.renderRecentProducts(productsData.data.slice(0, 5));
            }

            // Load articles count
            const articlesResponse = await fetch(this.baseURL + 'articles/read.php');
            const articlesData = await articlesResponse.json();
            
            if (articlesData.success) {
                document.getElementById('totalArticles').textContent = articlesData.data.length;
            }

            // Update other statistics...
            this.updateRevenueStats();
            
        } catch (error) {
            console.error('Error loading dashboard data:', error);
        }
    }

    static renderRecentProducts(products) {
        const tbody = document.getElementById('recentProducts');
        tbody.innerHTML = '';

        products.forEach(product => {
            const row = `
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="${product.foto || 'assets/img/default-product.jpg'}" 
                                 alt="${product.nama_produk}" 
                                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;">
                            <span>${product.nama_produk}</span>
                        </div>
                    </td>
                    <td>${product.kategori}</td>
                    <td>Rp ${parseInt(product.harga).toLocaleString()}</td>
                    <td>${product.stok}</td>
                    <td>
                        <span class="badge ${product.stok > 0 ? 'badge-success' : 'badge-secondary'}">
                            ${product.stok > 0 ? 'Tersedia' : 'Habis'}
                        </span>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    // SEARCHING & FILTERING
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
        
        try {
            const response = await fetch(`${this.baseURL}products/search.php?search=${encodeURIComponent(searchTerm)}&category=${encodeURIComponent(category)}`);
            const result = await response.json();
            
            if (result.success) {
                this.renderProducts(result.data);
            }
        } catch (error) {
            console.error('Search error:', error);
        }
    }

    // CHARTS & REPORTING
    static initCharts() {
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Penjualan',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: '#2e7d32',
                    backgroundColor: 'rgba(46, 125, 50, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Padi & Beras', 'Sayuran', 'Buah-buahan', 'Jagung'],
                datasets: [{
                    data: [30, 25, 20, 25],
                    backgroundColor: [
                        '#2e7d32',
                        '#4caf50',
                        '#7cb342',
                        '#aed581'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    static updateRevenueStats() {
        // Simulate revenue calculation
        const revenue = 2500000;
        document.getElementById('totalRevenue').textContent = 'Rp ' + revenue.toLocaleString();
        
        // Update consultations count
        document.getElementById('totalConsultations').textContent = '5';
    }

    // Modal functions
    static showProductModal() {
        alert('Fitur tambah produk akan diimplementasikan');
        // Implement modal show logic
    }

    static showArticleModal() {
        alert('Fitur tulis artikel akan diimplementasikan');
        // Implement modal show logic
    }
}

// Initialize dashboard when page loads
document.addEventListener('DOMContentLoaded', function() {
    CustomDashboard.init();
});

// Global logout function
function logout() {
    if (confirm('Apakah Anda yakin ingin logout?')) {
        Auth.logout();
    }
}