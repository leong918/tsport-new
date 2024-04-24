<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\PointLogRepository;
use App\Repositories\UserRepository;

class CheckUserPointExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:user_point_expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check user point expiry';

    private PointLogRepository $pointLogRepository;
    private UserRepository $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PointLogRepository $pointLogRepository, UserRepository $userRepository)
    {
        parent::__construct();
        $this->pointLogRepository = $pointLogRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $point_logs = $this->pointLogRepository->getUnusedPoint();

        foreach ($point_logs as &$point_log) {
            $user = $this->userRepository->find($point_log->user_id);
            $user->point -= $point_log->point;
            $user->save();

            $pointLogData['user_id'] = $user->id;
            $pointLogData['point'] = $point_log->point;
            $pointLogData['type'] = 'OUT';
            $pointLogData['remark'] = 'Expired Point Deduction. ID: ' . $point_log->id;
            $this->pointLogRepository->create($pointLogData);

            $point_log->is_expired = 1;
            $point_log->save();
        }
    }
}
