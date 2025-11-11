<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $query = Leave::with(['person', 'leaveType']);
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('person', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('national_id', $search);
            });
        }
        
        $leaves = $query->paginate(50)->withQueryString();
        $leaveTypes = LeaveType::all();
        
        return view('leaves.index', compact('leaves', 'leaveTypes'));
    }

    public function create($nationalId = null)
    {
        $person = $nationalId ? Person::where('national_id', $nationalId)->first() : null;
        $persons = Person::all();
        $leaveTypes = LeaveType::all();
        return view('leaves.create', compact('person', 'persons', 'leaveTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'national_id' => 'required|exists:persons,national_id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_days' => 'required|integer|min:1'
        ]);

        Leave::create($request->all());

        return redirect()->route('leaves.index')->with('success', 'تم حفظ الإجازة بنجاح');
    }

    public function edit($id)
    {
        $leave = Leave::findOrFail($id);
        $persons = Person::all();
        $leaveTypes = LeaveType::all();
        return view('leaves.edit', compact('leave', 'persons', 'leaveTypes'));
    }

    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        
        $request->validate([
            'national_id' => 'required|exists:persons,national_id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_days' => 'required|integer|min:1'
        ]);

        $leave->update($request->all());

        return redirect()->route('leaves.index')->with('success', 'تم تحديث الإجازة بنجاح');
    }

    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        
        return redirect()->route('leaves.index')->with('success', 'تم حذف الإجازة بنجاح');
    }
}