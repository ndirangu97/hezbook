<?php


$query = false;
$data = false;

$data["me"] = $_SESSION["userid"];
$data["h"] = $DATA_OBJECT->sender;
$data["k"] = 1;
$mess = "";

$query = "UPDATE requests SET status= :k WHERE reciever =:me and sender=:h";
$save = $DB->write($query, $data);
if ($save) {


    $sql = false;
    $data = false;

    $data["me"] = $_SESSION["userid"];

    $mess = "";

    $sql = "SELECT * FROM users WHERE userid=:me";
    $results = $DB->read($sql, $data);

    if (is_array($results)) {
        $results = $results[0];
        $r = $results->friends;
        $ra = unserialize(base64_decode($r));

        array_push($ra, $DATA_OBJECT->sender);

        //now update users with new friends array
        $query = false;
        $data = false;

        $sra = base64_encode(serialize($ra));


        $data["k"] = $sra;
        $mess = "";

        $query = "UPDATE users SET friends= :k ";
        $save = $DB->write($query, $data);
        if ($save) {
            $mess .= "good";
        }
    } else {
        $mess .= "No result";
    }
} else {
    $echo = "No result";
}
$info->message = $mess;
$info->type = "accept";
echo json_encode($info);
