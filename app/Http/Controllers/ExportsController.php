<?php

namespace App\Http\Controllers;

use App\Exports\CollectionExport;
use App\Exports\MembershipExport;
use App\Models\Role;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{
    public function memberships_export_page()
    {
        $roles = Role::all();
        return view('reports.member', compact('roles'));
    }

    public function collection_export_page()
    {
        return view('reports.collection');
    }


    public function memberships_export_system(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'roles'      => 'nullable|array',
            'columns'    => 'nullable|array',
        ]);

        $filename = 'Laporan_Anggota_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(
            new MembershipExport($request->start_date, $request->end_date, $request->roles, $request->columns),
            $filename
        );
    }

    public function collection_export_system(Request $request)
    {
    $request->validate([
        'start_date' => 'nullable|date',
        'end_date'   => 'nullable|date|after_or_equal:start_date',
        'columns'    => 'required|array|min:1',
        'all_data'   => 'nullable|boolean',
    ]);

    $filename = 'Laporan_Koleksi_' . now()->format('Ymd_His') . '.xlsx';

    return Excel::download(
        new CollectionExport(
        $request->start_date,
        $request->end_date,
        $request->boolean('all_data'),
        (array) $request->columns
        ),
        $filename
    );
    }
}
