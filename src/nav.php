<!--Navbar -->
<style type="text/css">
    #userlbl {
      font-family: Rubik;
      margin-top: 10px; 
      font-size: 13.5px;
    }
</style>
<nav class="mb-1 navbar navbar-expand-lg navbar-dark green darken-3 text-white">
  <a class="navbar-brand" href="#">HOME</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active" id="monitoring">
        <a class="nav-link" href="home.php">PO Monitoring
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Masterlist</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Open PO (Car Model)</a>
      </li> -->
      <li class="nav-item" id="history">
        <a class="nav-link" href="history.php">History</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <p id="userlbl"><?php echo $_SESSION['username'];?></p>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#">Account Settings</a>
          <a class="dropdown-item" href="src/request.php?logout=true">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->
<script type="text/javascript">

 
</script>