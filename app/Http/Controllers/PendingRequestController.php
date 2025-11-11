<?php

namespace App\Http\Controllers;

use App\Models\PendingRequest;
use App\Models\Person;
use App\Models\MilitaryInfo;
use App\Models\WorkInfo;
use Illuminate\Http\Request;

class PendingRequestController extends Controller
{
    public function index()
    {
        $requests = PendingRequest::where('status', 'pending')
                                 ->orderBy('created_at', 'desc')
                                 ->get();
        
        // جلب البيانات المرجعية لتحويل IDs إلى نصوص
        $ranks = \App\Models\Rank::pluck('rank_name', 'id');
        $employmentStatuses = \App\Models\EmploymentStatus::pluck('status_name', 'id');
        
        return view('pending.index', compact('requests', 'ranks', 'employmentStatuses'));
    }

    public function approve($id)
    {
        $pendingRequest = PendingRequest::findOrFail($id);
        
        switch ($pendingRequest->type) {
            case 'person':
                $person = Person::find($pendingRequest->record_id);
                $person->update($pendingRequest->new_data);
                // التزامن يتم تلقائياً عبر Model Events
                break;
                
            case 'military_info':
                $militaryInfo = MilitaryInfo::find($pendingRequest->record_id);
                $militaryInfo->update($pendingRequest->new_data);
                // التزامن يتم تلقائياً عبر Model Events
                break;
                
            case 'work_info':
                $workInfo = WorkInfo::find($pendingRequest->record_id);
                $workInfo->update($pendingRequest->new_data);
                break;
        }
        
        $pendingRequest->update([
            'status' => 'approved',
            'reviewed_by' => 'المراجع الحالي'
        ]);
        
        return redirect()->route('pending.index')->with('success', 'تم الموافقة على الطلب بنجاح');
    }

    public function reject(Request $request, $id)
    {
        $pendingRequest = PendingRequest::findOrFail($id);
        $pendingRequest->update([
            'status' => 'rejected',
            'reviewed_by' => 'المراجع الحالي',
            'rejection_reason' => $request->rejection_reason
        ]);
        
        return redirect()->route('pending.index')->with('success', 'تم رفض الطلب');
    }
}
