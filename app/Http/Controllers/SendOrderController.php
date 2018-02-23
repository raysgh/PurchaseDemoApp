<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class SendOrderController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth');
      }

      public function send(Order $order)
      {
          $order->update([
              'is_ordered' => true
          ]);

          return back();
      }

      public function cancel(Order $order)
      {
          $order->update([
              'is_ordered' => false
          ]);

          return back();
      }
}
