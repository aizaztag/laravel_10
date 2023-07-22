<?php

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class LargeDataExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return DB::table('posts')
            ->select('column1', 'column2', 'column3');
    }

    public function headings(): array
    {
        return ['Column 1', 'Column 2', 'Column 3'];
    }
}


