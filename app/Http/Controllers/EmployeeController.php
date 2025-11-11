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

class EmployeeController extends Controller
{
    private $categoryId = 3; // ID فئة الموظفين

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
                  ->orWhere('national_id', $search);
            });
        }
        
        if ($request->filled('rank_id')) {
            $query->where('rank_id', $request->rank_id);
        }
        
        $persons = $query->paginate(50)->withQueryString();
        $ranks = Rank::where('category_id', $this->categoryId)->get();
        $category = RankCategory::find($this->categoryId);
        
        return view('employees.index', compact('persons', 'ranks', 'category'));
    }

    public function create()
    {
        $ranks = Rank::where('category_id', $this->categoryId)->get();
        $employmentStatuses = EmploymentStatus::all();
        $category = RankCategory::find($this->categoryId);
        return view('employees.create', compact('ranks', 'employmentStatuses', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_number' => 'required|string',
            'national_id' => 'required|string|unique:persons',
            'name' => 'required|string',
            'rank_id' => 'required|exists:ranks,id'
        ]);

        $person = Person::create($request->only([
            'file_type', 'file_number', 'name', 'birth_date', 'birth_place',
            'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
            'personal_card_number', 'passport_number', 'rank_id'
        ]));

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

        return redirect()->route('employees.index')->with('success', 'تم حفظ بيانات الموظف بنجاح');
    }

    public function edit(Person $employee)
    {
        $ranks = Rank::where('category_id', $this->categoryId)->get();
        $employmentStatuses = EmploymentStatus::all();
        $category = RankCategory::find($this->categoryId);
        return view('employees.edit', compact('employee', 'ranks', 'employmentStatuses', 'category'));
    }

    public function update(Request $request, Person $employee)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_number' => 'required|string',
            'national_id' => 'required|string|unique:persons,national_id,' . $employee->id,
            'name' => 'required|string'
        ]);

        $requestData = $request->only([
            'file_type', 'file_number', 'name', 'birth_date', 'birth_place',
            'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
            'personal_card_number', 'passport_number'
        ]);

        // فلترة الحقول المتغيرة فقط
        $originalData = $employee->only(array_keys($requestData));
        $changedData = [];
        
        foreach($requestData as $key => $value) {
            if($originalData[$key] != $value) {
                $changedData[$key] = $value;
            }
        }

        if(empty($changedData)) {
            return redirect()->route('employees.index')->with('info', 'لم يتم إجراء أي تغييرات');
        }

        PendingRequest::create([
            'type' => 'person',
            'record_id' => $employee->id,
            'original_data' => $originalData,
            'new_data' => $changedData,
            'requested_by' => 'المستخدم الحالي'
        ]);

        return redirect()->route('employees.index')->with('success', 'تم إرسال طلب تعديل بيانات الموظف للمراجعة');
    }

    public function destroy(Person $employee)
    {
        $person->delete();
        return redirect()->route('employees.index')->with('success', 'تم حذف بيانات الموظف بنجاح');
    }
}