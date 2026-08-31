@php $type=$type??'text'; $isDate=in_array($type,['date','datetime-local']); @endphp
<div class="block">
  <span class="mb-2 block text-sm font-bold">{{ $label }} @if(!($optional??false))*@endif</span>
  @if($isDate)
  <div class="relative">
    <input type="text" name="{{ $name }}" value="{{ old($name,$value??'') }}" data-jdatepicker="{{ $type==='datetime-local'?'datetime':'date' }}" autocomplete="off" @unless($optional??false) required @endunless placeholder="{{ $type==='datetime-local'?'۱۴۰۳/۰۱/۰۱ ۰۸:۰۰':'۱۴۰۳/۰۱/۰۱' }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-4 pr-11 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" dir="ltr">
    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
    </span>
  </div>
  @else
  <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name,$value??'') }}" @unless($optional??false) required @endunless placeholder="{{ $placeholder??'' }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
  @endif
  @error($name)<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
</div>
