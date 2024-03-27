<?php

namespace App\Models\ValueObjects;

final class Title
{
   private $value;

   public function __construct(string $value)
   {
       if (empty($value)) {
           throw new \InvalidArgumentException("Title cannot be empty");
       }
       $this->value = $value;
   }

   public function getValue(): string
   {
       return $this->value;
   }
   
   public function __toString() {
       return $this->getValue();
   }
}