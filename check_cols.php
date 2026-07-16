<?php
$db = new PDO('mysql:host=localhost;dbname=sim_diklat', 'root', '');
$stmt = $db->query('DESCRIBE mahasiswa_pendidikan');
echo "mahasiswa_pendidikan columns:\n";
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo $row['Field'] . "\n";
}
echo "\ninstitusi_pendidikan columns:\n";
$stmt = $db->query('DESCRIBE institusi_pendidikan');
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo $row['Field'] . "\n";
}
