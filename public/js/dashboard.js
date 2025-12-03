/**
 * ====================================================
 * DASHBOARD INITIALIZATION
 * ====================================================
 */
document.addEventListener('DOMContentLoaded', () => {
    ProfileDropdown.init();
    CounterAnimation.init();
    // NavigationSystem.init(); // Tidak diperlukan karena kita menggunakan navigasi Blade
    // ChartManager.init(); // Dihilangkan karena tidak ada chart di dashboard saat ini
});

/**
 * ====================================================
 * PROFILE DROPDOWN LOGIC
 * Mengelola Dark Mode Toggle dan tampilan dropdown profil
 * ====================================================
 */
class ThemeManager {
    static THEMES = { DARK: 'dark-theme', LIGHT: 'light-theme' };
    static currentTheme = ThemeManager.THEMES.DARK;

    static loadTheme() {
        const savedTheme = localStorage.getItem('theme');
        const html = document.documentElement;

        if (savedTheme === this.THEMES.LIGHT) {
            html.classList.replace(this.THEMES.DARK, this.THEMES.LIGHT);
            this.currentTheme = this.THEMES.LIGHT;
            return false; // Not checked (Light Mode)
        } else {
            html.classList.add(this.THEMES.DARK);
            this.currentTheme = this.THEMES.DARK;
            return true; // Checked (Dark Mode)
        }
    }

    static toggleTheme() {
        const html = document.documentElement;
        if (this.currentTheme === this.THEMES.DARK) {
            html.classList.replace(this.THEMES.DARK, this.THEMES.LIGHT);
            this.currentTheme = this.THEMES.LIGHT;
        } else {
            html.classList.replace(this.THEMES.LIGHT, this.THEMES.DARK);
            this.currentTheme = this.THEMES.DARK;
        }
        localStorage.setItem('theme', this.currentTheme);
    }
}


class ProfileDropdown {
    static init() {
        const profileTrigger = document.querySelector('.profile-trigger');
        const profileDropdown = document.querySelector('.profile-dropdown');
        const themeToggle = document.getElementById('theme-toggle');

        // Load Theme saat inisialisasi
        if (themeToggle) {
            themeToggle.checked = ThemeManager.loadTheme();

            themeToggle.addEventListener('change', () => {
                ThemeManager.toggleTheme();
            });
        }
        
        // Logic buka/tutup dropdown
        if (profileTrigger && profileDropdown) {
            profileTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('active');
            });

            document.addEventListener('click', (e) => {
                if (!profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                }
            });
        }
    }
}

/**
 * ====================================================
 * COUNTER ANIMATION LOGIC (Untuk Stat Cards di Dashboard)
 * ====================================================
 */
class CounterAnimation {
    static init() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.ceil(current).toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString();
                }
            };

            // Hanya jalankan jika elemen counter ada
            if (counter) {
                updateCounter();
            }
        });
    }
}