<?php 
// session_start();
?>
<link rel="stylesheet" href="css/style.css">
<div class="header-wrapper">
  <nav class="header container">
    <div class="header-left">
      <div>
        <a href="index.php">Home</a>
      </div>
      <div>
        <a href="upload.php">Upload</a>
      </div>
      <div>
        <a href="update.php">Update</a>
      </div>
      <div>
        <a href="showFavourites.php">Favourites</a>
      </div>
      <div>
        <a href="musicLib.php">Library</a>
      </div>
      <div>
        <a href="showUploads.php">My songs</a>
      </div>
    </div>
    <div class="header-right">
      <?php if (isset($_SESSION['logged'])) {?>
        <div>
          <?php echo  "Hello, ".$_SESSION['userName'];?>
        </div>
      <?php } ?>
      <?php if (isset($_SESSION['logged']) && $_SESSION['logged']) {?>
        <div>
          <a href="logout.php" class="buttons">Logout</a>
        </div>
      <?php } ?>
    </div>
  </nav>
</div>
