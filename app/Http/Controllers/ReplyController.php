<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use App\Models\Review;
use App\Models\Reply;
use App\Http\Requests\ReplyStoreRequest;
use App\Events\ReplyAdded;

class ReplyController extends Controller
{
    public function store(ReplyStoreRequest $request, Review $review): JsonResponse
    {
        $validated = $request->validated();
        $validated['review_id'] = $review->id;
        $validated['user_id'] = auth()->user()->id;
        $reply = Reply::query()->create($validated)->load('user');

        return response()->json($reply, Response::HTTP_CREATED);
    }
}
