<?php
namespace App\Http\Controllers;
use App\Models\Checklist; use Illuminate\Http\Request; use Illuminate\Support\Facades\DB;
class ChecklistController extends Controller {
 public function index(){return view('checklists.index',['checklists'=>Checklist::withCount('items')->latest()->paginate(15)]);}
 public function create(){return view('checklists.create');}
 public function store(Request $r){$d=$r->validate(['title'=>'required|max:190','category'=>'required|max:100','description'=>'nullable','version'=>'required|max:20','items'=>'required|array|min:1','items.*.question'=>'required|max:1000','items.*.weight'=>'required|integer|between:1,10','items.*.is_critical'=>'nullable|boolean']);$c=DB::transaction(function()use($d,$r){$c=Checklist::create(['title'=>$d['title'],'category'=>$d['category'],'description'=>$d['description']??null,'version'=>$d['version'],'created_by'=>$r->user()->id]);foreach($d['items'] as $i=>$item)$c->items()->create($item+['sort_order'=>$i]);return $c;});$this->log('created',$c,'چک‌لیست بازرسی ایجاد شد.');return redirect()->route('checklists.index')->with('success','چک‌لیست ایجاد شد.');}
 public function toggle(Checklist $checklist){$checklist->update(['is_active'=>!$checklist->is_active]);return back()->with('success','وضعیت چک‌لیست تغییر کرد.');}
}
