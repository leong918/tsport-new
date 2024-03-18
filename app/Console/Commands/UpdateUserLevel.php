<?php

namespace App\Console\Commands;

use App\Repositories\LevelChangeLogRepository;
use App\Repositories\LevelRepository;
use App\Repositories\UserRepository;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateUserLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:user_level';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user level';

    private UserRepository $userRepository;
    private LevelChangeLogRepository $levelChangeLogRepository;
    private LevelRepository $levelRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, LevelChangeLogRepository $levelChangeLogRepository, LevelRepository $levelRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->levelRepository = $levelRepository;
        $this->levelChangeLogRepository = $levelChangeLogRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user_list = $this->userRepository->makeModel()->where('status',1)->where('level_id', '!=', '1')->whereDate('level_validity', Carbon::today()->subDay())->get();
        $lowest_level = $this->levelRepository->getLowestLeveling();

        foreach($user_list as $user){
            $data['user_id'] = $user->id;
            $data['level_id'] = $user->level_id;
            $data['new_level_id'] = $lowest_level->id;
            $data['remark'] = 'Downgrade due to the inability to reach the sales amount.';
            $data['previous_validity'] = $user->level_validity;
            $data['current_validity'] = null;

            $this->levelChangeLogRepository->createLevelLog($data);
            
            $user->level_id = $lowest_level->id;
            $user->level_validity = null;
            $user->save();
        }
    }
}
