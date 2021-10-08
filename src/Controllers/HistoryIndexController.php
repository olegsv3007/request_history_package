<?php

namespace Olegsv\History\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Olegsv\History\Services\RequestService;

class HistoryIndexController extends Controller
{
    public function __invoke(Request $request): View
    {
        $filters = $request->all();

        $requestService = $this->getRequestService();
        $requests = $requestService->get($filters);

        return view('history::index', compact(['requests', 'filters']));
    }

    public function getRequestService(): RequestService
    {
        return app(RequestService::class);
    }
}
