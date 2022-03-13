<?php

/**
 * server connect function
 */
function connect(){
    return new mysqli(HOST, USER, PASS, DB);
};



/**
 * Age calculate function
 */
function ageCalculate($name, $year)
{
    $age = date('Y') - $year;

    $alert_type = "";
    switch (userStatus($age)) {
        case "Infant":
            $alert_type = 'success';
            break;
        case "Child":
            $alert_type = 'primary';
            break;
        case "Boy":
            $alert_type = 'danger';
            break;
        case "Young":
            $alert_type = 'warning';
            break;
        case "Semi-old":
            $alert_type = 'dark';
            break;
        case "Old":
            $alert_type = 'warning';
            break;
    };

    return "<p class=\"alert alert-{$alert_type}\">Hi {$name} you are {$age} years old ! and You are" . userStatus($age) . "</p>";
};
/**
 * user status
 */
function userStatus($age)
{
    if ($age >= 1 && $age < 9) {
        return "Infant";
    } elseif ($age >= 9 && $age < 12) {
        return "Child";
    } elseif ($age >= 12 && $age < 18) {
        return "Boy";
    } elseif ($age >= 18 && $age < 35) {
        return "Young";
    } elseif ($age >= 35 && $age < 50) {
        return "Semi-old";
    } elseif ($age >= 50 && $age < 150) {
        return "Old";
    }
};

/**
 * massage validation
 */
function validation($msg, $type = 'danger')
{

    return "<p class=\"alert alert-{$type}\"> {$msg} <button data-bs-dismiss=\"alert\" class=\"btn-close\">&times;</button> </p>";
}
/**
 * email Check
 */
function emailCheck($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
/**
 * old Function
 */
function old($key)
{
    return $_POST[$key] ?? "";
}
/**
 * form clear
 */
function formClear()
{
    return $_POST = "";
}
/**
 * currency Converter function
 */
function currencyConverter($amount, $currency){

    $rate = 0;
    switch ($currency) {
        case "USD":
            $rate = 89;
            break;

        case "EURO":
            $rate = 85;
            break;

        case "POUND":
            $rate = 110;
            break;
        case "CAD":
            $rate = 86;
            break;
    }
    $bdt = $rate * $amount;
    return "{$amount} {$currency} = {$bdt} BDT";

}
/**
 * photo upload function
 */
function photoUpload($file_data, $path='/'){

    $file_name = $file_data['name'];
    $file_tmp_name = $file_data['tmp_name'];
    move_uploaded_file($file_tmp_name, $path . $file_name);
    return $file_name;
}