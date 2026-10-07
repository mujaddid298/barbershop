<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarberController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $barbers = Barber::query()
            ->when($request->search, fn ($q) =>
                $q->where('nama', 'like', '%' . $request->search . '%')
            )
            ->when(in_array($status, ['0', '1']), fn ($q) =>
                $q->where('status', $status)
            )
            ->orderBy('nama')
            ->get();

        $totalCount = Barber::count();
        $aktifCount = Barber::where('status', true)->count();
        $nonaktifCount = Barber::where('status', false)->count();

        return view('pages.admin.barbers.barbers', compact('barbers', 'totalCount', 'aktifCount', 'nonaktifCount'));
    }

    public function create()
    {
        return view('pages.admin.barbers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'keahlian' => 'nullable|string|max:100',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'   => 'required|boolean',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('barbers', 'public');
        }

        Barber::create($validated);

        return redirect()->route('admin.barber')
            ->with('success', 'Barber berhasil ditambahkan.');
    }

    public function edit(Barber $barber)
    {
        return view('pages.admin.barbers.edit', compact('barber'));
    }

    public function update(Request $request, Barber $barber)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'keahlian' => 'nullable|string|max:100',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'   => 'required|boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($barber->foto) {
                Storage::disk('public')->delete($barber->foto);
            }
            $validated['foto'] = $request->file('foto')->store('barbers', 'public');
        } else {
            unset($validated['foto']);
        }

        $barber->update($validated);

        return redirect()->route('admin.barber')
            ->with('success', 'Barber berhasil diperbarui.');
    }

    public function destroy(Barber $barber)
    {
        if ($barber->foto) {
            Storage::disk('public')->delete($barber->foto);
        }

        $barber->delete();

        return redirect()->route('admin.barber')
            ->with('success', 'Barber berhasil dihapus.');
    }
}