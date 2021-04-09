<?php

interface I_User
{
    public function getAllUSers();
    public function getUserByEmail(string $email);
}
 
class User implements I_User
{
    private $userList = [];
 
    public function __construct(array $userList) {
        // $i = 1;
        foreach($userList as $user) {
            // $key = 'uid_' . $i++;
            $this->userList[] = $user;
        }
    } 

    public static function Load(array $userList ) 
    {
        return new User($userList);
    }

    public function getAllUSers() {
        return $this->userList;
    }

    public function getUserByEmail($email)
    {
      $key = array_search($email, array_column($this->userList, "email"));
      if (is_numeric($key)) {
        return $this->userList[$key];
      } 
      return false;     
    }
}


  $list = include(__DIR__ . '/../data/usersList.php');
  // print_r (include(__DIR__ . '/../data/usersList.php'));
  $uo = User::Load($list);
  // print_r( $uo->getAllUsers());
  print_r( $uo->getUserByEmail("user1@mail.me"));

// $array = [
//   "uid-1" => ["name" =>"user1", "email" => "user1@mail.me", "address" => "Address-1", "password" => '$2y$10$CC.fGe7wVCC2LBlc78YMkexFizQgkZKL1j6b/wmZavA33Qk1JKbJW'],
//   "uid-2" => ["name" =>"user2", "email" => "user2@mail.me", "address" => "Address-2", "password" => '$2y$10$CC.fGe7wVCC2LBlc78YMkexFizQgkZKL1j6b/wmZavA33Qk1JKbJW'],
//   "uid-3" => ["name" =>"user3", "email" => "user3@mail.me", "address" => "Address-3", "password" => '$2y$10$CC.fGe7wVCC2LBlc78YMkexFizQgkZKL1j6b/wmZavA33Qk1JKbJW'], 
// ];

// echo array_search("user1@mail.me", array_column($array, "email")); // $key = 2;
// echo array_search('red', $array);   // $key = 1;

?>