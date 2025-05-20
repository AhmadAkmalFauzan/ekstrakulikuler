<?php
require_once "koneksi.php";

// Ambil filter dari URL jika ada
$tanggal = $_GET['tanggal'] ?? '';
$kelas   = $_GET['kelas'] ?? '';
$ekskul  = $_GET['ekskul'] ?? '';
$nama    = $_GET['nama'] ?? '';
$page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit   = 10; // Jumlah data per halaman
$offset  = ($page - 1) * $limit;

// Koneksi database
$koneksi = koneksi();

// Query utama dengan pagination
$sql = "
    SELECT p.*, u.nisn, u.nama, u.kelas, e.nama_ekskul
    FROM presensi_ekskul p
    JOIN user u ON p.id_user = u.id_user
    JOIN list_ekskul e ON p.id_ekskul = e.id_ekskul
    WHERE 1=1
";

$countSql = "
    SELECT COUNT(*) as total
    FROM presensi_ekskul p
    JOIN user u ON p.id_user = u.id_user
    JOIN list_ekskul e ON p.id_ekskul = e.id_ekskul
    WHERE 1=1
";

$params = [];
$types  = '';

// Tambahkan filter ke query
if ($tanggal) {
    $sql .= " AND p.tanggal = ?";
    $countSql .= " AND p.tanggal = ?";
    $params[] = $tanggal;
    $types .= 's';
}
if ($kelas) {
    $sql .= " AND u.kelas = ?";
    $countSql .= " AND u.kelas = ?";
    $params[] = $kelas;
    $types .= 's';
}
if ($ekskul) {
    $sql .= " AND e.nama_ekskul = ?";
    $countSql .= " AND e.nama_ekskul = ?";
    $params[] = $ekskul;
    $types .= 's';
}
if ($nama) {
    $sql .= " AND u.nama LIKE ?";
    $countSql .= " AND u.nama LIKE ?";
    $params[] = "%$nama%";
    $types .= 's';
}

// Tambahkan sorting dan pagination
$sql .= " ORDER BY p.tanggal DESC LIMIT ? OFFSET ?";
$limitParams = [$limit, $offset];
$limitTypes = 'ii';

// Eksekusi query untuk menghitung total data
$countStmt = $koneksi->prepare($countSql);
if ($params) {
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$totalResult = $countStmt->get_result()->fetch_assoc();
$total = $totalResult['total'];
$totalPages = ceil($total / $limit);

// Eksekusi query utama dengan pagination
$stmt = $koneksi->prepare($sql);
if ($params) {
    $allParams = array_merge($params, $limitParams);
    $allTypes = $types . $limitTypes;
    $stmt->bind_param($allTypes, ...$allParams);
} else {
    $stmt->bind_param($limitTypes, ...$limitParams);
}
$stmt->execute();
$result = $stmt->get_result();

// Daftar kelas (hardcoded) 
$kelasList = ['X ULW', 'X RPL 1', 'X RPL 2', 'X KUL 1', 'X KUL 2', 'X KUL 3', 'X PH 1', 'X PH 2', 'X PH 3', 'X BSN 1', 'X BSN 2', 'X BSN 3', 'XI ULW', 'XI RPL 1', 'XI RPL 2', 'XI KUL 1', 'XI KUL 2', 'XI KUL 3', 'XI PH 1', 'XI PH 2', 'XI PH 3', 'XI BSN 1', 'XI BSN 2', 'XI BSN 3'];

// Daftar ekskul (hardcoded)
$ekskulList = ['Voli', 'RohKris', 'Pencak Silat', 'Paskibra', 'Basket', 'Tari Tradisional', 'Ratoh Jaroe', 'Modern Dance', 'Pramuka', 'PMR', 'PIK-R', 'RohIs', 'Futsal'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Absensi Ekstrakurikuler</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #4338ca;
      --primary-light: #6366f1;
      --primary-dark: #3730a3;
      --secondary-color: #f9fafb;
      --text-color: #1f2937;
      --text-light: #6b7280;
      --border-color: #e5e7eb;
      --success-color: #10b981;
      --warning-color: #f59e0b;
      --error-color: #ef4444;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', 'Roboto', sans-serif;
      background-color: var(--secondary-color);
      color: var(--text-color);
      line-height: 1.6;
      padding: 2rem;
    }

    .container {
      max-width: 1280px;
      margin: 0 auto;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    h2 {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--primary-dark);
    }

    .card {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }

    .filter-box {
      padding: 1.5rem;
      margin-bottom: 2rem;
      border-top: 4px solid var(--primary-color);
    }

    .filter-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .filter-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--primary-dark);
    }

    .filter-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
    }

    .form-group {
      margin-bottom: 0.8rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      font-size: 0.9rem;
      color: var(--text-light);
    }

    input, select {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 1rem;
      color: var(--text-color);
      transition: all 0.2s ease;
    }

    input:focus, select:focus {
      outline: none;
      border-color: var(--primary-light);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .btn-group {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
      justify-content: flex-end;
    }

    button {
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-primary {
      background-color: var(--primary-color);
      color: white;
    }

    .btn-primary:hover {
      background-color: var(--primary-dark);
    }

    .btn-secondary {
      background-color: #f3f4f6;
      color: var(--text-color);
    }

    .btn-secondary:hover {
      background-color: #e5e7eb;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }

    th, td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid var(--border-color);
    }

    th {
      background-color: var(--primary-color);
      color: white;
      font-weight: 600;
      position: sticky;
      top: 0;
    }

    tr:hover {
      background-color: #f8fafc;
    }

    .status-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 500;
    }

    .image-container {
      width: 70px;
      height: 70px;
      overflow: hidden;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .text-muted {
      color: var(--text-light);
      font-style: italic;
    }

    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 2rem;
      gap: 0.5rem;
    }

    .pagination a, .pagination span {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.5rem 0.75rem;
      border-radius: 6px;
      font-size: 0.9rem;
      text-decoration: none;
      color: var(--text-color);
      min-width: 2.5rem;
      transition: all 0.2s ease;
    }

    .pagination a {
      background-color: white;
      border: 1px solid var(--border-color);
    }

    .pagination a:hover {
      background-color: #f3f4f6;
    }

    .pagination .active {
      background-color: var(--primary-color);
      color: white;
      border: 1px solid var(--primary-color);
    }

    .search-container {
      position: relative;
      display: flex;
      align-items: center;
    }

    .search-container input {
      padding-right: 2.5rem;
      width: 100%;
    }

    .btn-clear {
      position: absolute;
      right: 0.5rem;
      background: none;
      border: none;
      color: var(--text-light);
      font-size: 1.2rem;
      cursor: pointer;
      padding: 0.4rem;
      border-radius: 50%;
    }

    .btn-clear:hover {
      background-color: rgba(0, 0, 0, 0.05);
      color: var(--error-color);
    }

    @media (max-width: 768px) {
      body {
        padding: 1rem;
      }

      .filter-grid {
        grid-template-columns: 1fr;
      }

      th, td {
        padding: 0.8rem 0.5rem;
        font-size: 0.85rem;
      }

      .btn-group {
        flex-direction: column;
      }

      button {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2><i class="fas fa-clipboard-check"></i> Dashboard Absensi Ekstrakurikuler</h2>
    </div>

    <div class="card filter-box">
      <div class="filter-header">
        <div class="filter-title"><i class="fas fa-filter"></i> Filter Data</div>
      </div>
      
      <form method="GET" id="filterForm">
        <div class="filter-grid">
          <div class="form-group">
            <label for="tanggal"><i class="fas fa-calendar"></i> Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="<?= htmlspecialchars($tanggal) ?>" onchange="this.form.submit()">
          </div>
          <div class="form-group">
            <label for="kelas"><i class="fas fa-users"></i> Kelas</label>
            <select name="kelas" id="kelas" onchange="this.form.submit()">
              <option value="">Semua Kelas</option>
              <?php foreach ($kelasList as $k): ?>
                <option value="<?= htmlspecialchars($k) ?>" <?= $kelas === $k ? 'selected' : '' ?>><?= htmlspecialchars($k) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="ekskul"><i class="fas fa-award"></i> Ekstrakurikuler</label>
            <select name="ekskul" id="ekskul" onchange="this.form.submit()">
              <option value="">Semua Ekskul</option>
              <?php foreach ($ekskulList as $e): ?>
                <option value="<?= htmlspecialchars($e) ?>" <?= $ekskul === $e ? 'selected' : '' ?>><?= htmlspecialchars($e) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama"><i class="fas fa-search"></i> Cari Nama</label>
            <div class="search-container">
              <input type="text" name="nama" id="nama" placeholder="Masukkan nama siswa" value="<?= htmlspecialchars($nama) ?>" autocomplete="off">
              <button type="button" class="btn-clear" id="clearNameBtn" <?= empty($nama) ? 'style="display:none"' : '' ?>>×</button>
            </div>
          </div>
        </div>

        <div class="btn-group">
          <button type="button" class="btn-secondary" id="resetBtn">
            <i class="fas fa-eraser"></i> Apus Filter
          </button>
        </div>
      </form>
    </div>

    <div class="card">
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>NISN</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Ekstrakurikuler</th>
              <th>Tanggal</th>
              <th>Deskripsi</th>
              <th>Foto</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result->num_rows > 0): ?>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['nisn']) ?></td>
                  <td><?= htmlspecialchars($row['nama']) ?></td>
                  <td><?= htmlspecialchars($row['kelas']) ?></td>
                  <td><?= htmlspecialchars($row['nama_ekskul']) ?></td>
                  <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                  <td><?= htmlspecialchars($row['deskripsi'] ?: '-') ?></td>
                  <td>
                    <div class="image-container">
                      <?php if ($row['foto']): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($row['foto']) ?>" alt="Foto <?= htmlspecialchars($row['nama']) ?>">
                      <?php else: ?>
                        <span class="text-muted">Tidak ada foto</span>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-muted" style="text-align: center; padding: 2rem;">
                  <i class="fas fa-info-circle"></i> Tidak ada data ditemukan.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <?php if ($totalPages > 1): ?>
        <div class="pagination">
          <?php
          $queryParams = $_GET;
          
          // Previous page link
          if ($page > 1) {
            $queryParams['page'] = $page - 1;
            $prevLink = '?' . http_build_query($queryParams);
            echo "<a href='$prevLink'><i class='fas fa-chevron-left'></i></a>";
          } else {
            echo "<span class='disabled'><i class='fas fa-chevron-left'></i></span>";
          }
          
          // Page numbers
          $startPage = max(1, $page - 2);
          $endPage = min($totalPages, $page + 2);
          
          if ($startPage > 1) {
            $queryParams['page'] = 1;
            $firstLink = '?' . http_build_query($queryParams);
            echo "<a href='$firstLink'>1</a>";
            if ($startPage > 2) {
              echo "<span class='disabled'>...</span>";
            }
          }
          
          for ($i = $startPage; $i <= $endPage; $i++) {
            $queryParams['page'] = $i;
            $pageLink = '?' . http_build_query($queryParams);
            $activeClass = ($i === $page) ? 'active' : '';
            echo "<a href='$pageLink' class='$activeClass'>$i</a>";
          }
          
          if ($endPage < $totalPages) {
            if ($endPage < $totalPages - 1) {
              echo "<span class='disabled'>...</span>";
            }
            $queryParams['page'] = $totalPages;
            $lastLink = '?' . http_build_query($queryParams);
            echo "<a href='$lastLink'>$totalPages</a>";
          }
          
          // Next page link
          if ($page < $totalPages) {
            $queryParams['page'] = $page + 1;
            $nextLink = '?' . http_build_query($queryParams);
            echo "<a href='$nextLink'><i class='fas fa-chevron-right'></i></a>";
          } else {
            echo "<span class='disabled'><i class='fas fa-chevron-right'></i></span>";
          }
          ?>
        </div>
      <?php endif; ?>

      <!-- Summary -->
      <div class="summary">
        Menampilkan <?= $total > 0 ? (($page - 1) * $limit) + 1 : 0 ?> - <?= min($page * $limit, $total) ?> dari <?= $total ?> data
      </div>
    </div>
  </div>

  <script>
    // Handle input nama dengan submit otomatis setelah delay
    const namaInput = document.getElementById('nama');
    const clearNameBtn = document.getElementById('clearNameBtn');
    let typingTimer;
    
    namaInput.addEventListener('input', function() {
      clearTimeout(typingTimer);
      
      // Tampilkan tombol clear jika ada teks
      if (this.value.length > 0) {
        clearNameBtn.style.display = 'block';
      } else {
        clearNameBtn.style.display = 'none';
      }
      
      // Set timer untuk submit form setelah berhenti mengetik
      typingTimer = setTimeout(function() {
        document.getElementById('filterForm').submit();
      }, 800); // 800ms delay
    });
    
    // Clear input nama
    clearNameBtn.addEventListener('click', function() {
      namaInput.value = '';
      clearNameBtn.style.display = 'none';
      document.getElementById('filterForm').submit();
    });
    
    // Apus semua filter
    document.getElementById('resetBtn').addEventListener('click', function() {
      document.getElementById('tanggal').value = '';
      document.getElementById('kelas').value = '';
      document.getElementById('ekskul').value = '';
      document.getElementById('nama').value = '';
      document.getElementById('filterForm').submit();
    });
  </script>
</body>
</html>