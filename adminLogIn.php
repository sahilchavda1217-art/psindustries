
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
}

.company-info h1 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #CF4B00;
    margin-bottom: 5px;
    letter-spacing: -0.5px;
    text-shadow: 1px 1px 3px rgba(207, 75, 0, 0.2);
    position: relative;
}

.company-info h1::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #CF4B00, transparent);
}

.tagline {
    color: #666;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding-left: 5px;
    border-left: 3px solid #9CC6DB;
}

/* ================= NAVIGATION ================= */
nav {
    padding: 15px 30px 0;
    position: relative;
    z-index: 1100;
    transition: all 0.3s ease;
}

.nav-links {
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
    z-index: -1; /* IMPORTANT: This should be behind */
}

.nav-links li {
    position: relative;
}

.dropdown {
    position: relative;
}

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

/* ================= FIXED DROPDOWN MENUS ================= */
.dropdown-content {
    position: absolute;
    top: calc(100% + 10px); /* Position below the nav item */
    left: 0;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    min-width: 220px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(207, 75, 0, 0.25);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    padding: 15px;
    border: 2px solid #DDBA7D;
    z-index: 2000; /* Higher z-index */
    transform: translateY(-10px);
}

/* Show dropdown on hover */
.dropdown:hover .dropdown-content {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
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
    text-decoration: none;
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
nav {
    padding: 15px 30px 0;
    transition: all 0.3s ease;
}

.nav-links {
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
    z-index: -1;
}

.nav-links li { position: relative; }

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
/* ================= LOGIN FORM STYLES ================= */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
    padding: 40px 20px;
    margin: 100px 0 50px;
}

.login-form {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 50px 40px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 15px 40px rgba(207, 75, 0, 0.2);
    border: 3px solid #DDBA7D;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.login-form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(156, 198, 219, 0.1), rgba(221, 186, 125, 0.1));
    z-index: -1;
}

.login-form::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D);
}

/* Decorative elements */
.login-form .decoration {
    position: absolute;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(207, 75, 0, 0.1), rgba(221, 186, 125, 0.1));
    z-index: -1;
}

.login-form .decoration:nth-child(1) {
    top: -40px;
    right: -40px;
}

.login-form .decoration:nth-child(2) {
    bottom: -30px;
    left: -30px;
    width: 80px;
    height: 80px;
}

.login-form h2 {
    text-align: center;
    color: #CF4B00;
    font-size: 1.8rem;
    margin-bottom: 35px;
    font-weight: 700;
    position: relative;
    padding-bottom: 15px;
}

.login-form h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D);
    border-radius: 1.5px;
}

.login-form h2 i {
    margin-right: 10px;
    color: #9CC6DB;
}

/* Form elements */
.form-group {
    margin-bottom: 25px;
    position: relative;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #666;
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 8px;
    padding-left: 5px;
}

.form-group label i {
    color: #CF4B00;
    width: 16px;
    text-align: center;
}

.form-group input {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid #DDBA7D;
    border-radius: 12px;
    font-size: 1rem;
    font-family: 'Segoe UI', system-ui, sans-serif;
    background: rgba(255, 255, 255, 0.9);
    transition: all 0.3s ease;
    color: #333;
    outline: none;
}

.form-group input:focus {
    border-color: #CF4B00;
    box-shadow: 0 0 0 3px rgba(207, 75, 0, 0.15);
    background: white;
}

.form-group input::placeholder {
    color: #999;
    font-weight: 400;
}

/* Password visibility toggle */
.password-container {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    padding: 5px;
    transition: color 0.3s ease;
}

.toggle-password:hover {
    color: #CF4B00;
}

/* Login button */
.login-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.login-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #DDBA7D, #CF4B00);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.login-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(207, 75, 0, 0.3);
}

.login-btn:hover::before {
    opacity: 1;
}

.login-btn:active {
    transform: translateY(-1px);
}

.login-btn i {
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.login-btn:hover i {
    transform: translateX(5px);
}

/* Form status messages */
.success, .error {
    padding: 15px 20px;
    border-radius: 10px;
    margin: 20px 0;
    font-size: 0.95rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.success {
    background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(76, 175, 80, 0.05));
    color: #2e7d32;
    border: 2px solid #4CAF50;
}

.error {
    background: linear-gradient(135deg, rgba(244, 67, 54, 0.1), rgba(244, 67, 54, 0.05));
    color: #d32f2f;
    border: 2px solid #F44336;
}

.success i, .error i {
    font-size: 1.2rem;
}

/* Form footer */
.form-footer {
    text-align: center;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid rgba(221, 186, 125, 0.3);
    color: #666;
    font-size: 0.9rem;
}

.form-footer a {
    color: #CF4B00;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    padding: 5px 10px;
    border-radius: 6px;
}

.form-footer a:hover {
    background: rgba(207, 75, 0, 0.1);
    color: #9CC6DB;
}

/* Loading animation */
.login-btn.loading {
    cursor: not-allowed;
    opacity: 0.8;
}

.login-btn.loading #btnText {
    display: none;
}

.login-btn.loading #btnIcon {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive design */
@media (max-width: 768px) {
    .login-container {
        margin: 80px 0 30px;
        min-height: 70vh;
        padding: 30px 15px;
    }
    
    .login-form {
        padding: 40px 30px;
        max-width: 400px;
    }
    
    .login-form h2 {
        font-size: 1.6rem;
    }
    
    .form-group input {
        padding: 12px 16px;
    }
    
    .login-btn {
        padding: 14px;
    }
}

@media (max-width: 480px) {
    .login-form {
        padding: 35px 25px;
        border-width: 2px;
    }
    
    .login-form h2 {
        font-size: 1.4rem;
        margin-bottom: 25px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        font-size: 0.9rem;
    }
    
    .form-group input {
        font-size: 0.95rem;
        padding: 12px 14px;
    }
    
    .login-btn {
        font-size: 1rem;
        padding: 13px;
    }
    
    .success, .error {
        padding: 12px 16px;
        font-size: 0.9rem;
    }
}

/* Additional decorative elements */
.login-form .wave {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="%23CF4B00" opacity="0.1"/></svg>');
    background-size: 1200px 100%;
    z-index: -1;
    animation: wave 12s linear infinite;
}

@keyframes wave {
    0% {
        background-position-x: 0;
    }
    100% {
        background-position-x: 1200px;
    }
}

/* Form validation styles */
.form-group input:invalid:not(:focus):not(:placeholder-shown) {
    border-color: #F44336;
    background: linear-gradient(135deg, rgba(244, 67, 54, 0.05), white);
}

.form-group input:valid:not(:focus):not(:placeholder-shown) {
    border-color: #4CAF50;
}

.validation-message {
    position: absolute;
    bottom: -20px;
    left: 0;
    font-size: 0.8rem;
    color: #F44336;
    padding: 3px 10px;
    background: white;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: none;
}

.form-group input:invalid:not(:focus):not(:placeholder-shown) + .validation-message {
    display: block;
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
                    <p class="tagline">Precision Engineering & Manufacturing</p>
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
            </nav>
        </header>
        
        <div class="login-container">
    <div class="login-form">
        <div class="decoration"></div>
        <div class="decoration"></div>
        <h2><i class="fas fa-lock"></i> Admin Login</h2>
        <form action="" method="post" id="loginForm">
            <div class="form-group">
                <label for="adminID"><i class="fas fa-user"></i> Admin ID</label>
                <input type="text" name="adminID" id="adminID" placeholder="Enter your admin ID" required>
                <div class="validation-message">Please enter a valid Admin ID</div>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-key"></i> Password</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <button type="button" class="toggle-password" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="validation-message">Password is required</div>
            </div>
            <button type="submit" name="login" class="login-btn" id="loginBtn">
                <span id="btnText">Log In</span>
                <i class="fas fa-sign-in-alt" id="btnIcon"></i>
            </button>
        </form>
        
        <?php
        include('db.php');
        if(isset($_POST["login"])) {
            $id = $_POST["adminID"];
            $pass = $_POST["password"];

            $q1 = "SELECT * FROM admintb WHERE adminID = '$id' AND Password = '$pass'";
            $res = mysqli_query($conn, $q1);

            if(mysqli_num_rows($res) > 0)
                {
                    echo "<div class='success'><i class='fas fa-check-circle'></i> Login successful! Redirecting to dashboard...</div>";
                    echo "<script>
                    setTimeout(function() {
                        window.location.href = 'dashboard.php';
                    }, 1500);
                    </script>";
                }
                else{
                    echo "<div class='error'><i class='fas fa-exclamation-triangle'></i> Invalid credentials. Please try again.</div>";
                }
        }
        ?>
        <div class="wave"></div>
    </div>
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
</body>
</html>