<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if(isset($_GET['country'])){
  $country = filter_var($_GET['country'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
}else{
  $country = "";
}

$output = 0;
if(isset($_GET['context']) && $_GET['context']=='cities'){
  $context = filter_var($_GET['context'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$country%'");
  $output = 1;
}else{
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if($output == 0){ ?>
<table>
  <thead>
    <th>Country Name </th>
    <th>Continent </th>
    <th>Independence </th>
    <th>Head of State </th>
  </thead>
<?php foreach ($results as $row): ?>
  <tr>
    <td><?= $row['name']; ?> </td>
    <td><?= $row['continent']; ?> </td>
    <td><?= $row['independence_year']; ?> </td>
    <td><?= $row['head_of_state']; ?> </td>
  </tr>
<?php endforeach; ?>
  </thead>
</table>
<?php }else{ ?>
<table>
  <thead>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
  </thead>
<?php foreach ($results as $row): ?>
  <tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['district'] ?></td>
    <td><?= $row['population'] ?></td>
  </tr>
<?php endforeach; ?>
  </thead>
</table>
<?php } ?>
