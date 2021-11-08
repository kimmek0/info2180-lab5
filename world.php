<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
//$stmt = $conn->query("SELECT * FROM countries");
// if(isset($_GET['country'])){
//   $country = $_GET['country'];
//   $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
if(isset($_GET['context'])){
  $context=filter_var($_GET['context'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
}

// if(!isset($_GET['country'])){
//   $stmt = $conn->query("SELECT * FROM countries");
$country=filter_var($_GET['country'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$search="countries";
if(isset($country)){
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
}else{
    $stmt = $conn->query("SELECT * FROM countries");
  }


if(isset($context)=="cities"){
  $search="cities";
  if(isset($country)){
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$country%'");
  }else{
      $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code;"); 
  }
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if ($search == "countries"):?>
<table>
  <thead>
      <tr>
          <th>Name</th>
          <th>Continent</th>
          <th>Idependence</th>
          <th>Head of State</th>
      </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row): ?>
      <tr>
          <td><?= $row['name']; ?></td>
          <td><?= $row['continent']; ?></td>
          <td><?= $row['independence_year']; ?></td>
          <td><?= $row['head_of_state']; ?></td>
      </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

<?php if ($search == "cities"):?>
<table>
  <thead>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row): ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['district'] ?></td>
        <td><?= $row['population'] ?></td>
      </tr>
  <?php endforeach; ?>
  </tbody>
  </table>
  <?php endif; ?> 
