<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PostModelCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:post-model-c-s-v';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //optimize it
        $num_rows = 100000;

// Create a header row
        $headers = array("Name", "Description", "Date");

// Create an empty array to store the data rows
        $rows = array();

// Generate random data and add it to the rows array
        //dd($faker);
        for ($i = 0; $i < $num_rows; $i++) {
            // Generate a random name
            $name = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 10);

            // Generate a random description
            $description = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 20);;

            // Generate a random date between 5 years ago and today

            $dateString = '2023-04-05';
            $date = Carbon::parse($dateString);
            $randomDate = $date->addDays(rand(-7, 7))->format('Y-m-d');
            $date = $randomDate;

            // Add the data row to the rows array
            $rows[] = array($name, $description, $date);
        }

// Create a CSV file and write the header row
        $filename = 'data.csv';
        $file = fopen('php://temp', 'w');
        fputcsv($file, $headers);

// Write the data rows to the file
        foreach ($rows as $row) {
            fputcsv($file, $row);
        }

// Save the file to the storage disk
        rewind($file);
        Storage::disk('local')->put($filename, stream_get_contents($file));
        fclose($file);
    }
}
