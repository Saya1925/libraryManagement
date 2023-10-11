<?php
// Array with book titles
$a[] = "Harry Potter and the Philosopher's Stone";
$a[] = "Harry Potter and the Deathly Hallows";
$a[] = "Harry Potter and the Chamber of Secrets";
$a[] = "Dogura Magura";
$a[] = " Harry Potter and the Prisoner of Azkaban ";
$a[] = "Tsugumi";
$a[] = "Harry Potter and the Half-Blood Prince";

// get the q parameter from URL
// $q = $_REQUEST["q"];
$q = $_GET["q"];

$hint = "";
// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>
