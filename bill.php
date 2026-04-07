<?php
session_start();
include('db.php');

// Initialize search variables
$search_term = '';
$search_condition = '';

// Check if search form was submitted
if(isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search_term = mysqli_real_escape_string($conn, trim($_GET['search']));
    $search_condition = " WHERE billNo LIKE '%$search_term%' ";
}

// Fetch records from billtb with optional search
$query = "SELECT billNo, custName, Address, billDate, billAmt FROM billtb 
          $search_condition 
          ORDER BY billDate DESC";
$result = mysqli_query($conn, $query);

// Check for errors
if(!$result) {
    $error = "Error fetching records: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Records - P S Industries</title>
    <style>
        /* ================= RESET & BASE STYLES ================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #333;
            line-height: 1.6;
            background: linear-gradient(rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.92)),
                        url('factory-bg.jpg') center/cover fixed no-repeat;
            min-height: 100vh;
            padding-top: 120px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ================= HEADER STYLES ================= */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid #DDBA7D;
            box-shadow: 0 4px 20px rgba(207, 75, 0, 0.15);
            padding: 15px 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .logo-company-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo-frame {
            background: white;
            border-radius: 12px;
            padding: 8px;
            border: 2px solid #CF4B00;
            box-shadow: 0 4px 15px rgba(207, 75, 0, 0.15);
        }

        .logo-frame img {
            border-radius: 8px;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .company-info h1 {
            font-size: 1.8rem;
            color: #CF4B00;
            font-weight: 700;
        }

        .admin-controls {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .logout-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #CF4B00, #DDBA7D);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(207, 75, 0, 0.3);
        }

        .back-btn {
            padding: 10px 20px;
            background: #9CC6DB;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .back-btn:hover {
            background: #7bb3d3;
            transform: translateY(-2px);
        }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            margin: 40px 0;
        }

        .page-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title h2 {
            font-size: 2.5rem;
            color: #CF4B00;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .page-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #CF4B00, #DDBA7D);
            border-radius: 2px;
        }

        .page-title p {
            color: #666;
            font-size: 1.1rem;
            margin-top: 20px;
        }

        /* ================= SEARCH BOX STYLES ================= */
        .search-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(207, 75, 0, 0.1);
            border: 2px solid #DDBA7D;
            backdrop-filter: blur(5px);
        }

        .search-box {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .search-label {
            font-weight: 600;
            color: #CF4B00;
            font-size: 1.1rem;
            white-space: nowrap;
        }

        .search-input-group {
            flex: 1;
            display: flex;
            gap: 10px;
        }

        .search-input {
            flex: 1;
            padding: 14px 20px;
            border: 2px solid #9CC6DB;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .search-input:focus {
            outline: none;
            border-color: #CF4B00;
            box-shadow: 0 0 0 3px rgba(207, 75, 0, 0.1);
        }

        .search-btn {
            padding: 14px 30px;
            background: linear-gradient(135deg, #CF4B00, #DDBA7D);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(207, 75, 0, 0.3);
        }

        .clear-search-btn {
            padding: 14px 20px;
            background: #9CC6DB;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            text-decoration: none;
        }

        .clear-search-btn:hover {
            background: #7bb3d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(156, 198, 219, 0.3);
        }

        .search-results-info {
            margin-top: 15px;
            padding: 12px 20px;
            background: rgba(156, 198, 219, 0.1);
            border-radius: 8px;
            border-left: 4px solid #9CC6DB;
            font-size: 0.95rem;
            color: #555;
        }

        .search-results-info .highlight {
            font-weight: 700;
            color: #CF4B00;
        }

        /* ================= TABLE STYLES ================= */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(207, 75, 0, 0.15);
            border: 2px solid #DDBA7D;
            backdrop-filter: blur(5px);
            overflow-x: auto;
        }

        .records-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .records-table th {
            background: linear-gradient(135deg, #9CC6DB, #DDBA7D);
            color: white;
            font-weight: 600;
            padding: 18px 15px;
            text-align: left;
            border-bottom: 3px solid #CF4B00;
            font-size: 1rem;
        }

        .records-table td {
            padding: 16px 15px;
            border-bottom: 1px solid #e0e0e0;
            color: #444;
            font-size: 0.95rem;
        }

        .records-table tr:nth-child(even) {
            background: rgba(156, 198, 219, 0.05);
        }

        .records-table tr:hover {
            background: rgba(207, 75, 0, 0.05);
            transform: scale(1.002);
            transition: all 0.2s ease;
            box-shadow: 0 3px 10px rgba(207, 75, 0, 0.1);
        }

        .records-table tr:last-child td {
            border-bottom: none;
        }

        .bill-amount {
            font-weight: 600;
            color: #CF4B00;
        }

        .bill-date {
            color: #666;
            font-size: 0.9rem;
        }

        .no-records {
            text-align: center;
            padding: 60px 20px;
            color: #666;
            font-size: 1.1rem;
        }

        .no-records i {
            font-size: 3rem;
            color: #9CC6DB;
            margin-bottom: 20px;
            display: block;
        }

        /* ================= STATS CARDS ================= */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(207, 75, 0, 0.1);
            border: 2px solid #DDBA7D;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(207, 75, 0, 0.15);
        }

        .stat-card i {
            font-size: 2.5rem;
            color: #CF4B00;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #CF4B00;
            margin: 10px 0;
        }

        .stat-label {
            color: #666;
            font-size: 1rem;
            font-weight: 500;
        }

        /* ================= ACTION BUTTONS ================= */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .export-btn {
            background: linear-gradient(135deg, #CF4B00, #DDBA7D);
            color: white;
        }

        .export-btn:hover {
            background: linear-gradient(135deg, #DDBA7D, #CF4B00);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(207, 75, 0, 0.3);
        }

        .add-btn {
            background: #9CC6DB;
            color: white;
        }

        .add-btn:hover {
            background: #7bb3d3;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(156, 198, 219, 0.3);
        }

        /* ================= RESPONSIVE DESIGN ================= */
        @media (max-width: 1200px) {
            .container {
                max-width: 95%;
            }
        }

        @media (max-width: 992px) {
            body {
                padding-top: 140px;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .admin-controls {
                width: 100%;
                justify-content: center;
            }
            
            .search-box {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-label {
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .page-title h2 {
                font-size: 2rem;
            }
            
            .table-container {
                padding: 20px;
            }
            
            .records-table th,
            .records-table td {
                padding: 12px 10px;
                font-size: 0.9rem;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .action-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
            
            .search-input-group {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            body {
                padding-top: 160px;
            }
            
            .page-title h2 {
                font-size: 1.8rem;
            }
            
            .records-table {
                font-size: 0.85rem;
            }
            
            .records-table th,
            .records-table td {
                padding: 10px 8px;
            }
            
            .search-btn,
            .clear-search-btn {
                padding: 12px 15px;
                font-size: 0.9rem;
                justify-content: center;
            }
        }

        /* ================= ANIMATIONS ================= */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-container, .stat-card, .search-container {
            animation: fadeIn 0.6s ease;
        }

        /* ================= PRINT STYLES ================= */
        @media print {
            header, .action-buttons, .stats-container, .logout-btn, .back-btn,
            .search-container {
                display: none;
            }
            
            body {
                padding-top: 0;
                background: white;
            }
            
            .table-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }
            
            .records-table {
                font-size: 12pt;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <div class="logo-company-container">
                    <div class="logo-frame">
                        <img src="final.png" alt="Company Logo">
                    </div>
                    <div class="company-info">
                        <h1>P S Industries</h1>
                        <p style="color: #666; font-size: 0.9rem;">Admin Dashboard</p>
                    </div>
                </div>
                <div class="admin-controls">
                    <a href="dashboard.php" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </header>

        <main class="main-content">
            <div class="page-title">
                <h2><i class="fas fa-file-invoice-dollar"></i> Bill Records</h2>
                <p>View and manage all billing records</p>
            </div>

            <?php if(isset($error)): ?>
                <div style="background: #ffebee; color: #c62828; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid #ffcdd2;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <!-- Search Box -->
            <div class="search-container">
                <form method="GET" action="" class="search-box">
                    <div class="search-label">
                        <i class="fas fa-search"></i> Search by Bill Number
                    </div>
                    <div class="search-input-group">
                        <input type="text" 
                               name="search" 
                               class="search-input" 
                               placeholder="Enter bill number (e.g., BILL001, 2023001)"
                               value="<?php echo htmlspecialchars($search_term); ?>"
                               autofocus>
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <?php if(!empty($search_term)): ?>
                            <a href="bill.php" class="clear-search-btn">
                                <i class="fas fa-times"></i> Clear
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
                
                <?php if(!empty($search_term)): ?>
                    <?php
                    $totalResults = mysqli_num_rows($result);
                    $searchMessage = $totalResults > 0 
                        ? "Found <span class='highlight'>$totalResults</span> bill(s) matching '<span class='highlight'>" . htmlspecialchars($search_term) . "</span>'"
                        : "No bills found matching '<span class='highlight'>" . htmlspecialchars($search_term) . "</span>'";
                    ?>
                    <div class="search-results-info">
                        <i class="fas fa-info-circle"></i> <?php echo $searchMessage; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <?php
                // Calculate total bills and amount
                $totalBills = 0;
                $totalAmount = 0;
                if(isset($result) && mysqli_num_rows($result) > 0) {
                    mysqli_data_seek($result, 0); // Reset pointer
                    while($row = mysqli_fetch_assoc($result)) {
                        $totalBills++;
                        $totalAmount += $row['billAmt'];
                    }
                    mysqli_data_seek($result, 0); // Reset pointer again for table display
                }
                ?>
                <div class="stat-card">
                    <i class="fas fa-file-invoice"></i>
                    <div class="stat-value"><?php echo $totalBills; ?></div>
                    <div class="stat-label">Total Bills</div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-money-bill-wave"></i>
                    <div class="stat-value">₹<?php echo number_format($totalAmount, 2); ?></div>
                    <div class="stat-label">Total Amount</div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar-alt"></i>
                    <div class="stat-value">
                        <?php 
                        if($totalBills > 0) {
                            $avgAmount = $totalAmount / $totalBills;
                            echo '₹' . number_format($avgAmount, 2);
                        } else {
                            echo '₹0.00';
                        }
                        ?>
                    </div>
                    <div class="stat-label">Average Bill Amount</div>
                </div>
            </div>

            <!-- Records Table -->
            <div class="table-container">
                <div class="action-buttons">
                    <a href="#" onclick="window.print()" class="action-btn export-btn">
                        <i class="fas fa-print"></i> Print Records
                    </a>
                    <a href="addBill.php" class="action-btn add-btn">
                        <i class="fas fa-plus-circle"></i> Add New Bill
                    </a>
                </div>

                <?php if(isset($result) && mysqli_num_rows($result) > 0): ?>
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>Bill No.</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Bill Date</th>
                                <th>Bill Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td>
                                        <strong>
                                            <?php 
                                            $billNo = htmlspecialchars($row['billNo']);
                                            if(!empty($search_term)) {
                                                // Highlight the search term in bill number
                                                $highlighted = preg_replace(
                                                    "/(" . preg_quote($search_term, '/') . ")/i",
                                                    "<mark style='background:#FFEB3B;padding:2px 4px;border-radius:2px;'>$1</mark>",
                                                    $billNo
                                                );
                                                echo "#" . $highlighted;
                                            } else {
                                                echo "#" . $billNo;
                                            }
                                            ?>
                                        </strong>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['custName']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Address']); ?></td>
                                    <td class="bill-date">
                                        <?php 
                                        $date = date('d M Y', strtotime($row['billDate']));
                                        echo $date;
                                        ?>
                                    </td>
                                    <td class="bill-amount">₹<?php echo number_format($row['billAmt'], 2); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="no-records">
                        <i class="fas fa-file-alt"></i>
                        <h3>No Bill Records Found</h3>
                        <p>
                            <?php if(!empty($search_term)): ?>
                                No bills found matching your search criteria.
                            <?php else: ?>
                                There are no billing records in the database.
                            <?php endif; ?>
                        </p>
                        <a href="add_bill.php" class="action-btn add-btn" style="margin-top: 20px;">
                            <i class="fas fa-plus-circle"></i> Add Your First Bill
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Add row hover effect enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.records-table tr');
            rows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.002)';
                    this.style.transition = 'all 0.2s ease';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Auto-focus search input on page load if it has value
            const searchInput = document.querySelector('input[name="search"]');
            if(searchInput && searchInput.value) {
                searchInput.focus();
                searchInput.select();
            }

            // Keyboard shortcut for search (Ctrl+F)
            document.addEventListener('keydown', function(e) {
                if((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    if(searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
            });
        });
    </script>
</body>
</html>