<!DOCTYPE html>
<html lang="id">
    @include('layouts.parts.head')
    <body>
        <div class="app-wrapper">
            @include('layouts.parts.sidebar')
            <main class="main">
                @include('layouts.parts.navbar')
                <section class="content">
                    @yield('content')
                </section>
                <footer class="footer">
                    © 2025 <strong>SIMDA Barang</strong> – Pemerintah Kota Samarinda.  
                    All rights reserved.
                </footer>
            </main>
        </div>
        @include('layouts.parts.script')
    </body>
</html>