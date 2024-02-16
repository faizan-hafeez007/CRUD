<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reg;
use App\Models\Lender;
use Illuminate\Http\Request;

class LenderController extends Controller
{

    public function create($id)
    {
        $reg = Reg::findOrFail($id);
        $reg_name = $reg->regName;
        $reg_id = $reg->id;

        return view('lender.lender')->with(['reg_id' => $reg_id, 'reg_name' => $reg_name]);
    }

    public function reg()
    {
        return view('lender.reg');
    }

    public function reg_store(Request $request)
    {
        $validated = $request->validate([
            'regName' => 'required',
        ]);

        $reg = new Reg;
        $reg->regName = $validated['regName'];
        $saveSuccess = $reg->save();
        $reg_id = $reg->id;

        if ($saveSuccess) {
            return redirect("/admin/vehicle/create/{$reg_id}");
        }

        return redirect('/admin/vehicle/reg');
    }

    public function reg_index($id)
    {
        $reg = Reg::findOrFail($id);

        $reg_id = $reg->id;
        return view('lender.lender', ['reg_id' => $reg_id]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'ownerName' => 'required',
            'carModel' => 'required',
            'reg_id' => 'required',
            'vehicleCount' => 'required',
        ]);

        $lender = new Lender([
            'ownerName' => $validated['ownerName'],
            'carModel' => $validated['carModel'],
            'reg_id' => $validated['reg_id'],
            'vehicleCount' => $validated['vehicleCount'],
        ]);

        $saveSuccess = $lender->save();

        if ($saveSuccess) {
            return redirect("/admin/car/show/{$lender->reg_id}")->with('success', 'Form data submitted successfully!');
        } else {

            return redirect()->back()->with('error', 'Error saving data to the database.');
        }
    }

    public function car(Request $request)
    {
        $validatedData = $request->validate([
            'reg.*' => 'required|max:255',
            'value.*' => 'required|numeric',
            'lender.*' => 'required|max:255',
            'reg_id' => 'required',
        ]);
        $allSaved = true;

        foreach ($request->reg as $index => $reg) {
            $car = new Car;
            $car->reg = $reg;
            $car->value = $request->value[$index];
            $car->lender = $request->lender[$index];
            $car->reg_id = $request->reg_id;
            if (!$car->save()) {
                $allSaved = false;
            }
            // dd($request->all());
        }

        if ($allSaved) {
            return redirect('/admin/car/thankYou')->with('success', 'Form data submitted successfully!');
        } else {
            return redirect('/admin/vehicle/show')->with('error', 'Some cars could not be saved.');
        }
    }

    public function index($reg_id)
    {
        $lender = Lender::where('reg_id', $reg_id)->firstOrFail();

        $reg_id = $lender->reg_id;
        $vehicleCount = $lender->vehicleCount;

        return view('lender.show', compact('reg_id', 'vehicleCount'));
    }
    public function car_index()
    {

        $latestLender = Lender::latest()->first();
        if ($latestLender) {
            $ownerName = $latestLender->ownerName;

            return view('lender.thankyou', ['ownerName' => $ownerName]);
        } else {
            return view('lender.thankyou', ['ownerName' => '']);
        }
    }
}
