@extends('layouts.public')

@section('title', $title)
@section('description', $description)

@section('content')
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-common.section-header
                number="01"
                tag="HUBUNGI SAYA"
                title="MARI DISKUSIKAN PROJECT ANDA"
                subtitle="Gunakan form kontak atau hubungi langsung lewat email, WhatsApp, GitHub, dan LinkedIn." />

            @if(session('status'))
                <div class="mb-8 border-neo bg-[#ECFDF5] text-[#047857] px-5 py-4 rounded-md shadow-neo-sm font-mono text-sm font-bold">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                <x-contact.contact-info :profile="$profile" />
                <x-contact.form />
            </div>
        </div>
    </section>
@endsection
