<?php

declare(strict_types=1);

namespace models;

use PDO;

class Mode
{

    public function getName(): array
    {
        global $PDO;
        $sql = "SELECT * FROM `users`";
        $result = $PDO->prepare($sql);
        $result->execute();

        $users = $result->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
}
