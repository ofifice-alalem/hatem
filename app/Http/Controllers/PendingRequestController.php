<?php

namespace App\Http\Controllers;

use App\Models\PendingRequest;
use App\Models\Person;
use App\Models\MilitaryInfo;
use Illuminate\Http\Request;

class PendingRequestController extends Controller
{
    public function index()
    {
        $requests = PendingRequest::with(['person', 'oldType', 'newType', 'oldRank', 'newRank'])
                                 ->where('status', 'pending')
                                 ->orderBy('created_at', 'desc')
                                 ->get();
        return view('pending.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = PendingRequest::findOrFail($id);
        $person = $request->person;
        
        // تحديث بيانات الشخص
        $person->update([
            'type_id' => $request->new_type_id,
            'rank_id' => $request->new_rank_id
        ]);
        
        // تحديث المعلومات العسكرية
        if ($request->new_military_no) {
            MilitaryInfo::updateOrCreate(
                ['national_no' => $person->national_no],
                ['military_no' => $request->new_military_no]
            );
        } else {
            MilitaryInfo::where('national_no', $person->national_no)->delete();
        }
        
        $request->update(['status' => 'approved']);
        
        return redirect()->route('pending.index')->with('success', 'تم الموافقة على الطلب بنجاح');
    }

    public function reject($id)
    {
        $request = PendingRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);
        
        return redirect()->route('pending.index')->with('success', 'تم رفض الطلب');
    }
}
