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

class NonCommissionedOfficerController extends Controller
{
    private $categoryId = 2; // ID فئة ضباط الصف

    public function index(Request $request)
    {
        $query = Person::with(['rank.category', 'militaryInfo', 'workInfo'])
                      ->whereHas('rank', function($q) {
                          $q->where('category_id', $this->categoryId);
                      });
        
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
        
        if ($request->filled('rank_id')) {
            $query->where('rank_id', $request->rank_id);
        }
        
        $persons = $query->paginate(50)->withQueryString();
        $ranks = Rank::where('category_id', $this->categoryId)->get();
        $category = RankCategory::find($this->categoryId);
        
        return view('non-commissioned-officers.index', compact('persons', 'ranks', 'category'));
    }

    public function create()
    {
        $ranks = Rank::where('category_id', $this->categoryId)->get();
        $employmentStatuses = EmploymentStatus::all();
        $category = RankCategory::find($this->categoryId);
        return view('non-commissioned-officers.create', compact('ranks', 'employmentStatuses', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_number' => 'required|string',
            'national_id' => 'required|string|unique:persons',
            'name' => 'required|string',
            'military_rank_id' => 'required|exists:ranks,id',
            'military_number' => 'required|string'
        ]);

        $person = Person::create($request->only([
            'file_type', 'file_number', 'name', 'birth_date', 'birth_place',
            'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
            'personal_card_number', 'passport_number'
        ]));

        $person->update(['rank_id' => $request->military_rank_id]);

        MilitaryInfo::create([
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

        return redirect()->route('non-commissioned-officers.index')->with('success', 'تم حفظ بيانات ضابط الصف بنجاح');
    }

    public function edit(Person $nonCommissionedOfficer)
    {
        $ranks = Rank::where('category_id', $this->categoryId)->get();
        $employmentStatuses = EmploymentStatus::all();
        $category = RankCategory::find($this->categoryId);
        return view('non-commissioned-officers.edit', compact('nonCommissionedOfficer', 'ranks', 'employmentStatuses', 'category'));
    }

    public function update(Request $request, Person $nonCommissionedOfficer)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_number' => 'required|string',
            'national_id' => 'required|string|unique:persons,national_id,' . $nonCommissionedOfficer->id,
            'name' => 'required|string'
        ]);

        $newData = $request->only([
            'file_type', 'file_number', 'name', 'birth_date', 'birth_place',
            'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
            'personal_card_number', 'passport_number'
        ]);

        // تحديث المعلومات العسكرية
        if ($request->filled('military_rank_id')) {
            $nonCommissionedOfficer->militaryInfo()->updateOrCreate(
                ['national_id' => $nonCommissionedOfficer->national_id],
                [
                    'military_rank_id' => $request->military_rank_id,
                    'military_number' => $request->military_number
                ]
            );
            $nonCommissionedOfficer->update(['rank_id' => $request->military_rank_id]);
        }

        PendingRequest::create([
            'type' => 'person',
            'record_id' => $nonCommissionedOfficer->id,
            'original_data' => $nonCommissionedOfficer->toArray(),
            'new_data' => $newData,
            'requested_by' => 'المستخدم الحالي'
        ]);

        return redirect()->route('non-commissioned-officers.index')->with('success', 'تم إرسال طلب تعديل بيانات ضابط الصف للمراجعة');
    }

    public function destroy(Person $nonCommissionedOfficer)
    {
        $person->delete();
        return redirect()->route('non-commissioned-officers.index')->with('success', 'تم حذف بيانات ضابط الصف بنجاح');
    }
}