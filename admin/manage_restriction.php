<script type="text/javascript">
function deletes(id)
{
	a=confirm('Are You Sure To Remove This Record ?')
	 if(a)
     {
        window.location.href='delete_restriction.php?id='+id;
     }
}
</script>


<?php
include('../dbconfig.php');

// Check if the form is submitted
if(isset($_POST['add'])) {
    // Get the values from the form
    $faculty_id = $_POST['faculty'];
    $class_id = $_POST['class'];
    $subject_id = $_POST['subject'];

    $sql = "INSERT INTO restriction_list VALUES ('', '$faculty_id', '$class_id', '$subject_id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Success message
        $message = "Restriction added successfully!";
    } else {
        // Error message
        $message = "Error adding restriction: " . mysqli_error($conn);
    }
}
?>

<div class="container-fluid">
    <form id="manage-restriction" method="POST">
        <div id="msg" class="form-group">
            <?php if(isset($message)): ?>
                <div class="alert alert-<?php echo ($result) ? 'success' : 'danger'; ?>"><?php echo $message; ?></div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="form-group">
                    <label for="faculty_id" class="control-label">Faculty</label>
                    <select name="faculty" id="faculty_id" class="form-control form-control-sm select2">
                        <option value=""></option>
                        <?php 
                        $faculty = $conn->query("SELECT *, concat(firstname,' ',lastname) as name FROM faculty_list ORDER BY concat(firstname,' ',lastname) ASC");
                        $f_arr = array();
                        while($row = $faculty->fetch_assoc()):
                            $f_arr[$row['id']] = $row;
                        ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="class_id" class="control-label">Class</label>
                    <select name="class" id="class_id" class="form-control form-control-sm select2">
                        <option value=""></option>
                        <?php 
                        $classes = $conn->query("SELECT id, concat(curriculum,' ',level,' - ',section) as class FROM class_list");
                        $c_arr = array();
                        while($row = $classes->fetch_assoc()):
                            $c_arr[$row['id']] = $row;
                        ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['class'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject_id" class="control-label">Subject</label>
                    <select name="subject" id="subject_id" class="form-control form-control-sm select2">
                        <option value=""></option>
                        <?php 
                        $subject = $conn->query("SELECT id, concat(code,' - ',subject) as subj FROM subject_list");
                        $s_arr = array();
                        while($row = $subject->fetch_assoc()):
                            $s_arr[$row['id']] = $row;
                        ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['subj'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="d-flex w-100 justify-content-center">
                        <button class="btn btn-sm btn-flat btn-primary bg-gradient-primary" id="add_to_list" type="submit" name="add">Add to List</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
    <table class="table table-condensed" id="r-list">
        <thead>
            <tr>
                <th>Faculty</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $restrictions = $conn->query("SELECT * FROM restriction_list");
            if ($restrictions && $restrictions->num_rows > 0) {
                while ($row = $restrictions->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <b><?php echo isset($f_arr[$row['faculty_id']]) ? $f_arr[$row['faculty_id']]['name'] : '' ?></b>
                            <input type="hidden" name="rid[]" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="faculty_id[]" value="<?php echo $row['faculty_id'] ?>">
                        </td>
                        <td>
                            <b><?php echo isset($c_arr[$row['class_id']]) ? $c_arr[$row['class_id']]['class'] : '' ?></b>
                            <input type="hidden" name="class_id[]" value="<?php echo $row['class_id'] ?>">
                        </td>
                        <td>
                            <b><?php echo isset($s_arr[$row['subject_id']]) ? $s_arr[$row['subject_id']]['subj'] : '' ?></b>
                            <input type="hidden" name="subject_id[]" value="<?php echo $row['subject_id'] ?>">
                        </td>
                        <td class="text-center">
                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="deletes(<?php echo $row['id']; ?>)" style="color: red;"><i class="fa fa-trash"></i></button>                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4">No restrictions found.</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
            </div>
        </div>
    </form>
</div>