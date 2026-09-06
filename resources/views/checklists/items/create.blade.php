@extends('layouts.app')
@section('title', 'افزودن سؤال')
@section('page-title', 'افزودن سؤال به چک‌لیست')
@section('content')
<form method="post" action="{{ route('checklists.items.store', $checklist) }}" class="mx-auto max-w-4xl">@csrf @include('checklists.items.form',['item'=>null])</form>
@endsection
