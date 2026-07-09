<?php
$json_content = file_get_contents("schema_dump.json");
$json_content = preg_replace("/^[\x00-\x1F\x80-\xFF]+/", "", $json_content);
$json = json_decode($json_content, true);

if (!$json) {
    // maybe it's utf-16?
    $json_content = file_get_contents("schema_dump.json");
    $json_content = mb_convert_encoding($json_content, "UTF-8", "UTF-16LE");
    $json_content = preg_replace("/^[\x00-\x1F\x80-\xFF]+/", "", $json_content);
    $json = json_decode($json_content, true);
}

if (!$json) {
    die("Error decoding JSON: " . json_last_error_msg());
}

$out = "DOKUMENTASI DATABASE PELATIHAN\n==============================\n\n";
foreach($json as $table => $cols){
    if(strpos($table, "pelatihan") !== false){
        $out .= "Tabel: " . strtoupper($table) . "\n";
        $out .= "Fungsi: Menyimpan data terkait " . str_replace("_", " ", $table) . "\n\n";
        $out .= "Kolom:\n";
        foreach($cols as $col){
            $pk = ($col["Key"] == "PRI") ? "[PK]" : "";
            $fk = ($col["Key"] == "MUL") ? "[FK]" : "";
            $flags = trim("$pk $fk");
            $flags = $flags ? "$flags " : "";
            $out .= "- " . $col["Field"] . " (" . $col["Type"] . ") " . $flags . ($col["Null"]=="NO"?"NOT NULL":"NULL") . " " . $col["Extra"] . "\n";
        }
        $out .= "\n----------------------------------------\n\n";
    }
}
file_put_contents("pelatihandoc.txt", $out);
echo "Document generated at pelatihandoc.txt";
