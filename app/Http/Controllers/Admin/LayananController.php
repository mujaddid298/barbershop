<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $query = Layanan::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%')
                ->orWhere('deskripsi', 'like', '%'.$request->search.'%');
        }

        $layanans = $query->latest()->get();

        return view('pages.admin.layanan.layanan', compact('layanans'));
    }

    public function create()
    {
        return view('pages.admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
        ], [
            'nama.required' => 'Nama layanan wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'durasi.required' => 'Durasi wajib diisi.',
            'durasi.integer' => 'Durasi harus berupa angka (menit).',
        ]);

        Layanan::create($request->only('nama', 'deskripsi', 'harga', 'durasi'));

        return redirect()->route('admin.layanan')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {

        return view('pages.admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
        ], [
            'nama.required' => 'Nama layanan wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'durasi.required' => 'Durasi wajib diisi.',
            'durasi.integer' => 'Durasi harus berupa angka (menit).',
        ]);

        $layanan->update($request->only('nama', 'deskripsi', 'harga', 'durasi'));

        return redirect()->route('admin.layanan')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()->route('admin.layanan')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
