<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilKarya;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HasilKaryaController extends Controller
{
    public function index(Request $request)
    {
        $hasilKaryas = HasilKarya::with('barber')
            ->when($request->search, function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhereHas('barber', function ($sub) use ($request) {
                      $sub->where('nama', 'like', '%' . $request->search . '%');
                  });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $totalCount = HasilKarya::count();

        return view('pages.admin.hasil_karya.index', compact('hasilKaryas', 'totalCount'));
    }

    public function create()
    {
        $barbers = Barber::where('status', true)->orderBy('nama')->get();
        return view('pages.admin.hasil_karya.create', compact('barbers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'barber_id' => 'nullable|exists:barbers,id',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('hasil_karya', 'public');
        }

        HasilKarya::create($validated);

        return redirect()->route('admin.hasil-karya.index')
            ->with('success', 'Hasil karya berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $hasilKarya = HasilKarya::findOrFail($id);
        $barbers = Barber::where('status', true)->orderBy('nama')->get();
        return view('pages.admin.hasil_karya.edit', compact('hasilKarya', 'barbers'));
    }

    public function update(Request $request, $id)
    {
        $hasilKarya = HasilKarya::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'barber_id' => 'nullable|exists:barbers,id',
        ]);

        if ($request->hasFile('foto')) {
            if ($hasilKarya->foto) {
                Storage::disk('public')->delete($hasilKarya->foto);
            }
            $validated['foto'] = $request->file('foto')->store('hasil_karya', 'public');
        } else {
            unset($validated['foto']);
        }

        $hasilKarya->update($validated);

        return redirect()->route('admin.hasil-karya.index')
            ->with('success', 'Hasil karya berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $hasilKarya = HasilKarya::findOrFail($id);

        if ($hasilKarya->foto) {
            Storage::disk('public')->delete($hasilKarya->foto);
        }

        $hasilKarya->delete();

        return redirect()->route('admin.hasil-karya.index')
            ->with('success', 'Hasil karya berhasil dihapus.');
    }
}
