<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersExport implements  WithChunkReading
{
    public function chunkSize(): int
    {
        return 1000;
    }

    public function withChunkCount(): bool
    {
        return true;
    }
}
