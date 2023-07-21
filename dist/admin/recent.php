<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links -->
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/8b614ed6c5.js" crossorigin="anonymous"></script>
    <title>Recent | Admin</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar.php'?>

    <!-- Recent Body -->
    <div class="recent-main-container">
        <div class="recent-main-header">
            <h3>Recent Activities</h5>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, architecto.</p>

            <!-- Table and Button -->
            <div class="sort-menu">
                <div class="date-container">
                    <div class="datefrom">
                        <label for="Date From">Date From</label>
                        <input type="date">
                    </div>
                    <div class="dateto">
                        <label for="Date To">Date To</label>
                        <input type="date">
                    </div>
                    <button>Sort</button>
                </div>
            </div>
            <div class="table-container">
                    <p>sda</p>
                </div>
        </div>
        <div class="recent-faculty-member">
            <div class="user-activity">
                <h3>User Activity</h3>
                <p>lorem</p>
            </div>
            <div class="list-member">
                <h3>Faculty Member</h3>
            </div>
        </div>
    </div>

    
</body>
</html>