<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Laravel - Installation Guide (Nginx)</title>
  <style>
    :root{
      --bg:#0f1724; --card:#0b1220; --muted:#9aa6b2; --accent:#e3342f; --glass: rgba(255,255,255,0.03);
      --mono-bg:#0b1220; --code-bg:#071021;
      --maxw:980px;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    body{ background: linear-gradient(180deg,#071028 0%, #071226 60%); color:#e6eef3; margin:0; padding:40px 18px; display:flex; justify-content:center; }
    .wrap{ max-width:var(--maxw); width:100%; }
    .hero{ background:linear-gradient(90deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border-radius:12px; padding:26px; display:flex; gap:20px; align-items:center; box-shadow: 0 6px 24px rgba(2,6,23,0.6); }
    .logo{ text-align:center; flex:0 0 420px; }
    .logo img{ max-width:100%; height:auto; display:block; margin:0 auto; }
    .badges{ text-align:center; margin-top:12px; }
    .badges img{ height:24px; margin:0 6px; vertical-align:middle; }
    h1{ margin:18px 0 6px; font-size:20px; color:#fff; }
    p.lead{ color:var(--muted); margin:0 0 18px; }
    .card{ background:var(--card); border-radius:10px; padding:18px; margin-top:18px; box-shadow: 0 4px 18px rgba(2,6,23,0.6); }
    h2{ color:#fff; margin:14px 0; font-size:16px; display:flex; align-items:center; gap:10px; }
    ul.features{ color:var(--muted); margin:0 0 12px 18px; }
    .cmd, pre{ background:var(--code-bg); color:#dbeafe; padding:14px; border-radius:8px; overflow:auto; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, "Roboto Mono", "Courier New", monospace; font-size:13px; line-height:1.5; margin:8px 0; }
    table{ width:100%; border-collapse:collapse; margin-top:12px; }
    th, td{ text-align:left; padding:10px 8px; border-bottom:1px solid rgba(255,255,255,0.04); color:var(--muted); }
    .note{ color:var(--muted); font-size:13px; margin-top:8px; }
    footer{ color:var(--muted); font-size:13px; margin-top:22px; text-align:center; }
    a { color:#9fe7ff; text-decoration:none; }
    .section-split{ height:1px; background:linear-gradient(90deg, transparent, rgba(255,255,255,0.03), transparent); margin:18px 0; border-radius:4px; }
    @media (max-width:860px){
      .hero{ flex-direction:column; padding:18px; }
      .logo{ flex:unset; width:100%;}
    }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="hero">
      <div class="logo">
        <a href="https://laravel.com" target="_blank" rel="noopener">
          <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" alt="Laravel Logo" width="400">
        </a>
        <div class="badges">
          <a href="https://github.com/laravel/framework/actions" target="_blank" rel="noopener">
            <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
          </a>
          <a href="https://packagist.org/packages/laravel/framework" target="_blank" rel="noopener">
            <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
          </a>
          <a href="https://packagist.org/packages/laravel/framework" target="_blank" rel="noopener">
            <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
          </a>
          <a href="https://packagist.org/packages/laravel/framework" target="_blank" rel="noopener">
            <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
          </a>
        </div>
      </div>

      <div style="flex:1">
        <h1>🚀 Instalasi Laravel di Server Nginx (Ubuntu)</h1>
        <p class="lead">Panduan lengkap untuk meng-install Laravel pada server Nginx, mulai dari instalasi paket, konfigurasi Nginx & PHP-FPM, hingga aplikasi Laravel dapat diakses melalui domain atau IP.</p>

        <div class="card">
          <h2>📌 Persyaratan Sistem</h2>
          <ul class="features">
            <li>Ubuntu 20.04 / 22.04 LTS</li>
            <li>Akses <code>root</code> / <code>sudo</code></li>
            <li>Nginx</li>
            <li>PHP 8.1+</li>
            <li>Composer</li>
            <li>MySQL / MariaDB (opsional)</li>
          </ul>

          <div class="section-split"></div>

          <h2>🧩 1. Update Sistem</h2>
          <pre class="cmd">sudo apt update && sudo apt upgrade -y</pre>

          <h2>🧩 2. Install Nginx</h2>
          <pre class="cmd">sudo apt install nginx -y
# cek status
systemctl status nginx</pre>

          <h2>🧩 3. Install PHP & Extensions</h2>
          <pre class="cmd">sudo apt install php php-fpm php-mbstring php-xml php-zip php-curl php-mysql php-gd php-cli php-common php-bcmath php-json -y
# cek versi
php -v</pre>

          <h2>🧩 4. Install Composer</h2>
          <pre class="cmd">sudo apt install composer -y
# atau manual
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer</pre>

          <h2>🧩 5. Clone Project Laravel</h2>
          <pre class="cmd">cd /var/www
sudo git clone https://github.com/username/nama-project.git
cd nama-project</pre>

          <h2>🧩 6. Install Dependency Laravel</h2>
          <pre class="cmd">composer install
cp .env.example .env
php artisan key:generate</pre>

          <h2>🧩 7. Permission Folder</h2>
          <pre class="cmd">sudo chown -R $USER:www-data /var/www/nama-project
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache</pre>

          <h2>🧩 8. Setup Database (Opsional)</h2>
          <pre class="cmd"># di MySQL
mysql -u root -p

CREATE DATABASE laravel_db;
CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON laravel_db.* TO 'laravel'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# edit file .env
DB_DATABASE=laravel_db
DB_USERNAME=laravel
DB_PASSWORD=password

# jalankan migrasi
php artisan migrate</pre>

          <h2>🧩 9. Konfigurasi Nginx</h2>
          <p class="note">Buat file server block baru di <code>/etc/nginx/sites-available/nama-project</code> lalu aktifkan.</p>
          <pre class="cmd">sudo nano /etc/nginx/sites-available/nama-project</pre>
          <pre class="cmd"><code>server {
    listen 80;
    server_name your-domain.com www.your-domain.com;
    root /var/www/nama-project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}</code></pre>

          <pre class="cmd">sudo ln -s /etc/nginx/sites-available/nama-project /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx</pre>

          <h2>🧩 10. Jalankan Queue (Opsional)</h2>
          <pre class="cmd">php artisan queue:work
# atau gunakan supervisor untuk production
sudo apt install supervisor -y</pre>

          <h2>🟢 11. Akses Aplikasi</h2>
          <pre class="cmd">http://your-domain.com
# atau
http://SERVER_IP</pre>

          <h2>🟡 Troubleshooting Umum</h2>
          <table>
            <thead>
              <tr><th>Masalah</th><th>Penyebab</th><th>Solusi</th></tr>
            </thead>
            <tbody>
              <tr><td>500 Error</td><td>Permission salah</td><td>Perbaiki permission folder <code>storage</code> & <code>bootstrap/cache</code></td></tr>
              <tr><td>404</td><td>Konfigurasi Nginx / try_files</td><td>Pastikan <code>try_files $uri $uri/ /index.php?$query_string;</code></td></tr>
              <tr><td>Blank page</td><td>Error internal</td><td>Cek <code>storage/logs/laravel.log</code></td></tr>
              <tr><td>PHP-FPM error</td><td>Sock / versi PHP salah</td><td>Periksa <code>fastcgi_pass unix:/run/php/php8.1-fpm.sock;</code></td></tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>

    <div class="card" style="margin-top:18px;">
      <h2>About Laravel</h2>
      <p style="color:var(--muted)">
        Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
      </p>
      <ul class="features">
        <li><a href="https://laravel.com/docs/routing" target="_blank" rel="noopener">Simple, fast routing engine</a></li>
        <li><a href="https://laravel.com/docs/container" target="_blank" rel="noopener">Powerful dependency injection container</a></li>
        <li>Multiple back-ends for <a href="https://laravel.com/docs/session" target="_blank" rel="noopener">session</a> and <a href="https://laravel.com/docs/cache" target="_blank" rel="noopener">cache</a> storage</li>
        <li><a href="https://laravel.com/docs/eloquent" target="_blank" rel="noopener">Expressive, intuitive database ORM</a></li>
        <li><a href="https://laravel.com/docs/migrations" target="_blank" rel="noopener">Database agnostic schema migrations</a></li>
        <li><a href="https://laravel.com/docs/queues" target="_blank" rel="noopener">Robust background job processing</a></li>
        <li><a href="https://laravel.com/docs/broadcasting" target="_blank" rel="noopener">Real-time event broadcasting</a></li>
      </ul>

      <h2>Learning Laravel</h2>
      <p class="note">Laravel has the most extensive and thorough <a href="https://laravel.com/docs" target="_blank" rel="noopener">documentation</a> and video tutorial library. Try <a href="https://bootcamp.laravel.com" target="_blank" rel="noopener">Laravel Bootcamp</a> or <a href="https://laracasts.com" target="_blank" rel="noopener">Laracasts</a>.</p>

      <h2>Laravel Sponsors</h2>
      <p class="note">We would like to thank Laravel sponsors. See Laravel Partners: <a href="https://partners.laravel.com" target="_blank" rel="noopener">partners.laravel.com</a></p>

      <h2>Contributing</h2>
      <p class="note">Contribution guide: <a href="https://laravel.com/docs/contributions" target="_blank" rel="noopener">https://laravel.com/docs/contributions</a></p>

      <h2>Code of Conduct</h2>
      <p class="note">Please review and follow the Code of Conduct: <a href="https://laravel.com/docs/contributions#code-of-conduct" target="_blank" rel="noopener">Laravel Code of Conduct</a></p>

      <h2>Security Vulnerabilities</h2>
      <p class="note">If you discover a security vulnerability within Laravel, contact Taylor Otwell: <a href="mailto:taylor@laravel.com">taylor@laravel.com</a>.</p>

      <h2>License</h2>
      <p class="note">The Laravel framework is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT" target="_blank" rel="noopener">MIT license</a>.</p>
    </div>

    <footer>
      Generated README • If you want the file saved and downloaded as <code>README.html</code>, say "simpan" and I'll create the file for you.
    </footer>
  </div>
</body>
</html>
