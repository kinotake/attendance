<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Work;
use App\Http\Requests\WorkRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rest;
use Carbon\Carbon;

class DailyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '日付変更前のDB入力';

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
        $day = \Carbon\Carbon::today();
        $onlyDay=substr("$day","0","10");
        
        $works = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->whereNull('work_end')->update
        ([
        'work_end'=>$onlyDay." "."23:59:59",
        ]);

        $rests = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->whereNull('rest_end')->update
        ([
        'rest_end'=>$onlyDay." "."23:59:59",
        ]);

    }
}
