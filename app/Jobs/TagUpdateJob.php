<?php

namespace App\Jobs;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TagUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tag;
    public $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request, Tag $tag)
    {
        $this->request = $request;
        $this->tag = $tag;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->request->hasFile('image')){
            $path = $this->request->file('image')->store('tag');
        }

        $this->tag->title = $this->request->title;
        $this->tag->image = $path ?? $this->tag->image;
        $this->tag->save();
    }
}
