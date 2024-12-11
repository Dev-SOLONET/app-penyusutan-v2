<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BiayaDimuka;

class BiayaDimukaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('from') && $request->has('to')) {
            $data = BiayaDimuka::with(['account_debit', 'account_kredit'])->where('tgl', '>=', $request->get('from'))
                ->where('tgl', '<=', $request->get('to'))
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $data = BiayaDimuka::with(['account_debit', 'account_kredit'])->where('tgl', '>=', date('Y-01-01'))
                ->where('tgl', '<=', date('Y-12-31'))
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        return view('management.biaya-dimuka.index', [
            'title' => 'Data Biaya Dimuka',
            'data'  => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
