<!-- Example from pages 362-364 -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Form Quiz</title>
</head>
<body>
	<h1>PHP Form Quiz</h1>
	<hr />
	<hr />
	<br />
	<?php
	// associative array of the questions and answers
	$StateCapitals = array(
		"Connecticut" => "Hartford", "Maine" => "Augutsa", "Massachusetts" => "Boston", "New Hapshire" => "Concord", "Rhode Island" => "Providence", "Vermont" => "Montpelier");

	// determine if the submit button was clicked
	if(isset($_POST["submit"])) {
		// create an array out of the array of the user-submitted data
		$Answers = $_POST["answers"];
		// acumulator variable for the scoring
		$Score = 0;
		// variable for storing hopw many questions that there are
		$Questions = count($Answers);

		if(is_array($Answers)) {
			// we checked $Answers and it IS an array
			foreach ($Answers as $State => $Response) {
				$Response = stripslashes($Response);
				// check this response to see if it was left empty
				if(strlen($Response) > 0) {
					# we have an attempt at an answer
					if(strcasecmp($StateCapitals[$State], $Response) == 0) {
						echo "<p>Correct! The capital of $State is " . $StateCapitals[$State] . ".</p>\n";
						echo "<br />";
						++$Score;
					}
					else {
					# $response is incorrect
					echo "<p>Sorry, The capital of $State is not $Response.</p>\n";	
					}
				}
				else {
					// this answer is empty
					echo "<p>Sorry, you did not enter a value for the captial of $State!</p>\n";
				} 
			} // end of foreach loop
		}
		// variable for storing the percentage of the quiz 
		$Grade = $Score / $Questions * 100;
		echo "<p>You got a score of: $Score out of $Questions! You got a $Grade%.</p>\n";
		echo "<p><a href='Quiz.php'>Try Again?</a></p>\n";
	}
	else {
		echo "<form action='Quiz.php' method='POST'>\n";
		foreach ($StateCapitals as $State => $Response) {
			echo "The capital of $State is: <input type='text' name='answers[" . $State . "]' /><br />\n";
			echo "<br />";
		} // end of foreach loop
		echo "<input type='submit' name='submit' value='Check Answers'/>";
		echo "<input type='reset' name='reset' value='Reset Form'/>\n";
		echo "</form>\n";
	}

	?>
</body>
</html>