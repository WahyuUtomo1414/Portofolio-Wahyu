@extends('layouts.public')

@section('title', $title)
@section('description', $description)

@section('content')
    <section class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-common.section-header
                number="01"
                tag="BLOG"
                title="TULISAN TEKNIS & CATATAN PROJECT"
                subtitle="Area ini disiapkan untuk artikel, studi kasus, dan dokumentasi teknis. Konten blog bisa diaktifkan setelah sumber data blog tersedia." />

            <x-common.empty-state
                title="Belum Ada Tulisan"
                message="Blog masih disiapkan. Fokus website saat ini adalah profil, project, journey, dan kontak." />
        </div>
    </section>
@endsection
