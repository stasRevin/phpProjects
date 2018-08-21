<?php

    require_once('appvars.php');
    require_once('connectvars.php');

    session_start();

    if (session_id() == $_SESSION['session_id'] && (isset($_GET['id']) && !empty($_GET['id'])))
    {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die("Error connection to DB_NAME server.");

        $exercise_id = $_GET['id'];

        $query = "DELETE FROM exercise_log WHERE id = $exercise_id";

        if (mysqli_query($dbc, $query))
        {
            error_log("exercise with id of $exercise_id was deleted.");
        }

        mysqli_close($dbc);

        header('Location: userProfile.php');

        error_log("session " . session_id() . " is active.");
        exit();
    }