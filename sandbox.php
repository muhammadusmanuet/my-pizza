<?php
class User
{
    public $name;
    public $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function login()
    {
        echo "You are logged in as " . $this->name;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        if (is_string($name) && strlen($name) > 1) {
            $this->name = $name;
        } else {
            echo 'not a valid name';
        }
    }
}

$user = new User('usman', 'usman@gmail.com');
$user->setName('ab');
echo $user->getName();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>