<?php

declare(strict_types=1);

namespace models;

use Exception;
use PDO;

class Mode
{

    public function getName(): array
    {
      global $PDO;
      try
      {
        $sql = "SELECT * FROM `users`";
        $result = $PDO->prepare($sql);
        $result->execute();

        $users = $result->fetchAll(PDO::FETCH_ASSOC);

        return $users;

      } catch (Exception $e) {
        return  [
          "errors" => $e->getMessage(),
        ];
      }
        
    }

    public function getCourses() {
      global $PDO;
      $stmt = $PDO->prepare("SELECT 
            courses.*,
            course_categories.CategoryName 
            FROM `courses` 
            INNER JOIN course_categories ON 
            course_categories.CategoryID=courses.course_category_id
            WHERE courses.is_deleted=0
            ORDER BY `courses`.`course_id` DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseById(int $id):array 
    {
      global $PDO;
       $stmt = $PDO->prepare("SELECT 
            courses.*,
            course_categories.CategoryName 
            FROM `courses` 
            INNER JOIN course_categories ON 
            course_categories.CategoryID=courses.course_category_id
            WHERE courses.course_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);      
    }
}
