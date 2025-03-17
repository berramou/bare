<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bare PHP Framework</title>
  <style>
    /* Base styles */
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap');

    :root {
      --primary-color: #3b82f6;
      --primary-dark: #1e3a8a;
      --text-color: #1f2937;
      --text-light: #6b7280;
      --bg-light: #f9fafb;
      --border-light: #e5e7eb;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
      color: var(--text-color);
      line-height: 1.5;
    }

    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1rem;
    }

    /* Header */
    header {
      border-bottom: 1px solid var(--border-light);
      padding: 1rem 0;
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 600;
      font-size: 1.25rem;
    }

    .logo-icon {
      width: 1.5rem;
      height: 1.5rem;
      background-color: var(--primary-color);
      border-radius: 0.375rem;
    }

    nav {
      display: none;
    }

    .cta-buttons {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .github-icon {
      color: var(--text-light);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      cursor: pointer;
      transition: all 0.2s;
    }

    .btn-outline {
      border: 1px solid var(--border-light);
      background: transparent;
    }

    .btn-outline:hover {
      background-color: var(--bg-light);
    }

    .btn-primary {
      background-color: var(--primary-color);
      color: white;
      border: none;
    }

    .btn-primary:hover {
      background-color: #2563eb;
    }

    /* Hero Section */
    .hero {
      padding: 5rem 0;
      text-align: center;
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      background: linear-gradient(to right, var(--primary-dark), var(--primary-color));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .hero p {
      font-size: 1.25rem;
      color: var(--text-light);
      max-width: 42rem;
      margin: 0 auto 2.5rem;
    }

    .hero-buttons {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      justify-content: center;
      margin-bottom: 4rem;
    }

    .code-block {
      background-color: var(--bg-light);
      border: 1px solid var(--border-light);
      border-radius: 0.5rem;
      padding: 1.5rem;
      font-family: 'Roboto Mono', monospace;
      font-size: 0.875rem;
      text-align: left;
      max-width: 32rem;
      margin: 0 auto;
      overflow-x: auto;
    }

    /* Features Section */
    .features {
      padding: 5rem 0;
      background-color: var(--bg-light);
    }

    .features h2 {
      font-size: 2rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 4rem;
      background: linear-gradient(to right, var(--primary-dark), var(--primary-color));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .features-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2rem;
    }

    .feature-card {
      background-color: white;
      padding: 1.5rem;
      border-radius: 0.5rem;
      border: 1px solid var(--border-light);
      transition: all 0.2s;
    }

    .feature-card:hover {
      border-color: rgba(59, 130, 246, 0.3);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
      color: var(--primary-color);
      margin-bottom: 1rem;
    }

    .feature-card h3 {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .feature-card p {
      color: var(--text-light);
    }

    /* Get Started Section */
    .get-started {
      padding: 5rem 0;
    }

    .get-started h2 {
      font-size: 2rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 1.5rem;
      background: linear-gradient(to right, var(--primary-dark), var(--primary-color));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .get-started-desc {
      font-size: 1.25rem;
      color: var(--text-light);
      text-align: center;
      max-width: 42rem;
      margin: 0 auto 3rem;
    }

    .tabs {
      max-width: 42rem;
      margin: 0 auto;
    }

    .tab-list {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.5rem;
      margin-bottom: 2rem;
      background-color: var(--bg-light);
      padding: 0.25rem;
      border-radius: 0.5rem;
    }

    .tab-trigger {
      padding: 0.75rem;
      text-align: center;
      font-size: 0.875rem;
      font-weight: 500;
      border-radius: 0.375rem;
      cursor: pointer;
    }

    .tab-trigger.active {
      background-color: white;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    .get-started-buttons {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-top: 3rem;
    }

    /* Footer */
    footer {
      background-color: var(--bg-light);
      border-top: 1px solid var(--border-light);
      padding: 3rem 0;
    }

    .footer-top {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 2rem;
    }

    .footer-logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .footer-logo-icon {
      width: 1.25rem;
      height: 1.25rem;
      background-color: var(--primary-color);
      border-radius: 0.375rem;
    }

    .social-links {
      display: flex;
      gap: 1.5rem;
    }

    .social-icon {
      color: var(--text-light);
      transition: color 0.2s;
    }

    .social-icon:hover {
      color: var(--primary-color);
    }

    .footer-bottom {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      text-align: center;
      padding-top: 2rem;
      border-top: 1px solid var(--border-light);
    }

    .copyright {
      font-size: 0.875rem;
      color: var(--text-light);
    }

    .footer-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      font-size: 0.875rem;
      color: var(--text-light);
    }

    .footer-link {
      transition: color 0.2s;
    }

    .footer-link:hover {
      color: var(--primary-color);
    }

    .made-with-love {
      display: flex;
      align-items: center;
      font-size: 0.875rem;
      color: var(--text-light);
    }

    .heart-icon {
      color: #ef4444;
      margin: 0 0.25rem;
    }

    /* Responsive Styles */
    @media (min-width: 768px) {
      nav {
        display: flex;
        gap: 2rem;
      }

      .nav-link {
        font-size: 0.875rem;
        color: var(--text-light);
        transition: color 0.2s;
      }

      .nav-link:hover {
        color: var(--primary-color);
      }

      .hero-buttons {
        flex-direction: row;
      }

      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .footer-top {
        flex-direction: row;
      }

      .footer-logo {
        margin-bottom: 0;
      }

      .footer-bottom {
        flex-direction: row;
        justify-content: space-between;
      }
    }

    @media (min-width: 1024px) {
      .features-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }
  </style>
</head>
<body>
<!-- Header -->
<header>
  <div class="container">
    <div class="header-content">
      <div class="logo">
        <div class="logo-icon"></div>
        <span>Bare</span>
      </div>

      <nav>
        <a href="#features" class="nav-link">Features</a>
        <a href="#get-started" class="nav-link">Documentation</a>
        <a href="#" class="nav-link">Community</a>
      </nav>

      <div class="cta-buttons">
        <a href="#" class="github-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
            <path d="M9 18c-4.51 2-5-2-7-2"></path>
          </svg>
        </a>
        <button class="btn btn-outline">Download</button>
        <button class="btn btn-primary">Get Started</button>
      </div>
    </div>
  </div>
</header>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1>Bare PHP Framework</h1>
    <p>A lightweight and minimalistic PHP framework for building elegant web applications</p>

    <div class="hero-buttons">
      <button class="btn btn-primary">
        Get Started
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 0.5rem;">
          <path d="M5 12h14"></path>
          <path d="m12 5 7 7-7 7"></path>
        </svg>
      </button>
      <button class="btn btn-outline">View on GitHub</button>
    </div>

    <div class="code-block">
                <pre>
// Simple Bare application
$app = new \Bare\App();

$app->get('/', function() {
    return 'Hello World!';
});

$app->run();
                </pre>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="features" id="features">
  <div class="container">
    <h2>Why Choose Bare?</h2>

    <div class="features-grid">
      <!-- Feature 1 -->
      <div class="feature-card">
        <div class="feature-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
          </svg>
        </div>
        <h3>Lightweight</h3>
        <p>No bloat, just the essentials for high performance applications</p>
      </div>

      <!-- Feature 2 -->
      <div class="feature-card">
        <div class="feature-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          </svg>
        </div>
        <h3>Secure</h3>
        <p>Built with security in mind to protect your applications</p>
      </div>

      <!-- Feature 3 -->
      <div class="feature-card">
        <div class="feature-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6"></polyline>
            <polyline points="8 6 2 12 8 18"></polyline>
          </svg>
        </div>
        <h3>Simple API</h3>
        <p>Intuitive and easy-to-learn API that gets out of your way</p>
      </div>

      <!-- Feature 4 -->
      <div class="feature-card">
        <div class="feature-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
          </svg>
        </div>
        <h3>Zero Dependencies</h3>
        <p>Standalone framework with no external requirements</p>
      </div>

      <!-- Feature 5 -->
      <div class="feature-card">
        <div class="feature-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="3" y1="9" x2="21" y2="9"></line>
            <line x1="9" y1="21" x2="9" y2="9"></line>
          </svg>
        </div>
        <h3>Flexible Views</h3>
        <p>Use any template engine or go template-free</p>
      </div>

      <!-- Feature 6 -->
      <div class="feature-card">
        <div class="feature-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19.439 7.85c-.049.322.059.648.289.878l1.568 1.568c.47.47.706 1.087.706 1.704s-.235 1.233-.706 1.704l-1.611 1.611a.98.98 0 0 1-.837.276c-.47-.07-.802-.48-.743-.95l.067-.551c.073-.595-.11-1.2-.55-1.64l-1.325-1.325c-.47-.47-1.1-.67-1.71-.55l-.54.09c-.448.072-.846-.224-.89-.672l-.044-.452a1.193 1.193 0 0 1 .325-.937l2.12-2.123c.261-.261.628-.389.989-.357.489.045.848.37.891.86l.8.503zM3 9h6m-6 5h5"></path>
          </svg>
        </div>
        <h3>Extendable</h3>
        <p>Add only what you need with simple extension points</p>
      </div>
    </div>
  </div>
</section>

<!-- Get Started Section -->
<section class="get-started" id="get-started">
  <div class="container">
    <h2>Get Started in Seconds</h2>
    <p class="get-started-desc">Bare's installation is as minimal as its footprint</p>

    <div class="tabs">
      <div class="tab-list">
        <div class="tab-trigger active" onclick="showTab('composer')">Using Composer</div>
        <div class="tab-trigger" onclick="showTab('manual')">Manual Download</div>
      </div>

      <div id="composer" class="tab-content active">
        <div class="code-block">
          <pre>composer require bare/framework</pre>
        </div>
        <p style="margin: 1rem 0; color: var(--text-light);">
          After installation, create your index.php file to bootstrap your application:
        </p>
        <div class="code-block">
                        <pre>
// Example index.php
require 'vendor/autoload.php';

$app = new \Bare\App();

// Define your routes
$app->get('/hello/{name}', function($name) {
    return "Hello, {$name}!";
});

$app->run();</pre>
        </div>
      </div>

      <div id="manual" class="tab-content">
        <p style="margin-bottom: 1rem; color: var(--text-light);">
          Download the latest release from GitHub and extract it into your project:
        </p>
        <div style="text-align: center; margin: 1rem 0;">
          <button class="btn btn-primary">Download Latest Release</button>
        </div>
        <p style="margin: 1rem 0; color: var(--text-light);">
          Include the autoloader in your index.php:
        </p>
        <div class="code-block">
                        <pre>
// Example index.php
require 'path/to/bare/autoload.php';

$app = new \Bare\App();
// Your application code...
$app->run();</pre>
        </div>
      </div>
    </div>

    <div class="get-started-buttons">
      <button class="btn btn-outline">Read Docs</button>
      <button class="btn btn-primary">View Examples</button>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="footer-top">
      <div class="footer-logo">
        <div class="footer-logo-icon"></div>
        <span>Bare</span>
      </div>

      <div class="social-links">
        <a href="#" class="social-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
            <path d="M9 18c-4.51 2-5-2-7-2"></path>
          </svg>
        </a>
        <a href="#" class="social-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
          </svg>
        </a>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="copyright">
        &copy; <script>document.write(new Date().getFullYear())</script> Bare PHP Framework. All rights reserved.
      </div>

      <div class="footer-links">
        <a href="#" class="footer-link">Documentation</a>
        <a href="#" class="footer-link">Contribute</a>
        <a href="#" class="footer-link">License</a>
        <div class="made-with-love">
          Made with
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#ef4444" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="heart-icon">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
          </svg>
          by the community
        </div>
      </div>
    </div>
  </div>
</footer>

<script>
  // Simple tab functionality
  function showTab(tabId) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
      tab.classList.remove('active');
    });

    // Deactivate all triggers
    document.querySelectorAll('.tab-trigger').forEach(trigger => {
      trigger.classList.remove('active');
    });

    // Show the selected tab content
    document.getElementById(tabId).classList.add('active');

    // Activate the clicked trigger
    document.querySelector(`.tab-trigger[onclick="showTab('${tabId}')"]`).classList.add('active');
  }
</script>
</body>
</html>