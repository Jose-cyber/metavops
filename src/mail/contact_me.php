<?php
// Check for empty fields
if(empty($_POST['name'])    || 
   empty($_POST['email'])   || 
   empty($_POST['phone'])   || 
   empty($_POST['message']) || 
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
    header('location:../contact.html');
    return false;
   }
else{
     $name = $_POST['name'];
     $email  = $_POST['email'];
     $phone = $_POST['phone'];
     $message = $_POST['message'];
}

// connection DB
$servername = getenv("DB_HOST");
$database =  getenv("MYSQL_DATABASE");
$username = getenv("USER_DB");
$password = getenv("MYSQL_ROOT_PASSWORD");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// crate table on database
$create_table = "CREATE TABLE IF NOT EXISTS formulario (id INT(11) AUTO_INCREMENT, nome VARCHAR(255), email VARCHAR(255), telefone VARCHAR(255), mensagem VARCHAR(255), PRIMARY KEY (id));";

// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
if(mysqli_query($conn, $create_table)){
   //  echo "tabela criada com sucesso!";
}
else {
      echo "Error: " . $create_table . "<br>" . mysqli_error($conn);
}


$sql = "INSERT INTO FORM_SITE.formulario (nome, email, telefone, mensagem) VALUES ('$name', '$email', '$phone', '$message')";

if (mysqli_query($conn, $sql)) {
  // echo "New record created successfully";
  // header('location:contact.html');
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>
