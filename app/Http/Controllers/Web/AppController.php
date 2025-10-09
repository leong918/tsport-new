<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Event;
use App\Models\Matches;
use App\Repositories\EventRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class AppController extends BaseController
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index()
    {
        return $this->view('index');
    }

    public function liveMatches(Request $request)
    {
        // Get all active matches from database
        $allMatches = Matches::active()->get();
        
        // Separate top matches for swiper and regular matches for bottom content
        $topMatches = $allMatches->where('is_top', true);
        $regularMatches = $allMatches->where('is_top', false);
        
        // Format top matches data for the swiper
        $swiperMatches = $topMatches->map(function ($match) {
            return [
                'id' => $match->id,
                'title' => $match->match_title,
                'league' => $match->short_content ?? 'Sports League',
                'status' => $match->status == 1 ? '直播中' : '已结束',
                'image' => $match->banner_url ?? '/assets/web/assets/img/matches/default.jpg',
                'time' => $match->start_at ? $match->start_at->format('Y/m/d H:i') : 'TBD',
                'is_top' => true
            ];
        })->values()->toArray();
        
        // Format regular matches data for the bottom content
        $allContentMatches = $regularMatches->map(function ($match) {
            return [
                'id' => $match->id,
                'title' => $match->match_title,
                'league' => $match->short_content ?? 'Sports League',
                'status' => $match->status == 1 ? '直播中' : '已结束',
                'image' => $match->banner_url ?? '/assets/web/assets/img/matches/default.jpg',
                'time' => $match->start_at ? $match->start_at->format('Y/m/d H:i') : 'TBD',
                'is_top' => false
            ];
        })->values()->toArray();

        // If no matches in database, fall back to mock data
        if (empty($swiperMatches) && empty($allContentMatches)) {
            $fallbackMatches = $this->getFallbackMatches();
            $swiperMatches = array_values(array_filter($fallbackMatches, function($match) {
                return $match['is_top'] === true;
            }));
            $allContentMatches = array_values(array_filter($fallbackMatches, function($match) {
                return $match['is_top'] === false;
            }));
        }

        // Pagination for content matches (4 per page)
        $perPage = 4;
        $currentPage = $request->get('page', 1);
        $currentPath = $request->url();
        
        // Create paginator for content matches
        $contentMatchesPaginated = new LengthAwarePaginator(
            array_slice($allContentMatches, ($currentPage - 1) * $perPage, $perPage),
            count($allContentMatches),
            $perPage,
            $currentPage,
            [
                'path' => $currentPath,
                'pageName' => 'page'
            ]
        );

        return $this->view('live-matches', [
            'swiperMatches' => $swiperMatches,
            'contentMatches' => $contentMatchesPaginated
        ]);
    }

    public function events()
    {
        // Get formatted active events from repository
        $events = $this->eventRepository->getFormattedActiveEvents();

        // If no events in database, fall back to static data
        if (empty($events)) {
            $events = $this->getFallbackEvents();
        }

        return $this->view('events', compact('events'));
    }

    public function ordering()
    {
        // Mock ordering data - replace with actual database queries
        $categories = [
            [
                'id' => 1,
                'name' => '点',
                'icon' => 'dian',
                'items' => [
                    ['id' => 1, 'name' => '大推小荐球', 'price' => 28.00, 'description' => '酷然君加料推荐', 'image' => null],
                    ['id' => 2, 'name' => '热门推荐', 'price' => 35.00, 'description' => '今日热门选择', 'image' => null],
                    ['id' => 3, 'name' => '精选推荐', 'price' => 42.00, 'description' => '专家精选', 'image' => null],
                ]
            ],
            [
                'id' => 2,
                'name' => '单',
                'icon' => 'dan',
                'items' => [
                    ['id' => 4, 'name' => '盘推口荐', 'price' => 25.00, 'description' => '国哥君推荐', 'image' => null],
                    ['id' => 5, 'name' => '单场分析', 'price' => 30.00, 'description' => '深度分析', 'image' => null],
                    ['id' => 6, 'name' => '专业预测', 'price' => 38.00, 'description' => '专业团队预测', 'image' => null],
                ]
            ],
            [
                'id' => 3,
                'name' => '区',
                'icon' => 'qu',
                'items' => [
                    ['id' => 7, 'name' => '串推单荐', 'price' => 45.00, 'description' => '摩洛Special推荐', 'image' => null],
                    ['id' => 8, 'name' => '组合推荐', 'price' => 50.00, 'description' => '多场组合', 'image' => null],
                    ['id' => 9, 'name' => '高级套餐', 'price' => 68.00, 'description' => '全场覆盖', 'image' => null],
                ]
            ]
        ];

        $recommendations = [
            [
                'expert' => '酷然君',
                'avatar' => '/assets/web/assets/img/experts/expert1.jpg',
                'title' => '大推小荐球',
                'description' => '今日热门推荐',
                'badge' => 'hot'
            ],
            [
                'expert' => '国哥君',
                'avatar' => '/assets/web/assets/img/experts/expert2.jpg',
                'title' => '盘推口荐',
                'description' => '专业分析推荐',
                'badge' => 'recommended'
            ],
            [
                'expert' => '摩洛Special',
                'avatar' => '/assets/web/assets/img/experts/expert3.jpg',
                'title' => '串推单荐',
                'description' => '高胜率组合',
                'badge' => 'special'
            ]
        ];

        return $this->view('ordering', compact('categories', 'recommendations'));
    }

    private function getFallbackEvents()
    {
        return [
            [
                'id' => 1,
                'title' => '猜胜负赢奖金',
                'status' => '进行中',
                'image' => asset('assets/web/images/events/title.png'),
                'timer' => '03天04小时57分钟',
            ],
            [
                'id' => 2,
                'title' => '波神来啦-季节赛',
                'status' => '即将开始',
                'image' => asset('assets/web/images/events/title.png'),
                'timer' => '03天04小时57分钟',
            ],
            [
                'id' => 3,
                'title' => 'FIFA世界杯预选赛',
                'status' => '即将开始',
                'image' => asset('assets/web/images/events/title.png'),
                'timer' => '05天12小时30分钟',
            ]
        ];
    }

    private function getFallbackMatches()
    {
        return [
            // Top matches for swiper
            [
                'id' => 1,
                'title' => '曼市 vs 曼联',
                'league' => '英超联赛 2024/25 第2轮',
                'status' => '直播中',
                'image' => '/assets/web/assets/img/matches/match1.jpg',
                'time' => '2024/25 第2轮',
                'is_top' => true
            ],
            [
                'id' => 3,
                'title' => '切尔西 vs 托特纳姆',
                'league' => '英超联赛 2024/25 第2轮',
                'status' => '已结束',
                'image' => '/assets/web/assets/img/matches/match3.jpg',
                'time' => '2024/25 第2轮',
                'is_top' => true
            ],
            // Regular matches for content area (more than 4 to show pagination)
            [
                'id' => 2,
                'title' => '阿森纳 vs 利物浦',
                'league' => '英超联赛 2024/25 第2轮',
                'status' => '即将开始',
                'image' => '/assets/web/assets/img/matches/match2.jpg',
                'time' => '2024/25 第2轮',
                'is_top' => false
            ],
            [
                'id' => 4,
                'title' => '莱斯特城 vs 布莱顿',
                'league' => '英超联赛 2024/25 第2轮',
                'status' => '即将开始',
                'image' => '/assets/web/assets/img/matches/match4.jpg',
                'time' => '2024/25 第2轮',
                'is_top' => false
            ],
            [
                'id' => 5,
                'title' => '狼队 vs 水晶宫',
                'league' => '英超联赛 2024/25 第2轮',
                'status' => '已结束',
                'image' => '/assets/web/assets/img/matches/match5.jpg',
                'time' => '2024/25 第2轮',
                'is_top' => false
            ],
            [
                'id' => 6,
                'title' => '埃弗顿 vs 南安普顿',
                'league' => '英超联赛 2024/25 第2轮',
                'status' => '即将开始',
                'image' => '/assets/web/assets/img/matches/match6.jpg',
                'time' => '2024/25 第2轮',
                'is_top' => false
            ],
            [
                'id' => 7,
                'title' => '诺丁汉森林 vs 富勒姆',
                'league' => '英超联赛 2024/25 第3轮',
                'status' => '即将开始',
                'image' => '/assets/web/assets/img/matches/match7.jpg',
                'time' => '2024/25 第3轮',
                'is_top' => false
            ],
            [
                'id' => 8,
                'title' => '伯恩茅斯 vs 西汉姆',
                'league' => '英超联赛 2024/25 第3轮',
                'status' => '已结束',
                'image' => '/assets/web/assets/img/matches/match8.jpg',
                'time' => '2024/25 第3轮',
                'is_top' => false
            ],
            [
                'id' => 9,
                'title' => '纽卡斯尔 vs 阿斯顿维拉',
                'league' => '英超联赛 2024/25 第3轮',
                'status' => '即将开始',
                'image' => '/assets/web/assets/img/matches/match9.jpg',
                'time' => '2024/25 第3轮',
                'is_top' => false
            ],
            [
                'id' => 10,
                'title' => '布伦特福德 vs 伊普斯维奇',
                'league' => '英超联赛 2024/25 第3轮',
                'status' => '即将开始',
                'image' => '/assets/web/assets/img/matches/match10.jpg',
                'time' => '2024/25 第3轮',
                'is_top' => false
            ]
        ];
    }

    public function sendContact(Request $request)
    {
        try {
            Mail::to('sample@gmail.com')->send(new ContactMail($request->first_name, $request->last_name, $request->email, $request->message));

            return response()->json(['type' => 'success', 'message' => 'Form submitted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => 'Failed to send email. Please try again later.']);
        }
    }
}
