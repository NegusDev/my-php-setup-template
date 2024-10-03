<?php
declare(strict_types=1);

namespace service;

use dtos\ExampleDto;

interface ExampleService {
  public function getCourses():array;
  public function getCourseById(int $id):ExampleDto;
}
