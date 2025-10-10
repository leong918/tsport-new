<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Matches;
use App\Models\Predict;
use App\Repositories\EventRepository;
use App\Repositories\PredictRepository;
use App\Repositories\MatchRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class AppController extends BaseController
{
    protected $eventRepository;
    protected $predictRepository;
    protected $matchRepository;

    public function __construct(
        EventRepository $eventRepository, 
        PredictRepository $predictRepository, 
        MatchRepository $matchRepository
    ) {
        $this->eventRepository = $eventRepository;
        $this->predictRepository = $predictRepository;
        $this->matchRepository = $matchRepository;
    }

    /**
     * Get character display name mapping
     */
    private function getCharacterDisplayNames()
    {
        return [
            'Expert 1' => 'Expert 1',
            'Expert 2' => 'Expert 2',
            'Expert 3' => 'Expert 3'
        ];
    }

    public function index()
    {
        return $this->view('index');
    }

    public function liveMatches(Request $request)
    {
        // Get matches using repository
        $topMatches = $this->matchRepository->getTopMatches();
        $regularMatches = $this->matchRepository->getRegularMatches();

        // Format matches data for display
        $swiperMatches = $this->matchRepository->formatMatchesForDisplay($topMatches);
        $allContentMatches = $this->matchRepository->formatMatchesForDisplay($regularMatches);

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

        return $this->view('events', compact('events'));
    }

    public function predict()
    {
        // Get character display names
        $characterDisplayNames = $this->getCharacterDisplayNames();

        // Get active predictions using repository
        $predictions = $this->predictRepository->getActivePredictions(10);

        // Format predictions data for the view
        $formattedPredictions = $predictions->map(function ($prediction) use ($characterDisplayNames) {
            return [
                'id' => $prediction->id,
                'character_name' => $prediction->character_name,
                'character_display_name' => $characterDisplayNames[$prediction->character_name] ?? $prediction->character_name,
                'description' => $prediction->description,
                'image' => $prediction->image,
                'created_at' => $prediction->created_at,
                'match' => $prediction->matches ? [
                    'id' => $prediction->matches->id,
                    'title' => $prediction->matches->match_title,
                    'short_content' => $prediction->matches->short_content,
                    'start_at' => $prediction->matches->start_at,
                    'banner_url' => $prediction->matches->banner_url,
                ] : null,
                'comments_count' => $prediction->comment->count(),
                'likes_count' => $prediction->like->count(),
                'recent_comments' => $prediction->comment->take(3)->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'comment' => $comment->comment,
                        'user_name' => $comment->user->name ?? 'Anonymous',
                        'created_at' => $comment->created_at,
                    ];
                })
            ];
        });

        // Get featured predictions using repository
        $featuredPredictions = $this->predictRepository->getFeaturedPredictions(3)
            ->map(function ($prediction) use ($characterDisplayNames) {
                return [
                    'id' => $prediction->id,
                    'character_name' => $prediction->character_name,
                    'character_display_name' => $characterDisplayNames[$prediction->character_name] ?? $prediction->character_name,
                    'description' => $prediction->description,
                    'match_title' => $prediction->matches->match_title ?? 'Unknown Match',
                    'likes_count' => $prediction->like_count,
                ];
            });

        // Get prediction statistics using repository
        $stats = $this->predictRepository->getPredictionStats();

        return $this->view('predict', [
            'predictions' => $predictions,
            'formattedPredictions' => $formattedPredictions,
            'featuredPredictions' => $featuredPredictions,
            'stats' => $stats,
            'characters' => Predict::CHARACTER
        ]);
    }

    public function predictDetail($id)
    {
        // Get character display names
        $characterDisplayNames = $this->getCharacterDisplayNames();

        // Get the specific prediction using repository
        $prediction = $this->predictRepository->getActivePredictionById($id);

        if (!$prediction) {
            abort(404);
        }

        // Format prediction data
        $formattedPrediction = [
            'id' => $prediction->id,
            'character_name' => $prediction->character_name,
            'character_display_name' => $characterDisplayNames[$prediction->character_name] ?? $prediction->character_name,
            'description' => $prediction->description,
            'image' => $prediction->image,
            'created_at' => $prediction->created_at,
            'match' => $prediction->matches ? [
                'id' => $prediction->matches->id,
                'title' => $prediction->matches->match_title,
                'short_content' => $prediction->matches->short_content,
                'start_at' => $prediction->matches->start_at,
                'banner_url' => $prediction->matches->banner_url,
            ] : null,
            'comments_count' => $prediction->comment->count(),
            'likes_count' => $prediction->like->count(),
            'comments' => $prediction->comment->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'user_name' => $comment->user->name ?? 'Anonymous',
                    'created_at' => $comment->created_at,
                ];
            })
        ];

        // Get related predictions using repository
        $relatedPredictions = $this->predictRepository->getRelatedPredictions($prediction, 3)
            ->map(function ($relatedPrediction) use ($characterDisplayNames) {
                return [
                    'id' => $relatedPrediction->id,
                    'character_name' => $relatedPrediction->character_name,
                    'character_display_name' => $characterDisplayNames[$relatedPrediction->character_name] ?? $relatedPrediction->character_name,
                    'description' => $relatedPrediction->description,
                    'image' => $relatedPrediction->image,
                    'match_title' => $relatedPrediction->matches->match_title ?? 'Unknown Match',
                    'likes_count' => $relatedPrediction->like_count,
                ];
            });

        return $this->view('predict-detail', [
            'prediction' => $formattedPrediction,
            'relatedPredictions' => $relatedPredictions,
        ]);
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
