<?php

session_start();

$database_file = 'database/database.txt';
$msg = [
    'success' => '',
    'error' => '',
];



if (isset($_POST['register'])) {

    $firstname = ($_POST['firstname']);
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (register()) {
        $msg['success'] = 'Record inserted successfully';
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (login()) {
        $_SESSION['username'] = $email;
        header('Location: /');
    } else {
        $msg['error'] = 'Invalid username or password';
    }
}

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (reset_password()) {
        $msg['success'] = 'Password updated';
    } else {
        $msg['error'] = 'User not found';
    }
}

/**
 * Registers new user
 */

function register()
{
    global $firstname, $lastname, $email, $password, $database_file;

    $user_entered_data = [$firstname, $lastname, $email, $password,];

    $final_list = implode(',', $user_entered_data);
    if (file_put_contents($database_file, $final_list . PHP_EOL, FILE_APPEND)) {
        return true;
    }
}

/**
 * Logs user in
 */

function login()
{
    global $email, $password, $database_file;
    $valid = false;
    $database_as_array = get_database_records_as_array($database_file);
    foreach ($database_as_array as $data) {
        if (in_array($email, $data) && in_array($password, $data)) {
            $valid = true;
        }
    }
    return $valid;
}

/**
 * Logs user out
 */

function logout()
{
    unset($_SESSION);
    session_destroy();
}

/**
 * Basically overwrites the database file with the array
 * returned from updated_database_as_array.
 */

function reset_password()
{
    global $database_file;
    $valid = false;
    if (updated_database_as_array()) {
        $new_database_as_array = updated_database_as_array();
        for ($i = 0; $i < count($new_database_as_array); $i++) {
            $new_database_as_array[$i] = implode(",", $new_database_as_array[$i]) . PHP_EOL;
            if ($i > 0) {
                $file = fopen($database_file, 'a+');
                fwrite($file, $new_database_as_array[$i]);
                fclose($file);
                $valid = true;
            } else {
                $file = fopen($database_file, 'w');
                fwrite($file, $new_database_as_array[$i]);
                fclose($file);
                $valid = true;
            }
        }
    }
    return $valid;
}

/** 
 * Gets the contents of the database file then
 * converts contents to an array then
 * trims the trailing whitespace at the end of the last element of array
 */

function get_database_records_as_array($database)
{
    $database_result_array = [];
    $database = file($database);
    for ($i = 0; $i < count($database); $i++) {
        $database[$i] = explode(",", $database[$i]);
        for ($j = 0; $j < count($database[$i]); $j++) {
            $database[$i][$j] = trim($database[$i][$j]);
        }
        array_push($database_result_array, $database[$i]);
    }
    return $database_result_array;
}

/**
 * Returns an updated database as an array after user
 * resets password
 */

function updated_database_as_array()
{
    global $email, $password, $database_file;
    $new_database_as_array = null;
    $database_as_array = get_database_records_as_array($database_file);
    foreach ($database_as_array as $k => $data) {
        if (in_array($email, $data)) {
            $data[3] = $password;
            array_pop($database_as_array[$k]);
            array_push($database_as_array[$k], $password);
            $new_database_as_array = $database_as_array;
        }
    }
    return $new_database_as_array;
}
