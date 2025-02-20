<?php

namespace App\Http\Controllers;

use App\Providers\AppServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

// enum para los métodos de pago
// permite añadir un nuevo método fácilmente
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
            'products.*.quantity' => ['required', 'gte:1', 'integer'],
        ]);

        $fechaCompra = date('Y-m-d');
        $metodoPago = $req->input('payment_method');
        $estadoCompra = "";

        // obtener el metodo de pago de acuerdo con la enumeración de arriba
        switch($metodoPago) {
            case PaymentMethod::Transferencia->value:
                $estadoCompra = "Pendiente de Revisión";
                break;
            case PaymentMethod::ContraEntrega->value:
            case PaymentMethod::TarjetaCredito->value:
                $estadoCompra = "Procesando Orden";
        }

        // contador hard-coded, puesto que no se utiliza base de datos por ahora
        $orderNumber = "RB" . date('Y') . date('m') . '-1';

        $reqData = $req->all();
        $precioTotal = 0;

        // calcular el total de los productos
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
