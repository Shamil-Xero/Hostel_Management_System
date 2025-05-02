<?php
include('includes/header.php');
include('includes/db.php');

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

// Get statistics
$totalStudents = $conn->query("SELECT COUNT(*) as count FROM students")->fetch_assoc()['count'];
$assignedRooms = $conn->query("SELECT COUNT(*) as count FROM students WHERE room_no IS NOT NULL")->fetch_assoc()['count'];
$availableRooms = 100 - $assignedRooms; // Assuming total 100 rooms
?>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card dashboard-card bg-primary text-white">
            <div class="card-body text-center">
                <i class="bi bi-people"></i>
                <h5 class="card-title">Total Students</h5>
                <h2 class="card-text"><?php echo $totalStudents; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card bg-success text-white">
            <div class="card-body text-center">
                <i class="bi bi-door-open"></i>
                <h5 class="card-title">Assigned Rooms</h5>
                <h2 class="card-text"><?php echo $assignedRooms; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card bg-info text-white">
            <div class="card-body text-center">
                <i class="bi bi-door-closed"></i>
                <h5 class="card-title">Available Rooms</h5>
                <h2 class="card-text"><?php echo $availableRooms; ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="add_student.php" class="btn btn-outline-primary">
                        <i class="bi bi-person-plus"></i> Add New Student
                    </a>
                    <a href="view_students.php" class="btn btn-outline-primary">
                        <i class="bi bi-people"></i> View All Students
                    </a>
                    <a href="assign_room.php" class="btn btn-outline-primary">
                        <i class="bi bi-door-open"></i> Assign Room
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Recent Activities</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <?php
                    $recentActivities = $conn->query("
                        SELECT * FROM students 
                        WHERE room_no IS NOT NULL 
                        ORDER BY id DESC 
                        LIMIT 5
                    ");
                    
                    while($activity = $recentActivities->fetch_assoc()):
                    ?>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1"><?php echo $activity['name']; ?></h6>
                            <small class="text-muted">Room <?php echo $activity['room_no']; ?></small>
                        </div>
                        <p class="mb-1"><?php echo $activity['course']; ?></p>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>