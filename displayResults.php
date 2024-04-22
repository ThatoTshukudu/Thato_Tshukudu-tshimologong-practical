<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
        <title>Survey</title>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    </head>
    <body>
        <label class="Surveys">Surveys</label>
        <div class= "fillOut"><a href="index.php">Fill out survey</a></div>
        <div class= "results"><a href="displayResults.php">View Results</a></div>
        <label class="sResults">Survey Results</label>
        <div class="Display">
        <?php
        session_start();
        //connecting to database
        $conn = "mysql:host=localhost;dbname=surveydata";
        $username = "Survey";
        $password = "MasonMount19";        

    try{
        // creating and establishing connection with database using PDO
        $db = new PDO($conn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Query to get the total number of surveys
        $surveys_count_query = "SELECT COUNT(*) as count FROM participantsdetails";
        $surveys_count_result = $db->query($surveys_count_query);
        $surveys_count_row = $surveys_count_result->fetch(PDO::FETCH_ASSOC);
        $surveys_count = isset($surveys_count_row['count']) ? $surveys_count_row['count'] : 0;

        //checking if any data was fetched
        if ($surveys_count == 0) {
            throw new Exception("No surveys available");
        }
        echo "<label> Total number of surveys:  </label>" . $surveys_count . "<br>";
        echo "<br>";

        //Query to get the average age of people who participated in the survey
        $average_age_query = "SELECT AVG(YEAR(CURRENT_DATE) - YEAR(dateOfBirth)) as average_age FROM participantsdetails";
        $average_age_result = $db->query($average_age_query);
        $average_age_row = $average_age_result->fetch(PDO::FETCH_ASSOC);
        $average_age = isset($average_age_row['average_age']) ? $average_age_row['average_age'] : 0;
        echo "<label> Average Age:  </label>" .round($average_age, 1) .  "<br>";
        echo "<br>";

        //Query to get the oldest age of people who participated in the survey
        $oldest_age_query = "SELECT MAX(YEAR(CURRENT_DATE) - YEAR(dateOfBirth)) as oldest_age FROM participantsdetails";
        $oldest_age_result = $db->query($oldest_age_query);
        $oldest_age_row = $oldest_age_result->fetch(PDO::FETCH_ASSOC);
        $oldest_age = isset($oldest_age_row['oldest_age']) ? $oldest_age_row['oldest_age'] : 0;
        echo "<label> Oldest age to participate in survey:  </label>" . $oldest_age . "<br>";
        echo "<br>";

        //Query to get the youngest age  of people who participated in the survey
        $youngest_age_query = "SELECT MIN(YEAR(CURRENT_DATE) - YEAR(dateOfBirth)) as youngest_age FROM participantsdetails";
        $youngest_age_result = $db->query($youngest_age_query);
        $youngest_age_row = $youngest_age_result->fetch(PDO::FETCH_ASSOC);
        $youngest_age = isset($youngest_age_row['youngest_age']) ? $youngest_age_row['youngest_age'] : 0;
        echo "<label> Youngest age to participate in survey:  </label>" . $youngest_age . "<br>";
        echo "<br>";

        //Query to calculate and get the percentage of people who like pizza
        $pizza_query =  "SELECT COUNT(*) as pizza_count FROM favFood WHERE pizza = 1";
        $pizza_result = $db->query($pizza_query);
        $pizza_row = $pizza_result->fetch(PDO::FETCH_ASSOC);
        $pizza_count = isset($pizza_row['pizza_count']) ? $pizza_row['pizza_count'] : 0;
        $percantage = ($surveys_count > 0) ? ($pizza_count/$surveys_count) * 100 : 0;
        echo "<label> Percentage of people who like Pizza:  </label>" . round($percantage, 1) . "%<br>";
        echo "<br>";

        // Query to calculate and get the percentage of people who like pasta
        $pasta_query =  "SELECT COUNT(*) as pasta_count FROM favFood WHERE pasta = 1";
        $pasta_result = $db->query($pasta_query);
        $pasta_row = $pasta_result->fetch(PDO::FETCH_ASSOC);
        $pasta_count = isset($pasta_row['pasta_count']) ? $pasta_row['pasta_count'] : 0;
        $pastaPercantage = ($surveys_count > 0) ? ($pasta_count/$surveys_count) * 100 : 0;
        echo "<label> Percentage of people who like Pasta:  </label>" . round($pastaPercantage, 1) . "%<br>";
        echo "<br>";

        // Query to calculate and get the percentage of people who like pap and wors
        $pap_query =  "SELECT COUNT(*) as pap_count FROM favFood WHERE papAndwors = 1";
        $pap_result = $db->query($pap_query);
        $pap_row = $pap_result->fetch(PDO::FETCH_ASSOC);
        $pap_count = isset($pap_row['pap_count']) ? $pap_row['pap_count'] : 0;
        $papPercantage = ($surveys_count > 0) ? ($pap_count/$surveys_count) * 100 : 0;
        echo "<label> Percentage of people who like Pap and wors:  </label>" . round($papPercantage, 1) . "%<br>";
        echo "<br>";
        
        // Query to get and display the average for Movies rating 
        $movies_average_query =  "SELECT AVG(movies) as movies_average FROM agreeordisagree";
        $movies_average_result = $db->query($movies_average_query);
        $movies_average_row = $movies_average_result->fetch(PDO::FETCH_ASSOC);
        $movies_average = isset($movies_average_row['movies_average']) ? $movies_average_row['movies_average'] : 0;
        echo "<label> People who like to watch movies:  </label>" . round($movies_average, 1) . "<br>";
        echo "<br>";

        // Query to get and display the average  for radio rating 
        $radio_average_query =  "SELECT AVG(radio) as radio_average FROM agreeordisagree";
        $radio_average_result = $db->query($radio_average_query);
        $radio_average_row = $radio_average_result->fetch(PDO::FETCH_ASSOC);
        $radio_average = isset($radio_average_row['radio_average']) ? $radio_average_row['radio_average'] : 0;
        echo "<label> People who like to listen to radio:  </label>" . round($radio_average, 1) . "<br>";
        echo "<br>";

        // Query to get and display the average rating 
        $eatOut_average_query =  "SELECT AVG(eatOut) as eatOut_average FROM agreeordisagree";
        $eatOut_average_result = $db->query($eatOut_average_query);
        $eatOut_average_row = $eatOut_average_result->fetch(PDO::FETCH_ASSOC);
        $eatOut_average = isset($eatOut_average_row['eatOut_average']) ? $eatOut_average_row['eatOut_average'] : 0;
        echo "<label> People who like to eat out:  </label>" . round($eatOut_average, 1) . "<br>";
        echo "<br>";

        // Query to get and display the average rating 
        $TV_average_query =  "SELECT AVG(watchTV) as TV_average FROM agreeordisagree";
        $TV_average_result = $db->query($TV_average_query);
        $TV_average_row = $TV_average_result->fetch(PDO::FETCH_ASSOC);
        $TV_average = isset($TV_average_row['TV_average']) ? $TV_average_row['TV_average'] : 0;
        echo "<label> People who like to watch TV:  </label>" . round($TV_average, 1) . "<br>";
        echo "<br>";

    }
catch(Exception $e){
    $_SESSION['error_message'] = $e->getMessage();
}

    if(isset($_SESSION['error_message'])){
        echo " " . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']);
    }
?>
