<?php
         session_start();

         //checkng success message using sessions.
         if (isset($_SESSION['success_message'])) {
             echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';
             unset($_SESSION['success_message']);
         }
         
         // Check for error message
         if (isset($_SESSION['error_message'])) {
            echo '<script>alert("' . $_SESSION['error_message'] . '");</script>';
             unset($_SESSION['error_message']); 
         }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
        <title>Survey</title>
        <link rel="stylesheet" type="text/css" href="/css/style.css">

        <!-- Using javascript to check and validate if at least one radio box per row is selected before allowing the 
         form to get submitted-->
        <script>
          function validateForm() {
            var rows = document.querySelectorAll('tbody tr');
            for (var i = 0; i < rows.length; i++) {
                var inputs = rows[i].querySelectorAll('input[type="radio"]');
                var checked = false;
                for(var t = 0; t<inputs.length; t++) {
                    if(inputs[t].checked) {
                        checked = true;
                    break;
                    }
                 }
                 //If none is selected, the following error will be shown to the user 
            if(!checked) {
                alert("Please select at least one option for eact row.");
                return false;
              }
               }
               return true;
              }
          </script>
          </head>
          <body>
          <main>
            <div class="form">
                <form action="handlingForm.php" method="post" onsubmit="return validateForm()">
                <label class="slabel">Surveys</label> <br>
            </br>
            <label class="pDetails">Personal Details</label> <br>
            <!-- Declaring form fields that the users will user to store their information-->
            <label>Full Names</label>
            <input required type="text" name="fullNames" placeholder="Please enter your full names">
            <br>
            <label>Email</label>
            <input required type="text" name="Email" placeholder="Please enter your Email Address">
            <br>
            <label>Date of birth</label>
            <input required type="date" name="dateOFbirth">
            <br>
            <label>Contact Number</label>
            <input required type="text" name="contactNumber" placeholder="Please enter your Contact Number ">
            <br>
            <label>What is your favorite food?</label>
            <input type="checkbox" name="favoriteFood[]" value="pizza">
            <label>Pizza</label>
            <input type="checkbox" name="favoriteFood[]" value="pasta">
            <label>Pasta</label>
            <input type="checkbox" name="favoriteFood[]" value="papANDwors">
            <label>Pap and wors</label>
            <input type="checkbox" name="favoriteFood[]" value="other">
            <label>Other</label>
            <br></br>
            <label>Please rate your level of agreement on a scale from 1 to 5, with 1 being "Strongly agree" and 5 being "Strongly disagree"</label>
            <div class="table">
              <table border = "1">
                <thead>
                 <tr>
                  <th></th>
                  <th>Strongly Agree</th>
                  <th>Agree</th>
                  <th>Neutral</th>
                  <th>Disagree</th>
                  <th>Strongly Disagree</th>
                 <tr>
                </thead>
                <tbody>
                    <tr>
                     <td>I like to watch movies</td>
                     <td><input type="radio" name="movies" value="1"></td>
                     <td><input type="radio" name="movies" value="2"></td>
                     <td><input type="radio" name="movies" value="3"></td>
                     <td><input type="radio" name="movies" value="4"></td>
                     <td><input type="radio" name="movies" value="5"></td>
                    </tr> 
                    
                    <tr>
                     <td>I like to listen to radio</td>
                     <td><input type="radio" name="radio" value="1"></td>
                     <td><input type="radio" name="radio" value="2"></td>
                     <td><input type="radio" name="radio" value="3"></td>
                     <td><input type="radio" name="radio" value="4"></td>
                     <td><input type="radio" name="radio" value="5"></td>
                    </tr> 

                    <tr>
                     <td>I like to eat out</td>
                     <td><input type="radio" name="eatOut" value="1"></td>
                     <td><input type="radio" name="eatOut" value="2"></td>
                     <td><input type="radio" name="eatOut" value="3"></td>
                     <td><input type="radio" name="eatOut" value="4"></td>
                     <td><input type="radio" name="eatOut" value="5"></td>
                    </tr> 

                    <tr>
                     <td>I like to watch TV</td>
                     <td><input type="radio" name="watchTV" value="1"></td>
                     <td><input type="radio" name="watchTV" value="2"></td>
                     <td><input type="radio" name="watchTV" value="3"></td>
                     <td><input type="radio" name="watchTV" value="4"></td>
                     <td><input type="radio" name="watchTV" value="5"></td>
                    </tr> 
                </tbody>
            </table>
            </div>
            <button type="submit" name="saveAnswers">Submit</button> <br>
            <div class="results"><a href="index.php">Fill Out Survey</a></div>
            <div class="fillOut"><a href="displayResults.php">View survey results</a></div>
            </form>
            </div>
            </body>
            </html>



            

        