<?php

    //fetch_data.php

    $connect = new PDO("mysql:host=localhost;dbname=fileattente_bidew_multi", "root", "");

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'GET'){
        $data = array(
            ':USRMATRICULE'   => "%" . $_GET['MATRICULE'] . "%",
            ':USRNOM'     => "%" . $_GET['NOM'] . "%",
            ':USRCODE'   => "%" . $_GET['CODE'] . "%",
            ':USRPRENOM'    => "%" . $_GET['PRENOM'] . "%",
            ':PROFIL'   => "%" . $_GET['PROFIL'] . "%"

        );
        //$query = "SELECT * FROM sample_data WHERE first_name LIKE :first_name AND last_name LIKE :last_name AND age LIKE :age AND gender LIKE :gender ORDER BY id DESC";
        $query = "SELECT * FROM fa_tusers WHERE USRMATRICULE LIKE :USRMATRICULE  and USRNOM LIKE :USRNOM and USRPRENOM LIKE :USRPRENOM and PROFIL LIKE :PROFIL and USRCODE LIKE :USRCODE  ORDER BY USRCODE DESC";

        $statement = $connect->prepare($query);
        $statement->execute($data);
        $result = $statement->fetchAll();
        foreach($result as $row){
            $output[] = array(
            'USRCODE'    => $row['USRCODE'],   
            'MATRICULE'  => $row['USRMATRICULE'],
            'NOM'   => $row['USRNOM'],
            'CODE'  => $row['USRCODE'],
            'PRENOM'    => $row['USRPRENOM'],
            'PROFIL'    => $row['PROFIL']
            );
        }
        header("Content-Type: application/json");
        echo json_encode($output);
    }

    if($method == "POST"){
        $data = array(
        ':first_name'  => $_POST['first_name'],
        ':last_name'  => $_POST["last_name"],
        ':age'    => $_POST["age"],
        ':gender'   => $_POST["gender"]
        );

        $query = "INSERT INTO sample_data (first_name, last_name, age, gender) VALUES (:first_name, :last_name, :age, :gender)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
    }

    if($method == 'PUT'){
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = array(
        ':id'   => $_PUT['id'],
        ':first_name' => $_PUT['first_name'],
        ':last_name' => $_PUT['last_name'],
        ':age'   => $_PUT['age'],
        ':gender'  => $_PUT['gender']
        );
        $query = "
        UPDATE sample_data 
        SET first_name = :first_name, 
        last_name = :last_name, 
        age = :age, 
        gender = :gender 
        WHERE id = :id
        ";
        $statement = $connect->prepare($query);
        $statement->execute($data);
    }

    if($method == "DELETE"){
        parse_str(file_get_contents("php://input"), $_DELETE);
        $query = "DELETE FROM sample_data WHERE id = '".$_DELETE["id"]."'";
        $statement = $connect->prepare($query);
        $statement->execute();
    }

?>
