<?php
 namespace projects\project01;

 $connection = mysqli_connect( 'localhost', 'root', '', 'project_one' )
        or die('Error connecting to MYSQL database.');

 $noun = $_POST['noun'];
 $verb = $_POST['verb'];
 $adjective = $_POST['adjective'];
 $adverb = $_POST['adverb'];

 $story = "If you $verb your $adjective $noun $adverb, then I can be friends with you.";


 $insertQuery = "INSERT INTO mad_libs (noun, verb, adjective, adverb, story) " .
                "VALUES ('$noun', '$verb', '$adjective', '$adverb', '$story')";




 mysqli_query($connection, $insertQuery);
 $returnedStory = "select noun, verb, adjective, adverb, story from mad_libs order by timestamp desc";
 $result = $connection->query($returnedStory);

 echo "<!DOCTYPE html>";
 echo "<html>";
 echo "<head><title>Result</title><link rel=\"stylesheet\" type=\"text/css\" href=\"index.css\"></head>";
 echo "<body>";
 echo "Enter a  noun: $noun<br/>" .
      "Enter a verb: $verb<br/>" .
      "Enter an adjective: $adjective<br/>" .
      "Enter an adverb: $adverb<br/><br/>" .
      "$story<br/>";

 if ( $result->num_rows > 0)
 {
     echo "<table><tr><th>noun</th><th>verb</th><th>adjective</th><th>adverb</th><th>story</th></tr>";
     while($row = $result->fetch_assoc())
     {
        echo "<tr>"
            ."<td>".$row["noun"]."</td>"
            ."<td>".$row["verb"]."</td>"
            ."<td>".$row["adjective"]."</td>"
            ."<td>".$row["adverb"]."</td>"
            ."<td>".$row["story"]."</td>"
        ."</tr>";
     }
     echo "</table>";
 }
echo "</body>";
echo "</html>";
 mysqli_close($connection);
?>