<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::firstOrCreate(['id' => 1,'title' => 'new']);
        Status::firstOrCreate(['id' => 2,'title' => 'at_work']);
        Status::firstOrCreate(['id' => 3,'title' => 'completed']);
    }
}
