<?php
class Dog {
    protected $size = "medium";
    protected $breed = "Amstaff";

    function properties() {
        echo $this->size . "<br/>" . $this->breed;
    }
}


$firstDog = new Dog();
$firstDog->properties();

?>
