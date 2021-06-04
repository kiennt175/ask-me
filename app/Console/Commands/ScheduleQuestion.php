<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Question;
use Carbon\Carbon;
use App\Notifications\PublishQuestion;
use Pusher\Pusher;

class ScheduleQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:question';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule to post question';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $scheduleQuestions = Question::with('user')->where('schedule_time', '<=', Carbon::now())
        ->where('status', 0)
        ->get();
        $scheduleQuestions->each->update(['status' => 1]);

        $options = [
            'cluster' => 'ap1',
            'encrypted' => true
        ];
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        foreach ($scheduleQuestions as $scheduleQuestion) {
            $data = [
                'question_id' => $scheduleQuestion->id,
                'question_title' => $scheduleQuestion->title
            ];
            $scheduleQuestion->user->notify(new PublishQuestion($data));
            $pusher->trigger('PublishQuestionNotiEvent', 'publish-question', $data);

        }

    }
}
