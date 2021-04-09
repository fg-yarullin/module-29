<?php

$filename = './setup.php';

if (file_exists($filename)) {
echo"i see the file";
} else {
echo "recheck the link file maybe broken";
}
$file = sha1_file('./setup.php');

echo"<br>is file hash valid?";
echo"hash = add the hash here<br>";
echo"hash of file :";
print($file . '.fff');
?>