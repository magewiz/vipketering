/* VIP Ketering — shared interactions */
(function(){
  // sticky header state — pages with .nav-solid stay opaque even at the top
  const nav = document.querySelector('.nav');
  const alwaysSolid = nav && nav.classList.contains('nav-solid');
  const onScroll = () => { if(nav){ nav.classList.toggle('scrolled', alwaysSolid || window.scrollY > 40); } };
  window.addEventListener('scroll', onScroll, {passive:true}); onScroll();

  // mobile menu
  const burger = document.querySelector('[data-burger]');
  const menu = document.querySelector('.mobile-menu');
  const closeMenu = () => { menu && menu.classList.remove('open'); document.body.style.overflow=''; };
  if(burger && menu){
    burger.addEventListener('click', () => {
      menu.classList.toggle('open');
      document.body.style.overflow = menu.classList.contains('open') ? 'hidden' : '';
    });
    menu.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));
    const x = menu.querySelector('[data-close]');
    x && x.addEventListener('click', closeMenu);
  }

  // reveal on scroll
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); } });
  }, {threshold:0.14, rootMargin:'0px 0px -8% 0px'});
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  // animated counters
  const fmt = n => n.toLocaleString('en-US');
  const counter = (el) => {
    const target = +el.dataset.count; const dur = 1800; const t0 = performance.now();
    const step = (now) => {
      const p = Math.min((now - t0)/dur, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      el.textContent = fmt(Math.floor(eased * target));
      if(p < 1) requestAnimationFrame(step); else el.textContent = fmt(target);
    };
    requestAnimationFrame(step);
  };
  const cio = new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting){ counter(e.target); cio.unobserve(e.target); } });
  }, {threshold:0.6});
  document.querySelectorAll('[data-count]').forEach(el => cio.observe(el));

  // lightbox (gallery)
  const lb = document.querySelector('.lb');
  if(lb){
    const lbImg = lb.querySelector('img');
    const items = Array.from(document.querySelectorAll('[data-lb]'));
    let idx = 0;
    const show = (i) => { idx = (i + items.length) % items.length; lbImg.src = items[idx].dataset.lb; };
    items.forEach((it, i) => it.addEventListener('click', () => { show(i); lb.classList.add('open'); document.body.style.overflow='hidden'; }));
    const close = () => { lb.classList.remove('open'); document.body.style.overflow=''; };
    lb.querySelector('[data-lb-close]').addEventListener('click', close);
    lb.querySelector('[data-lb-prev]').addEventListener('click', () => show(idx-1));
    lb.querySelector('[data-lb-next]').addEventListener('click', () => show(idx+1));
    lb.addEventListener('click', (e) => { if(e.target === lb) close(); });
    document.addEventListener('keydown', (e) => {
      if(!lb.classList.contains('open')) return;
      if(e.key==='Escape') close();
      if(e.key==='ArrowLeft') show(idx-1);
      if(e.key==='ArrowRight') show(idx+1);
    });
  }

  // toast helper
  let toastEl;
  const toast = (msg) => {
    if(!toastEl){ toastEl = document.createElement('div'); toastEl.className='toast'; document.body.appendChild(toastEl); }
    toastEl.textContent = msg; toastEl.classList.add('show');
    clearTimeout(toastEl._t); toastEl._t = setTimeout(()=>toastEl.classList.remove('show'), 2600);
  };

  // share buttons — native share sheet on mobile, clipboard fallback on desktop
  document.querySelectorAll('[data-share]').forEach(btn => {
    btn.addEventListener('click', async (e) => {
      e.preventDefault(); e.stopPropagation();
      const title = btn.dataset.share;
      const price = btn.dataset.price ? ` — ${btn.dataset.price}` : '';
      const url = location.origin + location.pathname + '#' + (btn.closest('[id]')?.id || '');
      const shareData = { title: `VIP Ketering · ${title}`, text: `${title}${price} · VIP Ketering`, url };
      try {
        if(navigator.share){ await navigator.share(shareData); }
        else { await navigator.clipboard.writeText(`${shareData.text}\n${url}`); toast('Линкот е копиран ✓'); }
      } catch(err){ /* user cancelled */ }
    });
  });

  // year
  const y = document.querySelector('[data-year]'); if(y) y.textContent = new Date().getFullYear();

  // form (demo only)
  const form = document.querySelector('[data-form]');
  if(form){ form.addEventListener('submit', (e)=>{ e.preventDefault(); const b=form.querySelector('[type=submit]'); b.textContent='Испратено ✓'; b.style.background='var(--gold-bright)'; form.reset(); setTimeout(()=>{b.textContent='Испрати порака';},2600); }); }
})();
