<?php
include('db.php');

// Fetch all products
$products = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC");

// Fetch product for editing (if ?edit=ID)
$editProduct = null;
if (isset($_GET['edit'])) {
    $editId      = intval($_GET['edit']);
    $editProduct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$editId"));
}

// Categories list
$categories = ['DTY Machine', 'TFO Machine', 'Jari Machine', 'Accessories', 'Other'];

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products — P S Industries Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
* { margin: 0; padding: 0; box-sizing: border-box; }

html { scroll-behavior: smooth; scrollbar-width: none; }
html::-webkit-scrollbar { display: none; }

body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    color: #333;
    background: linear-gradient(rgba(255,255,255,0.93), rgba(255,255,255,0.93)),
                url('TFO.jpg') center/cover fixed no-repeat;
    min-height: 100vh;
    padding-top: 155px;
}

/* ── HEADER ── */
header {
    position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;
    background: rgba(255,255,255,0.97);
    backdrop-filter: blur(10px);
    border-bottom: 2px solid #DDBA7D;
    box-shadow: 0 4px 20px rgba(207,75,0,0.15);
    padding: 15px 0;
    transition: all 0.4s ease;
}
header.scrolled {
    padding: 5px 0;
    background: rgba(255,255,255,0.95);
    border-bottom-color: #CF4B00;
    box-shadow: 0 6px 25px rgba(207,75,0,0.2);
}
header.scrolled .header-top { margin-bottom: 5px; }
header.scrolled .header-spacer { width: 15px; }
header.scrolled .logo-company-container { padding: 5px 15px; gap: 15px; }
header.scrolled .logo-frame img { width: 40px; height: 40px; }
header.scrolled .company-info h1 { font-size: 1.5rem; margin-bottom: 0; }
header.scrolled .company-info h1::after { opacity: 0; }
header.scrolled .tagline { font-size: 0; opacity: 0; padding: 0; border: none; height: 0; }
header.scrolled nav { padding-top: 5px; }
header.scrolled .nav-links { padding: 5px 10px; }
header.scrolled .admin-login-btn { padding: 6px 14px; font-size: 0.82rem; }

.header-top { display: flex; align-items: center; justify-content: center; padding: 0 30px; margin-bottom: 10px; transition: all 0.4s ease; }
.header-spacer { width: 100vw; transition: width 0.4s ease; }
.logo-container, .company-info { flex-shrink: 0; transition: all 0.4s ease; }

.logo-company-container {
    display: flex; align-items: center; gap: 25px;
    padding: 10px 20px; background: rgba(255,255,255,0.9);
    border-radius: 15px; border: 2px solid #DDBA7D;
    box-shadow: 0 4px 15px rgba(207,75,0,0.1);
    position: relative; overflow: hidden; transition: all 0.3s ease;
}
.logo-frame {
    background: white; border-radius: 12px; padding: 8px;
    box-shadow: 0 4px 15px rgba(207,75,0,0.15); border: 2px solid #CF4B00;
    flex-shrink: 0; position: relative; z-index: 1; transition: all 0.3s ease;
}
.logo-frame img { border-radius: 8px; display: block; width: 60px; height: 60px; object-fit: cover; transition: all 0.3s ease; }

.company-info { display: flex; flex-direction: column; position: relative; z-index: 1; }
.company-info h1 {
    font-size: 2.2rem; font-weight: 800; color: #CF4B00;
    margin-bottom: 5px; letter-spacing: -0.5px;
    text-shadow: 1px 1px 3px rgba(207,75,0,0.2); position: relative; transition: all 0.3s ease;
}
.company-info h1::after {
    content: ''; position: absolute; bottom: -5px; left: 0;
    width: 100%; height: 2px; background: linear-gradient(90deg, #CF4B00, transparent); transition: all 0.3s ease;
}
.tagline {
    color: #666; font-size: 0.9rem; font-weight: 600; letter-spacing: 1.5px;
    text-transform: uppercase; padding-left: 5px; border-left: 3px solid #9CC6DB;
    transition: all 0.3s ease; overflow: hidden;
}

nav {
    display: flex; align-items: center; gap: 15px;
    padding: 15px 30px 0; position: relative; z-index: 100; transition: all 0.3s ease;
}
.nav-links {
    flex: 1; display: flex; justify-content: center; list-style: none;
    gap: 8px; background: rgba(255,255,255,0.95); padding: 10px;
    border-radius: 15px; box-shadow: 0 4px 15px rgba(207,75,0,0.2);
    position: relative; overflow: visible; transition: all 0.3s ease;
}
.nav-links li { position: relative; }
.nav-links a {
    text-decoration: none; color: #CF4B00; font-weight: 600;
    padding: 12px 25px; border-radius: 10px; transition: all 0.3s ease;
    font-size: 0.95rem; display: block; background: transparent;
    border: 2px solid transparent; position: relative; z-index: 1;
}
.nav-links a:hover, .nav-links a.active {
    background: #CF4B00; color: white; transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(207,75,0,0.3); border-color: #CF4B00;
}
.admin-login-btn {
    flex-shrink: 0; display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 20px; background: #CF4B00; color: white; text-decoration: none;
    border-radius: 10px; font-weight: 700; font-size: 0.9rem; border: 2px solid #CF4B00;
    transition: all 0.3s ease; white-space: nowrap;
    box-shadow: 0 4px 12px rgba(207,75,0,0.25); z-index: 2;
}
.admin-login-btn:hover { background: white; color: #CF4B00; transform: translateY(-3px); }

/* ── ADMIN BADGE ── */
.admin-badge {
    display: flex; align-items: center; gap: 15px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white; padding: 12px 30px; margin-bottom: 30px;
    border-radius: 15px; font-weight: 600; font-size: 1rem;
    box-shadow: 0 4px 15px rgba(207,75,0,0.25);
}
.admin-badge span { font-size: 1.5rem; }

/* ── TOAST ── */
.toast {
    position: fixed; top: 170px; right: 30px; z-index: 9999;
    background: linear-gradient(135deg, #2e7d32, #43a047);
    color: white; padding: 14px 24px; border-radius: 12px;
    font-weight: 600; box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    animation: slideIn 0.4s ease, fadeOut 0.5s ease 3s forwards;
}
@keyframes slideIn { from { transform: translateX(100px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
@keyframes fadeOut { to { opacity: 0; transform: translateY(-10px); } }

/* ── LAYOUT ── */
.page-wrapper {
    max-width: 1300px; margin: 0 auto; padding: 30px 25px 60px;
}

/* ── SECTION HEADER ── */
.section-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 25px;
}
.section-title {
    font-size: 1.8rem; font-weight: 800; color: #CF4B00;
    position: relative; padding-bottom: 10px;
}
.section-title::after {
    content: ''; position: absolute; bottom: 0; left: 0;
    width: 60px; height: 3px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D); border-radius: 2px;
}

/* ── CARD BOX ── */
.card-box {
    background: rgba(255,255,255,0.95); border-radius: 20px;
    border: 2px solid #DDBA7D; box-shadow: 0 8px 30px rgba(207,75,0,0.1);
    padding: 30px; margin-bottom: 35px; backdrop-filter: blur(5px);
}

/* ── PRODUCTS TABLE ── */
.products-table { width: 100%; border-collapse: collapse; }
.products-table thead th {
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white; padding: 14px 20px; text-align: left;
    font-weight: 700; font-size: 0.9rem; letter-spacing: 0.5px;
}
.products-table thead th:first-child { border-radius: 10px 0 0 10px; }
.products-table thead th:last-child { border-radius: 0 10px 10px 0; }
.products-table tbody tr {
    border-bottom: 1px solid rgba(221,186,125,0.3);
    transition: background 0.2s ease;
}
.products-table tbody tr:hover { background: rgba(207,75,0,0.03); }
.products-table tbody td { padding: 14px 20px; vertical-align: middle; font-size: 0.92rem; }

.prod-thumb {
    width: 60px; height: 60px; object-fit: cover;
    border-radius: 10px; border: 2px solid #DDBA7D;
}
.no-img {
    width: 60px; height: 60px; border-radius: 10px;
    background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem;
}

.badge {
    display: inline-block; padding: 4px 12px; border-radius: 20px;
    font-size: 0.78rem; font-weight: 700; letter-spacing: 0.3px;
}
.badge-active { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
.badge-inactive { background: #ffeee8; color: #CF4B00; border: 1px solid #DDBA7D; }
.badge-cat { background: rgba(207,75,0,0.1); color: #CF4B00; border: 1px solid rgba(207,75,0,0.2); }

/* ── BUTTONS ── */
.btn {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 8px 16px; border-radius: 8px; font-size: 0.85rem;
    font-weight: 600; border: none; cursor: pointer; text-decoration: none;
    transition: all 0.25s ease;
}
.btn-edit { background: rgba(156,198,219,0.2); color: #1565c0; border: 1.5px solid #9CC6DB; }
.btn-edit:hover { background: #9CC6DB; color: white; transform: translateY(-2px); }
.btn-delete { background: rgba(207,75,0,0.08); color: #CF4B00; border: 1.5px solid rgba(207,75,0,0.3); }
.btn-delete:hover { background: #CF4B00; color: white; transform: translateY(-2px); }
.btn-toggle { background: rgba(221,186,125,0.2); color: #795548; border: 1.5px solid #DDBA7D; }
.btn-toggle:hover { background: #DDBA7D; color: white; transform: translateY(-2px); }
.btn-primary {
    background: linear-gradient(135deg, #CF4B00, #DDBA7D); color: white;
    padding: 12px 28px; font-size: 1rem; border-radius: 12px; font-weight: 700;
    box-shadow: 0 4px 15px rgba(207,75,0,0.25);
}
.btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(207,75,0,0.35); }
.btn-secondary {
    background: white; color: #CF4B00;
    padding: 12px 24px; font-size: 1rem; border-radius: 12px; font-weight: 700;
    border: 2px solid #CF4B00;
}
.btn-secondary:hover { background: #CF4B00; color: white; transform: translateY(-2px); }

/* ── FORM ── */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; }
.form-group { display: flex; flex-direction: column; gap: 8px; }
.form-group.full { grid-column: 1 / -1; }
.form-group label { font-weight: 700; color: #444; font-size: 0.9rem; letter-spacing: 0.3px; }
.form-group input[type="text"],
.form-group select,
.form-group textarea {
    padding: 12px 16px; border-radius: 10px;
    border: 2px solid #DDBA7D; font-size: 0.95rem;
    font-family: inherit; background: white; color: #333;
    transition: border-color 0.2s ease;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none; border-color: #CF4B00;
    box-shadow: 0 0 0 3px rgba(207,75,0,0.1);
}
.form-group textarea { resize: vertical; min-height: 100px; }

.image-upload-area {
    border: 2px dashed #DDBA7D; border-radius: 12px;
    padding: 20px; text-align: center; cursor: pointer;
    transition: all 0.2s ease; background: rgba(221,186,125,0.05);
    position: relative;
}
.image-upload-area:hover { border-color: #CF4B00; background: rgba(207,75,0,0.03); }
.image-upload-area input[type="file"] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
.upload-icon { font-size: 2.5rem; margin-bottom: 8px; }
.upload-text { color: #666; font-size: 0.9rem; font-weight: 500; }
.upload-hint { color: #999; font-size: 0.78rem; margin-top: 4px; }

.img-preview {
    width: 100%; max-height: 200px; object-fit: cover;
    border-radius: 10px; border: 2px solid #DDBA7D; margin-top: 10px;
}

.toggle-row { display: flex; align-items: center; gap: 12px; margin-top: 5px; }
.toggle-switch { position: relative; display: inline-block; width: 48px; height: 26px; }
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider {
    position: absolute; cursor: pointer; inset: 0;
    background: #ddd; border-radius: 26px; transition: 0.3s ease;
}
.toggle-slider::before {
    content: ''; position: absolute;
    height: 20px; width: 20px; left: 3px; bottom: 3px;
    background: white; border-radius: 50%; transition: 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
.toggle-switch input:checked + .toggle-slider { background: #CF4B00; }
.toggle-switch input:checked + .toggle-slider::before { transform: translateX(22px); }

.form-actions { display: flex; gap: 15px; margin-top: 10px; }

.empty-state {
    text-align: center; padding: 50px 20px; color: #999;
}
.empty-state .empty-icon { font-size: 4rem; margin-bottom: 15px; }
.empty-state p { font-size: 1.1rem; }

/* ── RESPONSIVE ── */
@media (max-width: 700px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-group.full { grid-column: 1; }
    .products-table { font-size: 0.82rem; }
    .products-table thead th, .products-table tbody td { padding: 10px 12px; }
}
    </style>
</head>
<body>

<!-- ── TOAST ── -->
<?php if ($msg): ?>
<div class="toast">✅ <?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<!-- ── HEADER ── -->
<header id="mainHeader">
    <div class="header-top">
        <div class="logo-company-container">
            <div class="logo-container">
                <div class="logo-frame">
                    <img src="final.png" alt="Company Logo">
                </div>
            </div>
            <div class="header-spacer"></div>
            <div class="company-info">
                <h1>P S Industries</h1>
                <p class="tagline">Precision Engineering &amp; Manufacturing</p>
            </div>
        </div>
    </div>
    <nav>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="adminProducts.php" class="active">Manage Products</a></li>
        </ul>
        <a href="adminLogIn.php" class="admin-login-btn">🔐 Admin</a>
    </nav>
</header>

<!-- ── PAGE CONTENT ── -->
<div class="page-wrapper">

    <div class="admin-badge">
        <span>⚙️</span>
        <div>
            <div style="font-size:1.1rem;font-weight:800;">Product Management Panel</div>
            <div style="opacity:0.85;font-size:0.88rem;">Add, edit, or remove products from the website</div>
        </div>
    </div>

    <!-- ============= ADD / EDIT FORM ============= -->
    <div class="card-box">
        <div class="section-header">
            <h2 class="section-title"><?= $editProduct ? '✏️ Edit Product' : '➕ Add New Product' ?></h2>
            <?php if ($editProduct): ?>
                <a href="adminProducts.php" class="btn btn-secondary">✕ Cancel Edit</a>
            <?php endif; ?>
        </div>

        <form action="productAction.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?= $editProduct ? 'edit' : 'add' ?>">
            <?php if ($editProduct): ?>
                <input type="hidden" name="id" value="<?= $editProduct['id'] ?>">
            <?php endif; ?>

            <div class="form-grid">
                <!-- Product Name -->
                <div class="form-group">
                    <label>Product Name *</label>
                    <input type="text" name="name" placeholder="e.g. Double Density DTY Machine"
                        value="<?= htmlspecialchars($editProduct['name'] ?? '') ?>" required>
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label>Category *</label>
                    <select name="category" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat ?>"
                                <?= ($editProduct['category'] ?? '') === $cat ? 'selected' : '' ?>>
                                <?= $cat ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Description -->
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" placeholder="Describe the product features and use cases..."><?= htmlspecialchars($editProduct['description'] ?? '') ?></textarea>
                </div>

                <!-- Specs -->
                <div class="form-group full">
                    <label>Specifications <span style="font-weight:400;color:#888;">(one per line, e.g. Speed: 800 RPM)</span></label>
                    <textarea name="specs" placeholder="Speed: 800 RPM&#10;Power: 3.5 kW&#10;Weight: 450 kg" style="min-height:120px;"><?= htmlspecialchars($editProduct['specs'] ?? '') ?></textarea>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label>Product Image <?= $editProduct ? '(leave empty to keep current)' : '' ?></label>
                    <div class="image-upload-area" id="uploadArea">
                        <div class="upload-icon">📷</div>
                        <div class="upload-text">Click to upload image</div>
                        <div class="upload-hint">JPG, PNG, WebP — max 5MB</div>
                        <input type="file" name="image" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <?php if (!empty($editProduct['image_path'])): ?>
                        <img src="uploads/products/<?= htmlspecialchars($editProduct['image_path']) ?>"
                             class="img-preview" id="imgPreview" alt="Current image">
                    <?php else: ?>
                        <img src="" class="img-preview" id="imgPreview" style="display:none;" alt="Preview">
                    <?php endif; ?>
                </div>

                <!-- Active Toggle -->
                <div class="form-group">
                    <label>Visibility</label>
                    <div class="toggle-row">
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" value="1"
                                <?= ($editProduct['is_active'] ?? 1) ? 'checked' : '' ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <span style="font-weight:600;color:#444;">Show on website</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-group full">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <?= $editProduct ? '💾 Save Changes' : '➕ Add Product' ?>
                        </button>
                        <?php if ($editProduct): ?>
                            <a href="adminProducts.php" class="btn btn-secondary">Cancel</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- ============= PRODUCT LIST ============= -->
    <div class="card-box">
        <div class="section-header">
            <h2 class="section-title">📦 All Products</h2>
            <span style="color:#999;font-size:0.9rem;"><?= mysqli_num_rows($products) ?> product(s) found</span>
        </div>

        <?php if (mysqli_num_rows($products) === 0): ?>
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <p>No products yet. Add your first product above!</p>
        </div>
        <?php else: ?>
        <div style="overflow-x:auto;">
        <table class="products-table">
            <thead>
                <tr>
                    <th style="width:70px;">Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Added</th>
                    <th style="width:210px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($p = mysqli_fetch_assoc($products)): ?>
                <tr>
                    <td>
                        <?php if ($p['image_path']): ?>
                            <img src="uploads/products/<?= htmlspecialchars($p['image_path']) ?>"
                                 class="prod-thumb" alt="<?= htmlspecialchars($p['name']) ?>">
                        <?php else: ?>
                            <div class="no-img">📦</div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
                    <td><span class="badge badge-cat"><?= htmlspecialchars($p['category']) ?></span></td>
                    <td>
                        <span class="badge <?= $p['is_active'] ? 'badge-active' : 'badge-inactive' ?>">
                            <?= $p['is_active'] ? '✓ Active' : '✗ Hidden' ?>
                        </span>
                    </td>
                    <td style="color:#888;font-size:0.85rem;"><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                    <td>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            <a href="adminProducts.php?edit=<?= $p['id'] ?>" class="btn btn-edit">✏️ Edit</a>

                            <form method="POST" action="productAction.php" style="display:inline;" onsubmit="return toggleConfirm()">
                                <input type="hidden" name="action" value="toggle">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <button type="submit" class="btn btn-toggle">
                                    <?= $p['is_active'] ? '👁️ Hide' : '👁️ Show' ?>
                                </button>
                            </form>

                            <form method="POST" action="productAction.php" style="display:inline;" onsubmit="return deleteConfirm()">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <button type="submit" class="btn btn-delete">🗑️ Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        </div>
        <?php endif; ?>
    </div>

</div><!-- end page-wrapper -->

<script>
// Scroll header shrink
const hdr = document.getElementById('mainHeader');
window.addEventListener('scroll', () => {
    hdr.classList.toggle('scrolled', window.scrollY > 10);
});

// Image preview
function previewImage(input) {
    const preview = document.getElementById('imgPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Confirmations
function deleteConfirm() {
    return confirm('⚠️ Delete this product? This cannot be undone.');
}
function toggleConfirm() { return true; }

// Auto-dismiss toast
setTimeout(() => {
    const t = document.querySelector('.toast');
    if (t) t.style.display = 'none';
}, 4000);
</script>
</body>
</html>
