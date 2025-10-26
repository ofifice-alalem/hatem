<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Rank;
use App\Models\Person;
use App\Models\MilitaryInfo;
use App\Models\PendingRequest;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $query = Person::with(['type', 'rank', 'militaryInfo']);
        
        // فلتر البحث النصي
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('national_no', 'like', "%{$search}%")
                  ->orWhereHas('militaryInfo', function($mq) use ($search) {
                      $mq->where('military_no', 'like', "%{$search}%");
                  });
            });
        }
        
        // فلتر الصفة
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->type_id);
        }
        
        // فلتر الرتبة
        if ($request->filled('rank_id')) {
            $query->where('rank_id', $request->rank_id);
        }
        
        $persons = $query->paginate(50)->withQueryString();
        $types = Type::all();
        $ranks = Rank::all();
        
        return view('persons.index', compact('persons', 'types', 'ranks'));
    }

    public function create()
    {
        $types = Type::all();
        $ranks = Rank::all();
        return view('persons.create', compact('types', 'ranks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_no' => 'required|string|max:20',
            'national_no' => 'required|string|max:20|unique:persons',
            'name' => 'required|string|max:100',
            'type_id' => 'required|exists:types,id',
            'rank_id' => 'required|exists:ranks,id',
            'military_no' => 'nullable|string|max:20'
        ]);

        $person = Person::create($request->only(['file_no', 'national_no', 'name', 'type_id', 'rank_id']));

        $type = Type::find($request->type_id);
        if ($type->type_name === 'ضابط صف' && $request->military_no) {
            MilitaryInfo::create([
                'national_no' => $request->national_no,
                'military_no' => $request->military_no
            ]);
        }

        return redirect()->route('persons.index')->with('success', 'تم حفظ البيانات بنجاح');
    }

    public function edit(Person $person)
    {
        $types = Type::all();
        $ranks = Rank::where('type_id', $person->type_id)->get();
        return view('persons.edit', compact('person', 'types', 'ranks'));
    }

    public function update(Request $request, Person $person)
    {
        $request->validate([
            'file_no' => 'required|string|max:20',
            'national_no' => 'required|string|max:20|unique:persons,national_no,' . $person->system_no . ',system_no',
            'name' => 'required|string|max:100',
            'type_id' => 'required|exists:types,id',
            'rank_id' => 'required|exists:ranks,id',
            'military_no' => 'nullable|string|max:20'
        ]);

        // تحديد مستوى الصفة
        $typeHierarchy = ['موظف' => 1, 'ضابط صف' => 2, 'ضابط' => 3];
        $oldType = $person->type;
        $newType = Type::find($request->type_id);
        
        $oldLevel = $typeHierarchy[$oldType->type_name];
        $newLevel = $typeHierarchy[$newType->type_name];
        
        // إذا كانت ترقية (من مستوى أقل إلى أعلى)
        if ($newLevel > $oldLevel) {
            PendingRequest::create([
                'person_id' => $person->system_no,
                'old_type_id' => $person->type_id,
                'new_type_id' => $request->type_id,
                'old_rank_id' => $person->rank_id,
                'new_rank_id' => $request->rank_id,
                'old_military_no' => $person->militaryInfo?->military_no,
                'new_military_no' => $request->military_no,
                'status' => 'pending'
            ]);
            
            return redirect()->route('persons.index')->with('success', 'تم إرسال طلب الترقية للموافقة');
        }
        
        // تحديث عادي للبيانات الأخرى
        $person->update($request->only(['file_no', 'national_no', 'name', 'type_id', 'rank_id']));

        if ($newType->type_name === 'ضابط صف') {
            if ($request->military_no) {
                MilitaryInfo::updateOrCreate(
                    ['national_no' => $request->national_no],
                    ['military_no' => $request->military_no]
                );
            }
        } else {
            MilitaryInfo::where('national_no', $person->national_no)->delete();
        }

        return redirect()->route('persons.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('persons.index')->with('success', 'تم حذف البيانات بنجاح');
    }

    public function getRanksByType($typeId)
    {
        $ranks = Rank::where('type_id', $typeId)->get();
        return response()->json($ranks);
    }
}
