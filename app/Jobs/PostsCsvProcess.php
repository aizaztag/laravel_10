<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostsCsvProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;
    private $header;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $header)
    {
        //
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data as $sale) {
            $saleData = array_combine($this->header, $sale);
            Post::create($saleData);
        }
    }
}
