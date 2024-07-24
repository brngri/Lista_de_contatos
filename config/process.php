<?php

session_start();
include_once ("connection.php");
include_once ("url.php");

$data = $_POST;

// MODIFICAÇÔES NO BANCO
if (!empty($data)) {
    // CRIANDO CONTATO
    if ($data["type"] === "create") {

        $name = $data["name"];
        $phone = $data["phone"];
        $observations = $data["observations"];

        $sql = "INSERT INTO contacts(name,phone,observations) VALUES(:name,:phone,:observations)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":observations", $observations);

        try {
            $statement->execute();
            $_SESSION["msg"] = "Contato criado com sucesso!";
    
        } catch (PDOException $e) {
            //erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    }else if($data["type"] === "edit"){

        $name = $data["name"];
        $phone = $data["phone"];
        $observations = $data["observations"];
        $id = $data["id"];

        $sql = "UPDATE contacts SET name= :name, phone= :phone, observations= :observations WHERE id= :id";

        $statement = $conn->prepare($sql);

        $statement->bindParam(":name",$name);
        $statement->bindParam(":phone",$phone);
        $statement->bindParam(":observations",$observations);
        $statement->bindParam(":id",$id);

        try{
            $statement->execute();
            $_SESSION["msg"] = "Contato atualizado com sucesso!";
        }catch(PDOException $e){
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    }else if($data["type"] === "delete"){
        $id = $data["id"];

        $sql = "DELETE * FROM contacts WHERE id= :id";
        $statement = $conn->prepare($sql);

        $statement->bindParam(":id", $id);
        
        try{
            $statement->execute();
            $_SESSION["msg"] = "Contato deleteado com sucesso";
        }catch(PDOException $e){
            $error = $e->getMessage();
            echo "Erro: ".$error;
        }
    }


    // Redirect HOME
    header("Location:" . $BASE_URL . "../index.php");

// SELEÇÕES DE DADOS
} else {
    $id;
    if (!empty($_GET)) {
        $id = $_GET["id"];
    }
    // Retorna o dado de um contato
    if (!empty($id)) {
        $sql = "SELECT * FROM contacts WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $contact = $statement->fetch();
    } else {
        // Retorna todos os contatos
        $contacts = [];

        $sql = "SELECT * FROM contacts";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $contacts = $statement->fetchAll();
    }
}

// FECHAR CONEXÂO
$conn = null;

