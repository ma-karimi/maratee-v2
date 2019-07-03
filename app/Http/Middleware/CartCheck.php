<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\Order;
use Closure;
use Illuminate\Support\Facades\Auth;

class CartCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('cart_id')) {
            $cart = Cart::find($request->cart_id);
            if (isset($cart) && $cart[0]->user_id == Auth::id()) {
                return $next($request);
            } else {
                abort(403);
            }
        } elseif ($request->segment(6) && $request->segment(5) == "delete") {
            $order = Order::find($request->segment(6));
            if (isset($order) && $order->user_id == Auth::id()) {
                return $next($request);
            } else {
                abort(403,'شما مجاز به انجام این عملیات نیستید');
            }
        } else {
        }
    }
}
