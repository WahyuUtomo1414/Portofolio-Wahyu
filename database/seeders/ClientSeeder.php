<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->clients() as $client) {
            Client::query()->updateOrCreate(
                ['name' => $client['name']],
                $client + ['active' => true],
            );
        }
    }

    private function clients(): array
    {
        return [
            ['name' => 'Keysoft ERP', 'logo' => 'https://picsum.photos/seed/client-keysoft/320/320', 'desc' => 'Penyedia solusi ERP untuk kebutuhan operasional, inventory, accounting, dan proses bisnis perusahaan.'],
            ['name' => 'Pesona Trip Travel Indonesia', 'logo' => 'https://picsum.photos/seed/client-ubsi/320/320', 'desc' => 'Perusahaan travel dan perjalanan wisata yang membutuhkan sistem digital untuk promosi, paket trip, dan operasional booking.'],
            ['name' => 'Dinas Pertamanan Dan Pemakaman DKI Jakarta', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Instansi pemerintahan daerah yang mengelola layanan pertamanan, pemakaman, data aset, dan kebutuhan informasi publik.'],
            ['name' => 'Himpunan Mahasiswa Sistem Informasi', 'logo' => 'https://picsum.photos/seed/client-ubsi/320/320', 'desc' => 'Organisasi mahasiswa sistem informasi yang mengelola kegiatan, publikasi, struktur kepengurusan, dan informasi organisasi.'],
            ['name' => 'SMA Harapan Jaya', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Institusi pendidikan sekolah menengah atas dengan kebutuhan sistem informasi sekolah dan publikasi digital.'],
            ['name' => 'PT. Charlyn Jaya', 'logo' => 'https://picsum.photos/seed/client-ubsi/320/320', 'desc' => 'Perusahaan swasta dengan kebutuhan digitalisasi proses bisnis, administrasi internal, dan pengelolaan data operasional.'],
            ['name' => 'Gereja Protestan Maluku', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Lembaga keagamaan yang membutuhkan media informasi digital untuk jemaat, kegiatan, pelayanan, dan publikasi internal.'],
            ['name' => 'PT. Arthur Teknik Indoprima', 'logo' => 'https://picsum.photos/seed/client-ubsi/320/320', 'desc' => 'Perusahaan teknik dan konstruksi dengan kebutuhan sistem administrasi project, dokumentasi pekerjaan, dan operasional lapangan.'],
            ['name' => 'SMK Patriot Nusantara', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Institusi pendidikan kejuruan dengan kebutuhan sistem informasi sekolah, profil digital, dan pengelolaan data akademik.'],
            ['name' => 'PT. Intikarya Baja Lestari', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Perusahaan industri baja dengan kebutuhan sistem operasional, inventory, administrasi produksi, dan pelaporan bisnis.'],
            ['name' => 'Roda Nurmala', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Brand atau bisnis lokal dengan kebutuhan website profil, katalog informasi, dan dukungan digital untuk aktivitas bisnis.'],
            ['name' => 'Hepiso', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Brand digital dengan kebutuhan pengembangan aplikasi, website, dan sistem pendukung operasional produk.'],
            ['name' => 'DLDK Kabupaten Lamandau', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Brand digital dengan kebutuhan pengembangan aplikasi, website, dan sistem pendukung operasional produk.'],
        ];
    }
}
