<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\Person;
use App\Models\RankCategory;
use App\Models\MilitaryInfo;
use App\Models\WorkInfo;
use App\Models\EmploymentStatus;
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
            'name' => 'required|string',
            'rank_id' => 'required|exists:ranks,id'
        ]);

        $person = Person::create($request->only([
            'file_type', 'file_number', 'name', 'rank_id', 'birth_date', 'birth_place',
            'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
            'personal_card_number', 'passport_number'
        ]));

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
            'name' => 'required|string',
            'rank_id' => 'required|exists:ranks,id'
        ]);

        $person->update($request->only([
            'file_type', 'file_number', 'name', 'rank_id', 'birth_date', 'birth_place',
            'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
            'personal_card_number', 'passport_number'
        ]));

        return redirect()->route('persons.index')->with('success', 'تم تحديث البيانات بنجاح');
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
