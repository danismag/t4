<?php


namespace App\Models;


use T4\Orm\Model;

class Genre
    extends Model
{
    protected static $schema = [

        'columns' => [

            'title' => ['type' => 'string'],
            'description' => ['type' => 'text']
        ],
        'relations' => [

            'music' => ['model' => Music::class, 'type' => self::HAS_MANY]
        ]
    ];

    protected function validateTitle($title)
    {
        if (strlen(trim($title)) < 1) {
            yield new \Exception('Заполните название музыкального жанра');
        }
        if (strlen(trim($title)) < 3) {
            yield new \Exception('Слишком короткое название');
        }
        return true;
    }

    protected function validateDescription($desc)
    {
        if (strlen(trim($desc)) < 1) {
            yield new \Exception('Заполните описание музыкального жанра');
        }
        return true;
    }

    protected function satitizeTitle($title)
    {
        return trim($title);
    }

    protected function satitizeDescription($desc)
    {
        return trim($desc);
    }

}