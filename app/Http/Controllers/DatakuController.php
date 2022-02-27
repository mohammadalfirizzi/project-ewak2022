<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatakuModel;
use App\Models\Dataku;
use Illuminate\Validation\ConditionalRules;
use Dompdf\Dompdf;

class DatakuController extends Controller
{
     public function __construct()
    {
        $this->DatakuModel = new DatakuModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $dataku = DatakuModel::all();
        return view('dataku.v_dataku', compact('dataku'));
    }

    public function add_dataku()
    {
        $dataku = DatakuModel::all();
        return view('dataku.v_add_dataku', compact('dataku'));
    }

    public function edit_dataku($id)
    {
        $dataku = DatakuModel::find($id);
        return view('dataku.v_edit_dataku', compact('dataku'));
    }

    public function insert_dataku(Request $request)
    {
        DatakuModel::create($request->all());
        Request()->validate([
            'id' => 'required',
            'tanggal' => 'required',
            'source_id' => 'required',
            'crew' => 'required',
            'dest_id' => 'required',
            'lat' => 'required',
            'longitude' => 'required',
            'message' => 'required',
        ],[
            'id.required'=>' id wajib diisi !!',
            'tanggal.required'=>' tanggal wajib diisi !!',
            'source_id.required' => 'source id wajib diisi !!',
            'crew.required' => 'crew wajib diisi !!',
            'dest_id.required' => 'dest id wajib diisi !!',
            'lat.required' => 'lat wajib diisi !!',
            'longitude.required' => 'longitude wajib diisi !!',
            'message.required' => 'message wajib diisi !!',
        ]);

        $dataku = [
            'id' => Request()->id,
            'tanggal' => Request()->tanggal,
            'source_id' => Request()->source_id,
            'crew' => Request()->crew,
            'dest_id' => Request()->dest_id,
            'lat' => Request()->lat,
            'longitude' => Request()->longitude,
            'message' => Request()->message,
        ];
        $this->DatakuModel->addData($dataku);
        return redirect()->route('dataku');
    }

    public function update_dataku(Request $request, $id)
    {
        $dataku = DatakuModel::find($id);
        $dataku->update($request->all());
        Request()->validate([
            'id' => 'required',
            'tanggal' => 'required',
            'source_id' => 'required',
            'crew' => 'required',
            'dest_id' => 'required',
            'lat' => 'required',
            'longitude' => 'required',
            'message' => 'required',
        ],[
            'id'=>' id dataku wajib diisi !!',
            'tanggal.required'=>' tanggal wajib diisi !!',
            'source_id.required' => 'source id wajib diisi !!',
            'crew.required' => 'crew wajib diisi !!',
            'dest_id.required' => 'dest id wajib diisi !!',
            'lat.required' => 'lat wajib diisi !!',
            'longitude.required' => 'longitude wajib diisi !!',
            'message.required' => 'message wajib diisi !!',
        ]);
        $this->DatakuModel->editData($dataku);
        return redirect()->route('dataku');
    }

    public function delete_dataku($id)
    {
        $dataku = DatakuModel::find($id);
        $dataku->delete();
        return redirect()->route('dataku');
    }

    public function printer_dataku()
    {
        $dataku = DatakuModel::all();
        return view('dataku.v_printer_dataku', compact('dataku'));
    }

    public function printpdf_dataku()
    {
        $dataku = DatakuModel::all();
        $html = view('dataku.v_printpdf_dataku', compact('dataku'));

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
