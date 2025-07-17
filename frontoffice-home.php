

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Front Office Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }
        header {
            background: #4B0082;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .dashboard {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .dashboard h2 {
            margin-bottom: 25px;
            color: #4B0082;
        }
        .nav-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        .nav-item {
            text-align: center;
            padding: 25px;
            border: 2px solid #4B0082;
            border-radius: 10px;
            transition: 0.3s;
            background: #fafafa;
        }
        .nav-item:hover {
            background: #f0e6ff;
            transform: scale(1.03);
        }
        .nav-item a {
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            color: #4B0082;
        }
    </style>
</head>
<body>

<header>
   
    
</header>

<div class="dashboard">
<h1>Hotel Front Office Dashboard</h1>
    <h2>Front Desk Operations</h2>
    <div class="nav-grid">
        <div class="nav-item">
            <a href="register-foreigner.php">Register Foreigner</a>
        </div>
        <div class="nav-item">
            <a href="checkin.php">Check-In Guest</a>
        </div>
        <div class="nav-item">
            <a href="checkout.php">Check-Out Guest</a>
        </div>
        <div class="nav-item">
            <a href="view-checkins.php">View Check-Ins</a>
        </div>
    </div>
</div>

</body>
</html>
