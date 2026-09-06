<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
{
	public function index()
	{
		return view('checklists.index', ['checklists' => Checklist::withCount(['activeItems as items_count'])->latest()->paginate(15)]);
	}

	public function create()
	{
		return view('checklists.create');
	}

	public function store(Request $request)
	{
		$data = $this->validated($request, true);
		$checklist = DB::transaction(function () use ($data, $request): Checklist {
			$checklist = Checklist::create([
				'title' => $data['title'], 'category' => $data['category'],
				'description' => $data['description'] ?? null, 'version' => $data['version'],
				'created_by' => $request->user()->id,
			]);
			foreach ($data['items'] as $sortOrder => $item) {
				$checklist->items()->create($item + ['sort_order' => $sortOrder]);
			}
			return $checklist;
		});
		$this->log('created', $checklist, 'چک‌لیست بازرسی ایجاد شد.');

		return redirect()->route('checklists.show', $checklist)->with('success', 'چک‌لیست ایجاد شد.');
	}

	public function show(Checklist $checklist)
	{
		$checklist->load('allItems');
		$checklist->setRelation('items', $checklist->allItems);
		return view('checklists.show', compact('checklist'));
	}

	public function edit(Checklist $checklist)
	{
		return view('checklists.edit', compact('checklist'));
	}

	public function update(Request $request, Checklist $checklist)
	{
		$checklist->update($this->validated($request));
		return redirect()->route('checklists.show', $checklist)->with('success', 'مشخصات چک‌لیست به‌روزرسانی شد.');
	}

	public function destroy(Checklist $checklist)
	{
		if ($checklist->inspections()->exists()) {
			return back()->withErrors(['checklist' => 'چک‌لیستی که سابقه بازرسی دارد قابل حذف نیست؛ آن را غیرفعال کنید.']);
		}
		$checklist->delete();
		return redirect()->route('checklists.index')->with('success', 'چک‌لیست حذف شد.');
	}

	public function toggle(Checklist $checklist)
	{
		$checklist->update(['is_active' => ! $checklist->is_active]);
		return back()->with('success', 'وضعیت چک‌لیست تغییر کرد.');
	}

	private function validated(Request $request, bool $withItems = false): array
	{
		$rules = ['title' => 'required|string|max:190', 'category' => 'required|string|max:100', 'description' => 'nullable|string', 'version' => 'required|string|max:20'];
		if ($withItems) {
			$rules += ['items' => 'required|array|min:1', 'items.*.question' => 'required|string|max:1000', 'items.*.guidance' => 'nullable|string', 'items.*.weight' => 'required|integer|between:1,10', 'items.*.is_critical' => 'nullable|boolean'];
		}
		return $request->validate($rules);
	}
}
