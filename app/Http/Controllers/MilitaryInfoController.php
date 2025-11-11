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
        $militaryInfo = MilitaryInfo::with('person.rank.category')->findOrFail($id);
        
        // فلترة الرتب حسب فئة الشخص
        $categoryId = $militaryInfo->person->rank->category_id ?? null;
        $ranks = $categoryId ? Rank::where('category_id', $categoryId)->get() : Rank::all();
        
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

        $requestData = $request->only([
            'military_rank_id', 'military_number', 'appointment_date', 'appointment_authority',
            'appointment_decision_number', 'last_promotion_date', 'last_promotion_decision',
            'last_promotion_year', 'seniority'
        ]);

        // فلترة الحقول المتغيرة فقط
        $originalData = $militaryInfo->only(array_keys($requestData));
        $changedData = [];
        
        foreach($requestData as $key => $value) {
            if($originalData[$key] != $value) {
                $changedData[$key] = $value;
            }
        }

        if(empty($changedData)) {
            return redirect()->route('persons.index')->with('info', 'لم يتم إجراء أي تغييرات');
        }

        // إنشاء طلب معلق للموافقة
        PendingRequest::create([
            'type' => 'military_info',
            'record_id' => $militaryInfo->id,
            'original_data' => $originalData,
            'new_data' => $changedData,
            'requested_by' => 'المستخدم الحالي'
        ]);

        return redirect()->route('persons.index')->with('success', 'تم إرسال طلب تعديل المعلومات العسكرية للمراجعة');
    }
}