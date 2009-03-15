<?php
// parses the error log finds unique errors
$path = 'logs/error.log';
$errors = file($path);

$unique = array();
for($i = 0; $i < count($errors); $i++) {
    $tmp = explode('::', $errors[$i]);
    if (!in_array($tmp[1], $unique)) {
        $unique[] = $tmp[1];
    }
}

for($i = 0; $i < count($unique); $i++) {
    echo $unique[$i] . '<br>';
}

?>