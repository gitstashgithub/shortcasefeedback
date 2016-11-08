<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ExaminationsTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'examinations';
        $this->filename = base_path() . '/database/seeds/csv/examinations.csv';
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();

//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        // Uncomment the below to wipe the table clean before populating
//        DB::table($this->table)->truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        parent::run();
    }
}