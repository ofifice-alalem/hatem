<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\Person;
use App\Models\RankCategory;
use App\Models\MilitaryInfo;
use App\Models\WorkInfo;
use App\Models\EmploymentStatus;
use App\Models\PendingRequest;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $query = Person::with(['rank.category', 'militaryInfo', 'workInfo']);
        
        // فلتر البحث النصي
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('national_id', $search)
                  ->orWhereHas('militaryInfo', function($mq) use ($search) {
                      $mq->where('military_number', $search);
                  });
            });
        }
        
        // فلتر الفئة
        if ($request->filled('category_id')) {
            $query->whereHas('rank', function($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }
        
        // فلتر الرتبة
        if ($request->filled('rank_id')) {
            $query->where('rank_id', $request->rank_id);
        }
        
        $persons = $query->paginate(50)->withQueryString();
        $categories = RankCategory::all();
        $ranks = Rank::all();
        
        return view('persons.index', compact('persons', 'categories', 'ranks'));
    }

    public function create()
    {
        $categories = RankCategory::all();
        $ranks = Rank::all();
        $employmentStatuses = EmploymentStatus::all();
        return view('persons.create', compact('categories', 'ranks', 'employmentStatuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_number' => 'required|string',
            'national_id' => 'required|string|unique:persons',
            'name' => 'required|string'
        ]);

        $person = Person::create($request->only([
            'file_type', 'file_number', 'name', 'birth_date', 'birth_place',
            'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
            'personal_card_number', 'passport_number'
        ]));

        // إنشاء المعلومات العسكرية إذا تم إدخالها
        if ($request->filled('military_rank_id') || $request->filled('military_number')) {
            $militaryInfo = MilitaryInfo::create([
                'national_id' => $person->national_id,
                'military_rank_id' => $request->military_rank_id,
                'military_number' => $request->military_number,
                'appointment_date' => $request->appointment_date,
                'appointment_authority' => $request->appointment_authority,
                'appointment_decision_number' => $request->appointment_decision_number,
                'last_promotion_date' => $request->last_promotion_date,
                'last_promotion_decision' => $request->last_promotion_decision,
                'last_promotion_year' => $request->last_promotion_year,
                'seniority' => $request->seniority
            ]);
            
            // تحديث جدول persons بالرتبة من المعلومات العسكرية
            if ($request->filled('military_rank_id')) {
                $person->update(['rank_id' => $request->military_rank_id]);
            }
        }

        // إنشاء معلومات العمل إذا تم إدخالها
        if ($request->filled('work_authority') || $request->filled('employment_status_id')) {
            WorkInfo::create([
                'national_id' => $person->national_id,
                'work_authority' => $request->work_authority,
                'work_location' => $request->work_location,
                'office' => $request->office,
                'assigned_task' => $request->assigned_task,
                'employment_status_id' => $request->employment_status_id,
                'employment_status_detail' => $request->employment_status_detail,
                'employment_notes' => $request->employment_notes,
                'reviewed' => $request->boolean('reviewed'),
                'leadership' => $request->boolean('leadership'),
                'financial_number' => $request->financial_number,
                'direct_date' => $request->direct_date,
                'wife_nationality' => $request->wife_nationality,
                'transfer_decision_number' => $request->transfer_decision_number,
                'transfer_date' => $request->transfer_date,
                'transfer_authority' => $request->transfer_authority,
                'academic_degree' => $request->academic_degree,
                'academic_degree_date' => $request->academic_degree_date
            ]);
        }

        return redirect()->route('persons.index')->with('success', 'تم حفظ البيانات بنجاح');
    }

    public function edit(Person $person)
    {
        $categories = RankCategory::all();
        $ranks = Rank::all();
        $employmentStatuses = EmploymentStatus::all();
        return view('persons.edit', compact('person', 'categories', 'ranks', 'employmentStatuses'));
    }

    public function update(Request $request, Person $person)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_number' => 'required|string',
            'national_id' => 'required|string|unique:persons,national_id,' . $person->id,
            'name' => 'required|string'
        ]);

        $requestData = $request->only([
            'file_type', 'file_number', 'name', 'birth_date', 'birth_place',
            'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
            'personal_card_number', 'passport_number'
        ]);

        // فلترة الحقول المتغيرة فقط
        $originalData = $person->only(array_keys($requestData));
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
            'type' => 'person',
            'record_id' => $person->id,
            'original_data' => $originalData,
            'new_data' => $changedData,
            'requested_by' => 'المستخدم الحالي'
        ]);

        return redirect()->route('persons.index')->with('success', 'تم إرسال طلب التعديل للمراجعة');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('persons.index')->with('success', 'تم حذف البيانات بنجاح');
    }

    public function getRanksByCategory($categoryId)
    {
        $ranks = Rank::where('category_id', $categoryId)->get();
        return response()->json($ranks);
    }
}
