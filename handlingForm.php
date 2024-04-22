<?php
session_start();
//connecting to database
$conn = "mysql:host=localhost;dbname=surveydata";
$username = "Survey";
$password = "MasonMount19";

try{
    // creating and establishing connetion with database using PDO
    $db = new PDO($conn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Processing form submissions 
    if(isset($_POST['saveAnswers'])) {
        //Declaring variables that will hold the information that will be stored into the participants details table in the surveys database
        $fNames = $_POST['fullNames'];
        $email = $_POST['Email'];
        $dateOFbirth = date('Y-m-d', strtotime($_POST['dateOFbirth']));
        $contactNumber = $_POST['contactNumber'];
        //checking if any of the checkboxes are checked/selected
        $favoriteFoods = isset($_POST['favoriteFood']) ? $_POST['favoriteFood'] : array();
        //Validating date of birth before inserting to database
        $currentYear = date('Y');
        $minAge = 5;
        $maxAge = 120;
        $minYear = $currentYear - $maxAge;
        $maxYear = $currentYear - $minAge;

        if($dateOFbirth < $minYear || $dateOFbirth > $maxYear) {
            $_SESSION['error_message'] = "Sorry, only persons of the age of five and above can participate in the survey";
        }
        else {
            //inserting data in to table
            $sql = "INSERT INTO participantsdetails (fullNames, Email, dateOFbirth, contactNumber) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$fNames, $email, $dateOFbirth, $contactNumber]);
        
        
        //Inserting favorite foods data into the favorite foods table in the surveys database
        $pizza = in_array('pizza', $favoriteFoods) ? 1 : 0;
        $pasta = in_array('pasta', $favoriteFoods) ? 1 : 0;
        $papAndwors = in_array('papANDwors', $favoriteFoods) ? 1 : 0;
        $other = in_array('other', $favoriteFoods) ? 1 : 0;

        $sql_favFoods = "INSERT INTO favFood (pizza, pasta, papAndwors, other) VALUES (?, ?, ?, ?)";
        $stmt_favFoods = $db->prepare($sql_favFoods);
        $stmt_favFoods->execute([$pizza, $pasta, $papAndwors, $other]);

        //Inserting into the Agree or Disagree table in the surveys database
        $movies = $_POST['movies'];
        $radio = $_POST['radio'];
        $eatOut = $_POST['eatOut'];
        $watchTV = $_POST['watchTV'];

        $sql_aORd = "INSERT INTO agreeordisagree (movies, radio, eatOut, watchTV) VALUES (?, ?, ?, ?)";
        $stmt_aORd = $db->prepare($sql_aORd);
        $stmt_aORd->execute([$movies, $radio, $eatOut, $watchTV]);

        $_SESSION['success_message'] = "Data saved successfully";
        }

        header("Location: index.php?success=1");
        exit();

    }
}
catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

?>