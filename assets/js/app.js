// Header scroll effect
const header = document.getElementById('header');
if (header) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
}

// Mobile menu toggle
const menuToggle = document.getElementById('menuToggle');
const navbar = document.querySelector('.navbar');
if (menuToggle && navbar) {
    menuToggle.addEventListener('click', () => {
        navbar.classList.toggle('open');
    });
    // Close on outside click
    document.addEventListener('click', (e) => {
        if (!menuToggle.contains(e.target) && !navbar.contains(e.target)) {
            navbar.classList.remove('open');
        }
    });
}

// Cart button visual feedback (for non-link buttons only)
document.querySelectorAll('button.btn-cart').forEach(btn => {
    btn.addEventListener('click', () => {
        const original = btn.innerHTML;
        btn.innerHTML = '✔ Agregado';
        btn.style.background = '#22c55e';
        btn.disabled = true;
        setTimeout(() => {
            btn.innerHTML = original;
            btn.style.background = '';
            btn.disabled = false;
        }, 2000);
    });
});

// Smooth fade-in for book cards
const cards = document.querySelectorAll('.book-card');
if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, i * 60);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(card);
    });
}

