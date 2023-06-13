<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\OrderServices;
use DataTables;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $flashData = [
        'status' => 0,
        'message' => 'Something went wrong.Try again later.',
    ];

    protected $orderServices = null;

    public function __construct(OrderServices $orderServices)
    {
        $this->orderServices = $orderServices;
    }

    public function listOrders(Request $request)
    {
        if ($request->ajax()) {
            $users = Order::where([['is_dummy_order', '=', 0]])->latest()->get();
            $orderStatus = OrderStatus::activeOnly();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('order_no', function ($row) {
                    return '<a title="View Order" href="' . route('admin.orders.orderDetail', $row->id) . '" target="new">#' . $row->order_no . '</a>';
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
                        'pod' => 'Pay Now',
                        'card' => 'Online',
                    ];
                    $paymentStatus = (!empty($row->payment_mode) ? $paymodes[$row->payment_mode] : $paymodes['pod']) . ' - ';

                    $paymentStatus .= '<a title="View Payment History" href="" ' . ($row->payment_status ? 'class="text-success font-weight-bold">Paid' : 'class="text-warning font-weight-bold">Pending') . '<i class="icon icon-2xl cil-find-in-page"></i></a>';

                    return $paymentStatus;
                })
                ->addColumn('ordered', function ($row) {
                    return formatDate($row->created_at, 'd/m/Y h:i A');
                })
                ->addColumn('status', function ($row) use ($orderStatus) {

                    if ($row->status == 6) {
                        $statusContent = '<p class="text-success mb-0">Delivered</p>';
                    } else if ($row->status == 2) {
                        $statusContent = '<p class="text-danger mb-0">Cancelled</p>';
                    } else {
                        $statusContent = '<select class="order_change" data-orderid="' . $row->id . '">';

                        foreach ($orderStatus as $key => $value) {
                            if ($row->status == 2 && $value->status_code != 2) {
                                continue;
                            }
                            $statusContent .= '<option value="' . $value->status_code . '" ';
                            if ($row->status == $value->status_code) {
                                $statusContent .= ' selected="selected" ';
                            }
                            $statusContent .= '>' . $value->label . '</option>';

                        }
                        $statusContent .= '</select>';

                    }

                    return $statusContent;

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
        $this->orderServices->updateOrderStatus($request->all());
        $this->orderServices->updateOrderStatusHistory([
            [
                'order_id' => $request->orderId,
                'status_code' => $request->statusValue,
                'updated_by' => auth()->id(),
            ],
        ]);

        return returnApiResponse(true, 'Updated!');
    }

    public function updateDeliveryDate(Request $request)
    {
        Order::where('id', $request->order_id)->update([
            'expected_delivery_date' => $request->del_date,
        ]);
        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully date has been updated.',
        ];
        $request->session()->flash('flashData', $this->flashData);
        return redirect()->back();
    }
}
