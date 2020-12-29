<?php
if(isset($_GET['set_id'])){
    $set_id = $_GET['set_id'];
    } 
if(isset($_GET['q'])){
    $q = $_GET['q'];
    } 
class Product
{

   // database connectie en tabel-naam
   private $conn;
   private $table_name = "attacks";

   // object properties
   public $id;

   // constructor with $db as database connection
   public function __construct($db)
   {
       $this->conn = $db;
   }

   // read products
   function read()
   {
	$query = "SELECT attack_set.figure_id, figures.user, descr, figures.type_1, figures.rarity, figures.type_2, figures.mp, figures.figname, figures.ability_name, figures.ability, attacks.id, attacks.name, attacks.size, attacks.damage, attacks.color, attacks.descr, attacks.set_id FROM attack_set  INNER JOIN attacks ON attack_set.id = attacks.set_id INNER JOIN figures ON attack_set.figure_id = figures.id ORDER BY figures.id DESC";
       $result = $this->conn->query($query);

       return $result;
   }
	   function search($q)
   {
	$query = "SELECT attack_set.figure_id, descr, figures.user, figures.type_1, figures.rarity, figures.type_2, figures.mp, figures.figname, figures.ability_name, figures.ability, attacks.id, attacks.name, attacks.size, attacks.damage, attacks.color, attacks.descr, attacks.set_id FROM attack_set  INNER JOIN attacks ON attack_set.id = attacks.set_id INNER JOIN figures ON attack_set.figure_id = figures.id WHERE figures.figname LIKE '%" . $q . "%' OR figures.user LIKE '%" . $q . "%' ORDER BY figures.id DESC";
       $result = $this->conn->query($query);

       return $result;
   }
   function read_one_set($set_id)
   {
       // select all query
       $query = "SELECT attacks.id, access.password, `name`, figures.user, figures.rarity, figures.mp, size, damage, color, descr, figures.type_1, figures.type_2,  set_id, attack_set.figure_id, figures.ability, figures.ability_name, figures.figname FROM attacks INNER JOIN attack_set ON attacks.set_id = attack_set.id INNER JOIN figures ON attack_set.figure_id = figures.id INNER JOIN access ON figures.id = access.figure_id WHERE set_id = $set_id";  
$result = $this->conn->query($query);
       return $result;
   }
   function create_row($atk_id, $set_id)
   {
       $query1 = "UPDATE ".$this->table_name." SET id = id + 1 WHERE id > ".$atk_id." ORDER BY id DESC";
       $result1 = $this->conn->query($query1);
       $newattack = $atk_id + 1;
       $query = "INSERT INTO ".$this->table_name." (`id`,`set_id`, `name`, `color`, `size`, `damage`, `descr`) VALUES (".$newattack.", ".$set_id.", 'attack_name', 'white', '0', '100', 'none')";
       $result = $this->conn->query($query);
       return $result;
   }
   function create_fig($newname, $password_new, $user_new)
   {
       $query1 = "INSERT INTO figures(figname, ability_name, ability, type_1, type_2, mp, rarity, user) VALUES('$newname', 'ability', 'ability description', 'Normal', 'Normal', 2, 'EX', '$user_new')";
       $result1 = $this->conn->query($query1);

       $query2 = "SELECT id FROM figures ORDER BY id DESC LIMIT 1";
       $result2 = $this->conn->query($query2);
       $row = $result2->fetch_assoc();
       $new_id = $row['id'];

       $query3 = "INSERT INTO attack_set(id, figure_id) VALUES('$new_id', '$new_id')";
       $result3 = $this->conn->query($query3);

       $query4 = "INSERT INTO access(id, figure_id, password) VALUES('$new_id','$new_id', '$password_new')";
       $result4 = $this->conn->query($query4);

       $query4 = "INSERT INTO attacks(set_id, name, color, size, damage, descr) VALUES('$new_id', 'attack', 'white', 50, 50, 'description')";
       $result4 = $this->conn->query($query4);
       



return $result4;

       
   }



   function update_attacks($atk_id, $name, $type)
   {
       // select all query
       $name = str_replace("'", "''", $name);
       $name = str_replace('"', '""', $name);
       if ($type == "name" || $type == "color" || $type == "descr") {
           $query = "UPDATE " . $this->table_name." SET ".$type." = '".$name."' WHERE id=".$atk_id;
       }else{
        $query = "UPDATE " . $this->table_name." SET ".$type." = ".$name." WHERE id=".$atk_id;
       }
       $result = $this->conn->query($query);
       return $result;
       
       
   }
   function update_figure($figure_id, $value, $type)
   {
    $value = str_replace("'", "''", $value);
    $value = str_replace('"', '""', $value);
       // select all query
        $query = "UPDATE figures SET ".$type." = '".$value."' WHERE id=".$figure_id;
    
       $result = $this->conn->query($query);
       return $result;
       
       
   }
function delete($atk_id)
{

    $query = "DELETE  FROM attacks WHERE id = $atk_id";
    $result = $this->conn->query($query);
    $query1 = "UPDATE ".$this->table_name." SET id = id - 1 WHERE id > ".$atk_id." ORDER BY id ASC";
    $result1 = $this->conn->query($query1);
    return $result;
}
function delete_fig($figid)
{
    $query = "DELETE FROM attacks WHERE set_id = $figid";
    $result = $this->conn->query($query);


    $query = "DELETE FROM figures WHERE id = $figid";
    $result = $this->conn->query($query);

    $query = "DELETE FROM access WHERE figure_id = $figid";
    $result = $this->conn->query($query);

    $query = "DELETE FROM attack_set WHERE figure_id = $figid";
    $result = $this->conn->query($query);




    return $result;
}
}