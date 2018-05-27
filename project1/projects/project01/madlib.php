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

 $returnedStory = "select story from mad_libs where noun = 'vehicle'";

 $result = $connection->query($returnedStory);
 mysqli_query($connection, $insertQuery);
 mysqli_close($connection);

 echo "Enter a  noun: $noun<br/>" .
      "Enter a verb: $verb<br/>" .
      "Enter an adjective: $adjective<br/>" .
      "Enter an adverb: $adverb<br/><br/>" .
      "$story<br/>";

 if ( $result->num_rows > 0)
 {
     while($row = $result->fetch_assoc())
     {
        echo "story: " . $row["story"];

     }
 }

?>