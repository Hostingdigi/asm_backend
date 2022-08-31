<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;

class OrderController extends Controller
{
    protected $flashData = [
        'status' => 0,
        'message' => 'Something went wrong.Try again later.',
    ];

    public function listOrders(Request $request)
    {
        if ($request->ajax()) {
            $users = Order::latest()->get();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('order_no', function ($row) {
                    return '#'.$row->order_no;
                })
                ->addColumn('customer', function ($row) {
                    return $row->customer->name;
                })
                ->addColumn('total', function ($row) {
                    return 'SGD '.$row->total_amount;
                })
                ->addColumn('parent', function ($row) {
                    return !empty($row->parent_id) ? ucwords(Order::find($row->parent_id)->name) : '-';
                })
                ->addColumn('ordered', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i A');
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '1') {
                        return '<b>Ordered</b>';
                    } else if ($row->status == 0) {
                        return '<b class="text-danger">Failed</b>';
                    }
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<a title="View Order" class="btn btn-outline-dark" href="' . route('admin.masters.categories.updateStatus', [$row->id, 0]) . '"><i class="fa fa-fw fa-eye"></i></a> ';
                    return $actions;
                })
                ->rawColumns(['actions','status'])
                ->make(true);
        }

        return view('backend.orders');
    }
}
