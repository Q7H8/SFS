<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
?>
<?php include 'header.php' ?>
<body>
    <div class="container">
        <form action="php/logCheck.php" method="POST" id="login-form" class="logform">
        <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
		<?php } ?>

            <img src="images/rr.png" alt="wmsu logo">

            <div class="input-group mb-5">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" name="email" placeholder="username" required>
            </div>

            <div class="input-group mb-5">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                </div>
                <input type="password" class="form-control" name="password" placeholder="password" required >
            </div>


            <div class="input-group mb-5">
            <select name="typeOflog" id="" class="custom-select">
            <option value="3">Student</option>
            <option value="2">Faculty</option>
            <option value="1">Admin</option>
             </select>
                <div class="input-group-append">
                    <label class="input-group-text text" for="inputGroupSelect02">User type</label>
                </div>
            </div>
           <button type="submit" class="btn btn-lg btn-primary">Login</button>

        </form>
        
        <div class="title">
            <h1>Welocm,in</h1>
            <h3>Faculty Evaluation System</h3>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
