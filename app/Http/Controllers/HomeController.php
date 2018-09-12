<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Tweet\ReachCalculator;
use App\Http\Requests\PostCalculateReachRequest;

class HomeController extends Controller {

    /**
     * @var ReachCalculator 
     */
    protected $reachCalculatorService;

    /**
     * HomeController Constructor.
     * 
     * @param ReachCalculator $reachCalculatorService
     */
    public function __construct(ReachCalculator $reachCalculatorService)
    {
        $this->reachCalculatorService = $reachCalculatorService;
    }

    /**
     * Post calculate reach of tweet URL.
     * 
     * @param PostCalculateReachRequest $request
     * @return \Illuminate\View\View
     */
    public function postHome(PostCalculateReachRequest $request)
    {
        $url = $request->url;
        $reach = $this->reachCalculatorService->calculate($url);
//        dd($reach);
        return view('home', compact('reach', 'url'));
    }

}
