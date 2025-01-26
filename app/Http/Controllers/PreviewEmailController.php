<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

enum PaymentMethod: int {
    case Transferencia = 1;
    case ContraEntrega = 2;
    case TarjetaCredito = 3;
}

class PreviewEmailController extends Controller
{

    public static $orderCounter = 1;

    public function show(Request $req): View  {

        // validación y obtención de los datos

        $req->validate([
            'customer' => ['required'],
            'email' => ['required', 'email'],
            'payment_method' => ['required', 'integer', 'between:1,3'],
            'products' => ['required', 'min:1'],
            'products.*.name' => ['required', 'max:50'],
            'products.*.price' => ['required', 'numeric', 'gt:0'],
            'products.*.quantity' => ['required', 'gte:1'],
        ]);

        $fechaCompra = date('Y-m-d');
        $metodoPago = $req->input('payment_method');
        $estadoCompra = "";

        switch($metodoPago) {
            case PaymentMethod::Transferencia->value:
                $estadoCompra = "Pendiente de Revisión";
                break;
            case PaymentMethod::ContraEntrega->value:
            case PaymentMethod::TarjetaCredito->value:
                $estadoCompra = "Procesando Orden";
        }

        $orderNumber = "RB" . date('Y') . date('m') . '-' . PreviewEmailController::$orderCounter;
        PreviewEmailController::$orderCounter;

        $reqData = $req->all();
        $precioTotal = 0;

        foreach($reqData['products'] as $product) {
            $precioTotal += $product['price'] * $product['quantity'];
        }

        // retornar la vista
        return view('email-template', [
            'reqData' => $reqData,
            'date' => $fechaCompra,
            'orderNumber' => $orderNumber,
            'orderState' => $estadoCompra,
            'totalPrice' => $precioTotal
        ]);
    }
}
