<?php
declare(strict_types=1);

namespace service\impl;

use dtos\ExampleDto;
use models\Mode;
use service\ExampleService;

class ExampleServiceImpl implements ExampleService {
  private Mode $courseModel;
  public function __construct()
  {
    $this->courseModel = new Mode();
  }

  public function getCourses(): array
  {
    $courses = $this->courseModel->getCourses();
    $results = [];

    foreach($courses as $course) {
      $results[] = new ExampleDto($course);
    }
    return $results;
  }

  public function getCourseById(int $id):ExampleDto 
  {
    $course = $this->courseModel->getCourseById($id);
    return new ExampleDto($course);
  }
}
