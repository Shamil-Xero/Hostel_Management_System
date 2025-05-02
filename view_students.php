<?php
include('includes/header.php');
include('includes/db.php');

// Handle student deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id = $id");
    echo '<script>showMessage("Student deleted successfully!", "success");</script>';
}

$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Student List</h5>
        <a href="add_student.php" class="btn btn-light btn-sm">
            <i class="bi bi-person-plus"></i> Add Student
        </a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" id="searchInput" placeholder="Search students...">
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover" id="studentsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Room No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td>
                            <?php if($row['room_no']): ?>
                                <span class="badge bg-success"><?php echo $row['room_no']; ?></span>
                            <?php else: ?>
                                <span class="badge bg-warning">Not Assigned</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="assign_room.php?student_id=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-primary" 
                               data-bs-toggle="tooltip" 
                               title="Assign Room">
                                <i class="bi bi-door-open"></i>
                            </a>
                            <a href="edit_student.php?id=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-info" 
                               data-bs-toggle="tooltip" 
                               title="Edit Student">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="?delete=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-danger" 
                               data-bs-toggle="tooltip" 
                               title="Delete Student"
                               onclick="return confirm('Are you sure you want to delete this student?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    searchTable('searchInput', 'studentsTable');
});
</script>

<?php include('includes/footer.php'); ?>