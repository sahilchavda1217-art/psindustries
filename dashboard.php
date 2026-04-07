<?php
include('db.php');

$sql = "SELECT DATE_FORMAT(billDate, '%Y-%m') as month,
            SUM(billAmt) as monthly_revenue
        FROM billtb 
        GROUP BY DATE_FORMAT(billDate, '%Y-%m')
        ORDER BY month";

$sql1 = "SELECT SUM(billAmt) as totalRevenue from billtb";
$res1 = mysqli_query($conn, $sql1);

$res = mysqli_query($conn, $sql);

$maxRevenue = 0;
$data = [];

while($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
    if ($row['monthly_revenue'] > $maxRevenue) {
        $maxRevenue = $row['monthly_revenue'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Growth - P S Industries</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <style>
        /* ================= RESET & BASE STYLES ================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

html::-webkit-scrollbar {
    display: none;
}

body {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    color: #333;
    line-height: 1.6;
    overflow-x: hidden;
    padding-top: 90px;
    -ms-overflow-style: none;
    scrollbar-width: none;
    background: linear-gradient(rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.92)),
                url('factory-bg.jpg') center/cover fixed no-repeat;
    min-height: 100vh;
    position: relative;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('TFO.jpg');
    background-size: cover;
    opacity: 0.15;
    z-index: -1;
    pointer-events: none;
}

body::-webkit-scrollbar {
    display: none;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    margin-top: 150px;
    z-index: 1;
}

/* ================= ELEGANT FIXED HEADER ================= */
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 2px solid #DDBA7D;
    box-shadow: 0 4px 20px rgba(207, 75, 0, 0.15);
    padding: 15px 0;
    transition: all 0.3s ease;
}

header.scrolled {
    padding: 5px 0;
    background: rgba(255, 255, 255, 0.95);
    border-bottom-color: #CF4B00;
    box-shadow: 0 6px 25px rgba(207, 75, 0, 0.2);
}

header.scrolled .header-top { margin-bottom: 5px; }
header.scrolled .header-spacer { width: 15px; }
header.scrolled .logo-company-container { padding: 5px 15px; gap: 15px; }
header.scrolled .logo-frame img { width: 40px; height: 40px; }
header.scrolled .company-info h1 { font-size: 1.5rem; margin-bottom: 0px; }
header.scrolled .company-info h1::after { opacity: 0; }
header.scrolled .tagline { font-size: 0; opacity: 0; padding: 0; border: none; height: 0; }
header.scrolled nav { padding-top: 5px; }
header.scrolled .nav-links { padding: 5px 10px; }

.header-top {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 30px;
    margin-bottom: 10px;
    transition: all 0.4s ease;
}

.header-spacer { width: 100vw; transition: width 0.4s ease; }
.logo-container, .company-info { flex-shrink: 0; transition: all 0.4s ease; }

/* Logo and Company Name Container */
.logo-company-container {
    display: flex;
    align-items: center;
    gap: 25px;
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    border: 2px solid #DDBA7D;
    box-shadow: 0 4px 15px rgba(207, 75, 0, 0.1);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.logo-company-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(156, 198, 219, 0.1), transparent);
    z-index: 0;
}

.logo-frame {
    background: white;
    border-radius: 12px;
    padding: 8px;
    box-shadow: 0 4px 15px rgba(207, 75, 0, 0.15);
    border: 2px solid #CF4B00;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
}

.logo-frame img {
    border-radius: 8px;
    display: block;
    width: 60px;
    height: 60px;
    object-fit: cover;
    transition: all 0.3s ease;
}

.company-info {
    text-align: center;
    transition: all 0.3s ease;
}

.company-info h1 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #CF4B00;
    margin-bottom: 5px;
    letter-spacing: -0.5px;
    text-shadow: 1px 1px 3px rgba(207, 75, 0, 0.2);
    position: relative;
    transition: all 0.3s ease;
}

.company-info h1::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #CF4B00, transparent);
    transition: all 0.3s ease;
}

.tagline {
    color: #666;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding-left: 5px;
    border-left: 3px solid #9CC6DB;
    transition: all 0.3s ease;
    overflow: hidden;
}

/* ================= NAVIGATION ================= */
nav {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 30px 0;
    position: relative;
    z-index: 1100;
    transition: all 0.3s ease;
}

.nav-links {
    flex: 1;
    display: flex;
    justify-content: center;
    list-style: none;
    gap: 8px;
    background: rgba(255, 255, 255, 0.95);
    padding: 10px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(207, 75, 0, 0.2);
    position: relative;
    overflow: visible;
    z-index: 1100;
    transition: all 0.3s ease;
}

.nav-links::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
}

.nav-links li { position: relative; }

.dropdown { position: relative; }

.nav-links a {
    text-decoration: none;
    color: #CF4B00;
    font-weight: 600;
    padding: 12px 25px;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    display: block;
    background: transparent;
    border: 2px solid transparent;
    position: relative;
    z-index: 1;
}

.nav-links a:hover {
    background: #CF4B00;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(207, 75, 0, 0.3);
    border-color: #CF4B00;
}

.nav-links a.active {
    background: #CF4B00;
    color: white;
    border-color: #CF4B00;
    box-shadow: 0 3px 10px rgba(207, 75, 0, 0.3);
}

.admin-login-btn {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    background: #CF4B00;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.9rem;
    border: 2px solid #CF4B00;
    transition: all 0.3s ease;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(207, 75, 0, 0.25);
    position: relative;
    z-index: 2;
}

.admin-login-btn:hover {
    background: white;
    color: #CF4B00;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(207, 75, 0, 0.35);
}

header.scrolled .admin-login-btn {
    padding: 6px 14px;
    font-size: 0.82rem;
}

/* ================= DROPDOWN MENUS ================= */
.dropdown-content {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    min-width: 220px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(207, 75, 0, 0.25);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    padding: 15px;
    border: 2px solid #DDBA7D;
    z-index: 1200;
    pointer-events: none;
}

.dropdown:hover .dropdown-content,
.dropdown-content:hover {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    top: calc(100% + 5px);
}

.dropdown-content a {
    padding: 12px 18px;
    margin: 5px 0;
    border-radius: 8px;
    color: #333;
    font-weight: 500;
    background: rgba(255, 255, 255, 0.8);
    border-left: 4px solid #9CC6DB;
    transition: all 0.2s ease;
    text-align: left;
    display: block;
}

.dropdown-content a:hover {
    background: #CF4B00;
    color: white;
    transform: translateX(5px);
    border-left-color: #CF4B00;
}

/* ================= CHART CONTAINER ================= */
.chart-container {
    background: rgba(255, 255, 255, 0.92);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(207, 75, 0, 0.15);
    border: 2px solid #DDBA7D;
    backdrop-filter: blur(5px);
    position: relative;
    overflow: hidden;
    margin: 40px 0;
    margin-top: 150px;
}

.chart-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(156, 198, 219, 0.05), rgba(221, 186, 125, 0.05));
    z-index: 0;
}

.chart-header {
    position: relative;
    z-index: 1;
    margin-bottom: 40px;
}

.chart-title {
    font-size: 2rem;
    color: #CF4B00;
    margin-bottom: 10px;
    text-align: left;
    font-weight: 700;
    position: relative;
    padding-bottom: 15px;
}

.chart-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D);
    border-radius: 2px;
}

.chart-subtitle {
    color: #666;
    font-size: 1.1rem;
    font-weight: 500;
    position: relative;
}

.chart-content {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 40px;
    position: relative;
    z-index: 1;
}

.bars-container {
    background: rgba(255, 255, 255, 0.8);
    padding: 30px;
    border-radius: 15px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 5px 20px rgba(207, 75, 0, 0.1);
}

.bar {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
    padding: 15px 20px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    border: 1px solid #DDBA7D;
    transition: all 0.3s ease;
}

.bar:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(207, 75, 0, 0.15);
    border-color: #CF4B00;
}

.month {
    min-width: 100px;
    font-weight: 600;
    color: #CF4B00;
    font-size: 0.9rem;
}

.bar-track {
    flex: 1;
    height: 20px;
    background: linear-gradient(135deg, #9CC6DB, rgba(156, 198, 219, 0.3));
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
}

.bar-value {
    height: 100%;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D);
    border-radius: 10px;
    transition: width 1s ease-out;
    position: relative;
    overflow: hidden;
}

.bar-value::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.4), 
        transparent);
    animation: shimmer 2s infinite;
}

.amount {
    min-width: 120px;
    text-align: right;
    font-weight: 700;
    color: #2e7d32;
    font-size: 1.1rem;
    font-family: 'Monaco', 'Consolas', monospace;
}

/* ================= STATS SIDEBAR ================= */
.stats-sidebar {
    background: linear-gradient(135deg, rgba(156, 198, 219, 0.9), rgba(221, 186, 125, 0.9));
    padding: 30px;
    border-radius: 15px;
    border: 3px solid #CF4B00;
    box-shadow: 0 10px 30px rgba(207, 75, 0, 0.2);
    position: relative;
    overflow: hidden;
}

.stats-sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('factory-bg.jpg') center/cover;
    opacity: 0.1;
    z-index: 0;
}

.stats-title {
    font-size: 1.3rem;
    color: #CF4B00;
    margin-bottom: 25px;
    font-weight: 700;
    position: relative;
    z-index: 1;
    padding-bottom: 10px;
}

.stats-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: white;
    border-radius: 1.5px;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    margin-bottom: 10px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    border: 1px solid #DDBA7D;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.stat-item:hover {
    transform: translateX(5px);
    border-color: #CF4B00;
    box-shadow: 0 5px 15px rgba(207, 75, 0, 0.15);
}

.stat-label {
    color: #666;
    font-weight: 600;
    font-size: 0.9rem;
}

.stat-value {
    color: #CF4B00;
    font-weight: 700;
    font-size: 1.1rem;
    font-family: 'Monaco', 'Consolas', monospace;
}

.total-revenue {
    margin-top: 30px;
    padding: 20px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    border-radius: 12px;
    text-align: center;
    position: relative;
    z-index: 1;
    box-shadow: 0 8px 25px rgba(207, 75, 0, 0.3);
}

.total-revenue .amount {
    font-size: 2rem;
    font-weight: 800;
    color: white;
    margin: 10px 0;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    font-family: 'Monaco', 'Consolas', monospace;
}

.growth-indicator {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
    margin-top: 10px;
    backdrop-filter: blur(5px);
}

.growth-indicator svg {
    width: 16px;
    height: 16px;
}

/* ================= NAVIGATION BUTTONS ================= */
.navigation {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 40px 0;
    position: relative;
    z-index: 1;
}

.nav-btn {
    padding: 15px 30px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(207, 75, 0, 0.2);
    border: 2px solid transparent;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.nav-btn:hover {
    background: linear-gradient(135deg, #DDBA7D, #CF4B00);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(207, 75, 0, 0.3);
    border-color: #9CC6DB;
}

.nav-btn.secondary {
    background: white;
    color: #CF4B00;
    border: 2px solid #CF4B00;
}

.nav-btn.secondary:hover {
    background: #CF4B00;
    color: white;
}

/* ================= FOOTER ================= */
footer {
    background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
    color: white;
    padding: 30px 25px 15px;
    margin-top: 50px;
    border-top: 3px solid #CF4B00;
    position: relative;
    overflow: hidden;
}

footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('factory-bg.jpg') center/cover;
    opacity: 0.05;
    z-index: 0;
}

footer:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D, #9CC6DB);
    z-index: 1;
}

.footer-links {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    margin-bottom: 25px;
    position: relative;
    z-index: 1;
}

.footer-column h4 {
    font-size: 1.1rem;
    margin-bottom: 18px;
    color: #DDBA7D;
    font-weight: 600;
    position: relative;
    padding-bottom: 8px;
}

.footer-column h4:after {
    content: '';
    display: block;
    width: 35px;
    height: 2px;
    background: #CF4B00;
    margin-top: 6px;
    border-radius: 1px;
}

.footer-column a, .footer-column p {
    color: #aaa;
    text-decoration: none;
    margin-bottom: 10px;
    display: block;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    padding: 5px 10px;
    border-radius: 4px;
}

.footer-column a:hover {
    color: white;
    background: rgba(207, 75, 0, 0.2);
    transform: translateX(5px);
    border-left: 2px solid #9CC6DB;
}

.support-link {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    padding: 8px 12px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 6px;
    font-size: 0.9rem;
}

.support-link svg {
    margin-right: 8px;
    color: #DDBA7D;
}

.footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid rgba(221, 186, 125, 0.2);
    position: relative;
    font-size: 0.85rem;
    color: #999;
    z-index: 1;
}

.instagram-corner {
    position: absolute;
    left: 25px;
    bottom: 15px;
    z-index: 1;
}

.instagram-icon-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 15px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.instagram-icon-btn:hover {
    background: linear-gradient(135deg, #DDBA7D, #CF4B00);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(207, 75, 0, 0.25);
    border-color: #9CC6DB;
}

.instagram-icon-simple {
    width: 14px;
    height: 14px;
}

/* ================= ANIMATIONS ================= */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

@keyframes shimmer {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

.bar {
    animation: fadeInUp 0.6s ease forwards;
}

.bar:nth-child(1) { animation-delay: 0.1s; }
.bar:nth-child(2) { animation-delay: 0.2s; }
.bar:nth-child(3) { animation-delay: 0.3s; }
.bar:nth-child(4) { animation-delay: 0.4s; }
.bar:nth-child(5) { animation-delay: 0.5s; }
.bar:nth-child(6) { animation-delay: 0.6s; }

.stat-item:nth-child(1) { animation-delay: 0.1s; }
.stat-item:nth-child(2) { animation-delay: 0.2s; }
.stat-item:nth-child(3) { animation-delay: 0.3s; }

.total-revenue {
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: 0.7s;
}

.logo-frame:hover img {
    animation: float 2s ease-in-out infinite;
}

/* Subtle background animation */
@keyframes subtleBg {
    0%, 100% {
        background-position: center center;
    }
    50% {
        background-position: calc(50% + 5px) calc(50% + 5px);
    }
}

body {
    animation: subtleBg 30s ease-in-out infinite;
}

/* ================= RESPONSIVE DESIGN ================= */
@media (max-width: 1200px) {
    .container {
        max-width: 95%;
    }
}

@media (max-width: 1024px) {
    .chart-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .stats-sidebar {
        order: -1;
    }
}

@media (max-width: 992px) {
    .header-top {
        flex-direction: column;
        gap: 20px;
    }
    
    .company-info h1 {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    body {
        padding-top: 130px;
        background-attachment: scroll;
    }
    
    .container {
        margin-top: 120px;
        padding: 0 15px;
    }
    
    .logo-frame img {
        width: 140px;
        height: 140px;
    }
    
    .nav-links {
        flex-wrap: wrap;
        gap: 10px;
        padding: 12px;
    }
    
    .nav-links a {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .chart-container {
        padding: 30px 20px;
    }
    
    .chart-title {
        font-size: 1.7rem;
    }
    
    .chart-content {
        gap: 20px;
    }
    
    .bar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .month {
        min-width: auto;
    }
    
    .bar-track {
        width: 100%;
    }
    
    .amount {
        text-align: left;
        min-width: auto;
    }
    
    .navigation {
        flex-direction: column;
        align-items: center;
    }
    
    .nav-btn {
        width: 100%;
        max-width: 300px;
    }
    
    .footer-links {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .instagram-corner {
        position: relative;
        left: 0;
        bottom: 0;
        margin-bottom: 15px;
        text-align: center;
    }
}

@media (max-width: 576px) {
    body {
        padding-top: 150px;
    }
    
    .nav-links {
        flex-direction: column;
        align-items: stretch;
    }
    
    .nav-links a {
        text-align: center;
        padding: 14px;
    }
    
    .chart-title {
        font-size: 1.5rem;
    }
    
    .footer-links {
        grid-template-columns: 1fr;
    }
    
    .footer-bottom {
        text-align: center;
    }
    
    .instagram-corner {
        position: static;
        margin-top: 25px;
        text-align: center;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-top">
                <div class="logo-container">
                    <div class="logo-frame">
                        <img src="final.png" alt="Company Logo" height="185px" width="185px">
                    </div>
                </div>
                <div class="header-spacer"></div>
                <div class="company-info">
                    <h1>P S Industries</h1>
                    <p class="tagline">Precision Engineering &amp; Manufacturing</p>
                </div>
            </div>
            
            <nav>
                <ul class="nav-links">
                    <li><a href="home.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Overview</a>
                        <div class="dropdown-content">
                            <a href="history.php">Company History</a>
                            <a href="#">Our Mission</a>
                            <a href="#">Leadership Team</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#">Product Range</a>
                            <div class="dropdown-content">
                                <a href="#">Double Density DTY Machine</a>
                                <a href="#">Two-for-One Machine</a>
                                <a href="#">Jari Machine</a>
                            </div>
                    </li>
                    <li><a href="qualityControl.php">Quality Control</a></li>
                    <li><a href="global.html">Our Presence</a></li>
                </ul>
                <a href="adminLogIn.php" class="admin-login-btn">🔐 Admin</a>
            </nav>
        </header>
        <div class="chart-container">
            <div class="chart-header">
                <h1 class="chart-title">Revenue Growth Analysis</h1>
                <p class="chart-subtitle">FY: 2025-26 - Monthly Revenue Performance</p>
            </div>
            
            <div class="chart-content">
                <div class="bars-container">
                    <?php foreach($data as $row): ?>
                        <div class="bar">
                            <div class="month"><?php echo date('M Y', strtotime($row['month'] . '-01')); ?></div>
                            <div class="bar-track">
                                <div class="bar-value" style="width: <?php echo ($row['monthly_revenue'] / $maxRevenue) * 100; ?>%"></div>
                            </div>
                            <div class="amount">₹<?php echo number_format($row['monthly_revenue'], 2); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="stats-sidebar">
                    <h3 class="stats-title">Performance Summary</h3>
                    
                    <div class="stat-item">
                        <span class="stat-label">Total Months</span>
                        <span class="stat-value"><?php echo count($data); ?></span>
                    </div>
                    
                    <div class="stat-item">
                        <span class="stat-label">Peak Revenue</span>
                        <span class="stat-value">₹<?php echo number_format($maxRevenue, 2); ?></span>
                    </div>
                    
                    <div class="stat-item">
                        <span class="stat-label">Average Monthly</span>
                        <span class="stat-value">
                            ₹<?php echo count($data) > 0 ? number_format(array_sum(array_column($data, 'monthly_revenue')) / count($data), 2) : '0.00'; ?>
                        </span>
                    </div>
                    
                    <div class="total-revenue">
                        <div class="stat-label" style="color: rgba(255,255,255,0.9);">Total Revenue</div>
                        <div class="amount">
                            <?php 
                                if (mysqli_num_rows($res1) > 0) {
                                    $row = mysqli_fetch_assoc($res1);
                                    $revenue = $row['totalRevenue'];
                                    
                                    if ($revenue === NULL) {
                                        echo "₹0.00";
                                    } else {
                                        echo "₹" . number_format($revenue, 2);
                                    }
                                } else {
                                    echo "₹0.00";
                                }
                            ?>
                        </div>
                        <div class="growth-indicator">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16     6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                            </svg>
                            Revenue Growth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="navigation">
            <a href="home.php" class="nav-btn">Back to Home</a>
        </div>
        
    </div>
    <footer>
        <div class="footer-links">
            <div class="footer-column">
                <h4>Quick Links</h4>
                <a href="home.php">Home</a>
                <a href="history.php">Company History</a>
                <a href="#">Product Range</a>
                <a href="#">Quality Control</a>
            </div>
            
            <div class="footer-column">
                <h4>Support</h4>
                <a href="clientSupport.php" class="support-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                    Client Support
                </a>
                <a href="technical-support.php" class="support-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                        <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h11c.55 0 1-.45 1-1z"/>
                    </svg>
                    Technical Support
                </a>
                <a href="bill.php" class="support-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                        <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h11c.55 0 1-.45 1-1z"/>
                    </svg>
                    Records
                </a>
            </div>
            
            <div class="footer-column">
                <h4>Contact Info</h4>
                <p>📧 info@psindustries.com</p>
                <p>📞 +1 (555) 123-4567</p>
                <p>📍 123 Industrial Park, Manufacturing City</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2023 P S Industries. All Rights Reserved.</p>
            
            <!-- Instagram Icon in Bottom Left Corner -->
            <div class="instagram-corner">
                <a href="https://www.instagram.com/psindustries2026/" target="_blank" class="instagram-icon-btn">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a5.995 5.995 0 1 0 0 12 5.995 5.995 0 0 0 0-12zm0 9.899a3.904 3.904 0 1 1 0-7.807 3.904 3.904 0 0 1 0 7.807zm5.046-7.206a1.4 1.4 0 1 0 0 2.8 1.4 1.4 0 0 0 0-2.8z" fill="currentColor"/>
</svg> Follow our journey
                </a>
            </div>
        </div>
    </footer>
    <script>
        const header = document.querySelector('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>