$database = 'to_do_app';
$localhost = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$localhost;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}