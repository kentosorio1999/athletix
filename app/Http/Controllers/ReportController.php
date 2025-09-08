<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Athlete;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function export($type)
    {
        $users = User::with('athlete')->where('removed',0)->get();

        if($type == 'csv') {
            $filename = 'users_report_'.date('Ymd_His').'.csv';
            $handle = fopen(storage_path("app/public/$filename"), 'w');
            fputcsv($handle, ['ID','Username','Role','Name','Status']);
            foreach($users as $user){
                fputcsv($handle, [
                    $user->user_id,
                    $user->username,
                    $user->role,
                    $user->athlete?->full_name ?? 'N/A',
                    $user->removed==0?'Active':'Inactive'
                ]);
            }
            fclose($handle);
            return response()->download(storage_path("app/public/$filename"));
        }

        if($type == 'pdf'){
            // For simplicity, return a placeholder
            return response('PDF export is not implemented yet.');
        }

        abort(404);
    }
}
