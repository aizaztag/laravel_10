<?php

namespace App\Http\Controllers;

use App\Jobs\PostsCsvProcess;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->has('mycsv')) {
            $data = file(request()->mycsv);
            // Chunking file
            $chunks = array_chunk($data, 1000);

            $header = [];
            $batch = Bus::batch([])->name('Import Posts')->dispatch();

            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new PostsCsvProcess($data, $header));
            }

            return $batch;
        }

        return 'please upload file';
    }


    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }


    public function download()
    {
        //return Excel::download(new ExportPost(),'users.csv', \Maatwebsite\Excel\Excel::CSV);return (new InvoicesExport)->store('invoices.xlsx', 's3');

        // Get the data from the database
        $data = DB::table('posts')->select('id', 'title', 'description')->get();

// Open a memory buffer for writing
        $buffer = fopen('php://memory', 'w');

// Write the headers to the CSV file
        fputcsv($buffer, ['ID', 'Name',]);

// Loop through the data and write each row to the CSV file
        foreach ($data as $row) {
            fputcsv($buffer, [$row->id, $row->title, $row->description]);
        }

// Reset the pointer to the beginning of the buffer
        rewind($buffer);

// Set the HTTP headers to indicate a CSV file download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="posts.csv"',
        ];

// Return the CSV data as a download
        return response()->streamDownload(function () use ($buffer) {
            fpassthru($buffer);
        }, 'posts.csv', $headers);
    }

    public function filter_post(Request $request)
    {
        //pipeline
//        $posts = app(Pipeline::class)
//            ->send(Post::query())
//            ->through([
//                          \App\Filters\Filters::class,
//                          //\App\Filters\Sort::class
//                      ])
//            ->thenReturn();
       // dd($posts->get()->toArray());
        //scope method
         $posts = Post::query()
                    ->postFilter()
                    ->get();
        dd($posts->toArray());
    }
}
