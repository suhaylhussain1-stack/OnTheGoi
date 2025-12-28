// scripts.js - minimal interactions
document.addEventListener('DOMContentLoaded', function(){
  // Current year in footer
  const y = new Date().getFullYear();
  const yearEl = document.getElementById('year');
  if(yearEl) yearEl.textContent = y;

  // Mobile menu toggle
  const menuToggle = document.getElementById('menuToggle');
  const navList = document.getElementById('navList');
  menuToggle && menuToggle.addEventListener('click', function(){
    const expanded = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', String(!expanded));
    if(navList){
      navList.style.display = expanded ? 'none' : 'block';
    }
  });

  // Simple client-side form validation
  const form = document.getElementById('quoteForm');
  if(form){
    form.addEventListener('submit', function(e){
      const required = form.querySelectorAll('[required]');
      let ok = true;
      required.forEach(function(el){
        if(!el.value.trim()){
          ok = false;
          el.classList.add('error');
        } else {
          el.classList.remove('error');
        }
      });
      if(!ok){
        e.preventDefault();
        alert('Please fill in all required fields.');
      }
    });
  }
});
