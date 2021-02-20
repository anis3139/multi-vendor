<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use PDF;
use Illuminate\Http\Request;

class orderController extends Controller
{
   public function ordeIndex()
   {
      return view('admin.order.order');
   }


   public function getOrdersData()
   {
       $orderData=json_decode(Orders::orderBy('id', 'desc')->get());
       return $orderData;
   }


   public function ordersView(Request $request)
   {
    $id = $request->input('id');
    $resultView = Orders::with(['orderProducts', 'orderProducts.product'])->where('id', '=', $id)->get();

    return $resultView;
   }

   public function ordersStatusUpdate(Request $request)
   {


        $id=$request->input('id');
       $payment_status=$request->input("payment_status");



       $result = Orders::where('id', '=', $id)->update([
        'payment_status' => $payment_status
        ]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }




    }

    public function ordersPrint(Request $request, $id)
    {
        $orders = Orders::with(['orderProducts', 'orderProducts.product'])->findOrFail($id);

        $pdf = PDF::loadView('admin.order.printOrder', compact('orders') );
        return $pdf->download('invoice.pdf');
        return $pdf->stream('invoice.pdf');
    }


}
