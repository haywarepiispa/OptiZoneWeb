<?php
$conn = new mysqli("db", "root", "password", "palautusjarjestelma");
if ($conn->connect_error) {
    die("DB error");
} // testataan yhteys
// saadaan POST-data + tarkistetaan että nimi ja review ei ole tyhjänä
$name   = $_POST["name"] ?? "";
$rating = $_POST["rating"] ?? "";
$review = $_POST["review"] ?? "";

// jos palautus tyhjä = echo error
if (trim($name) === "" || trim($review) === "") {
    echo "❌ Name and review are required.";
    exit;
}
// muuten tallennetaan tietokantaan
$stmt = $conn->prepare("INSERT INTO reviews (name, rating, review) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $rating, $review);
// execute ja tarkistus onnistuiko tallentamine
if ($stmt->execute()) {
    echo "✅ Review added!";
} else {
    echo "❌ Error saving review.";
}

$stmt->close();
$conn->close();
?>