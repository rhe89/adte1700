<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 03.02.15
 * Time: 15.15
 */

class Person {
    private $name, $phone, $mail;

    public function __construct($name, $phone, $mail) {
        $this->name = $name;
        $this->phone = $phone;
        $this->mail = $mail;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getMail()
    {
        return $this->mail;
    }
}
?>