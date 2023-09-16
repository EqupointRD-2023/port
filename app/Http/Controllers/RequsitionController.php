<?php

namespace App\Http\Controllers;

use App\Models\PortStock;
use App\Models\requisitions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequsitionController extends Controller
{
    public function index()
    {
        $requsitions = requisitions::whereDate('created_at', Carbon::today())->get();
        $device = PortStock::where('user_id', auth()->user()->id)->where('status', 0)->count();
        $req = requisitions::whereDate('created_at', Carbon::today())->count();
        // dd($req);
        return view('requsition.requisition-port', [
            'requisitions' => $requsitions,
            'req' => $req,
            'device' => $device,
        ]);
    }

    public function index2()
    {
        $requsitions = requisitions::with('user')->get();

        return view('requsition.index', [
            'requisitions' => $requsitions,
        ]);
    }

    public function create(Request $request)
    {
        $bill_no = DB::table('requisitions')->count();
        $count = $bill_no + date('s') + 1;
        $requisitionNumber = 'REQ'.date('dmys').'00'.$count;

        // dd($request);

        $req = requisitions::create([
            'requisitionNumber' => $requisitionNumber,
            'request_id' => auth()->user()->id,
            'team_id' => $request->user()->team_id,
            'purpose' => $request->purpose,
            'purpose' => $request->purpose,
            'description' => $request->description,
            'quantity' => $request->quantity,
        ]);

        if ($req) {
            toastr()->success('Data has been saved successfully!', 'Successfully');

            return back();
        }
        toastr()->error('Oops! Something went wrong!', 'Error');

        return back();
    }

    public function update($id)
    {
        $req = requisitions::find($id);

        if ($req) {
            $req->update([
                'status' => 1,
            ]);
            toastr()->success('Requisition Acknowledged successfully!', 'Successfully');

            return back();
        }
    }

    public function cancel($id)
    {
        $req = requisitions::find($id);

        if ($req) {
            $req->update([
                'status' => 2,
            ]);

            toastr()->success('Requisition canceled successfully!', 'Successfully');

            return back();
        }
    }
}
