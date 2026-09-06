@extends('layouts.app')
@section('title', 'ویرایش سؤال')
@section('page-title', 'ویرایش سؤال چک‌لیست')
@section('content')
<form method="post" action="{{ route('checklists.items.update', [$checklist, $item]) }}" class="mx-auto max-w-4xl">@csrf @method('PUT') @include('checklists.items.form',['item'=>$item])</form>
@endsection
