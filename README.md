# Lista de contatos
## Informações:
Esse projeto consiste em um CRUD capaz de armazenar o nome, telefone e um descrição, caso deseje, do contato

## Tecnologias usadas:

- HTML5
  
- CSS3
  
- BOOTSTRAP site:cdnjs.com
  
- PHP
  
- MySQL
  
- XAMPP

### Banco de dados

1 - Crie uma database da seguinte maneira 
```Mysql
  CREATE DATABASE agenda;  
```

2 - Crie uma tabela
```Mysql
  CREATE TABLE contacts(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150),
    phone VARCHAR(20),
    observations TEXT
  );  
```

### Conexão com o banco

![image](https://github.com/user-attachments/assets/5d5fe9e9-1b92-44c7-a255-e3a796af5bf9)

1 - Em connection.php, mude as variáveis, comforme a sua necessidade: 
    $host = "";
    $dbname = "";
    $user = "";
    $password = ""; 
  

