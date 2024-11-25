<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\Paginator;

use App\Models\Review;
use App\Http\Requests\ReviewStoreRequest;


class ReviewController extends Controller
{
    public function index(): JsonResponse
    {
        $reviews = Review::query()->with('user', 'reply.user')->simplePaginate(15);

        return response()->json($reviews, Response::HTTP_OK);
    }

    public function store(ReviewStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $validated['user_id'] = auth()->user()->id;
            $review = Review::query()->create($validated)->load('user');

            return response()->json($review, Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), Response::HTTP_OK);
        }
    }
}
