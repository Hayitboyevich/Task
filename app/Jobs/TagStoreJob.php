<?php

namespace App\Jobs;

use App\Http\Requests\TagRequest;
use App\Mail\TagMail;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TagStoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public  $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TagRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        DB::beginTransaction();
        try {
            $path = $this->request->file('image')->store('tag');
            $tag = Tag::create([
                'title' => $this->request->title,
                'image' => $path,
                'user_id' => Auth::id(),
            ]);

//            $users = User::all();
//            foreach ($users as $user) {
//                Mail::to($user->email)->send(new TagMail($tag));
//            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $tag;

    }
}
