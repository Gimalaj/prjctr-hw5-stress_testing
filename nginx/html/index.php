<?php

    require_once "random_names.php";
    require_once "random_surnames.php";
    require_once "random_countries.php";

    global $random_names,$random_surnames, $random_countries;

    $db = mysqli_connect("mysql","prjctr","qwerty123","prjctr","3306");

    if (isset($_GET["add_records"])) {
        echo "Adding " . $_GET["add_records"] . " uniq clients";

        for ($i = 0; $i < $_GET["add_records"]; $i++) {

            $name = $random_names[array_rand($random_names)]." ".$random_surnames[array_rand($random_surnames)];
            $country = $random_countries[array_rand($random_countries)];
            $last_login = rand(946684800,time()); // 2000 to now

            mysqli_query($db,"INSERT INTO `Clients` (`name`,`country`,`last_login`) VALUES ('$name','$country',$last_login)");

        }


        exit;
    }

    if (isset($_GET["login_from"])) {
        $res = mysqli_query($db, "SELECT count(1) as `connections` FROM `Clients` WHERE `last_login` > ".$_GET["login_from"]);
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_assoc($res);
            echo $row["connections"]." clients logged in since ".date("d-m-Y H:i:s",$_GET["login_from"]);
        } else {
            echo "0 clients logged in since ".date("d-m-Y H:i:s",$_GET["login_from"]);
        }
        exit;
    }

    if (isset($_GET["random_name_count"])) {
        $name = rand(1,2) === 1? $random_names[array_rand($random_names)] : $random_surnames[array_rand($surrandom_names)];
        $res = mysqli_query($db, "SELECT count(1) as `connections` FROM `Clients` WHERE `name` LIKE '%$name%'");
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_assoc($res);
            echo $row["connections"]." clients with name $name";
        } else {
            echo "0 clients with name $name";
        }
        exit;
    }

    if (isset($_GET["random_country_count"])) {
        $country = $random_countries[array_rand($random_countries)];
        $res = mysqli_query($db, "SELECT count(1) as `connections` FROM `Clients` WHERE `country` = '$country'");
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_assoc($res);
            echo $row["connections"]." clients from $country";
        } else {
            echo "0 clients from $country";
        }
        exit;
    }

    if (isset($_GET["all_records_count"])) {
        $res = mysqli_query($db, "SELECT count(1) as `all_records` FROM `Clients` WHERE 1");
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_assoc($res);
            echo $row["all_records"]." clients in DB";
        } else {
            echo "0 clients in DB";
        }
        exit;
    }