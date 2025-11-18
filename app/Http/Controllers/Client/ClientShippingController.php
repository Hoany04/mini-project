<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientShippingService;
use Illuminate\Http\Request;

class ClientShippingController extends Controller
{
    protected $shippingService;

    public function __construct(ClientShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function index()
    {
        $method = $this->shippingService->getAvailableMethods();
        return view('client.pages.checkout.order', compact('methods'));
    }
}
?>
