<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdRequest;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\OrderRequest;
use App\Services\OrderValidator;
use App\Services\ProductService;
use App\Services\TimeService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService, private TimeService $timeService, private OrderValidator $orderValidator, private ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->timeService = $timeService;
        $this->orderValidator = $orderValidator;
        $this->productService = $productService;

    }

    public function index(): Factory | RedirectResponse | View
    {
        if(Auth::check())
        {
            $allOrders = $this->orderService->getAllOrders();

            return view('index', ['allOrders' => $allOrders]);
        }

        return redirect()->back();
    }
    public function show(IdRequest $idRequest): Factory | RedirectResponse | View
    {
        if(Auth::check())
        {
            $orderId = $idRequest->input('id');

            $productId = $this->orderService->getProductId($orderId);
            $date = $this->orderService->getDate($orderId);
            $from = $this->orderService->getFrom($orderId);
            $toCustomer = $this->orderService->getToCustomer($orderId);

            return view('index', ['productId' => $productId, 'date' => $date, 'from' => $from, 'toCustomer' => $toCustomer]);
        }

        return redirect()->back();
    }
    public function create(OrderRequest $orderRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $productId = $orderRequest['productId'];
            $date = $this->timeService->getCurrentDate();
            $from = $orderRequest['from'];
            $toCustomer = $orderRequest['toCustomer'];

            $orderIsCreated = $this->orderService->create($productId, $date, $from, $toCustomer);

            $countOfProduct = $this->productService->getCount($productId);

            $orderIsCompleted = $orderIsCreated && $this->orderValidator->isNonEmpty($productId, $countOfProduct);

            if($orderIsCompleted)
                return redirect()->route('showOrder', ['id' => $orderIsCreated]);

            return redirect()->back();
        }

        return redirect()->back();
    }
    public function update(IdRequest $idRequest, OrderRequest $orderRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $orderId = $idRequest->input('orderId');
            $productId = $orderRequest['productId'];
            $orderFrom = $orderRequest['from'];
            $orderToCustomer = $orderRequest['toCustomer'];

            $orderIsUpdated = $this->orderService->update($orderId, $productId, $orderFrom, $orderToCustomer);

            if($orderIsUpdated)
                return redirect()->route('showOrder', ['id' => $orderId]);

            return redirect()->back();
        }

        return redirect()->back();
    }
    public function delete(IdRequest $idRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $orderId = $idRequest->input('orderId');

            $orderIsDeleted = $this->orderService->delete($orderId);

            if($orderIsDeleted)
                return redirect()->route('showOrders');

            return redirect()->back();
        }

        return redirect()->back();
    }

}
