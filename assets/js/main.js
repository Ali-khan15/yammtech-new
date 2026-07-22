// Mobile menu
const menuBtn = document.getElementById('menuBtn');
const menuClose = document.getElementById('menuClose');
const mobileMenu = document.getElementById('mobileMenu');

if (menuBtn) menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('open'));
if (menuClose) menuClose.addEventListener('click', () => mobileMenu.classList.remove('open'));

document.addEventListener('click', (e) => {
  if (mobileMenu && mobileMenu.classList.contains('open') &&
      !mobileMenu.contains(e.target) && menuBtn && !menuBtn.contains(e.target)) {
    mobileMenu.classList.remove('open');
  }
});

// Contact form
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = contactForm.querySelector('button[type=submit]');
    const msg = document.getElementById('contactMsg');
    const origHTML = btn.innerHTML;
    btn.disabled = true;
    btn.textContent = 'Sending…';
    try {
      const res = await fetch('contact.php', {method: 'POST', body: new FormData(contactForm)});
      const data = await res.json();
      if (data.ok) {
        msg.className = 'form-msg ok';
        msg.textContent = "Message sent! We'll be in touch soon.";
        contactForm.reset();
      } else {
        throw new Error();
      }
    } catch {
      msg.className = 'form-msg err';
      msg.textContent = 'Something went wrong — please email info@yammtech.com directly.';
    }
    btn.disabled = false;
    btn.innerHTML = origHTML;
  });
}

// Audit form
const auditForm = document.getElementById('auditForm');
if (auditForm) {
  auditForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = auditForm.querySelector('button[type=submit]');
    const msg = document.getElementById('auditMsg');
    const origHTML = btn.innerHTML;
    btn.disabled = true;
    btn.textContent = 'Sending…';
    try {
      const res = await fetch('audit.php', {method: 'POST', body: new FormData(auditForm)});
      const data = await res.json();
      if (data.ok) {
        msg.className = 'form-msg ok';
        msg.textContent = "Audit request received! We'll send it to your inbox within 48 hours.";
        auditForm.reset();
      } else {
        throw new Error();
      }
    } catch {
      msg.className = 'form-msg err';
      msg.textContent = 'Something went wrong — please email info@yammtech.com directly.';
    }
    btn.disabled = false;
    btn.innerHTML = origHTML;
  });
}
