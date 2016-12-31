<?php

class ValidationResult
{
private $value;
private $errorMessage;
private $isValid = true;

public function __construct($value, $errorMessage,$isValid) {
$this->value = $value;
$this->errorMessage = $errorMessage;
$this->isValid = $isValid;
}
public function getValue() {
return $this->value;
}
public function getErrorMessage() {
return $this->errorMessage;
}
public function isValid() {
return $this->isValid;
}
public static function checkParameter($queryName, $pattern , $errMsg) {
$error = "";
$value = "";
$isValid = "true";

if(empty($_POST[$queryName])) {
$error = $errMsg;
$isValid = false;
} else {
$value = $_POST[$queryName];
if(!preg_match($pattern,$value)) {
$error = $errMsg;
$isValid = false;
}
}
return new ValidationResult($value, $error, $isValid);
}
}
?>