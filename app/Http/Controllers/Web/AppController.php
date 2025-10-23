<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMail;
use App\Repositories\EventRepository;
use App\Repositories\PredictRepository;
use App\Repositories\PredictCommentRepository;
use App\Repositories\PredictLikeRepository;
use App\Repositories\PredictCommentLikeRepository;
use App\Repositories\MatchRepository;
use App\Repositories\LiveMatchRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class AppController extends BaseController
{
    protected $eventRepository;
    protected $predictRepository;
    protected $predictCommentRepository;
    protected $predictLikeRepository;
    protected $predictCommentLikeRepository;
    protected $matchRepository;
    protected $liveMatchRepository;

    public function __construct(
        EventRepository $eventRepository, 
        PredictRepository $predictRepository,
        PredictCommentRepository $predictCommentRepository,
        PredictLikeRepository $predictLikeRepository,
        PredictCommentLikeRepository $predictCommentLikeRepository,
        MatchRepository $matchRepository,
        LiveMatchRepository $liveMatchRepository
    ) {
        $this->eventRepository = $eventRepository;
        $this->predictRepository = $predictRepository;
        $this->predictCommentRepository = $predictCommentRepository;
        $this->predictLikeRepository = $predictLikeRepository;
        $this->predictCommentLikeRepository = $predictCommentLikeRepository;
        $this->matchRepository = $matchRepository;
        $this->liveMatchRepository = $liveMatchRepository;
    }

    /**
     * Get character display name mapping
     */
    private function getCharacterDisplayNames()
    {
        return [
            'Expert1' => '摩漆Special',
            'Expert2' => '黯然雲加',
            'Expert3' => '回魂普'
        ];
    }

    public function index()
    {
        return $this->view('index');
    }

    public function matches(Request $request)
    {
        // Get live matches using repository
        $topLiveMatches = $this->liveMatchRepository->getTopLiveMatches();
        $regularLiveMatches = $this->liveMatchRepository->getRegularLiveMatches();

        // Format live matches data for display using repository
        $swiperMatches = $this->liveMatchRepository->formatLiveMatchesForDisplay($topLiveMatches);
        $allContentMatches = $this->liveMatchRepository->formatLiveMatchesForDisplay($regularLiveMatches);

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

        return $this->view('matches', [
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

    public function predict(Request $request)
    {
        // Get character display names
        $characterDisplayNames = $this->getCharacterDisplayNames();

        // 默认显示Expert1的预测，而不是所有预测
        $defaultExpert = 'Expert1';
        $predictions = $this->predictRepository->getActivePredictionsByExpert($defaultExpert, 10);

        // Format predictions data for the view
        $formattedPredictions = $predictions->map(function ($prediction) use ($characterDisplayNames) {
            return [
                'id' => $prediction->id,
                'character_name' => $prediction->character_name,
                'character_display_name' => $characterDisplayNames[$prediction->character_name] ?? $prediction->character_name,
                'description' => $prediction->description,
                'image' => $prediction->image_url, // Using the accessor
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

        // Handle AJAX requests (for getAllPredictions functionality)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'predictions' => $formattedPredictions,
                'expert' => $defaultExpert,
                'total' => $formattedPredictions->count()
            ]);
        }

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
            'characters' => $this->predictRepository->getCharacters(),
            'activeExpert' => $defaultExpert  // 传递默认激活的专家
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
            'image' => $prediction->image_url, // Using the accessor
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
            'user_liked' => false, // Default value
            'comments' => $prediction->comment->map(function ($comment) {
                $currentUser = auth('user')->user();
                $userLiked = false;
                
                if ($currentUser) {
                    $userLiked = $this->predictCommentLikeRepository->hasUserLikedComment($comment->id, $currentUser->id);
                }

                return [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'user_name' => $comment->user->name ?? 'Anonymous',
                    'created_at' => $comment->created_at,
                    'likes_count' => $comment->like->count(),
                    'created_at_human' => $comment->created_at->diffForHumans(),
                    'user_liked' => $userLiked,
                ];
            })
        ];

        // Check if current user has liked this prediction
        $currentUser = auth('user')->user();
        if ($currentUser) {
            $formattedPrediction['user_liked'] = $this->predictLikeRepository->hasUserLikedPredict($prediction->id, $currentUser->id);
        }

        // Get related predictions using repository
        $relatedPredictions = $this->predictRepository->getRelatedPredictions($prediction, 3)
            ->map(function ($relatedPrediction) use ($characterDisplayNames) {
                return [
                    'id' => $relatedPrediction->id,
                    'character_name' => $relatedPrediction->character_name,
                    'character_display_name' => $characterDisplayNames[$relatedPrediction->character_name] ?? $relatedPrediction->character_name,
                    'description' => $relatedPrediction->description,
                    'image' => $relatedPrediction->image_url, // Using the accessor
                    'match_title' => $relatedPrediction->matches->match_title ?? 'Unknown Match',
                    'likes_count' => $relatedPrediction->like_count,
                ];
            });

        return $this->view('predict-detail', [
            'prediction' => $formattedPrediction,
            'relatedPredictions' => $relatedPredictions,
        ]);
    }

    public function live($id = null)
    {
        try {
            // If ID is provided, get specific live match, otherwise get currently streaming matches
            if ($id) {
                $specificMatch = $this->liveMatchRepository->getLiveMatchWithDetails($id);
                if (!$specificMatch) {
                    abort(404, 'Live match not found');
                }
                $streamingMatches = collect([$specificMatch]);
                $currentMatch = $specificMatch;
                // Store the URL ID for later use
                $urlId = $id;
            } else {
                // Get currently streaming matches
                $streamingMatches = $this->liveMatchRepository->getCurrentlyStreamingMatches();
                $currentMatch = $streamingMatches->first();
                $urlId = $currentMatch ? $currentMatch->id : null;
            }
            
            // Format match data
            if ($currentMatch) {
                $matchData = [
                    'id' => $currentMatch->id,
                    'url_id' => $urlId, // Add URL ID for JavaScript to use
                    'match_id' => $currentMatch->match_id,
                    'home_team' => $currentMatch->match->home_team ?? '曼联',
                    'away_team' => $currentMatch->match->away_team ?? '曼市',
                    'league' => $currentMatch->match->league ?? '英超联赛',
                    'match_title' => $currentMatch->match->match_title ?? '曼联 vs 曼市',
                    'short_content' => $currentMatch->match->short_content ?? '',
                    'start_at' => $currentMatch->match->start_at ?? null,
                    'date' => $currentMatch->match->date ?? '2024/25',
                    'round' => $currentMatch->match->round ?? '第22轮',
                    'viewers' => $currentMatch->viewer_count ?? 0,
                    'video_url' => $currentMatch->stream_url,
                    'rtmp_url' => $currentMatch->rtmp_url,
                    'obs_status' => $currentMatch->obs_status,
                    'obs_status_text' => $currentMatch->obs_status_text,
                    'obs_stream_key' => $currentMatch->obs_stream_key,
                    'obs_server_url' => $currentMatch->obs_server_url,
                    'is_live' => $currentMatch->isLive(),
                    'stream_started_at' => $currentMatch->stream_started_at,
                    'stream_ended_at' => $currentMatch->stream_ended_at,
                    'thumbnail' => $currentMatch->thumbnail_url,
                    'fixture_image' => $currentMatch->fixture_image_url,
                    'comments' => $currentMatch->comments->map(function ($comment) {
                        return [
                            'id' => $comment->id,
                            'comment' => $comment->comment,
                            'user_name' => $comment->user->name ?? 'Anonymous',
                            'created_at' => $comment->created_at,
                            'created_at_human' => $comment->created_at->diffForHumans(),
                        ];
                    })
                ];
            } else {
                // Sample match data for when no live matches are available
                $matchData = [
                    'id' => 0,
                    'home_team' => '曼联',
                    'away_team' => '曼市',
                    'league' => '英超联赛',
                    'date' => '2024/25',
                    'round' => '第22轮',
                    'viewers' => 0,
                    'video_url' => null,
                    'rtmp_url' => null,
                    'obs_status' => 'Stopped',
                    'is_live' => false,
                    'stream_started_at' => null,
                    'comments' => []
                ];
            }

            // Get streaming statistics
            $stats = $this->liveMatchRepository->getStreamingStatistics();

            // Get character display names
            $characterDisplayNames = $this->getCharacterDisplayNames();

            // Get predictions related to this match (limit to 3 for Tab 2)
            $matchPredictions = collect();
            if ($currentMatch && isset($currentMatch->match_id)) {
                $matchPredictions = $this->predictRepository->getPredictionsByMatchId($currentMatch->match_id, 3)
                    ->map(function ($prediction) use ($characterDisplayNames) {
                        return [
                            'id' => $prediction->id,
                            'character_name' => $prediction->character_name,
                            'character_display_name' => $characterDisplayNames[$prediction->character_name] ?? $prediction->character_name,
                            'image' => $prediction->image_url,
                            'description' => $prediction->description,
                            'likes_count' => $prediction->like_count,
                            'comments_count' => $prediction->comment->count(),
                        ];
                    });
            }

            return $this->view('live', [
                'match' => $matchData,
                'comments' => $matchData['comments'] ?? [],
                'streamingMatches' => $streamingMatches,
                'stats' => $stats,
                'predictions' => $matchPredictions
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading live page: ' . $e->getMessage());
            
            // Fallback data in case of error
            $currentMatch = [
                'id' => 0,
                'home_team' => '曼联',
                'away_team' => '曼市',
                'league' => '英超联赛',
                'date' => '2024/25',
                'round' => '第22轮',
                'viewers' => 0,
                'video_url' => null,
                'rtmp_url' => null,
                'obs_status' => 'Stopped',
                'is_live' => false,
                'stream_started_at' => null,
                'comments' => []
            ];

            return $this->view('live', [
                'match' => $currentMatch,
                'streamingMatches' => collect(),
                'stats' => [
                    'total_matches' => 0,
                    'live_matches' => 0,
                    'total_viewers' => 0,
                    'average_viewers' => 0
                ]
            ]);
        }
    }


    public function predictByExpert(Request $request, $expert)
    {
        // 验证专家参数
        $validExperts = ['Expert1', 'Expert2', 'Expert3'];
        if (!in_array($expert, $validExperts)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid expert parameter',
                'error' => 'Invalid expert'
            ], 400);
        }

        try {
            // 获取字符显示名称
            $characterDisplayNames = $this->getCharacterDisplayNames();

            // 使用repository获取特定专家的预测
            $predictions = $this->predictRepository->getActivePredictionsByExpert($expert, 10);

            // 格式化预测数据
            $formattedPredictions = $predictions->map(function ($prediction) use ($characterDisplayNames) {
            return [
                'id' => $prediction->id,
                'character_name' => $prediction->character_name,
                'character_display_name' => $characterDisplayNames[$prediction->character_name] ?? $prediction->character_name,
                'description' => $prediction->description,
                'image' => $prediction->image_url, // Using the accessor
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

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'predictions' => $formattedPredictions,
                'expert' => $expert,
                'total' => $formattedPredictions->count()
            ]);
        }

        // 对于非AJAX请求，返回带过滤数据的正常视图
        return $this->view('predict', [
            'predictions' => $predictions,
            'formattedPredictions' => $formattedPredictions,
            'featuredPredictions' => $this->predictRepository->getFeaturedPredictions(3)
                ->map(function ($prediction) use ($characterDisplayNames) {
                    return [
                        'id' => $prediction->id,
                        'character_name' => $prediction->character_name,
                        'character_display_name' => $characterDisplayNames[$prediction->character_name] ?? $prediction->character_name,
                        'description' => $prediction->description,
                        'match_title' => $prediction->matches->match_title ?? 'Unknown Match',
                        'likes_count' => $prediction->like_count,
                    ];
                }),
            'stats' => $this->predictRepository->getPredictionStats(),
            'characters' => $this->predictRepository->getCharacters(),
            'activeExpert' => $expert
        ]);
        
        } catch (\Exception $e) {
            Log::error('Error in predictByExpert: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to load predictions',
                    'error' => $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('web.predict')->with('error', 'Failed to load expert predictions');
        }
    }

    public function ordering()
    {
        return $this->view('ordering');
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

    public function addPredictComment(Request $request, $id)
    {
        // Check if user is authenticated
        if (!auth('user')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required'
            ], 401);
        }

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        try {
            $user = auth('user')->user();
            
            // Check if prediction exists and is active
            $prediction = $this->predictRepository->getActivePredictionById($id);
            
            if (!$prediction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Prediction not found'
                ], 404);
            }

            // Create comment using repository
            $commentData = [
                'user_id' => $user->id,
                'predict_id' => $id,
                'comment' => $request->input('content'),
                'status' => 1 // Active
            ];

            $comment = $this->predictCommentRepository->createComment($commentData);

            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully',
                'comment' => $comment
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add comment. Please try again.'
            ], 500);
        }
    }

    public function likePredictComment(Request $request, $id)
    {
        // Check if user is authenticated
        if (!auth('user')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required'
            ], 401);
        }

        try {
            $user = auth('user')->user();
            
            // Check if comment exists using repository
            $comment = $this->predictCommentRepository->getCommentById($id);
            if (!$comment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Comment not found'
                ], 404);
            }

            // Toggle like using repository
            $result = $this->predictCommentLikeRepository->toggleCommentLike($id, $user->id);

            return response()->json([
                'success' => true,
                'liked' => $result['user_liked'],
                'likes_count' => $result['like_count']
            ]);

        } catch (\Exception $e) {
            Log::error('Comment like error: ' . $e->getMessage());
            Log::error('Comment like error trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Failed to process like. Please try again.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Toggle like for a prediction
     */
    public function likePrediction(Request $request, $id)
    {
        // Check if user is authenticated
        if (!auth('user')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required'
            ], 401);
        }

        try {
            $user = auth('user')->user();
            
            // Check if prediction exists using repository
            $prediction = $this->predictRepository->getActivePredictionById($id);
            if (!$prediction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Prediction not found'
                ], 404);
            }

            // Toggle like using repository
            $result = $this->predictLikeRepository->togglePredictLike($id, $user->id);

            return response()->json([
                'success' => true,
                'liked' => $result['user_liked'],
                'likes_count' => $result['like_count'],
                'message' => $result['action'] === 'liked' ? 'Prediction liked!' : 'Prediction unliked!'
            ]);

        } catch (\Exception $e) {
            Log::error('Prediction like error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to process like. Please try again.'
            ], 500);
        }
    }

    /**
     * Get prediction like statistics
     */
    public function getPredictionLikeStats(Request $request, $id)
    {
        try {
            $userId = auth('user')->check() ? auth('user')->id() : null;
            
            // Get comprehensive like statistics using repository
            $stats = $this->predictLikeRepository->getPredictLikeStatistics($id, $userId);

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Prediction like stats error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get like statistics.'
            ], 500);
        }
    }

    /**
     * Sync like counts for all predictions (utility endpoint)
     */
    public function syncPredictLikeCounts()
    {
        try {
            $predictions = \App\Models\Predict::all();
            $syncedCount = 0;

            foreach ($predictions as $prediction) {
                $prediction->updateLikeCount();
                $syncedCount++;
            }

            return response()->json([
                'success' => true,
                'message' => "Synced like counts for {$syncedCount} predictions",
                'synced_count' => $syncedCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to sync like counts: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Sync like counts for all comments (utility endpoint)
     */
    public function syncCommentLikeCounts()
    {
        try {
            $comments = \App\Models\PredictComment::all();
            $syncedCount = 0;

            foreach ($comments as $comment) {
                $comment->updateLikeCount();
                $syncedCount++;
            }

            return response()->json([
                'success' => true,
                'message' => "Synced like counts for {$syncedCount} comments",
                'synced_count' => $syncedCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to sync comment like counts: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get live match viewer count
     */
    public function getLiveViewerCount($id)
    {
        try {
            $liveMatch = $this->liveMatchRepository->find($id);

            if (!$liveMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'viewer_count' => $liveMatch->viewer_count ?? 0
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting viewer count: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting viewer count'
            ], 500);
        }
    }

    /**
     * Get live match status
     */
    public function getLiveStatus($id)
    {
        try {
            $liveMatch = $this->liveMatchRepository->find($id);

            if (!$liveMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'obs_status' => $liveMatch->obs_status,
                'obs_status_text' => $liveMatch->obs_status_text,
                'is_live' => $liveMatch->isLive(),
                'viewer_count' => $liveMatch->viewer_count ?? 0
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting live status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error getting live status'
            ], 500);
        }
    }

    /**
     * Add comment to live match
     */
    public function addLiveComment(Request $request, $id)
    {
        // Check if user is authenticated
        if (!auth('user')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required'
            ], 401);
        }

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        try {
            $user = auth('user')->user();
            
            // Check if live match exists
            $liveMatch = $this->liveMatchRepository->find($id);
            
            if (!$liveMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'Live match not found'
                ], 404);
            }

            // Create comment using repository
            $comment = $this->liveMatchRepository->addComment(
                $id,
                $user->id,
                $request->input('content')
            );

            if (!$comment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add comment'
                ], 500);
            }

            // Load user relationship for response
            $comment->load('user');
            
            // Refresh the model to get the actual Carbon instance before attribute casting
            $comment->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully',
                'comment' => [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'user_name' => $comment->user->name ?? 'Anonymous',
                    'user_id' => $comment->user_id,
                    'avatar' => $comment->user->avatar ?? '/assets/web/images/chat/avatar-default.png',
                    'created_at' => $comment->getOriginal('created_at'),
                    'created_at_human' => \Carbon\Carbon::parse($comment->getOriginal('created_at'))->diffForHumans(),
                    'likes_count' => 0
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error adding live comment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add comment. Please try again.'
            ], 500);
        }
    }
}
