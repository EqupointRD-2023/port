<?php

namespace App\Http\Controllers;

use App\Models\Border;
use App\Models\customer;
use App\Models\Lease;
use App\Models\PortStock;
use App\Models\Price;
use App\Models\TagPoints;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = PortStock::with('device')->
        where('status', 0)->
        where('user_id', auth()->user()->id)->get();
        $customers = customer::all();
        $borders = Border::all();
        $tagpoints = TagPoints::all();
        // dd($devices[0]->device[0]);
        return view('lease.index', [
            'devices' => $devices,
            'customers' => $customers,
            'borders' => $borders,
            'tagpoints' => $tagpoints,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = customer::all();

        return view('lease.report-port', [
            'customers' => $customers,
        ]);
    }

    public function history()
    {
        $customers = customer::all();
        $cash = Lease::where('tager_id', auth()->user()->id)->where('lease_type', 1)->distinct('lease_number')->count();

        $bill = Lease::where('tager_id', auth()->user()->id)->where('lease_type', 2)->distinct('lease_number')->count();
        $leases = Lease::with('master', 'customer', 'border', 'tager', 'tag', 'devices')
            ->where('tager_id', auth()->user()->id)->get();
        // dd($leases);

        return view('lease.history', [
            'cash' => $cash,
            'bill' => $bill,
            'leases' => $leases,
        ]);
    }

    public function filter(Request $request)
    {
        if ($request['lease_type'] == 2) {
            $report = Lease::with('master', 'devices', 'customer', 'border', 'tager', 'tag')
                ->where('lease_type', $request->leasetype)
                ->where('customer_id', $request->customer_id)
                ->whereBetween('created_at', [$request->from, $request->to])->get();
        } else {
            $report = Lease::with('master', 'devices', 'customer', 'border', 'tager', 'tag')
                ->where('lease_type', $request->leasetype)
                ->whereBetween('created_at', [$request->from, $request->to])->get();
        }
        // dd($report);
        return view('lease.getReport', [
            'reports' => $report,
        ]);
    }

    public function filterGet($report)
    {
        dd($report);

        return view('lease.getReport', [
            'report' => $report,
        ]);
    }

    public function lease(Request $request)
    {
        $leaseNO = substr(md5(Str::uuid()), 0, 12);
        $startDate = date('Ymd');
        $randomNumber = rand(1000, 9999);
        $leaseNo = 'LE'.$startDate.$randomNumber;
        // dd($request);

        if ($request['currency'] == 1 && $request['cargo_type'] == 4) {
            $price = Price::where('cargo_type', 'TANKER')->first();
            // $slave = count($request->slave);
            // dd(json_encode($request->slave));
            try {
                $lease = Lease::create([
                    'lease_number' => $leaseNo,
                    'master_id' => $request->master,
                    'master_price' => $price->master_price_usd,
                    'slave_price' => $price->slave_price_usd,
                    'cargo_type' => $request->cargo_type,
                    'pricetype' => 'USD',
                    'customer_id' => $request->customerId ?? null,
                    'customer_name' => $request->customerName,
                    'chasis_number' => $request->chasis_number,
                    'It_number' => $request->ITNumber,
                    'brand' => $request->brand,
                    'trailer_number' => $request->TrailerNumber,
                    'truck_number' => $request->TruckNumber,
                    'tager_id' => auth()->user()->id,
                    'tag_id' => $request->tagPointId,
                    'border_id' => $request->borderId,
                    'lease_type' => $request->lease_type,
                    'driver_name' => $request->driverName,
                    'driver_licence' => $request->driverLicense,
                    'driver_phone' => $request->driverPhone,
                ]);
                if ($lease) {
                    $lease->devices()->attach($request->slave);
                    $master = PortStock::where('device_id', $request['master'])->first();
                    $master->update([
                        'status' => 1,
                    ]);
                    foreach ($request['slave'] as $slave) {
                        $slave = PortStock::where('device_id', $slave)->first();
                        $slave->update([
                            'status' => 1,
                        ]);
                    }
                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                }
            } catch (Exception $error) {
                toastr()->error($error->getMessage(), 'oops');

                return back();
            }
        } elseif ($request['currency'] == 1 && $request['cargo_type'] == 3) {
            $price = Price::where('cargo_type', 'IT')->first();
            // dd(count($request->slave));
            try {
                $lease = Lease::create([
                    'lease_number' => $leaseNo,
                    'master_id' => $request->master,
                    'master_price' => $price->master_price_usd,
                    'cargo_type' => $request->cargo_type,
                    'pricetype' => 'USD',
                    'customer_id' => $request->customerId ?? null,
                    'customer_name' => $request->customerName,
                    'chasis_number' => $request->chasis_number,
                    'It_number' => $request->ITNumber,
                    'brand' => $request->brand,
                    'trailer_number' => $request->TrailerNumber,
                    'truck_number' => $request->TruckNumber,
                    'tager_id' => auth()->user()->id,
                    'tag_id' => $request->tagPointId,
                    'border_id' => $request->borderId,
                    'lease_type' => $request->lease_type,
                    'driver_name' => $request->driverName,
                    'driver_licence' => $request->driverLicense,
                    'driver_phone' => $request->driverPhone,
                ]);
                if ($lease) {
                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                }
            } catch (Exception $error) {
                toastr()->error($error->getMessage(), 'oops');
                $master = PortStock::where('device_id', $request['master'])->first();
                $master->update([
                    'status' => 1,
                ]);

                return back();
            }
        } elseif ($request['currency'] == 1 && $request['cargo_type'] == 2) {
            $price = Price::where('cargo_type', 'CONTAINERIZED')->first();
            // dd(count($request->slave));
            try {
                $lease = Lease::create([
                    'lease_number' => $leaseNo,
                    'master_id' => $request->master,
                    'master_price' => $price->master_price_usd,
                    'cargo_type' => $request->cargo_type,
                    'pricetype' => 'USD',
                    'customer_id' => $request->customerId ?? null,
                    'customer_name' => $request->customerName,
                    'chasis_number' => $request->chasis_number,
                    'It_number' => $request->ITNumber,
                    'brand' => $request->brand,
                    'trailer_number' => $request->TrailerNumber,
                    'truck_number' => $request->TruckNumber,
                    'tager_id' => auth()->user()->id,
                    'tag_id' => $request->tagPointId,
                    'border_id' => $request->borderId,
                    'lease_type' => $request->lease_type,
                    'driver_name' => $request->driverName,
                    'driver_licence' => $request->driverLicense,
                    'driver_phone' => $request->driverPhone,
                ]);
                if ($lease) {
                    toastr()->success('Leased Successfully', 'Successfully');
                    $master = PortStock::where('device_id', $request['master'])->first();
                    $master->update([
                        'status' => 1,
                    ]);

                    return back();
                }
            } catch (Exception $error) {
                toastr()->error($error->getMessage(), 'oops');

                return back();
            }
        } elseif ($request['currency'] == 1 && $request['cargo_type'] == 1) {
            $price = Price::where('cargo_type', 'LOOSE CARGO')->first();
            try {
                $lease = Lease::create([
                    'lease_number' => $leaseNo,
                    'master_id' => $request->master,
                    'master_price' => $price->master_price_usd,
                    'cargo_type' => $request->cargo_type,
                    'pricetype' => 'USD',
                    'customer_id' => $request->customerId ?? null,
                    'customer_name' => $request->customerName,
                    'chasis_number' => $request->chasis_number,
                    'It_number' => $request->ITNumber,
                    'brand' => $request->brand,
                    'trailer_number' => $request->TrailerNumber,
                    'truck_number' => $request->TruckNumber,
                    'tager_id' => auth()->user()->id,
                    'tag_id' => $request->tagPointId,
                    'border_id' => $request->borderId,
                    'lease_type' => $request->lease_type,
                    'driver_name' => $request->driverName,
                    'driver_licence' => $request->driverLicense,
                    'driver_phone' => $request->driverPhone,
                ]);
                if ($lease) {
                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                }
            } catch (Exception $error) {
                toastr()->error($error->getMessage(), 'oops');
                $master = PortStock::where('device_id', $request['master'])->first();
                $master->update([
                    'status' => 1,
                ]);

                return back();
            }
        }

        // TZS
        // TANKER
        elseif ($request['currency'] == 2 && $request['cargo_type'] == 4) {
            $price = Price::where('cargo_type', 'TANKER')->first();
            // dd($request->customerId);
            try {
                $lease = Lease::create([
                    'lease_number' => $leaseNo,
                    'master_id' => $request->master,
                    'master_price' => $price->master_price_tzs,
                    'slave_price' => $price->slave_price_tzs,
                    'cargo_type' => $request->cargo_type,
                    'pricetype' => 'TZS',
                    'slave_id' => $request->slave,
                    'customer_id' => $request->customerId ?? null,
                    'customer_name' => $request->customerName,
                    'chasis_number' => $request->chasis_number,
                    'It_number' => $request->ITNumber,
                    'brand' => $request->brand,
                    'trailer_number' => $request->TrailerNumber,
                    'truck_number' => $request->TruckNumber,
                    'tager_id' => auth()->user()->id,
                    'tag_id' => $request->tagPointId,
                    'border_id' => $request->borderId,
                    'lease_type' => $request->lease_type,
                    'driver_name' => $request->driverName,
                    'driver_licence' => $request->driverLicense,
                    'driver_phone' => $request->driverPhone,
                ]);
                if ($lease) {
                    $lease->devices()->attach($request->slave);
                    $master = PortStock::where('device_id', $request['master'])->first();
                    $master->update([
                        'status' => 1,
                    ]);

                    foreach ($request['slave'] as $slave) {
                        $slave = PortStock::where('device_id', $slave)->first();
                        $slave->update([
                            'status' => 1,
                        ]);
                    }
                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                }
            } catch (Exception $error) {
                toastr()->error($error->getMessage(), 'oops');

                return back();
            }
        }

        // IT
        elseif ($request['currency'] == 2 && $request['cargo_type'] == 3) {
            $price = Price::where('cargo_type', 'IT')->first();
            // dd(count($request->slave));
            try {
                $lease = Lease::create([
                    'lease_number' => $leaseNo,
                    'master_id' => $request->master,
                    'master_price' => $price->master_price_tzs,
                    'cargo_type' => $request->cargo_type,
                    'pricetype' => 'TZS',
                    'customer_id' => $request->customerId ?? null,
                    'customer_name' => $request->customerName,
                    'chasis_number' => $request->chasis_number,
                    'It_number' => $request->ITNumber,
                    'brand' => $request->brand,
                    'trailer_number' => $request->TrailerNumber,
                    'truck_number' => $request->TruckNumber,
                    'tager_id' => auth()->user()->id,
                    'tag_id' => $request->tagPointId,
                    'border_id' => $request->borderId,
                    'lease_type' => $request->lease_type,
                    'driver_name' => $request->driverName,
                    'driver_licence' => $request->driverLicense,
                    'driver_phone' => $request->driverPhone,
                ]);
                if ($lease) {
                    toastr()->success('Leased Successfully', 'Successfully');
                    $master = PortStock::where('device_id', $request['master'])->first();
                    $master->update([
                        'status' => 1,
                    ]);

                    return back();
                }
            } catch (Exception $error) {
                toastr()->error($error->getMessage(), 'oops');

                return back();
            }
        }

        // CONTAINERIZED
        elseif ($request['currency'] == 2 && $request['cargo_type'] == 2) {
            $price = Price::where('cargo_type', 'CONTAINERIZED')->first();
            // dd(count($request->slave));
            try {
                $lease = Lease::create([
                    'lease_number' => $leaseNo,
                    'master_id' => $request->master,
                    'master_price' => $price->master_price_usd,
                    'cargo_type' => $request->cargo_type,
                    'pricetype' => 'TZS',
                    'customer_id' => $request->customerId ?? null,
                    'customer_name' => $request->customerName,
                    'chasis_number' => $request->chasis_number,
                    'It_number' => $request->ITNumber,
                    'brand' => $request->brand,
                    'trailer_number' => $request->TrailerNumber,
                    'truck_number' => $request->TruckNumber,
                    'tager_id' => auth()->user()->id,
                    'tag_id' => $request->tagPointId,
                    'border_id' => $request->borderId,
                    'lease_type' => $request->lease_type,
                    'driver_name' => $request->driverName,
                    'driver_licence' => $request->driverLicense,
                    'driver_phone' => $request->driverPhone,
                ]);
                if ($lease) {
                    toastr()->success('Leased Successfully', 'Successfully');
                    $master = PortStock::where('device_id', $request['master'])->first();
                    $master->update([
                        'status' => 1,
                    ]);

                    return back();
                }
            } catch (Exception $error) {
                toastr()->error($error->getMessage(), 'oops');

                return back();
            }
        }

        // LOOSE CARDGO
        elseif ($request['currency'] == 2 && $request['cargo_type'] == 1) {
            $price = Price::where('cargo_type', 'LOOSE CARGO')->first();
            try {
                $lease = Lease::create([
                    'lease_number' => $leaseNo,
                    'master_id' => $request->master,
                    'master_price' => $price->master_price_tzs,
                    'cargo_type' => $request->cargo_type,
                    'pricetype' => 'TZS',
                    'customer_id' => $request->customerId ?? null,
                    'customer_name' => $request->customerName,
                    'chasis_number' => $request->chasis_number,
                    'It_number' => $request->ITNumber,
                    'brand' => $request->brand,
                    'trailer_number' => $request->TrailerNumber,
                    'truck_number' => $request->TruckNumber,
                    'tager_id' => auth()->user()->id,
                    'tag_id' => $request->tagPointId,
                    'border_id' => $request->borderId,
                    'lease_type' => $request->lease_type,
                    'driver_name' => $request->driverName,
                    'driver_licence' => $request->driverLicense,
                    'driver_phone' => $request->driverPhone,
                ]);
                if ($lease) {
                    $master = PortStock::where('device_id', $request['master'])->first();
                    $master->update([
                        'status' => 1,
                    ]);

                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                }
            } catch (Exception $error) {
                toastr()->error($error->getMessage(), 'oops');

                return back();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $bill_no = DB::table('leases')->count();
        $count = $bill_no + date('s') + 1;
        $leaseNo = 'LS'.date('dmys').'00'.$count;
        $price = Price::all();

        // dd($request);

        // CASH

        if ($request['lease_type'] == '1') {
            // dd($request);

            // USD
            if ($request['currency'] == 1) {
                $masterPrice = Price::select('price')->where('devicetype', 'master')
                    ->where('currency_type', 'USD')->first();
                $slavePrice = Price::select('price')->where('devicetype', 'slave')
                    ->where('currency_type', 'USD')->first();
                $slaveArray = $request->input('slave');
                $slave = 0;

                // dd($slave * $slavePrice->price)

                if ($request['slave'] != null) {
                    foreach ($slaveArray as $key => $slave) {
                        // dd($key);
                        $slave = $key + 1;
                    }

                    try {
                        foreach ($slaveArray as $key => $slave) {
                            $slave = (int) $slave;
                            // dd($slave);
                            $lease = Lease::create([
                                'lease_number' => $leaseNo,
                                'master_id' => $request->master,
                                'master_price' => $masterPrice->price,
                                'slave_price' => $slave * $slavePrice->price,
                                'cargo_type' => $request->cargo_type,
                                'slave_id' => $slave,
                                'customer_name' => $request->customerName,
                                'chasis_number' => $request->chasis_number,
                                'It_number' => $request->ITNumber,
                                'brand' => $request->brand,
                                'trailer_number' => $request->TrailerNumber,
                                'truck_number' => $request->TruckNumber,
                                'tager_id' => auth()->user()->id,
                                'tag_id' => $request->tagPointId,
                                'border_id' => $request->borderId,
                                'lease_type' => $request->lease_type,
                                'driver_name' => $request->driverName,
                                'driver_licence' => $request->driverLicense,
                                'driver_phone' => $request->driverPhone,
                            ]);
                        }
                        toastr()->success('Leased Successfully', 'Successfully');

                        return back();
                    } catch (Exception $e) {

                        toastr()->error($e->getMessage(), 'oops');

                        return back();
                    }
                }

                // dd($request);
                try {
                    $slave = (int) $slave;
                    // dd($slave);
                    $lease = Lease::create([
                        'lease_number' => $leaseNo,
                        'master_id' => $request->master,
                        'master_price' => $masterPrice->price,
                        'cargo_type' => $request->cargo_type,
                        'slave_price' => $slave * $slavePrice->price,
                        'customer_name' => $request->customerName,
                        'chasis_number' => $request->chasis_number,
                        'It_number' => $request->ITNumber,
                        'brand' => $request->brand,
                        'tager_id' => auth()->user()->id,
                        'trailer_number' => $request->TrailerNumber,
                        'truck_number' => $request->TruckNumber,
                        'tag_id' => $request->tagPointId,
                        'border_id' => $request->borderId,
                        'lease_type' => $request->lease_type,
                        'driver_name' => $request->driverName,
                        'driver_licence' => $request->driverLicense,
                        'driver_phone' => $request->driverPhone,
                    ]);

                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                } catch (Exception $e) {

                    toastr()->error($e->getMessage(), 'oops');

                    return back();
                }
            }

            // TSH

            else {
                $masterPrice = Price::select('price')->where('devicetype', 'master')
                    ->where('currency_type', 'TSH')->first();
                $slavePrice = Price::select('price')->where('devicetype', 'slave')
                    ->where('currency_type', 'TSH')->first();
                $slaveArray = $request->input('slave');
                $slave = 0;
                if ($request['slave'] != null) {
                    foreach ($slaveArray as $key => $slave) {
                        // dd($key);
                        $slave = $key + 1;
                    }

                    try {
                        foreach ($slaveArray as $key => $slave) {
                            $lease = Lease::create([
                                'lease_number' => $leaseNo,
                                'master_id' => $request->master,
                                'master_price' => $masterPrice->price,
                                'slave_price' => $slave * $slavePrice->price,
                                'slave_id' => $slave,
                                'cargo_type' => $request->cargo_type,
                                'chasis_number' => $request->chasis_number,
                                'It_number' => $request->ITNumber,
                                'brand' => $request->brand,
                                'trailer_number' => $request->TrailerNumber,
                                'truck_number' => $request->TruckNumber,
                                'tager_id' => auth()->user()->id,
                                'tag_id' => $request->tagPointId,
                                'border_id' => $request->borderId,
                                'lease_type' => $request->lease_type,
                                'driver_name' => $request->driverName,
                                'driver_licence' => $request->driverLicense,
                                'driver_phone' => $request->driverPhone,
                            ]);
                        }
                        toastr()->success('Leased Successfully', 'Successfully');

                        return back();
                    } catch (Exception $e) {

                        toastr()->error($e->getMessage(), 'oops');

                        return back();
                    }
                }

                // dd($slave * $slavePrice->price);

                try {
                    $lease = Lease::create([
                        'lease_number' => $leaseNo,
                        'master_id' => $request->master,
                        'master_price' => $masterPrice->price,
                        'slave_price' => $slave * $slavePrice->price,
                        'chasis_number' => $request->chasis_number,
                        'It_number' => $request->ITNumber,
                        'cargo_type' => $request->cargo_type,
                        'brand' => $request->brand,
                        'trailer_number' => $request->TrailerNumber,
                        'truck_number' => $request->TruckNumber,
                        'tager_id' => auth()->user()->id,
                        'tag_id' => $request->tagPointId,
                        'border_id' => $request->borderId,
                        'lease_type' => $request->lease_type,
                        'driver_name' => $request->driverName,
                        'driver_licence' => $request->driverLicense,
                        'driver_phone' => $request->driverPhone,
                    ]);

                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                } catch (Exception $e) {

                    toastr()->error($e->getMessage(), 'oops');

                    return back();
                }
            }
        }

        // Bill payment
        else {
            $customer = customer::where('id', $request['customerId'])->first();
            // dd($customer);
            // USD
            if ($request['currency'] == '1') {
                $masterPrice = Price::select('price')->where('devicetype', 'master')
                    ->where('currency_type', 'USD')->first();
                $slavePrice = Price::select('price')->where('devicetype', 'slave')
                    ->where('currency_type', 'USD')->first();
                $slaveArray = $request->input('slave');
                $slave = 0;
                if ($request['slave'] != null) {
                    foreach ($slaveArray as $key => $slave) {
                        // dd($key);
                        $slave = $key + 1;
                    }

                    try {
                        foreach ($slaveArray as $key => $slave) {
                            $slave = (int) $slave;
                            // dd($slave);
                            $lease = Lease::create([
                                'lease_number' => $leaseNo,
                                'master_id' => $request->master,
                                'master_price' => $masterPrice->price,
                                'slave_price' => $slave * $slavePrice->price,
                                'slave_id' => $slave,
                                'trailer_number' => $request->TrailerNumber,
                                'truck_number' => $request->TruckNumber,
                                'customer_id' => $customer->id,
                                'chasis_number' => $request->chasis_number,
                                'It_number' => $request->ITNumber,
                                'brand' => $request->brand,
                                'tager_id' => auth()->user()->id,
                                'tag_id' => $request->tagPointId,
                                'border_id' => $request->borderId,
                                'lease_type' => $request->lease_type,
                                'driver_name' => $request->driverName,
                                'driver_licence' => $request->driverLicense,
                                'driver_phone' => $request->driverPhone,
                            ]);
                        }
                        toastr()->success('Leased Successfully', 'Successfully');

                        return back();
                    } catch (Exception $e) {
                        toastr()->error($e->getMessage(), 'oops');

                        return back();
                    }
                }
                // dd($request);

                try {
                    $slave = (int) $slave;
                    // dd($slave);
                    $lease = Lease::create([
                        'lease_number' => $leaseNo,
                        'cargo_type' => $request->cargo_type,
                        'master_id' => $request->master,
                        'master_price' => $masterPrice->price,
                        'slave_price' => $slave * $slavePrice->price,
                        'customer_id' => $customer->id,
                        'chasis_number' => $request->chasis_number,
                        'It_number' => $request->ITNumber,
                        'brand' => $request->brand,
                        'trailer_number' => $request->TrailerNumber,
                        'truck_number' => $request->TruckNumber,
                        'tager_id' => auth()->user()->id,
                        'tag_id' => $request->tagPointId,
                        'border_id' => $request->borderId,
                        'lease_type' => $request->lease_type,
                        'driver_name' => $request->driverName,
                        'driver_licence' => $request->driverLicense,
                        'driver_phone' => $request->driverPhone,
                    ]);

                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                } catch (Exception $e) {
                    toastr()->error($e->getMessage(), 'oops');

                    return back();
                }
            }

            // TSH

            else {

                $masterPrice = Price::select('price')->where('devicetype', 'master')
                    ->where('currency_type', 'TSH')->first();
                $slavePrice = Price::select('price')->where('devicetype', 'slave')
                    ->where('currency_type', 'TSH')->first();
                $slaveArray = $request->input('slave');
                $slave = 0;
                if ($request['slave'] != null) {
                    foreach ($slaveArray as $key => $slave) {
                        // dd($key);
                        $slave = $key + 1;
                    }
                    try {
                        foreach ($slaveArray as $key => $slave) {
                            $slave = (int) $slave;
                            // dd($slave);
                            $lease = Lease::create([
                                'lease_number' => $leaseNo,
                                'master_id' => $request->master,
                                'master_price' => $masterPrice->price,
                                'slave_price' => $slave * $slavePrice->price,
                                'slave_id' => $slave,
                                'cargo_type' => $request->cargo_type,
                                'customer_id' => $customer->id,
                                'chasis_number' => $request->chasis_number,
                                'It_number' => $request->ITNumber,
                                'brand' => $request->brand,
                                'trailer_number' => $request->TrailerNumber,
                                'truck_number' => $request->TruckNumber,
                                'tager_id' => auth()->user()->id,
                                'tag_id' => $request->tagPointId,
                                'border_id' => $request->borderId,
                                'lease_type' => $request->lease_type,
                                'driver_name' => $request->driverName,
                                'driver_licence' => $request->driverLicense,
                                'driver_phone' => $request->driverPhone,
                            ]);
                        }
                        toastr()->success('Leased Successfully', 'Successfully');

                        return back();
                    } catch (Exception $e) {
                        toastr()->error($e->getMessage(), 'oops');

                        return back();
                    }
                }

                // dd($slave * $slavePrice->price);

                try {
                    $lease = Lease::create([
                        'lease_number' => $leaseNo,
                        'master_id' => $request->master,
                        'master_price' => $masterPrice->price,
                        'slave_price' => $slave * $slavePrice->price,
                        'customer_id' => $customer->id,
                        'cargo_type' => $request->cargo_type,
                        'chasis_number' => $request->chasis_number,
                        'It_number' => $request->ITNumber,
                        'brand' => $request->brand,
                        'trailer_number' => $request->TrailerNumber,
                        'truck_number' => $request->TruckNumber,
                        'tager_id' => auth()->user()->id,
                        'tag_id' => $request->tagPointId,
                        'border_id' => $request->borderId,
                        'lease_type' => $request->lease_type,
                        'driver_name' => $request->driverName,
                        'driver_licence' => $request->driverLicense,
                        'driver_phone' => $request->driverPhone,
                    ]);

                    toastr()->success('Leased Successfully', 'Successfully');

                    return back();
                } catch (Exception $e) {
                    toastr()->error($e->getMessage(), 'oops');

                    return back();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $lease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function receipt($id)
    {
        // dd($id);
        $leases = Lease::with('master', 'devices', 'customer', 'border', 'tager', 'tag')->where('lease_number', $id)->where('tager_id', auth()->user()->id)->get()->unique('lease_number');
        // dd($leaseToCompare);
        return view('lease.receipt', [
            'leases' => $leases,
        ]);
    }

    public function manyreceipt(Request $request)
    {
        $leaseNumbers = $request['lease_number'];
        $leases = Lease::with('master', 'devices', 'customer', 'border', 'tager', 'tag')
            ->whereIn('lease_number', $leaseNumbers)
            ->where('tager_id', auth()->user()->id)
            ->get()
            ->unique('lease_number');
        // dd($leases);
        return view('lease.receiptMany', [
            'leases' => $leases,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        //
    }
}
