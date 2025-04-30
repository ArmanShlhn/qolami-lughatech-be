<?php

namespace Database\Seeders;

use App\Models\Todolist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todolist::insert([
            [    'tittle' => 'Belajar Laravel',
                'desc' => 'Belajar Laravel',
                'its_done' => false,
            ],
            [
                'tittle' => 'Belajar Laravel',
                'desc' => 'adonis',
                'its_done' => true,
            ]
        ]);
    }
}
