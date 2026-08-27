@extends('layouts.public')

@section('title', $title ?? 'Blog — Wahyu Dwi Utomo')
@section('description', $description ?? 'Detail tulisan Wahyu Dwi Utomo.')

@section('content')
    <section class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-common.empty-state
                title="Tulisan Tidak Tersedia"
                message="Konten blog belum tersedia pada tahap ini." />
        </div>
    </section>
@endsection
