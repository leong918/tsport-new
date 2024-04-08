<?php

namespace App\Plugins\ProductReview\Web;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Plugins\ProductReview\Repositories\ProductReviewRepository;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    private ProductReviewRepository $productReviewRepository;
    private UserRepository $userRepository;

    public function __construct(ProductReviewRepository $productReviewRepository, UserRepository $userRepository,)
    {
        $this->productReviewRepository = $productReviewRepository;
        $this->userRepository = $userRepository;
    }

    public function postReview(Request $request, int $id)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;
        $data['product_id'] = $id;
        
        if ($data['user_id'] == null) {
            return response()->json(['msg' => 'Please log in to post review!'], 500);
        }

        $user = $this->userRepository->find($data['user_id']);
        $data['username'] = $user->username;

        $this->productReviewRepository->createProductReview($data);
        $this->userRepository->addReviewPoint($user->id, $id);

        return $this->response(['data' => $data], 'OK');
    }
}
