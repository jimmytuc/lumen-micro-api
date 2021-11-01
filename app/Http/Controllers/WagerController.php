<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\ViewModels\WagerViewModel;
use Illuminate\Validation\ValidationException;


class WagerController extends Controller
{
    /**
     * @var WagerViewModel
     */
    private $wager;

    /**
     * Controller constructor.
     *
     * @param WagerViewModel $wager
     */
    public function __construct(WagerViewModel $wager)
    {
        $this->wager = $wager;
    }

    /**
     * Create a wager.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request): JsonResponse
    {
        $wager = $this->wager->storeWager($request->all());

        return response()->json($wager, Response::HTTP_CREATED);
    }

    /**
     * Get all the wagers.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $wagers = $this->wager->getWagers($request);

        return response()->json($wagers, Response::HTTP_OK);
    }
}
