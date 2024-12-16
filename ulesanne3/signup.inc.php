<?php
if (isset($_POST["submit"])) {
    // Collect POST data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    // Include necessary files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Input validation checks
    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)!== false) {
        header("Location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUid($username) !== false) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat)!== false) {
        header("Location: ../signup.php?error=passwordsdontmatch");
        exit();
    }

    if (uidExists($conn, $username) !== false) {
        header("Location: ../signup.php?error=usernametaken");
        exit();
    }

    // Создание пользователя в базе данных
    createUser($conn, $name, $email, $username, $pwd);
    }

    else {
    // Возврат на форму, если доступ осуществляется неправильно
    header("Location: ../signup.php");
    exit();


}
