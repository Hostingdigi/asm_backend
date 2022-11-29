<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DataTables;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $flashData = [
        'status' => 0,
        'message' => 'Something went wrong.Try again later.',
    ];

    public function listOrders(Request $request)
    {
        if ($request->ajax()) {
            $users = Order::where([['is_dummy_order','=',0]])->latest()->get();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('order_no', function ($row) {
                    return '<a title="View Order" href="' . route('admin.orders.orderDetail', $row->id) . '" target="new">#' . $row->order_no.'</a>';
                })
                ->addColumn('customer', function ($row) {
                    return $row->customer->name;
                })
                ->addColumn('total', function ($row) {
                    return 'SGD ' . $row->total_amount;
                })
                ->addColumn('parent', function ($row) {
                    return !empty($row->parent_id) ? ucwords(Order::find($row->parent_id)->name) : '-';
                })
                ->addColumn('payment_status', function ($row) {

                    $paymodes = [
                        'pod' => 'Pay on Delivery',
                        'card' => 'Online',
                    ];
                    $paymentStatus = (!empty($row->payment_mode) ? $paymodes[$row->payment_mode] : $paymodes['pod']) .' - ';

                    $paymentStatus .= '<a title="View Payment History" href="" '.($row->payment_status ? 'class="text-success font-weight-bold">Paid' : 'class="text-warning font-weight-bold">Pending' ). '<i class="icon icon-2xl cil-find-in-page"></i></a>';

                    return $paymentStatus;
                })
                ->addColumn('ordered', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('d/m/Y h:i A');
                })
                ->addColumn('status', function ($row) {

                    $statusContent = '<select class="order_change" data-orderid="'.$row->id.'">';
                    $statusContent .= '<option>Order Confirmed</option>';
                    $statusContent .= '<option>Shipped</option>';
                    $statusContent .= '<option>Out for Delivery</option>';
                    $statusContent .= '<option>Delivered</option>';
                    $statusContent .= '</select>';

                    return $statusContent;

                    // if ($row->status == '1') {
                    //     return 'Ordered';
                    // } else if ($row->status == 0) {
                    //     return '<span class="text-danger">Failed</span>';
                    // }
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<a title="View Order" class="btn btn-outline-dark" href="' . route('admin.orders.orderDetail', $row->id) . '"><i class="fa fa-fw fa-eye"></i></a> ';
                    return $actions;
                })
                ->rawColumns(['order_no', 'payment_status', 'status'])
                ->make(true);
        }

        return view('backend.orders');
    }

    public function orderDetail(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        return view('backend.order_detail', ['order' => $order]);
    }

    public function changeStatus(Request $request)
    {
        return response()->json($request->all());
    }
}
