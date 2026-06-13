<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Spatie\LaravelPdf\Support\pdf;

class TransactionController extends Controller
{
    /**
     * Export transactions to PDF.
     */
    public function exportPdf()
    {
        $transactions = Transaction::orderBy('tanggal', 'desc')->get();
        $totalPemasukan = Transaction::where('jenis', 'masuk')->where('status', 'berhasil')->sum('nominal');
        $totalPengeluaran = Transaction::where('jenis', 'keluar')->where('status', 'berhasil')->sum('nominal');

        return pdf()
            ->view('transactions.pdf', compact('transactions', 'totalPemasukan', 'totalPengeluaran'))
            ->name('laporan-transaksi.pdf');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::orderBy('tanggal', 'desc')->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:masuk,keluar',
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'status' => 'required|in:berhasil,pending,batal',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('transactions', 'public');
            $validated['foto'] = $fotoPath;
        }

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:masuk,keluar',
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'status' => 'required|in:berhasil,pending,batal',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($transaction->foto && Storage::disk('public')->exists($transaction->foto)) {
                Storage::disk('public')->delete($transaction->foto);
            }

            $foto = $request->file('foto');
            $fotoPath = $foto->store('transactions', 'public');
            $validated['foto'] = $fotoPath;
        }

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // Delete associated foto file
        if ($transaction->foto && Storage::disk('public')->exists($transaction->foto)) {
            Storage::disk('public')->delete($transaction->foto);
        }

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
