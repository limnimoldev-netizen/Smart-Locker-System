@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    
    <div class="mx-auto max-w-6xl space-y-6 bg-[#F8F9FA]">

        <section class="bg-[#1E3A8A] px-6 py-5 text-white rounded-lg  shadow-md sm:px-8">
            <div class="flex items-center gap-3 sm:justify-between"> 
                <div class="flex items-center space-x-4">
                    <span class="bg-blue-600 text-white flex items-center justify-center h-10 w-10 rounded-lg ">
                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h1 class="text-[20px]  text-white font-semibold">Users & Usage</h1>
                        <p class="text-slate-300">Manage system users and usage and track usage</p>
                    </div>
                </div>

                <a href="/users/create" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#111827] shadow-sm hover:bg-[#C7D2EF] ">
                    <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
                    Add user
                </a>
            </div>
        </section>

        <section class="grid gap-8 sm:grid-cols-4">
            
            <div class=" bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm ">
                <div class="flex items-center justify-between">
                    <p class="text-base text-slate-600 ">Total users</p>
                    <i class="fa-solid fa-box text-blue-700" aria-hidden="true"></i>
                </div>
                <p class=" mt-2 text-2xl font-semibold">1204</p>
            </div>
               
            <div class="bg-white px-5 py-5 rounded-lg border border-slate-200">
                <div class="flex iteams-center justify-between">
                    <p class="text-base text-slate-600">Active Now</p>
                    <i class="fa-solid fa-circle-check text-emerald-600" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold">786</p>
            </div>

            <div class="bg-white px-5 py-5 rounded-lg border border-slate-200">
                <div class="flex items-center justify-between">
                    <p class="text-base text-slate-600">This months</p>
                    <i class="fa-solid fa-box text-blue-700" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold ">134</p>
            </div>

            <div class="bg-white px-5 py-5 rounded-lg border border-slate-200">
                <div class="flex items-center justify-between">
                    <p class="text-base text-slate-600">This year</p>
                    <i class="fa-solid fa-box text-blue-700" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold ">134</p>
            </div>
        </section>

    </div>

@endsection
