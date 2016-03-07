<?php
require_once "config.php";

class Message
{

    private $type;
    private $message;

    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getType()
    {
        return $this->type;
    }
}

class MessagesList
{

    private static $messages = [];

    public static function put($message = '', $type = 'error')
    {
        $message = new Message($type, $message);
        self::$messages[] = $message;
    }

    public static function getAll()
    {
        return self::$messages;
    }

    public static function getAllErrors()
    {
        $errors = [];
        foreach(self::$messages as $message){
            if($message->getType() == "error"){
                $errors[] = $message;
            }
        }
        return $errors;
    }
    public static function hasMessages()
    {
        if (count(self::$messages) > 0) {
            return true;
        }

        return false;
    }

    public static function hasErrors()
    {
        foreach(self::$messages as $message){
            if($message->getType() == "error"){
                return true;
            }
        }
        return false;
    }
}

class ViewData
{

    private static $view_data = [];

    public static function put($key, $data)
    {
        self::$view_data[$key] = $data;
    }

    public static function getAll()
    {
        return self::$view_data;
    }

    public static function get($key)
    {
        if (isset(self::$view_data[$key])) {
            return self::$view_data[$key];
        }

        return null;
    }
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=' . Config::get('mysql.db_name'), Config::get('mysql.user'), Config::get('mysql.pass'));
    $pdo->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    MessagesList::put($e->getMessage());
} catch (Exception $e) {
    MessagesList::put($e->getMessage());
}

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($page) && $page == "index") {
            $query = "SELECT p.name, p.surname, p.id_person, oh.id_OH, u.id as id_um, u.discipline, u.place, oh.year, oh.city, oh.country, oh.type FROM osoby as p
JOIN umiestnenia as u ON p.id_person = u.id_person
JOIN oh ON oh.id_OH = u.ID_OH";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $persons = [];
            while ($row = $stmt->fetchObject()) {
                $persons[] = $row;
            }
            ViewData::put('persons', $persons);
        }
        if (isset($page) && $page == "action" && isset($method) && $method == "edit" && isset($id_person) && isset($id_um)) {
            $query = "SELECT * FROM osoby WHERE id_person=:id_person";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_person', $id_person);
            $stmt->execute();

            ViewData::put('person', $stmt->fetchObject());

            $query = "SELECT * FROM umiestnenia WHERE id=:id_um";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_um', $id_um);
            $stmt->execute();

            ViewData::put('placement', $stmt->fetchObject());

            $query = "SELECT * FROM oh";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $ohs = [];
            while ($row = $stmt->fetchObject()) {
                $ohs[] = $row;
            }
            ViewData::put('ohs', $ohs);
        }
        if (isset($page) && $page == "action" && isset($method) && $method == "delete" && isset($id_person)) {
            $query = "SELECT * FROM osoby WHERE id_person=:id_person";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_person', $id_person);
            $stmt->execute();

            ViewData::put('person', $stmt->fetchObject());

        }
        if (isset($page) && $page == "action" && isset($method) && $method == "create") {
            $query = "SELECT * FROM oh";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $ohs = [];
            while ($row = $stmt->fetchObject()) {
                $ohs[] = $row;
            }
            ViewData::put('ohs', $ohs);

        }
        if (isset($page) && $page == "sportsman" && isset($id_person)) {
            $query = "SELECT p.name, p.surname, p.id_person FROM osoby as p WHERE id_person=:id_person";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_person', $id_person);
            $stmt->execute();

            $person = $stmt->fetchObject();

            ViewData::put('person', $person);

            if($person){
                $query = "SELECT u.id as id_um, u.id_person, u.discipline, u.place, oh.year, oh.city, oh.country, oh.type FROM umiestnenia as u
JOIN oh ON oh.id_OH = u.ID_OH WHERE u.id_person=:id_person";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_person', $id_person);
                $stmt->execute();

                $placements = [];
                while ($row = $stmt->fetchObject()) {
                    $placements[] = $row;
                }
                ViewData::put('placements', $placements);
            } else {
                MessagesList::put('Person with id "['.$id_person.']" not found!');
            }

        }
        if (isset($page) && $page == "action" && isset($method) && $method == "delete-placement") {
            $query = "DELETE FROM umiestnenia WHERE id=:id_um";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_um', $id_um);
            $stmt->execute();

            header('Location: /sportovec?id='.$_GET['id_person']);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $method = $_GET['method'];
        $id_person = isset($_GET['id_person']) ? $_GET['id_person'] : '';
        $id_um = isset($_GET['id_um']) ? $_GET['id_um'] : '';

        if (isset($page) && $page == "action" && isset($method) && $method == "delete" && isset($id_person)) {
            $query = "DELETE FROM osoby WHERE id_person=:id_person";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_person', $id_person);
            $stmt->execute();

            header('Location: /');
        }
        if (isset($page) && $page == "action" && isset($method) && $method == "edit" && isset($id_person) && isset($id_um)) {
            $query = "UPDATE osoby SET name=:name, surname=:surname, birthDay=:birthDay, birthPlace=:birthPlace, birthCountry=:birthCountry, deathDay=:deathDay, deathPlace=:deathPlace, deathCountry=:deathCountry WHERE id_person=:id_person";
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(':id_person', $id_person);
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':surname', $_POST['surname']);
            $stmt->bindParam(':birthDay', $_POST['birthDay']);
            $stmt->bindParam(':birthPlace', $_POST['birthPlace']);
            $stmt->bindParam(':birthCountry', $_POST['birthCountry']);
            $stmt->bindParam(':deathDay', $_POST['deathDay']);
            $stmt->bindParam(':deathPlace', $_POST['deathPlace']);
            $stmt->bindParam(':deathCountry', $_POST['deathCountry']);
            $stmt->execute();

            $query = "UPDATE umiestnenia SET ID_OH=:ID_OH, place=:place, discipline=:discipline WHERE id=:id_um";
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(':id_um', $id_um);
            $stmt->bindParam(':ID_OH', $_POST['ID_OH']);
            $stmt->bindParam(':place', $_POST['place']);
            $stmt->bindParam(':discipline', $_POST['discipline']);
            $stmt->execute();

            header('Location: /');
        }

        if (isset($page) && $page == "action" && isset($method) && $method == "create" && $_GET['model'] == "placement") {
            $query = "INSERT INTO umiestnenia VALUES(0 ,:id_person, :ID_OH, :place, :discipline)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':ID_OH', $_POST['ID_OH']);
            $stmt->bindParam(':place', $_POST['place']);
            $stmt->bindParam(':discipline', $_POST['discipline']);
            $stmt->bindParam(':id_person', $_POST['id_person']);

            $stmt->execute();

            header('Location: /sportovec?id='.$_POST['id_person']);
        }

        if (isset($page) && $page == "action" && isset($method) && $method == "create" && $_GET['model'] == "person") {
            var_dump($_POST);
            $query = "INSERT INTO osoby VALUES(0 ,:name, :surname, :birthDay, :birthPlace, :birthCountry, :deathDay, :deathPlace, :deathCountry)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':surname', $_POST['surname']);
            $stmt->bindParam(':birthDay', $_POST['birthDay']);
            $stmt->bindParam(':birthPlace', $_POST['birthPlace']);
            $stmt->bindParam(':birthCountry', $_POST['birthCountry']);
            $stmt->bindParam(':deathDay', $_POST['deathDay']);
            $stmt->bindParam(':deathPlace', $_POST['deathPlace']);
            $stmt->bindParam(':deathCountry', $_POST['deathCountry']);

            $stmt->execute();

//            header('Location: /');
        }
    }

    $dbh = null;
} catch (PDOException $e) {
    var_dump($e);
    MessagesList::put($e->getMessage());
} catch (Exception $e) {
    var_dump($e);
    MessagesList::put($e->getMessage());
}