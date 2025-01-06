<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="icon" href="/photo/pcu.png/">
    <link rel="stylesheet" href="../css-admin/side.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

  <!-- Headbar Section -->
  <header class="headbar">
    <div class="container">
      <div class="logo">
        <a href="#"></a>
      </div>
      <nav class="nav-menu">
        <ul> 
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  

  <!-- Sidebar Section -->
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="/photo/pcu.png" alt="Logo">
    </div>
    <ul class="sidebar-nav">
      <li class="nav-title">Philippine Christian University Dasmarinas Cavite</li>
      <li class="nav-item">
        <a class="nav-link" href="../sidebar/dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
      </li>
      <li class="nav-item" id="books-menu">
        <a href="javascript:void(0);"><i class="fa fa-book"></i> Manage Books</a>
        <ul class="submenu">
          <li><a href="#">Manage Books</a></li>
          <li><a href="#">Available Books</a></li>
          <li><a href="#">Borrow Books</a></li>
          <li><a href="#">Return Books</a></li>
          <li><a href="#">Damage Books</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../sidebar/manage-user.php"><i class="fa fa-user"></i> Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-clock-rotate-left"></i> History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa-solid fa-box-archive"></i> Archive</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>
      </li>
      <div class="sidebar-footer">
        <li class="nav-item">
          <a class="nav-link" href="../login.php">
            <button class="sidebar-toggler" type="button">
              <i class="fa fa-sign-out-alt"></i> Logout
            </button>
          </a>
        </li>
      </div>
    </ul>
  </div>
  <div class="main-content">
  <button id="toggle-btn" onclick="toggleSidebar()">Toggle Sidebar</button>

  <script>
    // JavaScript to handle submenu toggle when clicking 'Manage Books'
document.getElementById("books-menu").addEventListener("click", function() {
  var submenu = this.querySelector(".submenu");
  submenu.classList.toggle("show");
});
function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      const mainContent = document.querySelector('.main-content');
      
      sidebar.classList.toggle('collapsed');
      mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '70px' : '230px';
}

  </script>
</body>
</html>
