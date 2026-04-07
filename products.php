<?php
include('db.php');

// Get distinct active categories
$catRes    = mysqli_query($conn, "SELECT DISTINCT category FROM products WHERE is_active=1 ORDER BY category");
$categories = [];
while ($r = mysqli_fetch_assoc($catRes)) { $categories[] = $r['category']; }

// Active category filter
$selCat = isset($_GET['category']) ? trim($_GET['category']) : 'all';

// Fetch products
if ($selCat === 'all') {
    $result = mysqli_query($conn, "SELECT * FROM products WHERE is_active=1 ORDER BY created_at DESC");
} else {
    $safe   = mysqli_real_escape_string($conn, $selCat);
    $result = mysqli_query($conn, "SELECT * FROM products WHERE is_active=1 AND category='$safe' ORDER BY created_at DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Range — P S Industries</title>
    <meta name="description" content="Explore the complete product range of P S Industries — precision-engineered DTY, TFO, and Jari machines for the textile industry.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
* { margin: 0; padding: 0; box-sizing: border-box; }
html { scroll-behavior: smooth; scrollbar-width: none; }
html::-webkit-scrollbar { display: none; }

body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    color: #333; overflow-x: hidden;
    background: linear-gradient(rgba(255,255,255,0.92), rgba(255,255,255,0.92)),
                url('TFO.jpg') center/cover fixed no-repeat;
    min-height: 100vh; padding-top: 155px;
}

/* ── HEADER ── */
header {
    position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;
    background: rgba(255,255,255,0.97); backdrop-filter: blur(10px);
    border-bottom: 2px solid #DDBA7D;
    box-shadow: 0 4px 20px rgba(207,75,0,0.15);
    padding: 15px 0; transition: all 0.4s ease;
}
header.scrolled { padding: 5px 0; background: rgba(255,255,255,0.95); border-bottom-color: #CF4B00; box-shadow: 0 6px 25px rgba(207,75,0,0.2); }
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
    margin-bottom: 5px; text-shadow: 1px 1px 3px rgba(207,75,0,0.2);
    position: relative; transition: all 0.3s ease;
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
nav { display: flex; align-items: center; gap: 15px; padding: 15px 30px 0; position: relative; z-index: 100; transition: all 0.3s ease; }
.nav-links {
    flex: 1; display: flex; justify-content: center; list-style: none;
    gap: 8px; background: rgba(255,255,255,0.95); padding: 10px;
    border-radius: 15px; box-shadow: 0 4px 15px rgba(207,75,0,0.2);
    position: relative; overflow: visible; transition: all 0.3s ease;
}
.nav-links li { position: relative; }
.dropdown { position: relative; }
.nav-links a {
    text-decoration: none; color: #CF4B00; font-weight: 600; padding: 12px 25px;
    border-radius: 10px; transition: all 0.3s ease; font-size: 0.95rem;
    display: block; background: transparent; border: 2px solid transparent;
    position: relative; z-index: 1;
}
.nav-links a:hover, .nav-links a.active {
    background: #CF4B00; color: white; transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(207,75,0,0.3); border-color: #CF4B00;
}
.dropdown-content {
    position: absolute; top: calc(100% + 10px); left: 0;
    background: rgba(255,255,255,0.98); backdrop-filter: blur(10px);
    min-width: 220px; border-radius: 12px;
    box-shadow: 0 10px 30px rgba(207,75,0,0.25);
    opacity: 0; visibility: hidden; transition: all 0.3s ease;
    padding: 15px; border: 2px solid #DDBA7D; z-index: 2000;
    transform: translateY(-10px);
}
.dropdown:hover .dropdown-content { opacity: 1; visibility: visible; transform: translateY(0); }
.dropdown-content a {
    padding: 12px 18px; margin: 5px 0; border-radius: 8px;
    color: #333; font-weight: 500; background: rgba(255,255,255,0.8);
    border-left: 4px solid #9CC6DB; transition: all 0.2s ease;
    text-align: left; display: block;
}
.dropdown-content a:hover { background: #CF4B00; color: white; transform: translateX(5px); border-left-color: #CF4B00; }
.admin-login-btn {
    flex-shrink: 0; display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 20px; background: #CF4B00; color: white; text-decoration: none;
    border-radius: 10px; font-weight: 700; font-size: 0.9rem; border: 2px solid #CF4B00;
    transition: all 0.3s ease; white-space: nowrap; box-shadow: 0 4px 12px rgba(207,75,0,0.25); z-index: 2;
}
.admin-login-btn:hover { background: white; color: #CF4B00; transform: translateY(-3px); }

/* ── PAGE HERO ── */
.page-hero {
    text-align: center;
    padding: 50px 20px 40px;
    max-width: 700px;
    margin: 0 auto 50px;
}
.page-hero h1 {
    font-size: 3rem; font-weight: 800; color: #CF4B00;
    margin-bottom: 18px; line-height: 1.15;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.page-hero p { color: #666; font-size: 1.1rem; line-height: 1.8; }

/* ── CATEGORY FILTERS ── */
.filter-bar {
    display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;
    margin-bottom: 45px; padding: 0 20px;
}
.filter-btn {
    padding: 10px 22px; border-radius: 25px; font-size: 0.9rem; font-weight: 700;
    text-decoration: none; border: 2px solid #DDBA7D; color: #666;
    background: rgba(255,255,255,0.9); transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.filter-btn:hover { border-color: #CF4B00; color: #CF4B00; transform: translateY(-2px); }
.filter-btn.active {
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white; border-color: transparent;
    box-shadow: 0 5px 20px rgba(207,75,0,0.3); transform: translateY(-2px);
}

/* ── PRODUCT GRID ── */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 25px 60px;
}

/* ── PRODUCT CARD ── */
.product-card {
    background: rgba(255,255,255,0.97);
    border-radius: 20px;
    border: 2px solid #DDBA7D;
    box-shadow: 0 8px 30px rgba(207,75,0,0.1);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    animation: fadeUp 0.6s ease both;
}
.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(207,75,0,0.2);
    border-color: #CF4B00;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

.card-img-wrap {
    position: relative; overflow: hidden;
    height: 230px; background: linear-gradient(135deg, #f5f5f5, #ebebeb);
}
.card-img-wrap img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
}
.product-card:hover .card-img-wrap img { transform: scale(1.08); }

.card-img-placeholder {
    width: 100%; height: 100%; display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 10px;
    background: linear-gradient(135deg, rgba(207,75,0,0.05), rgba(221,186,125,0.1));
}
.card-img-placeholder span { font-size: 4rem; }
.card-img-placeholder p { color: #aaa; font-size: 0.85rem; font-weight: 500; }

.cat-badge {
    position: absolute; top: 15px; left: 15px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white; padding: 5px 14px; border-radius: 20px;
    font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;
    box-shadow: 0 3px 10px rgba(207,75,0,0.3);
}

.card-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(207,75,0,0.85), transparent);
    opacity: 0; transition: opacity 0.4s ease;
    display: flex; align-items: flex-end; padding: 20px;
}
.product-card:hover .card-overlay { opacity: 1; }
.overlay-text { color: white; font-weight: 700; font-size: 0.95rem; letter-spacing: 0.3px; }

.card-body { padding: 22px 22px 18px; }

.card-title { font-size: 1.15rem; font-weight: 800; color: #1a1a1a; margin-bottom: 10px; line-height: 1.3; }

.card-desc {
    color: #666; font-size: 0.88rem; line-height: 1.7;
    margin-bottom: 16px;
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}

.card-specs {
    background: rgba(207,75,0,0.04); border: 1px solid rgba(207,75,0,0.12);
    border-radius: 10px; padding: 12px 15px; margin-bottom: 18px;
}
.spec-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 4px 0; font-size: 0.82rem; color: #555;
    border-bottom: 1px solid rgba(221,186,125,0.2);
}
.spec-row:last-child { border-bottom: none; }
.spec-key { font-weight: 700; color: #CF4B00; }

.card-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 14px; border-top: 1px solid rgba(221,186,125,0.3);
}
.card-date { color: #bbb; font-size: 0.78rem; }
.view-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 18px; background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white; border-radius: 10px; font-size: 0.85rem; font-weight: 700;
    text-decoration: none; transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(207,75,0,0.2);
}
.view-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(207,75,0,0.35); }

/* ── EMPTY STATE ── */
.empty-products {
    grid-column: 1 / -1; text-align: center; padding: 80px 20px;
    color: #aaa;
}
.empty-products .big-icon { font-size: 5rem; margin-bottom: 20px; }
.empty-products h3 { font-size: 1.5rem; color: #888; margin-bottom: 10px; }
.empty-products p { font-size: 1rem; }

/* ── FOOTER ── */
footer {
    background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
    color: white; padding: 30px 25px 15px;
    margin-top: 50px; border-top: 3px solid #CF4B00;
    position: relative; overflow: hidden;
}
footer:after {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D, #9CC6DB); z-index: 1;
}
.footer-links {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px; margin-bottom: 25px; position: relative; z-index: 1;
}
.footer-column h4 { font-size: 1.1rem; margin-bottom: 18px; color: #DDBA7D; font-weight: 600; }
.footer-column a {
    color: #aaa; text-decoration: none; margin-bottom: 10px; display: block;
    font-size: 0.9rem; transition: all 0.2s ease; padding: 5px 10px; border-radius: 4px;
}
.footer-column a:hover { color: white; background: rgba(207,75,0,0.2); transform: translateX(5px); }
.footer-bottom {
    text-align: center; padding-top: 20px;
    border-top: 1px solid rgba(221,186,125,0.2);
    font-size: 0.85rem; color: #999; position: relative; z-index: 1;
}

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .page-hero h1 { font-size: 2rem; }
    .products-grid { grid-template-columns: 1fr; padding: 0 15px 40px; }
    .filter-bar { gap: 8px; }
    .filter-btn { padding: 8px 16px; font-size: 0.82rem; }
}
    </style>
</head>
<body>

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
            <li class="dropdown">
                <a href="#" class="active">Overview</a>
                <div class="dropdown-content">
                    <a href="history.php">Company History</a>
                    <a href="mission.php">Our Mission</a>
                    <a href="leadership.php">Leadership Team</a>
                </div>
            </li>
            <li><a href="products.php" class="active">Product Range</a></li>
            <li><a href="qualityControl.php">Quality Control</a></li>
            <li><a href="global.html">Our Presence</a></li>
        </ul>
        <a href="adminLogIn.php" class="admin-login-btn">🔐 Admin</a>
    </nav>
</header>

<!-- ── PAGE HERO ── -->
<div class="page-hero">
    <h1>Our Product Range</h1>
    <p>Precision-engineered machines built for performance, reliability, and the demands of modern textile manufacturing.</p>
</div>

<!-- ── CATEGORY FILTER ── -->
<?php if (!empty($categories)): ?>
<div class="filter-bar">
    <a href="products.php" class="filter-btn <?= $selCat === 'all' ? 'active' : '' ?>">🏭 All Products</a>
    <?php foreach ($categories as $cat): ?>
        <a href="products.php?category=<?= urlencode($cat) ?>"
           class="filter-btn <?= $selCat === $cat ? 'active' : '' ?>">
            <?= htmlspecialchars($cat) ?>
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- ── PRODUCTS GRID ── -->
<div class="products-grid">
<?php
$count = 0;
while ($p = mysqli_fetch_assoc($result)):
    $count++;
    // Parse specs into rows
    $specLines = array_filter(array_map('trim', explode("\n", $p['specs'] ?? '')));
    $specSlice = array_slice($specLines, 0, 4); // show max 4 specs on card
?>
    <div class="product-card" style="animation-delay: <?= ($count - 1) * 0.08 ?>s">
        <!-- Image -->
        <div class="card-img-wrap">
            <?php if ($p['image_path']): ?>
                <img src="uploads/products/<?= htmlspecialchars($p['image_path']) ?>"
                     alt="<?= htmlspecialchars($p['name']) ?>">
            <?php else: ?>
                <div class="card-img-placeholder">
                    <span>⚙️</span>
                    <p>No image available</p>
                </div>
            <?php endif; ?>
            <span class="cat-badge"><?= htmlspecialchars($p['category']) ?></span>
            <div class="card-overlay">
                <div class="overlay-text">View Product Details →</div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            <h2 class="card-title"><?= htmlspecialchars($p['name']) ?></h2>

            <?php if ($p['description']): ?>
            <p class="card-desc"><?= htmlspecialchars($p['description']) ?></p>
            <?php endif; ?>

            <!-- Specs -->
            <?php if (!empty($specSlice)): ?>
            <div class="card-specs">
                <?php foreach ($specSlice as $spec):
                    $parts = explode(':', $spec, 2);
                ?>
                <div class="spec-row">
                    <span class="spec-key"><?= htmlspecialchars(trim($parts[0])) ?></span>
                    <span><?= htmlspecialchars(trim($parts[1] ?? '')) ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Footer -->
            <div class="card-footer">
                <span class="card-date">Added <?= date('d M Y', strtotime($p['created_at'])) ?></span>
                <a href="products.php?category=<?= urlencode($p['category']) ?>" class="view-btn">
                    Browse <?= htmlspecialchars($p['category']) ?> →
                </a>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<?php if ($count === 0): ?>
<div class="empty-products">
    <div class="big-icon">🔧</div>
    <h3>No products found</h3>
    <p><?= $selCat !== 'all' ? "No products in this category yet." : "No products have been added yet." ?></p>
</div>
<?php endif; ?>
</div><!-- end grid -->

<!-- ── FOOTER ── -->
<footer>
    <div class="footer-links">
        <div class="footer-column">
            <h4>Quick Links</h4>
            <a href="home.php">Home</a>
            <a href="history.php">Company History</a>
            <a href="products.php">Product Range</a>
            <a href="qualityControl.php">Quality Control</a>
        </div>
        <div class="footer-column">
            <h4>Support</h4>
            <a href="clientSupport.php">Client Support</a>
            <a href="technical-support.php">Technical Support</a>
        </div>
        <div class="footer-column">
            <h4>Contact Info</h4>
            <a href="#">📧 info@psindustries.com</a>
            <a href="#">📞 +91 XXXXX XXXXX</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 P S Industries. All Rights Reserved.</p>
    </div>
</footer>

<script>
const hdr = document.getElementById('mainHeader');
window.addEventListener('scroll', () => {
    hdr.classList.toggle('scrolled', window.scrollY > 10);
});
</script>
</body>
</html>
