<?php
    class UserController
    {
        public function __construct(){}
        
        public function index(){
            echo 'login user';
        }

        public function createTicket(){
            echo 'Ticket created';
        }

        public function updateTicket(){
            echo 'Ticket updated';
        }        

        public function viewTicket(){
            echo 'Ticked view';
        }

        public function closeTicket(){
            echo 'Ticket closed';
        }

        public function comentaryTicket(){
            echo 'Ticket comentary';
        }
    }


?>