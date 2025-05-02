<?php
include('includes/header.php');
include('includes/db.php');

// Get student ID from URL if exists
$student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = (int)$_POST['student_id'];
    $room_no = $conn->real_escape_string($_POST['room_no']);
    
    if (empty($room_no)) {
        $error = "Please enter a room number";
    } else {
        // Check if room is already assigned
        $check = $conn->query("SELECT id FROM students WHERE room_no = '$room_no' AND id != $student_id");
        if ($check->num_rows > 0) {
            $error = "Room is already assigned to another student";
        } else {
            $query = "UPDATE students SET room_no = '$room_no' WHERE id = $student_id";
            if ($conn->query($query)) {
                echo '<script>showMessage("Room assigned successfully!", "success");</script>';
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}

// Get unassigned students
$students = $conn->query("SELECT * FROM students WHERE room_no IS NULL OR id = $student_id ORDER BY name");
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Assign Room to Student</h5>
            </div>
            <div class="card-body">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger fade-in" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="post" id="assignRoomForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Select Student</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <select class="form-select" id="student_id" name="student_id" required>
                                <option value="">Choose student...</option>
                                <?php while($row = $students->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id']; ?>" 
                                            <?php echo $row['id'] == $student_id ? 'selected' : ''; ?>>
                                        <?php echo $row['name']; ?> (<?php echo $row['course']; ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a student
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="room_no" class="form-label">Room Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-door-open"></i></span>
                            <input type="text" class="form-control" id="room_no" name="room_no" 
                                   value="<?php echo isset($_POST['room_no']) ? $_POST['room_no'] : ''; ?>" 
                                   required>
                            <div class="invalid-feedback">
                                Please enter room number
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Assign Room
                        </button>
                        <a href="view_students.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Students List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('assignRoomForm');
    
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>

<?php include('includes/footer.php'); ?>