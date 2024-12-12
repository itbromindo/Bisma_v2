<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Http\Requests\PendudukRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PendudukImport;
use App\Exports\PendudukExport;

class PendudukController extends Controller
{
    public function __construct()
    {
        $this->model = new Penduduk();
    }

    public function index() : Renderable
    {
        $this->checkAuthorization(auth()->user(), ['penduduk.view']);

        return view('backend.pages.penduduk.index', [
            'listdata' => Penduduk::latest()->get(),
        ]);
    }

    public function create() : Renderable
    {
        $this->checkAuthorization(auth()->user(), ['penduduk.create']);

        $nonik = $this->generateRandomNumber();

        return view('backend.pages.penduduk.create', [
            'roles' => Role::all(),
            'nonik' => $nonik,
        ]);
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['penduduk.edit']);

        $penduduk = Penduduk::findOrFail($id);
        return view('backend.pages.penduduk.edit', [
            'penduduk' => $penduduk,
            'roles' => Role::all(),
        ]);
    }

    public function importExcel()
    {
        $this->checkAuthorization(auth()->user(), ['penduduk.importexcel']);

        return view('backend.pages.penduduk.importexcel');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        Excel::import(new PendudukImport, $request->file('file'));

        return redirect()->route('admin.penduduk.index')->with('success', 'Data Penduduk berhasil diimport.');
    }

    public function export()
    {
        return Excel::download(new PendudukExport, 'data_penduduk.csv');
    }
    
    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['penduduk.create']);
        // Validasi input
        // $request->validate([
        //     'penNik' => 'required|unique:penduduks,penNik|digits:16',
        //     'penNama' => 'required|string|max:255',
        //     'penTempatLahir' => 'required|string|max:255',
        //     'penTglLahir' => 'required|date',
        //     'penImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        if ($request->hasFile('penImage')) {
            $file = $request->file('penImage');
            $filePath = $file->getRealPath();
            $img = 'data:image/png;base64, ' .base64_encode(file_get_contents($filePath));
        } else {
            $img = '';
        }

        Penduduk::create([
            'penNik' => $request->penNik,
            'penNama' => $request->penNama,
            'penTempatLahir' => $request->penTempatLahir,
            'penTglLahir' => $request->penTglLahir,
            'penImage' => $img,
        ]);

        return redirect()->route('admin.penduduk.index')->with('success', 'Penduduk berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $this->checkAuthorization(auth()->user(), ['penduduk.edit']);

        if ($request->hasFile('penImage')) {
            $file = $request->file('penImage');
            $filePath = $file->getRealPath();
            $img = 'data:image/png;base64, ' .base64_encode(file_get_contents($filePath));
        } else {
            $img = '';
        }

        $penduduk = Penduduk::findOrFail($id);
        $penduduk->penNik = $request->penNik;
        $penduduk->penNama = $request->penNama;
        $penduduk->penTempatLahir = $request->penTempatLahir;
        $penduduk->penTglLahir = $request->penTglLahir;
        $penduduk->penImage = $img;
        $penduduk->save();

        session()->flash('success', 'Data has been updated.');
        return back();

    }

    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['penduduk.delete']);

        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();
        session()->flash('success', 'Penduduk has been deleted.');
        return back();
    }

    public function generateRandomNumber($length = 16) {
        $number = '';
        for ($i = 0; $i < $length; $i++) {
            $number .= random_int(0, 9);
        }
        return $number;
    }
}
