<?php

namespace App\Http\Controllers;

use App\ViewModels\BuyViewModels;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BuyController extends Controller
{
    /**
     * @var BuyViewModels
     */
    private $buy;

    /**
     * Controller constructor.
     *
     * @param BuyViewModels $buy
     */
    public function __construct(BuyViewModels $buy)
    {
        $this->buy = $buy;
    }

    /**
     * Create a wager.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request, int $id): JsonResponse
    {
        $buy = $this->buy->storeBuyCommand($id, $request->all());

        return response()->json($buy, Response::HTTP_CREATED);
    }
}
