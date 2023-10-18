<?php
extract($_POST);

if (isset($sub)) {
    $email = $_SESSION['email'];
    $femail = $_POST['faculty'];

    $sql = mysqli_query($conn, "SELECT * FROM feedback WHERE student_id='$email' AND faculty_id='$femail'");
    $r = mysqli_num_rows($sql);

    if ($r > 0) {
        echo "<h2 style='color:red'>You have already given feedback to this faculty</h2>";
    } else {
        $query = "INSERT INTO feedback VALUES('', '$email', '$femail', '$quest1', '$quest2', '$quest3', '$quest4', '$quest5', '$quest6', '$quest7', '$quest8', '$quest9', '$quest10', '$quest11', '$quest12', now())";
        mysqli_query($conn, $query);

        echo "<h2 style='color:green'>Thank you for your feedback</h2>";
    }
  }

    $sqll = "SELECT * FROM student_list WHERE email='$email'";
    $res = mysqli_query($conn, $sqll);
    $row = mysqli_fetch_array($res);
    $class = $row['class_id'];

    $sql = mysqli_query($conn, "SELECT F.email AS femail, Suj.subject AS Sname, CONCAT(F.firstname, ' ', F.lastname) AS Fname 
    FROM faculty_list F 
    JOIN restriction_list R ON F.id = R.Faculty_id 
    JOIN student_list S ON R.class_id = S.class_id 
    JOIN subject_list Suj ON R.subject_id = Suj.id 
    WHERE R.class_id = '$class' AND F.status = 1");

    ?>
    <form method="post">
        <fieldset>
            <center><u>Student's Feedback Form</u></center><br>

            <fieldset>
                <h3>Please give your answer about the following questions by circling the given grade on the scale:</h3>

                <button type="button" style="font-size:10pt;color:white;background-color:green;border:2px solid #336600;padding:3px">Strongly Agree 5</button>
                <button type="button" style="font-size:10pt;color:white;background-color:Brown;border:2px solid #336600;padding:3px">Agree 4</button>
                <button type="button" style="font-size:10pt;color:white;background-color:blue;border:2px solid #336600;padding:3px">Neutral 3</button>
                <button type="button" style="font-size:10pt;color:white;background-color:Black;border:2px solid #336600;padding:3px">Disagree 2</button>
                <button type="button" style="font-size:10pt;color:white;background-color:red;border:2px solid #336600;padding:3px">Strongly Disagree 1</button><br>

                <table class="table table-bordered" style="margin-top:50px">
                    <tr>
                        <th>Select Faculty:</th>
                        <td>
                            <select name="faculty" class="form-control">
                                <?php
                                $visited = array(); // مجموعة مؤقتة لتتبع البريد الإلكتروني للمدرسين المستعرضين
                                
                                while ($r = mysqli_fetch_array($sql)) {
                                    $femail = $r['femail'];
                                    if (!in_array($femail, $visited)) {
                                        $visited[] = $femail; // إضافة البريد الإلكتروني للمدرس إلى المجموعة المؤقتة
                                        $optionText = $r['Sname'] . " - " . $r['Fname'];
                                        echo "<option value='" . $femail . "'>" . $optionText . "</option>";
                                    }
                                }
                                ?>

                            </select>
                        </td>
                    </tr>
                </table>


<h3>Course Material</h3>
<table class="table table-bordered">
<tr>
<td><b>1:</b> Teacher provided the course outline having weekly content plan with list of  required text book:</td>  
<td><input type="radio" name="quest1" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest1" value="4">&nbsp4&nbsp
  <input type="radio" name="quest1" value="3">&nbsp3&nbsp
<input type="radio" name=" quest1" value="2">&nbsp2&nbsp
<input type="radio" name="quest1" value="1">&nbsp1&nbsp</td>
</tr>
  
<tr>
<td><b>2:</b>Course objectives,learning outcomes and grading criteria are clear to me:</td> 
<td><input type="radio" name="quest2" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest2" value="4">&nbsp4&nbsp
  <input type="radio" name="quest2" value="3">&nbsp3&nbsp
<input type="radio" name=" quest2" value="2">&nbsp2&nbsp
<input type="radio" name="quest2" value="1">&nbsp1&nbsp</td>
</tr>

<tr>
<td>
<b>3:</b>Course integrates throretical course concepts with the real world examples:</td> 
<td>
<input type="radio" name="quest3" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest3" value="4">&nbsp4&nbsp
  <input type="radio" name="quest3" value="3">&nbsp3&nbsp
<input type="radio" name="quest3" value="2">&nbsp2&nbsp
<input type="radio" name="quest3" value="1">&nbsp1&nbsp</td>
</tr>
</table>

<h3>Class Teaching</h3>
 <table  class="table table-bordered" >
<Td><b>4:</b> Teacher is punctual,arrives on time and leaves on time:</td>
<td> <input type="radio" name="quest4" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest4" value="4">&nbsp4&nbsp
  <input type="radio" name="quest4" value="3">&nbsp3&nbsp
<input type="radio" name="quest4" value="2">&nbsp2&nbsp
<input type="radio" name="quest4" value="1">&nbsp1&nbsp
</td>

<tr>
<td>
<b>5:</b> Teacher is good at stimulating the interest in the course content:</td>
<td> 
<input type="radio" name="quest5" value="5" required>&nbsp5&nbsp
<input type="radio" name="quest5" value="4">&nbsp4&nbsp
  <input type="radio" name="quest5" value="3">&nbsp3&nbsp
<input type="radio" name="quest5" value="2">&nbsp2&nbsp
<input type="radio" name="quest5" value="1">&nbsp1&nbsp</td>
</tr>
<tr>
<td><b>6:</b> Teacher is good at explaining the subject matter:</td>
<td>
 <input type="radio" name="quest6" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest6" value="4">&nbsp4&nbsp
  <input type="radio" name="quest6" value="3">&nbsp3&nbsp
<input type="radio" name=" quest6" value="2">&nbsp2&nbsp
<input type="radio" name="quest6" value="1">&nbsp1&nbsp</td>
</tr>

<tr><td>
<b>7:</b> Teacher's presentation was clear,loud ad easy to understand:</td>
<td> <input type="radio" name="quest7" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest7" value="4">&nbsp4&nbsp
  <input type="radio" name="quest7" value="3">&nbsp3&nbsp
<input type="radio" name="quest7" value="2">&nbsp2&nbsp
<input type="radio" name="quest7" value="1">&nbsp1&nbsp</td>
<tr>
<td>
<b>8:</b> Teacher is good at using innovative teaching methods/ways:</td><td> 
<input type="radio" name="quest8" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest8" value="4">&nbsp4&nbsp
  <input type="radio" name="quest8" value="3">&nbsp3&nbsp
<input type="radio" name="quest8" value="2">&nbsp2&nbsp
<input type="radio" name="quest8" value="1">&nbsp1&nbsp</td>
</tr>
<tr>
<td>
<b>9:</b> Teacher is available and helpful during counseling hours:</td> 
<td><input type="radio" name="quest9" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest9" value="4">&nbsp4&nbsp
  <input type="radio" name="quest9" value="3">&nbsp3&nbsp
<input type="radio" name="quest9" value="2">&nbsp2&nbsp
<input type="radio" name="quest9" value="1">&nbsp1&nbsp</td>
</tr>
<tr>
<td>
<b>10:</b> Teacher has competed the whole course as per course outline:</td>
<td>
 <input type="radio" name="quest10" value="5" required>&nbsp5&nbsp
  <input type="radio" name="quest10" value="4">&nbsp4&nbsp
  <input type="radio" name="quest10" value="3">&nbsp3&nbsp
<input type="radio" name="quest10" value="2">&nbsp2&nbsp
<input type="radio" name="quest10" value="1">&nbsp1&nbsp</td>
</tr>
</table>

<b>11:</b>What I liked about the course:<br><br>
<center>
<textarea name="quest11" rows="5" cols="60" id="comments" style="font-family:sans-serif;font-size:1.2em;">

</textarea></center><br><br>
<b>12:</b>Any Suggestion:<br><br>
<center>
<textarea name="quest12" rows="5" cols="60" id="comments" style="font-family:sans-serif;font-size:1.2em;">

</textarea></center>

<p align="center"><button type="submit" style="font-size:10pt;color:white;background-color:brown;border:2px solid #336600;padding:7px" name="sub">Submit</button></p>


</form>
</fieldset>



</div><!--close content_item-->
      </div><!--close content-->   
	
	</div><!--close site_content-->  	
  
    
    </div><!--close main-->
  </form>
<center>