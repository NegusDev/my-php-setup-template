<?php
declare(strict_types=1);

namespace dtos;

use DateTime;

class ExampleDto {
  public int $course_id;
  public string $courseName;
  public String $CategoryName;
  public String $description;
  public String $duration;
  public bool $priority;
  public string $date;

  public function __construct(array $data) {
    $this->course_id = (int) $data['course_id'];
    $this->courseName = $data['course_name'];
    $this->description = $data['course_description'];
    $this->duration = $data['duration'] ?? '';
    $this->priority =  $data['priority'] == 0 ? false : true;
    $this->date = (new DateTime($data['created_at']))->format('d M, Y');
  }

  public function toArray():array {
    return [
      'id' => $this->course_id,
      'courseName' => $this->courseName,
      'description' => $this->description,
      'duration' => $this->duration,
      'priority' => $this->priority,
      'createdBy' => $this->date,
    ];
  }
}
