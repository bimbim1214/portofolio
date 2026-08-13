<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Certification;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Profile ─────────────────────────────────────────────────────────
        Profile::updateOrCreate(['id' => 1], [
            'name'         => 'Bimo Aditya Pangestu',
            'headline'     => 'Full Stack Developer & UI/UX Designer',
            'about_1'      => 'Saya adalah fresh graduate dari <span class="font-medium text-slate-200">Information Technology</span> di Universitas Muhammadiyah Yogyakarta (UMY). Memiliki pengalaman di bidang <span class="font-medium text-slate-200">coding</span> dan <span class="font-medium text-slate-200">development</span> dari UI/UX design, serta memiliki kemampuan sebagai Full Stack Developer.',
            'about_2'      => 'Saya terbiasa bekerja dengan berbagai project, baik secara individu maupun kolaborasi. Saya juga memiliki sertifikasi di bidang <span class="font-medium text-slate-200">Senior Web Developer</span> dari BNSP, kemampuan bahasa Inggris, serta menguasai berbagai framework dan template dalam pengerjaan project.',
            'about_3'      => 'Saat ini saya fokus membangun portfolio digital yang mencerminkan skill-skill yang saya miliki, dan terus mengeksplorasi teknologi web modern untuk menciptakan produk yang efektif, inklusif, dan ramah pengguna.',
            'short_bio'    => 'I build accessible, pixel-perfect digital experiences for the web.',
            'photo_path'   => 'images/fotoshot.png',
            'cv_path'      => null,
            'github_url'   => 'https://github.com/bimbim1214',
            'linkedin_url' => 'https://www.linkedin.com/in/bimo-aditya-pangestu',
            'email'        => 'bimoadityapangestu@gmail.com',
            'whatsapp'     => 'https://wa.me/62895334634949',
        ]);

        // ─── Experiences ─────────────────────────────────────────────────────
        $experiences = [
            [
                'date_range'  => 'Apr 2026 — May 2026',
                'title'       => 'Full Stack Developer',
                'company'     => 'SMAN 1 Kopang',
                'company_url' => 'http://sipintarsman1kopang.my.id/',
                'description' => 'Membuat SIPINTAR SMAN1Kopang — sistem pengelolaan guru dan murid, serta kalkulasi perhitungan point murid.',
                'tags'        => ['Laravel', 'MySQL', 'Tailwind CSS'],
                'sort_order'  => 1,
            ],
            [
                'date_range'  => 'Feb 2026',
                'title'       => 'Full Stack Developer',
                'company'     => 'SMAN 1 Kopang',
                'company_url' => 'https://smanegeri1kopang.sch.id',
                'description' => 'Pengembangan dan deployment website sekolah resmi SMAN 1 Kopang.',
                'tags'        => ['Web Development', 'Deployment'],
                'sort_order'  => 2,
            ],
            [
                'date_range'  => 'Nov 2025 — Dec 2025',
                'title'       => 'UI/UX Designer',
                'company'     => 'DISKOMINFO',
                'company_url' => 'https://www.figma.com/design/KKYYQEccr79Qti7S8DvR5A/Untitled--Copy-?node-id=0-1&t=z7olsinEVYYod339-1',
                'description' => 'Mendesain user interface untuk sistem dan dashboard aplikasi pemerintahan.',
                'tags'        => ['Figma', 'UI/UX Design'],
                'sort_order'  => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        // ─── Projects ─────────────────────────────────────────────────────────
        $projects = [
            [
                'year'         => '2026',
                'title'        => 'SIPINTAR SMAN1Kopang',
                'made_at'      => 'SMAN 1 Kopang',
                'url'          => 'http://sipintarsman1kopang.my.id/',
                'link_label'   => 'sipintarsman1kopang.my.id',
                'description'  => 'Sistem pengelolaan guru, murid, serta kalkulasi perhitungan poin murid terintegrasi untuk SMA Negeri 1 Kopang.',
                'tags'         => ['Laravel', 'PHP'],
                'image_path'   => null,
                'show_on_home' => true,
                'sort_order'   => 1,
            ],
            [
                'year'         => '2026',
                'title'        => 'Website SMAN 1 Kopang',
                'made_at'      => 'SMAN 1 Kopang',
                'url'          => 'https://smanegeri1kopang.sch.id',
                'link_label'   => 'smanegeri1kopang.sch.id',
                'description'  => 'Pengembangan dan deployment website sekolah resmi SMAN 1 Kopang.',
                'tags'         => ['Web Development'],
                'image_path'   => null,
                'show_on_home' => false,
                'sort_order'   => 2,
            ],
            [
                'year'         => '2025',
                'title'        => 'Dashboard Pemerintahan',
                'made_at'      => 'DISKOMINFO',
                'url'          => 'https://www.figma.com/design/KKYYQEccr79Qti7S8DvR5A/Untitled--Copy-?node-id=0-1&t=z7olsinEVYYod339-1',
                'link_label'   => 'Figma Prototype',
                'description'  => 'Mendesain user interface untuk sistem dan dashboard aplikasi pemerintahan.',
                'tags'         => ['Figma'],
                'image_path'   => null,
                'show_on_home' => false,
                'sort_order'   => 3,
            ],
        ];

        foreach ($projects as $proj) {
            Project::create($proj);
        }

        // ─── Certifications ───────────────────────────────────────────────────
        $certifications = [
            [
                'title'       => 'SENIOR WEB DEVELOPER',
                'issuer'      => 'BNSP',
                'issuer_full' => 'Badan Nasional Sertifikasi Profesi',
                'icon'        => 'verified_user',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'title'       => 'SOFTWARE DEVELOPMENT',
                'issuer'      => 'Certiport',
                'issuer_full' => 'Pearson VUE Authorized Center',
                'icon'        => 'terminal',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
        ];

        foreach ($certifications as $cert) {
            Certification::create($cert);
        }
    }
}
