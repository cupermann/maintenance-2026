<header class="pelapor-mobile-header">
    <div class="pelapor-mobile-brand">
        <img
            src="{{ asset('images/logo-maintenance.png') }}"
            alt="Logo Fixora"
        >

        <span>Fixora</span>
    </div>

    <button
        type="button"
        class="pelapor-menu-button"
        id="pelaporMenuButton"
        aria-label="Buka menu"
    >
        <svg
            width="25"
            height="25"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
        >
            <path d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</header>

<div
    class="pelapor-sidebar-overlay"
    id="pelaporSidebarOverlay"
></div>

<aside
    class="pelapor-sidebar"
    id="pelaporSidebar"
>
    <div class="pelapor-sidebar-brand">
        <img
            src="{{ asset('images/logo-maintenance.png') }}"
            alt="Logo Fixora"
            class="pelapor-sidebar-logo"
        >

        <div>
            <div class="pelapor-sidebar-brand-name">
                Fixora
            </div>

            <div class="pelapor-sidebar-brand-description">
                Sistem Pelaporan Fasilitas Kampus
            </div>
        </div>
    </div>

    <nav class="pelapor-sidebar-menu">
        <a
            href="{{ route('pelapor.dashboard') }}"
            class="pelapor-sidebar-link
                {{ request()->routeIs('pelapor.dashboard') ? 'active' : '' }}"
        >
            <svg
                class="pelapor-sidebar-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path d="M3 11.5 12 4l9 7.5"/>
                <path d="M5.5 10.5V20h13v-9.5"/>
                <path d="M9.5 20v-6h5v6"/>
            </svg>

            Beranda
        </a>

        <a
            href="{{ url('/lapor-maintenance') }}"
            class="pelapor-sidebar-link
                {{ request()->is('lapor-maintenance') ? 'active' : '' }}"
        >
            <svg
                class="pelapor-sidebar-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path d="M9 4h6"/>
                <path d="M9 2h6v4H9z"/>
                <path d="M6 4H5a2 2 0 0 0-2 2v14h18V6a2 2 0 0 0-2-2h-1"/>
                <path d="m8 14 2 2 5-5"/>
            </svg>

            Buat Laporan
        </a>

        <a
            href="{{ url('/riwayat-laporan') }}"
            class="pelapor-sidebar-link
                {{ request()->is('riwayat-laporan') ? 'active' : '' }}"
        >
            <svg
                class="pelapor-sidebar-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path d="M3 12a9 9 0 1 0 3-6.7"/>
                <path d="M3 4v6h6"/>
                <path d="M12 7v5l3 2"/>
            </svg>

            Cek Riwayat
        </a>

        <a
            href="{{ route('pelapor.dashboard') }}#panduan"
            class="pelapor-sidebar-link"
        >
            <svg
                class="pelapor-sidebar-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path d="M4 5a3 3 0 0 1 3-3h5v18H7a3 3 0 0 0-3 3z"/>
                <path d="M20 5a3 3 0 0 0-3-3h-5v18h5a3 3 0 0 1 3 3z"/>
            </svg>

            Panduan
        </a>

        <a
            href="{{ route('pelapor.dashboard') }}#kontak"
            class="pelapor-sidebar-link"
        >
            <svg
                class="pelapor-sidebar-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.3 19.3 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/>
            </svg>

            Kontak
        </a>

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="pelapor-sidebar-form"
        >
            @csrf

            <button
                type="submit"
                class="pelapor-sidebar-link pelapor-sidebar-logout-button"
            >
                <svg
                    class="pelapor-sidebar-icon"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <path d="M16 17l5-5-5-5"/>
                    <path d="M21 12H9"/>
                </svg>

                Logout
            </button>
        </form>
    </nav>

    <div class="pelapor-sidebar-footer">
        <div class="pelapor-sidebar-footer-title">
            Bersama menjaga fasilitas kampus
        </div>

        <div class="pelapor-sidebar-footer-text">
            Laporan Anda membantu menciptakan lingkungan kampus
            yang aman dan nyaman.
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.getElementById('pelaporMenuButton');
        const sidebar = document.getElementById('pelaporSidebar');
        const overlay = document.getElementById('pelaporSidebarOverlay');

        function closeSidebar() {
            sidebar?.classList.remove('open');
            overlay?.classList.remove('open');
        }

        menuButton?.addEventListener('click', function () {
            sidebar?.classList.toggle('open');
            overlay?.classList.toggle('open');
        });

        overlay?.addEventListener('click', closeSidebar);

        document
            .querySelectorAll('.pelapor-sidebar-link')
            .forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth <= 900) {
                        closeSidebar();
                    }
                });
            });
    });
</script>