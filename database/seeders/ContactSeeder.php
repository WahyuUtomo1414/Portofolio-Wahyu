<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->contacts() as $contact) {
            Contact::query()->updateOrCreate(
                [
                    'email' => $contact['email'],
                    'subject' => $contact['subject'],
                ],
                $contact + ['active' => true],
            );
        }
    }

    private function contacts(): array
    {
        return [
            ['name' => 'Raka Pratama', 'email' => 'raka@example.com', 'subject' => 'Diskusi website company profile', 'message' => 'Halo, saya ingin berdiskusi tentang kebutuhan website company profile untuk bisnis saya.'],
            ['name' => 'Nadia Putri', 'email' => 'nadia@example.com', 'subject' => 'Pembuatan dashboard admin', 'message' => 'Saya butuh dashboard admin untuk mengelola data internal dan laporan bulanan.'],
            ['name' => 'Fajar Nugroho', 'email' => 'fajar@example.com', 'subject' => 'Integrasi API Laravel', 'message' => 'Apakah bisa bantu integrasi API Laravel dengan aplikasi mobile yang sudah ada?'],
        ];
    }
}
