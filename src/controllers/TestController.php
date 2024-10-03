<?php
declare(strict_types=1);

namespace controllers;

use core\Controller;
use Exception;
use helpers\Response;
use service\impl\ExampleServiceImpl;

class TestController extends Controller
{
  private ExampleServiceImpl $exampleService;
  public function __construct()
  {
    $this->exampleService = new ExampleServiceImpl();
  }

  public function index()
  {
    $courses = $this->exampleService->getCourses();
    Response::send($courses);
  }

  public function show(int $id)
  {
    try {
      $course = $this->exampleService->getCourseById($id);
      Response::send($course->toArray());
    } catch (Exception $e) {
      http_response_code(500);
      $error = [
        'message' => $e->getMessage(),
      ];
      Response::send($error);
    }
  }
}
