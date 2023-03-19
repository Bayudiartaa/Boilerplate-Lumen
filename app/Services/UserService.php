<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
   protected $userRepository;

   public function __construct(UserRepository $userRepository) {
      $this->userRepository = $userRepository;
   }

   public function createUser(array $data) {
      $user = $this->userRepository->create($data);
      return $user;
   }

   public function updateUser(int $id, array $data) {
      $user = $this->userRepository->update($id, $data);
      return $user;
   }

   public function deleteUser(int $id) {
      return $this->userRepository->delete($id);
   }
}
