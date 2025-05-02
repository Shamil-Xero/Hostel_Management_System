<?php
include('includes/header.php');
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $course = $conn->real_escape_string($_POST['course']);
    
    if (empty($name) || empty($course)) {
        $error = "Please fill in all fields";
    } else {
        $query = "INSERT INTO students (name, course) VALUES ('$name', '$course')";
        if ($conn->query($query)) {
            echo '<script>showMessage("Student added successfully!", "success");</script>';
            // Clear form
            $name = $course = '';
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
                <h5 class="mb-0">Add New Student</h5>
            </div>
            <div class="card-body">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger fade-in" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="post" id="addStudentForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Student Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo isset($name) ? $name : ''; ?>" 
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
                                   value="<?php echo isset($course) ? $course : ''; ?>" 
                                   required>
                            <div class="invalid-feedback">
                                Please enter course name
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i> Add Student
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
    const form = document.getElementById('addStudentForm');
    
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