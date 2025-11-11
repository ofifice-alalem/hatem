<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\MilitaryInfo;
use App\Models\Rank;
use App\Models\RankCategory;
use App\Models\PendingRequest;
use Illuminate\Http\Request;

class MilitaryInfoController extends Controller
{
    public function create($nationalId)
    {
        $person = Person::where('national_id', $nationalId)->firstOrFail();
        $categories = RankCategory::all();
        $ranks = Rank::all();
        return view('military-info.create', compact('person', 'categories', 'ranks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'national_id' => 'required|exists:persons,national_id',
            'military_rank_id' => 'required|exists:ranks,id',
            'military_number' => 'nullable|string',
            'appointment_date' => 'nullable|date',
            'appointment_authority' => 'nullable|string',
            'appointment_decision_number' => 'nullable|string',
            'last_promotion_date' => 'nullable|date',
            'last_promotion_decision' => 'nullable|string',
            'last_promotion_year' => 'nullable|integer',
            'seniority' => 'nullable|string'
        ]);

        MilitaryInfo::create($request->all());
        
        // تحديث الرتبة في جدول persons
        Person::where('national_id', $request->national_id)
              ->update(['rank_id' => $request->military_rank_id]);

        return redirect()->route('persons.index')->with('success', 'تم حفظ المعلومات العسكرية بنجاح');
    }

    public function edit($id)
    {
        $militaryInfo = MilitaryInfo::with('person')->findOrFail($id);
        $ranks = Rank::with('category')->get();
        return view('military-info.edit', compact('militaryInfo', 'ranks'));
    }

    public function update(Request $request, $id)
    {
        $militaryInfo = MilitaryInfo::findOrFail($id);
        
        $request->validate([
            'military_rank_id' => 'required|exists:ranks,id',
            'military_number' => 'nullable|string',
            'appointment_date' => 'nullable|date',
            'appointment_authority' => 'nullable|string',
            'appointment_decision_number' => 'nullable|string',
            'last_promotion_date' => 'nullable|date',
            'last_promotion_decision' => 'nullable|string',
            'last_promotion_year' => 'nullable|integer',
            'seniority' => 'nullable|string'
        ]);

        // إنشاء طلب معلق للموافقة
        PendingRequest::create([
            'type' => 'military_info',
            'record_id' => $militaryInfo->id,
            'original_data' => $militaryInfo->toArray(),
            'new_data' => $request->all(),
            'requested_by' => 'المستخدم الحالي'
        ]);

        return redirect()->route('persons.index')->with('success', 'تم إرسال طلب تعديل المعلومات العسكرية للمراجعة');
    }
}