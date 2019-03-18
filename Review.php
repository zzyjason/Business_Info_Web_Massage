<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2018/7/27
 * Time: 23:59
 */

$reviews = fopen("Data/reviews.txt","r");
$data = utf8_encode(fread($reviews, filesize("Data/reviews.txt")));

fclose($reviews);

$reviews = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data), false, 10000);

$reviews = $reviews[0][0];



$sql_con = mysqli_connect("18.217.89.196", "jason", "jason5683", "massage");


if(!$sql_con)
{
    echo "Error: Unable to connect to MySQL.".mysqli_connect_error();
    exit;
}

for($i=0; $i < count($reviews); $i++)
{
    $review = $reviews[$i];
    $review = [$review[17], str_replace("'","''", $review[5]), $review[1],$review[19], $review[8]];

    echo $review[4];

    $statement = "Insert Into reviews
                  (user_photo, review, user_name, rate, time)
                  Value ('".$review[0]."','".$review[1]."','".$review[2]."','".$review[3]."','".$review[4]."');";
    $sql_con->real_query($statement);
    echo $sql_con->error."<br>";


}