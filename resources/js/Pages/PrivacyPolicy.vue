<template>
  <Head>
    <title>{{ isId ? 'Kebijakan Privasi — ELDITECH' : 'Privacy Policy — ELDITECH' }}</title>
    <meta name="description" :content="isId
      ? 'Kebijakan Privasi PT ELIAS DIGITAL TEKNOLOGI — Pelajari bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda.'
      : 'Privacy Policy of PT ELIAS DIGITAL TEKNOLOGI — Learn how we collect, use and protect your personal information.'" />
  </Head>
  <PublicLayout>
    <article class="max-w-4xl mx-auto px-6 py-32">

      <div class="mb-12">
        <div class="section-label">{{ isId ? 'Legal' : 'Legal' }}</div>
        <h1 class="text-4xl md:text-5xl font-black mt-4" style="font-family:'Sora',sans-serif">
          {{ isId ? 'Kebijakan Privasi' : 'Privacy Policy' }}
        </h1>
        <p class="mt-4 text-gray-400 text-sm">
          {{ isId ? 'Terakhir diperbarui: 10 Mei 2026' : 'Last updated: May 10, 2026' }}
        </p>
      </div>

      <div class="prose prose-invert max-w-none space-y-10 text-gray-300 leading-relaxed">

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '1. Pendahuluan' : '1. Introduction' }}
          </h2>
          <p>
            {{ isId
              ? 'PT ELIAS DIGITAL TEKNOLOGI ("ELDITECH", "Perusahaan", "kami") berkomitmen untuk melindungi privasi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, mengungkapkan, dan melindungi informasi pribadi Anda ketika Anda menggunakan layanan kami, termasuk situs web elditech.com dan aplikasi Android yang kami terbitkan.'
              : 'PT ELIAS DIGITAL TEKNOLOGI ("ELDITECH", "Company", "we", "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your personal information when you use our services, including the elditech.com website and Android applications we publish.'
            }}
          </p>
          <p class="mt-3">
            {{ isId
              ? 'Dengan mengakses atau menggunakan layanan kami, Anda menyetujui praktik yang dijelaskan dalam Kebijakan Privasi ini. Jika Anda tidak setuju, harap hentikan penggunaan layanan kami.'
              : 'By accessing or using our services, you agree to the practices described in this Privacy Policy. If you do not agree, please discontinue use of our services.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '2. Informasi yang Kami Kumpulkan' : '2. Information We Collect' }}
          </h2>
          <h3 class="text-base font-semibold text-accent mb-2">{{ isId ? '2.1 Informasi yang Anda Berikan' : '2.1 Information You Provide' }}</h3>
          <ul class="list-disc list-inside space-y-2 text-sm">
            <li v-for="item in (isId ? collectId1 : collectEn1)" :key="item">{{ item }}</li>
          </ul>
          <h3 class="text-base font-semibold text-accent mb-2 mt-5">{{ isId ? '2.2 Informasi yang Dikumpulkan Otomatis' : '2.2 Automatically Collected Information' }}</h3>
          <ul class="list-disc list-inside space-y-2 text-sm">
            <li v-for="item in (isId ? collectId2 : collectEn2)" :key="item">{{ item }}</li>
          </ul>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '3. Cara Kami Menggunakan Informasi Anda' : '3. How We Use Your Information' }}
          </h2>
          <ul class="list-disc list-inside space-y-2 text-sm">
            <li v-for="item in (isId ? useId : useEn)" :key="item">{{ item }}</li>
          </ul>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '4. Monetisasi Iklan dalam Aplikasi' : '4. In-App Advertising & Monetization' }}
          </h2>
          <p>
            {{ isId
              ? 'Aplikasi Android yang kami terbitkan menggunakan jaringan iklan pihak ketiga (termasuk namun tidak terbatas pada Google AdMob dan Meta Audience Network) untuk menayangkan iklan. Jaringan iklan ini mungkin menggunakan pengidentifikasi perangkat (seperti Android Advertising ID / GAID), data lokasi yang diagregasi, dan informasi penggunaan aplikasi untuk menayangkan iklan yang relevan.'
              : 'The Android applications we publish use third-party advertising networks (including but not limited to Google AdMob and Meta Audience Network) to serve advertisements. These ad networks may use device identifiers (such as Android Advertising ID / GAID), aggregated location data, and app usage information to serve relevant advertisements.'
            }}
          </p>
          <p class="mt-3">
            {{ isId
              ? 'Pengguna dapat memilih keluar dari iklan berbasis minat melalui pengaturan perangkat Android mereka (Pengaturan > Google > Iklan) atau dengan mengaktifkan Opt-Out Iklan Berbasis Minat.'
              : 'Users can opt out of interest-based advertising through their Android device settings (Settings > Google > Ads) or by enabling the Opt Out of Ads Personalization setting.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '5. Berbagi Informasi' : '5. Information Sharing' }}
          </h2>
          <p>{{ isId ? 'Kami tidak menjual, memperdagangkan, atau menyewakan informasi pribadi Anda kepada pihak ketiga. Kami dapat membagikan informasi Anda hanya dalam situasi berikut:' : 'We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following situations:' }}</p>
          <ul class="list-disc list-inside space-y-2 text-sm mt-3">
            <li v-for="item in (isId ? shareId : shareEn)" :key="item">{{ item }}</li>
          </ul>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '6. Keamanan Data' : '6. Data Security' }}
          </h2>
          <p>
            {{ isId
              ? 'Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi informasi Anda dari akses, penggunaan, atau pengungkapan yang tidak sah, termasuk enkripsi SSL/TLS, kontrol akses berbasis peran, dan audit keamanan berkala. Namun, tidak ada metode transmisi data melalui internet yang 100% aman.'
              : 'We implement appropriate technical and organizational security measures to protect your information from unauthorized access, use, or disclosure, including SSL/TLS encryption, role-based access controls, and regular security audits. However, no method of data transmission over the internet is 100% secure.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '7. Hak-Hak Anda' : '7. Your Rights' }}
          </h2>
          <ul class="list-disc list-inside space-y-2 text-sm">
            <li v-for="item in (isId ? rightsId : rightsEn)" :key="item">{{ item }}</li>
          </ul>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '8. Kebijakan Cookie' : '8. Cookie Policy' }}
          </h2>
          <p>
            {{ isId
              ? 'Situs web kami menggunakan cookie dan teknologi pelacakan serupa untuk meningkatkan pengalaman pengguna, menganalisis lalu lintas, dan mempersonalisasi konten. Anda dapat mengontrol penggunaan cookie melalui pengaturan browser Anda. Menonaktifkan cookie tertentu mungkin memengaruhi fungsionalitas situs.'
              : 'Our website uses cookies and similar tracking technologies to improve user experience, analyze traffic, and personalize content. You can control cookie usage through your browser settings. Disabling certain cookies may affect website functionality.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '9. Privasi Anak-Anak' : '9. Children\'s Privacy' }}
          </h2>
          <p>
            {{ isId
              ? 'Layanan kami tidak ditujukan untuk anak-anak di bawah usia 13 tahun. Kami tidak secara sengaja mengumpulkan informasi pribadi dari anak-anak. Jika Anda percaya bahwa seorang anak telah memberikan informasi pribadi kepada kami, harap hubungi kami segera.'
              : 'Our services are not directed to children under the age of 13. We do not knowingly collect personal information from children. If you believe a child has provided personal information to us, please contact us immediately.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '10. Perubahan Kebijakan Ini' : '10. Changes to This Policy' }}
          </h2>
          <p>
            {{ isId
              ? 'Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Perubahan material akan diberitahukan melalui email atau pemberitahuan yang menonjol di situs web kami. Tanggal pembaruan terakhir selalu tercantum di bagian atas dokumen ini.'
              : 'We may update this Privacy Policy from time to time. Material changes will be notified via email or prominent notice on our website. The last updated date is always listed at the top of this document.'
            }}
          </p>
        </section>

        <section>
          <h2 class="text-xl font-bold text-white mb-3">
            {{ isId ? '11. Hubungi Kami' : '11. Contact Us' }}
          </h2>
          <p>{{ isId ? 'Untuk pertanyaan tentang Kebijakan Privasi ini, silakan hubungi kami:' : 'For questions about this Privacy Policy, please contact us:' }}</p>
          <div class="mt-4 glass-card p-5 text-sm space-y-1 text-gray-300">
            <p class="font-semibold text-white">PT ELIAS DIGITAL TEKNOLOGI</p>
            <p>Email: privacy@elditech.com</p>
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

const collectEn1 = ['Name and email when contacting us via forms', 'Professional information provided during business inquiries', 'Login credentials for admin portal access'];
const collectId1 = ['Nama dan email saat menghubungi kami melalui formulir', 'Informasi profesional yang diberikan selama pertanyaan bisnis', 'Kredensial login untuk akses portal admin'];
const collectEn2 = ['IP address and browser type', 'Device information and OS version', 'Pages visited and time spent (via analytics)', 'Android Advertising ID (in our published apps)', 'Crash reports and performance data'];
const collectId2 = ['Alamat IP dan jenis browser', 'Informasi perangkat dan versi OS', 'Halaman yang dikunjungi dan waktu yang dihabiskan (via analitik)', 'Android Advertising ID (dalam aplikasi yang kami terbitkan)', 'Laporan crash dan data performa'];
const useEn = ['To provide and maintain our services', 'To respond to your inquiries and support requests', 'To improve our website and applications', 'To send service-related communications', 'To analyze usage patterns and optimize performance', 'To comply with legal obligations', 'To detect and prevent fraudulent or abusive activity'];
const useId = ['Untuk menyediakan dan memelihara layanan kami', 'Untuk merespons pertanyaan dan permintaan dukungan Anda', 'Untuk meningkatkan situs web dan aplikasi kami', 'Untuk mengirim komunikasi terkait layanan', 'Untuk menganalisis pola penggunaan dan mengoptimalkan performa', 'Untuk mematuhi kewajiban hukum', 'Untuk mendeteksi dan mencegah aktivitas penipuan atau penyalahgunaan'];
const shareEn = ['With service providers who assist in operating our services (under strict confidentiality agreements)', 'When required by law, court order, or government authority', 'In connection with a merger, acquisition, or sale of assets (with prior notice)', 'With your explicit consent'];
const shareId = ['Dengan penyedia layanan yang membantu operasional layanan kami (di bawah perjanjian kerahasiaan ketat)', 'Ketika diwajibkan oleh hukum, perintah pengadilan, atau otoritas pemerintah', 'Dalam hubungan dengan merger, akuisisi, atau penjualan aset (dengan pemberitahuan sebelumnya)', 'Dengan persetujuan eksplisit Anda'];
const rightsEn = ['Right to access your personal data we hold', 'Right to correct inaccurate personal data', 'Right to request deletion of your personal data', 'Right to restrict or object to processing', 'Right to data portability', 'Right to withdraw consent at any time'];
const rightsId = ['Hak untuk mengakses data pribadi Anda yang kami simpan', 'Hak untuk mengoreksi data pribadi yang tidak akurat', 'Hak untuk meminta penghapusan data pribadi Anda', 'Hak untuk membatasi atau menolak pemrosesan', 'Hak atas portabilitas data', 'Hak untuk menarik persetujuan kapan saja'];
</script>
