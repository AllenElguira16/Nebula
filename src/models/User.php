<?php

use Nebula\Database\{Model, PrimaryGeneratedColumn, Column};

#[Model()]
class User {

    #[PrimaryGeneratedColumn()]
    public int $id;

    #[Column()]
    public string $firstName;

    #[Column()]
    public string $lastName;

    #[Column()]
    public int $age;

}
