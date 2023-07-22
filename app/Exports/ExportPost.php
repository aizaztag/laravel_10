<?php

namespace App\Exports;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use function Symfony\Component\Translation\DataCollector\sanitizeString;

class ExportPost implements FromCollection, ShouldQueue
{
    public function collection()
    {
        return Post::all();
    }

}
