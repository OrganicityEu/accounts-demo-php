<ul>
  <li>Username: <?php echo $_SESSION['username']; ?></li>
  <li>Email: <?php echo $_SESSION['email']; ?></li>
  <li>Roles: <?php echo implode(", ", $_SESSION['roles']); ?></li>
</ul>