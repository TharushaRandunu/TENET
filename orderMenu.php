<?php
session_start();
if (!isset($_SESSION['full_name'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Room Service Menu</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .menu-wrapper {
  background-color: rgba(255, 255, 255, 0.1); /* semi-transparent white */
  backdrop-filter: blur(10px);               /* main blur effect */
  -webkit-backdrop-filter: blur(10px);       /* for Safari */
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  color: white;
  text-align: center;
  max-width: 700px;
  margin: 40px auto;
}

.menu-wrapper h2 {
  color: #cc00ffff;
  margin-bottom: 20px;
}

.category-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  justify-content: center;
}

.category-grid a {
  padding: 10px 20px;
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 8px;
  color: white;
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.category-grid a:hover {
  background-color: rgba(255, 255, 255, 0.4);
  color: black;
}

    </style>
</head>
<body>
    <div class="menu-wrapper">
        <h2>Select a Menu Category</h2>
        <div class="category-grid">
            <a href="view-items.php?category=Breakfast">Breakfast</a>
            <a href="view-items.php?category=Lunch">Lunch</a>
            <a href="view-items.php?category=Dinner">Dinner</a>
            <a href="view-items.php?category=Other Meals">Other Meals</a>
            <a href="view-items.php?category=Coffee">Coffee</a>
            <a href="view-items.php?category=Liquors">Liquors</a>
        </div>
    </div>
</body>
</html>
