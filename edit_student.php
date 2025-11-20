<?php
include('includes/header.php');
include('includes/db.php');

// Get student ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id) {
    header("Location: view_students.php");
    exit();
}

// Fetch student data
$student = $conn->query("SELECT * FROM students WHERE id = $id")->fetch_assoc();

if (!$student) {
    header("Location: view_students.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $course = $conn->real_escape_string($_POST['course']);
    
    if (empty($name) || empty($course)) {
        $error = "Please fill in all fields";
    } else {
        $query = "UPDATE students SET name = '$name', course = '$course' WHERE id = $id";
        if ($conn->query($query)) {
            echo '<script>showMessage("Student updated successfully!", "success");</script>';
            // Update the student data after successful update
            $student['name'] = $name;
            $student['course'] = $course;
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Student Information</h5>
            </div>
            <div class="card-body">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger fade-in" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="post" id="editStudentForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Student Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo htmlspecialchars($student['name']); ?>" 
                                   required>
                            <div class="invalid-feedback">
                                Please enter student name
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="course" class="form-label">Course</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-book"></i></span>
                            <input type="text" class="form-control" id="course" name="course" 
                                   value="<?php echo htmlspecialchars($student['course']); ?>" 
                                   required>
                            <div class="invalid-feedback">
                                Please enter course name
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Room Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-door-open"></i></span>
                            <input type="text" class="form-control" 
                                   value="<?php echo $student['room_no'] ? htmlspecialchars($student['room_no']) : 'Not Assigned'; ?>" 
                                   readonly>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Student
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
    const form = document.getElementById('editStudentForm');
    
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