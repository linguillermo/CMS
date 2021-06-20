<?php
session_start();

if(isset($_SESSION['sess_user_id']))
{
        require "connection.php";
        $sess = $_SESSION['sess_user_id'];
        $result = $dbh->prepare("SELECT * FROM event WHERE euser_id = :sess");
        $result->bindParam(':sess', $sess);
        $result->execute();
        $event_array = array();

        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($record = $result->fetch()) {
            $event_array[] = array(
                'id' => $record['event_id'],
                'title' => $record['event_name'],
                'start' => $record['start_event'],
                'end' => $record['end_event'],
            );
        }

    echo json_encode($event_array);
}
?>
