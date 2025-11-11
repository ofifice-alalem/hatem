<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\WorkInfo;
use App\Models\EmploymentStatus;
use Illuminate\Http\Request;

class WorkInfoController extends Controller
{
    public function create($nationalId)
    {
        $person = Person::where('national_id', $nationalId)->firstOrFail();
        $employmentStatuses = EmploymentStatus::all();
        return view('work-info.create', compact('person', 'employmentStatuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'national_id' => 'required|exists:persons,national_id'
        ]);

        WorkInfo::create($request->all());

        return redirect()->route('persons.index')->with('success', 'تم حفظ معلومات العمل بنجاح');
    }

    public function edit($id)
    {
        $workInfo = WorkInfo::findOrFail($id);
        $employmentStatuses = EmploymentStatus::all();
        return view('work-info.edit', compact('workInfo', 'employmentStatuses'));
    }

    public function update(Request $request, $id)
    {
        $workInfo = WorkInfo::findOrFail($id);
        $workInfo->update($request->all());

        return redirect()->route('persons.index')->with('success', 'تم تحديث معلومات العمل بنجاح');
    }
}