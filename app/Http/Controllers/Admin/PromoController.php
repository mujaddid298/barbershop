<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $query = Promo::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('kode', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        }

        $promos = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('pages.admin.promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:promos,kode',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:persentase,nominal',
            'nominal' => 'required|integer|min:1',
            'minimal_transaksi' => 'required|integer|min:0',
            'kuota' => 'required|integer|min:0',
            'mulai_berlaku' => 'nullable|date',
            'akhir_berlaku' => 'nullable|date|after_or_equal:mulai_berlaku',
            'status' => 'required|boolean',
        ], [
            'kode.required' => 'Kode promo wajib diisi.',
            'kode.unique' => 'Kode promo sudah terdaftar.',
            'nama.required' => 'Nama promo wajib diisi.',
            'tipe.required' => 'Tipe diskon wajib dipilih.',
            'nominal.required' => 'Nominal diskon wajib diisi.',
            'nominal.min' => 'Nominal diskon minimal 1.',
            'minimal_transaksi.required' => 'Minimal transaksi wajib diisi.',
            'kuota.required' => 'Kuota wajib diisi.',
            'akhir_berlaku.after_or_equal' => 'Tanggal akhir berlaku tidak boleh sebelum tanggal mulai.',
        ]);

        $data = $request->all();
        $data['kode'] = strtoupper(trim($request->kode));

        // Validation for percentage max 100
        if ($request->tipe === 'persentase' && $request->nominal > 100) {
            return back()->withErrors(['nominal' => 'Diskon persentase tidak boleh melebihi 100%.'])->withInput();
        }

        Promo::create($data);

        return redirect()->route('admin.promo')->with('success', 'Promo berhasil dibuat!');
    }

    public function edit(Promo $promo)
    {
        return view('pages.admin.promo.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'kode' => 'required|string|unique:promos,kode,'.$promo->id,
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:persentase,nominal',
            'nominal' => 'required|integer|min:1',
            'minimal_transaksi' => 'required|integer|min:0',
            'kuota' => 'required|integer|min:0',
            'mulai_berlaku' => 'nullable|date',
            'akhir_berlaku' => 'nullable|date|after_or_equal:mulai_berlaku',
            'status' => 'required|boolean',
        ], [
            'kode.required' => 'Kode promo wajib diisi.',
            'kode.unique' => 'Kode promo sudah terdaftar.',
            'nama.required' => 'Nama promo wajib diisi.',
            'tipe.required' => 'Tipe diskon wajib dipilih.',
            'nominal.required' => 'Nominal diskon wajib diisi.',
            'nominal.min' => 'Nominal diskon minimal 1.',
            'minimal_transaksi.required' => 'Minimal transaksi wajib diisi.',
            'kuota.required' => 'Kuota wajib diisi.',
            'akhir_berlaku.after_or_equal' => 'Tanggal akhir berlaku tidak boleh sebelum tanggal mulai.',
        ]);

        $data = $request->all();
        $data['kode'] = strtoupper(trim($request->kode));

        // Validation for percentage max 100
        if ($request->tipe === 'persentase' && $request->nominal > 100) {
            return back()->withErrors(['nominal' => 'Diskon persentase tidak boleh melebihi 100%.'])->withInput();
        }

        $promo->update($data);

        return redirect()->route('admin.promo')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();

        return redirect()->route('admin.promo')->with('success', 'Promo berhasil dihapus!');
    }
}
