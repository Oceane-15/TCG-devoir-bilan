    <footer class="site-footer">
        <img src="assets/img/canard.png" alt="" class="footer-duck">
        <nav class="footer-links">
            <a href="index.php?route=mentions">Mentions légales</a>
            <a href="index.php?route=faq">Contact et FAQ</a>
            <a href="index.php?route=cgv">CGV/CGU</a>
        </nav>
        <div class="socials">
            <a href="#" aria-label="X"><svg viewBox="0 0 24 24">
                    <path d="M18.9 2H22l-7.1 8.1L23.3 22h-6.6l-5.2-6.8L5.6 22H2.5l7.6-8.7L1 2h6.8l4.7 6.2L18.9 2Zm-1.2 18h1.8L7.1 3.9H5.2L17.7 20Z" />
                </svg></a>
            <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24">
                    <path d="M12 2c2.7 0 3 0 4.1.1 1 0 1.7.2 2.3.5.6.2 1.1.5 1.6 1s.8 1 1 1.6c.3.6.5 1.3.5 2.3.1 1.1.1 1.4.1 4.1s0 3-.1 4.1c0 1-.2 1.7-.5 2.3-.2.6-.5 1.1-1 1.6s-1 .8-1.6 1c-.6.3-1.3.5-2.3.5-1.1.1-1.4.1-4.1.1s-3 0-4.1-.1c-1 0-1.7-.2-2.3-.5-.6-.2-1.1-.5-1.6-1s-.8-1-1-1.6c-.3-.6-.5-1.3-.5-2.3C2 15 2 14.7 2 12s0-3 .1-4.1c0-1 .2-1.7.5-2.3.2-.6.5-1.1 1-1.6s1-.8 1.6-1c.6-.3 1.3-.5 2.3-.5C9 2 9.3 2 12 2Zm0 5a5 5 0 100 10 5 5 0 000-10Zm0 8.2a3.2 3.2 0 110-6.4 3.2 3.2 0 010 6.4Zm5.2-8.4a1.2 1.2 0 100 2.4 1.2 1.2 0 000-2.4Z" />
                </svg></a>
            <a href="#" aria-label="TikTok"><svg viewBox="0 0 24 24">
                    <path d="M16.6 5.8c-.9-1-1.4-2.3-1.4-3.8h-3v13.1c0 1.5-1.2 2.7-2.7 2.7s-2.7-1.2-2.7-2.7 1.2-2.7 2.7-2.7c.3 0 .6 0 .8.1v-3c-.3 0-.5-.1-.8-.1-3.1 0-5.7 2.6-5.7 5.7s2.6 5.7 5.7 5.7 5.7-2.6 5.7-5.7V9.3c1.2.9 2.6 1.4 4.2 1.4v-3c-.9 0-1.8-.4-2.8-1.9Z" />
                </svg></a>
            <a href="#" aria-label="Discord"><svg viewBox="0 0 24 24">
                    <path d="M20.3 4.9A19 19 0 0015.6 3.5l-.2.5a17.6 17.6 0 014.1 1.4A16.4 16.4 0 002.6 5.4 17.6 17.6 0 016.7 4l-.2-.5A19 19 0 001.7 4.9 19.7 19.7 0 00.1 17.6 19.2 19.2 0 006 20.5l.6-.9c-1-.4-1.9-.9-2.7-1.5l.7-.5a13.7 13.7 0 0011.8 0l.7.5c-.8.6-1.7 1.1-2.7 1.5l.6.9a19.2 19.2 0 005.9-2.9 19.7 19.7 0 00-1.7-12.7ZM8 15c-.9 0-1.7-.9-1.7-1.9S7 11.1 8 11.1s1.7.9 1.7 1.9S8.9 15 8 15Zm8 0c-.9 0-1.7-.9-1.7-1.9s.8-1.9 1.7-1.9 1.7.9 1.7 1.9S16.9 15 16 15Z" />
                </svg></a>
        </div>
    </footer>

    <?php require __DIR__ . '/panier_offcanvas.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/auth.js"></script>
    <?php if (!empty($_SESSION['ouvrir_panier'])): unset($_SESSION['ouvrir_panier']); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var el = document.getElementById('panierOffcanvas');
                if (el) {
                    new bootstrap.Offcanvas(el).show();
                }
            });
        </script>
    <?php endif; ?>
    </body>

    </html>