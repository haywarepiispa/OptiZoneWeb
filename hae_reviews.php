<?php
$conn = new mysqli("db", "root", "password", "palautusjarjestelma");
if ($conn->connect_error) {
    die("[]");
}
// haetaan kaikki reviewit tietokannasta
$res = $conn->query("SELECT * FROM reviews ORDER BY id DESC");
// luodaan array (sisältää reviewit)
$data = [];

while ($r = $res->fetch_assoc()) {
    $data[] = [
        "name"   => $r["name"],
        "rating" => $r["rating"],
        "review" => $r["review"],
        "time"   => $r["created"]
    ];
}
// palautetaan JSONin muodossa
header("Content-Type: application/json");
echo json_encode($data);

$conn->close();
?>