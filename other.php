<?php
include 'class/class.php';

echo "<br><br>";

echo "today_date() with default argument :- " . today_date();

echo "<br><br>";

echo "today_date() with argument (d) :- " . today_date('d');

echo "<br><br>";
 
echo "today_datetime() with default argument  :- " . today_datetime();

echo "<br><br>";
 
echo "today_datetime() with argument (h:s:i d/m/Y) :- " . today_date('h:s:i d/m/Y');

echo "<br><br>";
  
$date = today_date();

echo "Old Date Format :- $date";

echo "<br><br>";


$newdate = change_date_format("d/m/Y", $date);


echo "New Date Format:- $newdate";

echo "<br><br>";