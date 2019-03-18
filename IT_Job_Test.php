<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2018/7/12
 * Time: 22:39
 */

function helloWorld($n)
{
    // YOUR CODE HERE

    if(!is_int($n))
    {
        return;
    }

    $result = "";

    for($i=0; $i < $n; $i++)
    {
        $result = $result."HELLO WORLD<br>";
    }
    return $result;
}


function bassAckwards($input)
{
    // YOUR CODE HERE
    if(!is_string($input))
    {
        return;
    }

    $result="";
    $tmp="";

    for ($i = 0; $i < strlen($input); $i++){
        if($input[$i] == ',')
        {
            $result = $result.strrev($tmp).',';
            $tmp = "";
        }
        else
        {
            $tmp = $tmp.$input[$i];
        }
    }
    if($tmp!="")
    {
        $result = $result.strrev($tmp);
    }
    return $result;
}

function getTLD($domain)
{
    // YOUR CODE HERE

    if(!is_string($domain))
    {
        return;
    }
    $input_arr = str_split($domain);
    $result = "";
    $tmp = "";
    $sub_dir = false;
    foreach($input_arr as $char)
    {
        if($char == '/')
        {
            $sub_dir = true;
        }
        if($char == '.' || $char == '/')
        {
            $result = $tmp;
            $tmp = "";
        }
        else
        {
            $tmp = $tmp.$char;
        }
    }

    if(!$sub_dir && $tmp!="")
    {
        $result = $tmp;
    }


    return $result;
}


function getBirthDate($birthdate)
{
    // YOUR CODE HERE
    if(!is_string($birthdate))
    {
        return;
    }

    $date = date_create($birthdate);

    $target = $date->getTimestamp();

    $age = (time()-$target)/3600/24/365.25;

    $birthday = ((time()-$target)/3600/24/365.25)-intval($age) ;
    echo "age: ".$age."<br>";
    echo "birthday: ".$birthday."<br>";
    if( $birthday < 1/365)
    {
        $birthday = true;
    }
    else
    {
        $birthday = false;
    }


    return array('age'=>intval($age),  'birthday' => $birthday);
}

function bubbleSort($numbers)
{
    // YOUR CODE HERE
    $swaped = true;

    while($swaped)
    {
        $swaped = false;
        for($i=0; $i < count($numbers)-1; $i++)
        {
            if($numbers[$i] > $numbers[$i+1])
            {
                $swaped = true;
                $tmp = $numbers[$i];
                $numbers[$i] = $numbers[$i+1];
                $numbers[$i+1] = $tmp;
            }
        }
    }
    return $numbers;
}


function getStudent($min)
{
    // replace the query statement below with the correct statement
    if(!is_numeric($min))
    {
        return;
    }
    $query = "SELECT Student_ID, Last_Name, First_Name, GPA FROM interview_student where GPA > ".$min.";";

    return $query;
}

function hasHold($college)
{
    $query = "SELECT info.Student_ID, info.Last_Name, info.First_Name, info.College, account.Amount_Due
  from interview_student info, interview_account_hold account 
  where info.Student_ID = account.Student_ID and info.College = '".$college."';";

    return $query;
}

function checkPass($user, $password)
{
    // You will likely want to use mysql_query($query) AND mysql_fetch_assoc($result);
    // YOUR CODE HERE

    $password = md5($password);

    $Result = mysql_query("Select UserID from interview_user_info where NetID = '".$user."'and Passwd = '".$password."'");

    $UserID = mysql_fetch_assoc($Result);
    if(!$UserID)
    {
        return -1;
    }


    return $UserID["UserID"];


}