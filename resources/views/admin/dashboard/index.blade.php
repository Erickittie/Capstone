@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-8">

Dashboard

</h1>

<div class="grid grid-cols-4 gap-6">

<div class="bg-white rounded-lg shadow p-6">

<h3 class="text-gray-500">

Users

</h3>

<p class="text-4xl font-bold">

{{ $users }}

</p>

</div>

<div class="bg-white rounded-lg shadow p-6">

<h3>

Classes

</h3>

<p class="text-4xl font-bold">

{{ $classes }}

</p>

</div>

<div class="bg-white rounded-lg shadow p-6">

<h3>

Reports

</h3>

<p class="text-4xl font-bold">

{{ $reports }}

</p>

</div>

<div class="bg-white rounded-lg shadow p-6">

<h3>

Instructors

</h3>

<p class="text-4xl font-bold">

{{ $instructors }}

</p>

</div>

</div>

@endsection