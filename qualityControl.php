<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P S Industries</title>
    <style>
/* ================= RESET & BASE STYLES ================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
    /* Hide scrollbar for all browsers */
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE and Edge */
}

/* Hide scrollbar for Chrome, Safari and Opera */
html::-webkit-scrollbar {
    display: none;
}

body {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    color: #333;
    line-height: 1.6;
    overflow-x: hidden;
    padding-top: 90px;
    /* Hide scrollbar */
    -ms-overflow-style: none;
    scrollbar-width: none;
    /* Background Photo */
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
    max-width: 1200px;
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
    background: rgba(255, 255, 255, 0.98); /* White with transparency */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 2px solid #DDBA7D; /* Gold border */
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

/* Shrink effects when the header is scrolled */
header.scrolled .header-top {
    margin-bottom: 5px;
}

header.scrolled .header-spacer {
    width: 15px;
}

header.scrolled .logo-company-container {
    padding: 5px 15px;
    gap: 15px;
}

header.scrolled .logo-frame img {
    width: 40px;
    height: 40px;
}

header.scrolled .company-info h1 {
    font-size: 1.5rem;
    margin-bottom: 0px;
}

header.scrolled .company-info h1::after {
    opacity: 0;
}

header.scrolled .tagline {
    font-size: 0;
    opacity: 0;
    padding: 0;
    border: none;
    height: 0;
}

header.scrolled nav {
    padding-top: 5px;
}

header.scrolled .nav-links {
    padding: 5px 10px;
}

.header-top {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 30px;
    margin-bottom: 10px;
    transition: all 0.4s ease;
}

.header-spacer {
    width: 100vw;
    transition: width 0.4s ease;
}

.logo-container, .company-info {
    flex-shrink: 0;
    transition: all 0.4s ease;
}

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
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 1;
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
    z-index: 100;
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

.nav-links li {
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
    top: calc(100% + 10px);
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
    border: 2px solid #DDBA7D; /* Gold border */
    z-index: 1000;
}

.dropdown:hover .dropdown-content {
    opacity: 1;
    visibility: visible;
    top: calc(100% + 5px);
}

.dropdown-content a {
    padding: 12px 18px;
    margin: 5px 0;
    border-radius: 8px;
    color: #333;
    font-weight: 500;
    background: rgba(255, 255, 255, 0.8);
    border-left: 4px solid #9CC6DB; /* Blue accent */
    transition: all 0.2s ease;
}

.dropdown-content a:hover {
    background: #CF4B00; /* Orange */
    color: white;
    transform: translateX(5px);
    border-left-color: #CF4B00;
}
/* ================= DROPDOWN MENUS ================= */
.dropdown {
    position: relative;
}

.dropdown-content {
    position: absolute;
    top: 100%; /* Start directly below the parent */
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

/* Create a gap that connects the dropdown to its parent */
.dropdown-content::before {
    content: '';
    position: absolute;
    top: -10px;
    left: 0;
    width: 100%;
    height: 10px;
    background: transparent;
}

/* Show dropdown when hovering over parent OR dropdown itself */
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

/* ================= MAIN CONTENT ================= */
.content {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 40px;
    margin: 50px 0 70px;
    padding: 40px;
    background: rgba(255, 255, 255, 0.92);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(207, 75, 0, 0.15);
    border: 2px solid #DDBA7D;
    backdrop-filter: blur(5px);
    position: relative;
    overflow: hidden;
}

.content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D);
}

.main-content h2 {
    font-size: 2.4rem;
    margin-bottom: 25px;
    color: #CF4B00; /* Orange */
    font-weight: 700;
    position: relative;
    padding-bottom: 15px;
}

.main-content h2:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D);
    border-radius: 2px;
}

.main-content p {
    font-size: 1.1rem;
    color: #444;
    margin-bottom: 25px;
    line-height: 1.8;
    padding-left: 20px;
    border-left: 3px solid #9CC6DB;
}

.sidebar {
    background: linear-gradient(135deg, rgba(156, 198, 219, 0.15), rgba(221, 186, 125, 0.15));
    padding: 30px;
    border-radius: 15px;
    border: 2px solid #DDBA7D;
    backdrop-filter: blur(5px);
}

.sidebar h2 {
    font-size: 1.6rem;
    margin-bottom: 25px;
    color: #CF4B00;
    font-weight: 700;
    text-align: center;
    padding-bottom: 15px;
    border-bottom: 2px solid #9CC6DB;
}

.sidebar p {
    padding: 14px 0;
    margin: 8px 0;
    font-size: 1.05rem;
    color: #333;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 35px;
}

.sidebar p:before {
    content: "▸";
    position: absolute;
    left: 10px;
    color: #CF4B00;
    font-weight: bold;
    font-size: 1.2rem;
}

.sidebar p:hover {
    background: rgba(207, 75, 0, 0.1);
    padding-left: 40px;
    border-radius: 8px;
    color: #CF4B00;
    transform: translateX(5px);
}

/* ================= CARD DESIGN FOR STORIES SECTION ================= */
.story {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin: 70px 0;
}

.story-section {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(207, 75, 0, 0.15);
    border: 2px solid #DDBA7D;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
    backdrop-filter: blur(5px);
}

.story-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(156, 198, 219, 0.05), rgba(221, 186, 125, 0.05));
    z-index: 0;
}

.story-section:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 50px rgba(207, 75, 0, 0.25);
    border-color: #CF4B00;
}

/* Image container with overlay */
.image-container {
    position: relative;
    overflow: hidden;
    height: 250px;
    z-index: 1;
}

.story-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.story-section:hover .story-image {
    transform: scale(1.1);
}

/* Overlay on image */
.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(207, 75, 0, 0.85), transparent);
    color: white;
    padding: 20px;
    transform: translateY(100%);
    transition: transform 0.4s ease;
}

.story-section:hover .image-overlay {
    transform: translateY(0);
}

/* Card content */
.story-content {
    padding: 30px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 1;
}

.story-content h3 {
    font-size: 1.6rem;
    margin-bottom: 15px;
    color: #CF4B00;
    font-weight: 700;
    position: relative;
    padding-bottom: 15px;
}

.story-content h3:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: #9CC6DB;
    border-radius: 2px;
}

.story-text {
    font-size: 1rem;
    color: #666;
    line-height: 1.7;
    margin-bottom: 20px;
    flex-grow: 1;
}

/* Read More Button */
.read-more {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 25px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    margin-top: auto;
    position: relative;
    z-index: 1;
}

.read-more:hover {
    background: linear-gradient(135deg, #DDBA7D, #CF4B00);
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(207, 75, 0, 0.3);
    border-color: #9CC6DB;
}

.read-more i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(5px);
}

/* Card badges */
.card-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 2;
    box-shadow: 0 4px 10px rgba(207, 75, 0, 0.3);
}

/* ================= CONTACT INFO ================= */
.contact-info {
    background: linear-gradient(135deg, rgba(156, 198, 219, 0.9), rgba(221, 186, 125, 0.9));
    color: #333;
    padding: 60px 40px;
    border-radius: 20px;
    margin: 70px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
    border: 3px solid #CF4B00;
    box-shadow: 0 15px 40px rgba(207, 75, 0, 0.2);
    backdrop-filter: blur(5px);
}

.contact-info::before {
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

.contact-info:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, #CF4B00, #DDBA7D, #9CC6DB);
    z-index: 1;
}

.inner-div {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.92);
    padding: 40px;
    border-radius: 15px;
    border: 2px solid #DDBA7D;
    backdrop-filter: blur(5px);
}

.contact-info h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #CF4B00;
    font-weight: 700;
}

.contact-info h4 {
    font-size: 1.2rem;
    font-weight: 500;
    color: #444;
    max-width: 700px;
    margin: 20px auto 0;
    line-height: 1.7;
    padding: 15px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    border: 2px solid #9CC6DB;
}

/* ================= FOOTER ================= */
/* ================= COMPACT FOOTER ================= */
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
    display: inline-block;
    padding: 6px 15px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    margin-left: 1250px;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.instagram-icon-btn:hover {
    background: linear-gradient(135deg, #DDBA7D, #CF4B00);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(207, 75, 0, 0.25);
    border-color: #9CC6DB;
}

/* Contact info inside footer (if you want it there) */
.footer-contact {
    background: rgba(207, 75, 0, 0.1);
    padding: 12px 20px;
    border-radius: 8px;
    margin: 15px 0;
    text-align: center;
    border: 1px solid rgba(207, 75, 0, 0.3);
}

.footer-contact h4 {
    font-size: 1rem;
    margin: 0;
    color: #DDBA7D;
}

/* Responsive adjustments for compact footer */
@media (max-width: 768px) {
    footer {
        padding: 25px 20px 15px;
        margin-top: 40px;
    }
    
    .footer-links {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .instagram-corner {
        position: relative;
        left: 0;
        bottom: 0;
        margin-bottom: 15px;
        text-align: center;
    }
    
    .footer-bottom {
        text-align: center;
        padding-top: 15px;
    }
    
    .footer-bottom p {
        margin-top: 10px;
    }
}

@media (max-width: 480px) {
    .footer-links {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    footer {
        padding: 20px 15px 15px;
    }
}

/* ================= BUTTON STYLES ================= */
.btn-primary {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #CF4B00, #DDBA7D);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(207, 75, 0, 0.2);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(207, 75, 0, 0.3);
    background: linear-gradient(135deg, #DDBA7D, #CF4B00);
}

/* ================= RESPONSIVE DESIGN ================= */
@media (max-width: 1200px) {
    .story {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }
}

@media (max-width: 992px) {
    .content {
        grid-template-columns: 1fr;
        gap: 35px;
    }
    
    .logo-company-container {
        padding: 10px 15px;
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
    
    .header-top {
        flex-direction: column;
        gap: 20px;
        padding: 0 20px;
    }
    
    .logo-company-container {
        flex-direction: column;
        text-align: center;
        gap: 15px;
        width: 100%;
    }
    
    .company-info h1 {
        font-size: 1.8rem;
    }
    
    nav {
        padding: 15px 20px 0;
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
    
    .content {
        padding: 30px 20px;
        margin: 40px 0;
    }
    
    .main-content h2 {
        font-size: 2rem;
    }
    
    .story {
        grid-template-columns: 1fr;
        gap: 25px;
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
    
    .dropdown-content {
        position: static;
        transform: none;
        width: 100%;
        margin-top: 10px;
        opacity: 1;
        visibility: visible;
        box-shadow: none;
        background: rgba(255, 255, 255, 0.95);
    }
    
    .instagram-corner {
        position: static;
        margin-top: 25px;
        text-align: center;
    }
    
    .story {
        margin: 50px 0;
        gap: 25px;
    }
    
    .contact-info {
        padding: 40px 20px;
        margin: 50px 0;
    }
    
    .inner-div {
        padding: 30px 20px;
    }
    
    .contact-info h2 {
        font-size: 1.7rem;
    }
    
    .footer-links {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .story-content {
        padding: 20px;
    }
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

@keyframes cardHover {
    0% {
        transform: translateY(0) scale(1);
    }
    100% {
        transform: translateY(-15px) scale(1.02);
    }
}

.story-section {
    animation: fadeInUp 0.6s ease forwards;
}

.logo-frame:hover img {
    animation: float 2s ease-in-out infinite;
}

.story-section:hover {
    animation: cardHover 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

/* Staggered animation for cards */
.story-section:nth-child(1) {
    animation-delay: 0.1s;
}

.story-section:nth-child(2) {
    animation-delay: 0.2s;
}

.story-section:nth-child(3) {
    animation-delay: 0.3s;
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
                <a href="adminLogIn.php" class="admin-login-btn">🔐 Admin</a>
            </nav>
        </header>
        
        <div class="content">
            <div class="main-content">
                <h2>Welcome to P S Industries</h2>
                <p>With over three decades of excellence in engineering and manufacturing, P S Industries has established itself as a trusted partner for precision components and industrial solutions.</p>
                <p>Our commitment to quality, innovation, and customer satisfaction has made us a preferred choice for industries across the globe.</p>
                <p>We specialize in custom manufacturing solutions, leveraging state-of-the-art technology and a skilled workforce to deliver products that exceed expectations.</p>
            </div>
            
            <div class="sidebar">
                <h2>Our Expertise</h2>
                <p>• Precision Machining</p>
                <p>• Industrial Components</p>
                <p>• Custom Fabrication</p>
                <p>• Quality Assurance</p>
                <p>• Technical Consulting</p>
            </div>
        </div>

        <div class="story">
        
</div>

        <div class="contact-info">
            <div class="inner-div">
                <h2>Contact us: 9909783819 or email abcd@gmail.com</h2>
                <h4>Without our clients, our work would have no meaning</h4>
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
                <a href="global.html" class="support-link">
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
<script>
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    if (window.scrollY > 20) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 90,
                behavior: 'smooth'
            });
        }
    });
});
</script>
</html>