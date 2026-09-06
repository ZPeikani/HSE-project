<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChecklistItemController extends Controller
{
    public function create(Checklist $checklist)
    {
        return view('checklists.items.create', compact('checklist'));
    }

    public function store(Request $request, Checklist $checklist)
    {
        $data = $this->validated($request);
        $data['sort_order'] = (int) $checklist->allItems()->max('sort_order') + 1;
        $checklist->items()->create($data);

        return redirect()->route('checklists.show', $checklist)->with('success', 'سؤال به چک‌لیست اضافه شد.');
    }

    public function edit(Checklist $checklist, ChecklistItem $item)
    {
        abort_unless($item->checklist_id === $checklist->id, 404);

        return view('checklists.items.edit', compact('checklist', 'item'));
    }

    public function update(Request $request, Checklist $checklist, ChecklistItem $item)
    {
        abort_unless($item->checklist_id === $checklist->id, 404);
        $item->update($this->validated($request));

        return redirect()->route('checklists.show', $checklist)->with('success', 'سؤال به‌روزرسانی شد.');
    }

    public function destroy(Checklist $checklist, ChecklistItem $item)
    {
        abort_unless($item->checklist_id === $checklist->id, 404);

        if ($item->responses()->exists()) {
            $item->update(['is_active' => false]);
            $message = 'این سؤال در سوابق بازرسی استفاده شده بود و غیرفعال شد.';
        } else {
            $item->delete();
            $message = 'سؤال حذف شد.';
        }

        return redirect()->route('checklists.show', $checklist)->with('success', $message);
    }

    public function toggle(Checklist $checklist, ChecklistItem $item)
    {
        abort_unless($item->checklist_id === $checklist->id, 404);
        $item->update(['is_active' => ! $item->is_active]);

        return redirect()->route('checklists.show', $checklist)->with('success', 'وضعیت سؤال تغییر کرد.');
    }

    public function move(Request $request, Checklist $checklist, ChecklistItem $item)
    {
        abort_unless($item->checklist_id === $checklist->id, 404);
        $direction = $request->validate(['direction' => 'required|in:up,down'])['direction'];
        $items = $checklist->allItems()->get();
        $index = $items->search(fn (ChecklistItem $candidate) => $candidate->is($item));
        $swapIndex = $direction === 'up' ? $index - 1 : $index + 1;

        if ($index !== false && isset($items[$swapIndex])) {
            DB::transaction(function () use ($item, $items, $index, $swapIndex): void {
                $other = $items[$swapIndex];
                $sortOrder = $item->sort_order;
                $item->update(['sort_order' => $other->sort_order]);
                $other->update(['sort_order' => $sortOrder]);
            });
        }

        return redirect()->route('checklists.show', $checklist)->with('success', 'ترتیب سؤال‌ها به‌روزرسانی شد.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'question' => 'required|string|max:1000',
            'guidance' => 'nullable|string',
            'weight' => 'required|integer|between:1,10',
            'is_critical' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_critical'] = (bool) ($data['is_critical'] ?? false);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        return $data;
    }
}
