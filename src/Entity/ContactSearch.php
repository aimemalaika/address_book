<?php
    namespace App\Entity;


    class ContactSearch {
        private $name;

        

        /**
         * Get the value of name
         */
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         */
        public function setName($name): self
        {
                $this->name = $name;

                return $this;
        }
    }

