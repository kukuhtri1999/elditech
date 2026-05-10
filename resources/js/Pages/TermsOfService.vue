<template>
  <Head>
    <title>{{ isId ? 'Syarat & Ketentuan — ELDITECH' : 'Terms of Service — ELDITECH' }}</title>
    <meta name="description" :content="isId
      ? 'Syarat dan Ketentuan Layanan PT ELIAS DIGITAL TEKNOLOGI. Harap baca dengan saksama sebelum menggunakan layanan kami.'
      : 'Terms of Service of PT ELIAS DIGITAL TEKNOLOGI. Please read carefully before using our services.'" />
  </Head>
  <PublicLayout>
    <article class="max-w-4xl mx-auto px-6 py-32">

      <div class="mb-12">
        <div class="section-label">Legal</div>
        <h1 class="text-4xl md:text-5xl font-black mt-4" style="font-family:'Sora',sans-serif">
          {{ isId ? 'Syarat & Ketentuan' : 'Terms of Service' }}
        </h1>
        <p class="mt-4 text-gray-400 text-sm">
          {{ isId ? 'Terakhir diperbarui: 10 Mei 2026' : 'Last updated: May 10, 2026' }}
        </p>
      </div>

      <div class="space-y-10 text-gray-300 leading-relaxed">

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '1. Penerimaan Syarat' : '1. Acceptance of Terms' }}</h2>
          <p>
            {{ isId
              ? 'Dengan mengakses atau menggunakan layanan, situs web, atau aplikasi yang disediakan oleh PT ELIAS DIGITAL TEKNOLOGI ("ELDITECH"), Anda menyetujui untuk terikat oleh Syarat dan Ketentuan Layanan ini ("Syarat"). Jika Anda tidak menyetujui Syarat ini, harap jangan gunakan layanan kami. Syarat ini berlaku untuk semua pengguna layanan kami, termasuk pengguna yang berkontribusi konten, informasi, dan materi lainnya.'
              : 'By accessing or using services, websites, or applications provided by PT ELIAS DIGITAL TEKNOLOGI ("ELDITECH"), you agree to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms, please do not use our services. These Terms apply to all users of our services, including users who contribute content, information, and other materials.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '2. Deskripsi Layanan' : '2. Description of Services' }}</h2>
          <p>{{ isId ? 'ELDITECH menyediakan layanan berikut:' : 'ELDITECH provides the following services:' }}</p>
          <ul class="list-disc list-inside space-y-2 text-sm mt-3">
            <li v-for="s in (isId ? servicesId : servicesEn)" :key="s">{{ s }}</li>
          </ul>
          <p class="mt-4">
            {{ isId
              ? 'Kami berhak mengubah, menangguhkan, atau menghentikan layanan atau bagian mana pun dari layanan kapan saja dengan pemberitahuan yang wajar.'
              : 'We reserve the right to modify, suspend, or discontinue the service or any part of it at any time with reasonable notice.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '3. Penggunaan yang Diizinkan' : '3. Permitted Use' }}</h2>
          <p>{{ isId ? 'Anda setuju untuk menggunakan layanan kami hanya untuk tujuan yang sah dan sesuai dengan Syarat ini. Secara khusus, Anda tidak boleh:' : 'You agree to use our services only for lawful purposes and in accordance with these Terms. Specifically, you must not:' }}</p>
          <ul class="list-disc list-inside space-y-2 text-sm mt-3">
            <li v-for="p in (isId ? prohibitedId : prohibitedEn)" :key="p">{{ p }}</li>
          </ul>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '4. Hak Kekayaan Intelektual' : '4. Intellectual Property Rights' }}</h2>
          <p>
            {{ isId
              ? 'Seluruh konten, merek dagang, logo, nama merek, kode sumber, desain, dan materi lainnya yang tersedia melalui layanan kami adalah milik ELDITECH atau pemberi lisensinya dan dilindungi oleh undang-undang hak cipta, merek dagang, dan kekayaan intelektual yang berlaku. Tidak ada dalam Syarat ini yang memberikan hak kepada Anda untuk menggunakan merek dagang, logo, atau nama merek ELDITECH tanpa izin tertulis terlebih dahulu.'
              : 'All content, trademarks, logos, brand names, source code, designs, and other materials available through our services are owned by ELDITECH or its licensors and protected by applicable copyright, trademark, and intellectual property laws. Nothing in these Terms grants you any right to use ELDITECH\'s trademarks, logos, or brand names without prior written permission.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '5. Layanan Pengembangan Kustom' : '5. Custom Development Services' }}</h2>
          <p>
            {{ isId
              ? 'Ketika ELDITECH memberikan layanan pengembangan perangkat lunak kustom, berlaku ketentuan tambahan berikut:'
              : 'When ELDITECH provides custom software development services, the following additional terms apply:'
            }}
          </p>
          <ul class="list-disc list-inside space-y-2 text-sm mt-3">
            <li v-for="c in (isId ? customId : customEn)" :key="c">{{ c }}</li>
          </ul>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '6. Pembatasan Tanggung Jawab' : '6. Limitation of Liability' }}</h2>
          <p>
            {{ isId
              ? 'Sejauh diizinkan oleh hukum yang berlaku, ELDITECH tidak akan bertanggung jawab atas kerugian tidak langsung, insidental, khusus, konsekuensial, atau hukuman, termasuk namun tidak terbatas pada kehilangan keuntungan, data, penggunaan, atau niat baik, yang timbul dari atau terkait dengan penggunaan atau ketidakmampuan menggunakan layanan kami.'
              : 'To the maximum extent permitted by applicable law, ELDITECH shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to loss of profits, data, use, or goodwill, arising out of or related to your use of or inability to use our services.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '7. Penafian Jaminan' : '7. Disclaimer of Warranties' }}</h2>
          <p>
            {{ isId
              ? 'Layanan kami disediakan "sebagaimana adanya" dan "sebagaimana tersedia" tanpa jaminan dalam bentuk apa pun, baik tersurat maupun tersirat. ELDITECH tidak memberikan jaminan bahwa layanan akan bebas dari kesalahan, tidak terputus, aman, atau memenuhi persyaratan khusus Anda.'
              : 'Our services are provided "as is" and "as available" without warranties of any kind, either express or implied. ELDITECH does not warrant that services will be error-free, uninterrupted, secure, or meet your specific requirements.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '8. Ganti Rugi' : '8. Indemnification' }}</h2>
          <p>
            {{ isId
              ? 'Anda setuju untuk memberikan ganti rugi, membela, dan membebaskan ELDITECH, direktur, karyawan, mitra, dan agennya dari dan terhadap setiap klaim, tanggung jawab, kerusakan, kerugian, dan biaya, termasuk biaya hukum yang wajar, yang timbul dari penggunaan Anda atas layanan kami atau pelanggaran Syarat ini.'
              : 'You agree to indemnify, defend, and hold harmless ELDITECH, its directors, employees, partners, and agents from and against any claims, liabilities, damages, losses, and expenses, including reasonable legal fees, arising out of your use of our services or violation of these Terms.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '9. Hukum yang Berlaku' : '9. Governing Law' }}</h2>
          <p>
            {{ isId
              ? 'Syarat ini diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia. Setiap sengketa yang timbul berdasarkan Syarat ini akan diselesaikan secara eksklusif di pengadilan yang berwenang di Jakarta, Indonesia.'
              : 'These Terms shall be governed by and construed in accordance with the laws of the Republic of Indonesia. Any disputes arising under these Terms shall be resolved exclusively in the competent courts of Jakarta, Indonesia.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '10. Perubahan Syarat' : '10. Changes to Terms' }}</h2>
          <p>
            {{ isId
              ? 'Kami berhak mengubah Syarat ini kapan saja. Perubahan material akan diberitahukan setidaknya 30 hari sebelumnya. Penggunaan layanan yang berkelanjutan setelah perubahan berlaku merupakan penerimaan Syarat yang direvisi.'
              : 'We reserve the right to modify these Terms at any time. Material changes will be notified at least 30 days in advance. Continued use of the service after changes take effect constitutes acceptance of the revised Terms.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">{{ isId ? '11. Hubungi Kami' : '11. Contact Us' }}</h2>
          <p>{{ isId ? 'Untuk pertanyaan mengenai Syarat ini:' : 'For questions regarding these Terms:' }}</p>
          <div class="mt-4 glass-card p-5 text-sm space-y-1 text-gray-300">
            <p class="font-semibold text-white">PT ELIAS DIGITAL TEKNOLOGI</p>
            <p>Email: legal@elditech.com</p>
            <p>Website: <a href="https://elditech.com" class="text-accent hover:underline">elditech.com</a></p>
          </div>
        </section>

      </div>
    </article>
  </PublicLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

const page = usePage();
const isId = computed(() => (page.props.locale || 'en') === 'id');

const servicesEn = ['Development and publication of Android mobile applications', 'Custom web and mobile software development for businesses', 'API design and third-party integrations', 'Cloud infrastructure consulting and deployment', 'Ongoing technical maintenance and support'];
const servicesId = ['Pengembangan dan penerbitan aplikasi Android', 'Pengembangan perangkat lunak web dan mobile kustom untuk bisnis', 'Desain API dan integrasi pihak ketiga', 'Konsultasi dan penerapan infrastruktur cloud', 'Pemeliharaan teknis dan dukungan berkelanjutan'];
const prohibitedEn = ['Use our services for any unlawful purpose or in violation of regulations', 'Attempt to gain unauthorized access to our systems or networks', 'Transmit any viruses, malware, or other malicious code', 'Engage in any activity that disrupts or interferes with our services', 'Reverse-engineer, decompile, or disassemble any part of our software', 'Use our services to infringe intellectual property rights of others', 'Collect user data without proper consent'];
const prohibitedId = ['Menggunakan layanan kami untuk tujuan ilegal atau melanggar peraturan', 'Mencoba mendapatkan akses tidak sah ke sistem atau jaringan kami', 'Mengirimkan virus, malware, atau kode berbahaya lainnya', 'Terlibat dalam aktivitas yang mengganggu atau menghambat layanan kami', 'Merekayasa balik, mendekompilasi, atau membongkar bagian mana pun dari perangkat lunak kami', 'Menggunakan layanan kami untuk melanggar hak kekayaan intelektual pihak lain', 'Mengumpulkan data pengguna tanpa persetujuan yang tepat'];
const customEn = ['Project scope, timeline, and deliverables will be defined in a separate Statement of Work (SoW)', 'Client owns the final delivered work product upon full payment', 'ELDITECH retains ownership of any pre-existing IP, frameworks, and tools used', 'A 50% deposit is required before project commencement', 'Revisions beyond agreed scope may incur additional charges', 'A 3-month bug-fix warranty is provided after final delivery'];
const customId = ['Ruang lingkup proyek, jadwal, dan hasil kerja akan didefinisikan dalam Pernyataan Kerja (SoW) terpisah', 'Klien memiliki produk kerja akhir yang diserahkan setelah pembayaran penuh', 'ELDITECH mempertahankan kepemilikan atas IP, framework, dan alat yang sudah ada sebelumnya', 'Deposit 50% diperlukan sebelum dimulainya proyek', 'Revisi di luar ruang lingkup yang disepakati dapat dikenakan biaya tambahan', 'Garansi perbaikan bug selama 3 bulan diberikan setelah penyerahan final'];
</script>
