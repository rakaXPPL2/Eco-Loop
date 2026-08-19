import React, { useState, useEffect, useRef } from 'react';

// Animated Counter Component
const AnimatedCounter = ({ end, suffix = '', duration = 2000 }) => {
  const [count, setCount] = useState(0);
  useEffect(() => {
    let start = 0;
    const increment = end / (duration / 16);
    const timer = setInterval(() => {
      start += increment;
      if (start >= end) {
        setCount(end);
        clearInterval(timer);
      } else {
        setCount(Math.floor(start));
      }
    }, 16);
    return () => clearInterval(timer);
  }, [end, duration]);
  return <span>{count.toLocaleString()}{suffix}</span>;
};

// Hero Counter with delay
const HeroCounter = ({ end, suffix = '', duration = 3000 }) => {
  const [count, setCount] = useState(0);
  useEffect(() => {
    const timer = setTimeout(() => {
      let start = 0;
      const increment = end / (duration / 16);
      const interval = setInterval(() => {
        start += increment;
        if (start >= end) {
          setCount(end);
          clearInterval(interval);
        } else {
          setCount(Math.floor(start));
        }
      }, 16);
      return () => clearInterval(interval);
    }, 500);
    return () => clearTimeout(timer);
  }, [end, duration]);
  return <span>{count.toLocaleString()}{suffix}</span>;
};

const IconLeaf = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M19 3c-4.97 0-9.02 2.11-12.4 6.08C3.27 12.47 2 15.4 2 18.5 5.1 18.5 8.03 17.23 10.92 14.34 14.8 10.46 18 6.96 19 3zm-7.7 10.58c.26.26.6.38 1.05.38.63 0 1.16-.31 1.63-.79l3.4-4.23-3.87 1.14-1.95 1.93-1.26 1.57zM8.5 16.5c-1.78-1.8-2.87-4.12-3.5-6.94 2.82.63 5.14 1.72 6.93 3.5l-3.43 3.44z" />
  </svg>  
);

const IconTicket = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M20 6h-2.18A2.99 2.99 0 0017 4a3 3 0 00-5.8-1.2A3.03 3.03 0 008.18 4H6a2 2 0 00-2 2v2.5c0 .83.67 1.5 1.5 1.5S7 11.33 7 10.5V8h10v2.5c0 .83.67 1.5 1.5 1.5S20 11.33 20 10.5V8a2 2 0 000-2zm-2.18 4.72A2.99 2.99 0 0017 16a3 3 0 01-5.8 1.2A3.03 3.03 0 018.18 16H6a2 2 0 01-2-2v-2.5c0-.83.67-1.5 1.5-1.5S7 10.67 7 11.5V14h10v-2.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V14a2 2 0 01-2 2h-2.18A2.99 2.99 0 0017 20a3 3 0 01-5.8 1.2A3.03 3.03 0 008.18 20H6a2 2 0 01-2-2v-2.5c0-.83.67-1.5 1.5-1.5S7 16.67 7 17.5V18h10v-1.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V18a2 2 0 01-2 2H7a2 2 0 01-2-2" />
  </svg>
);

const IconHome = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M12 3l9 8h-3v9H6v-9H3l9-8zm0 3.2L7 10v7h3v-5h4v5h3V10l-5-3.8z" />
  </svg>
);

const IconCow = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M18.5 9.5c-.65 0-1.27.1-1.84.3A4.98 4.98 0 0012 6a4.98 4.98 0 00-4.66 3.8A5.15 5.15 0 006.5 9.5C4.57 9.5 3 11.07 3 13c0 1.93 1.57 3.5 3.5 3.5h.25c.9 2.58 3.32 4.5 6.25 4.5s5.35-1.92 6.25-4.5h.25A3.5 3.5 0 0021 13c0-1.93-1.57-3.5-3.5-3.5zm-9.3 6.2a2.5 2.5 0 112.5-2.5 2.5 2.5 0 01-2.5 2.5zm7.3 0a2.5 2.5 0 112.5-2.5 2.5 2.5 0 01-2.5 2.5zm-6.8-6.7a2.5 2.5 0 015 0v.5h-5v-.5z" />
  </svg>
);

const IconPalette = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M18.5 3.5A8.5 8.5 0 0012.2 20a1.5 1.5 0 001.5-1.5v-1.8c0-.83.67-1.5 1.5-1.5h1.8c.83 0 1.5-.67 1.5-1.5V9.5A8.5 8.5 0 0018.5 3.5zM8 14.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm4-4a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm5-2a1.5 1.5 0 110-3 1.5 1.5 0 010 3zM5 18.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />
  </svg>
);

const IconSprout = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M19 4c-2.76 0-5 1.84-5.8 4.36C12.04 9.87 11.16 10 10 10c-3.31 0-6 2.69-6 6 0 .85.17 1.65.49 2.39C5.98 18.53 7.17 19 8.5 19c2.12 0 4.11-.83 5.54-2.23C15.66 17.21 17.36 18 19.5 18c1.38 0 2.5-1.12 2.5-2.5 0-1.38-1.12-2.5-2.5-2.5-.88 0-1.67.38-2.2 1H15.5a6.5 6.5 0 00-3.68-3.68A5.5 5.5 0 0119 4zm-8.5 8.5c.65 0 1.28.1 1.86.3A4 4 0 0112 17c-2.54 0-4.5-1.91-4.5-4.5 0-.63.12-1.24.35-1.8A7.04 7.04 0 0110.5 12.5z" />
  </svg>
);

const IconBag = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M7 7V6a5 5 0 0110 0v1h2a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h2zm2 0h6V6a3 3 0 00-6 0v1z" />
  </svg>
);

const IconChart = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M5 19h14v2H3V3h2v16zm3-3h2V9H8v7zm4 0h2V5h-2v11zm4 0h2v-7h-2v7z" />
  </svg>
);

const IconTrophy = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M7 4h10v2h2a2 2 0 012 2v2a5 5 0 01-4 4.9V16h3v2H6v-2h3v-1.1A5 5 0 015 10V8a2 2 0 012-2h2V4zm2 2v2h6V6H9zm-1.5 6h9a3 3 0 003-3V8h-1v2a1 1 0 01-1 1H7.5a1 1 0 01-1-1V8h-1v3a3 3 0 003 3z" />
  </svg>
);

const IconBell = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M12 2a5 5 0 015 5v3.59l2.71 5.42A1 1 0 0118.74 18H5.26a1 1 0 01-.97-1.99L7 10.59V7a5 5 0 015-5zm0 20a2.5 2.5 0 01-2.45-2h4.9A2.5 2.5 0 0112 22z" />
  </svg>
);

const IconCheck = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M9.55 15.15L5.4 11l-1.4 1.4 5.55 5.55L20.6 5.4 19.2 4l-9.65 11.15z" />
  </svg>
);

const IconSpark = ({ className = '', size = 18, color = 'currentColor' }) => (
  <svg viewBox="0 0 24 24" width={size} height={size} className={className} fill={color} aria-hidden="true">
    <path d="M12 2l1.74 6.26L20 10l-6.26 1.74L12 18l-1.74-6.26L4 10l6.26-1.74L12 2zm7 12l.87 3.13L23 18l-3.13.87L19 22l-.87-3.13L15 18l3.13-.87L19 14zm-14 0l.87 3.13L9 18l-3.13.87L5 22l-.87-3.13L1 18l3.13-.87L5 14z" />
  </svg>
);

const renderIcon = (name, props = {}) => {
  const icons = {
    leaf: <IconLeaf {...props} />,
    ticket: <IconTicket {...props} />,
    home: <IconHome {...props} />,
    cow: <IconCow {...props} />,
    palette: <IconPalette {...props} />,
    sprout: <IconSprout {...props} />,
    bag: <IconBag {...props} />,
    chart: <IconChart {...props} />,
    trophy: <IconTrophy {...props} />,
    bell: <IconBell {...props} />,
    check: <IconCheck {...props} />,
    spark: <IconSpark {...props} />,
  };

  return icons[name] || icons.leaf;
};

const sectionLabelStyle = { letterSpacing: '0.14em' };
const bodyTextStyle = { letterSpacing: '0.01em', lineHeight: 1.7 };

// Navbar Component
const Navbar = () => {
  const [scrolled, setScrolled] = useState(false);
  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);
  const navLinks = [
    { label: 'Fitur', href: '#fitur' },
    { label: 'Cara Kerja', href: '#cara-kerja' },
    { label: 'Kategori', href: '#kategori' },
    { label: 'Voucher', href: '#voucher-karbon' },
  ];
  return (
    <nav className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${scrolled ? 'bg-[#152e1c]/95 backdrop-blur-md shadow-lg' : 'bg-transparent'}`}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10">
        <div className="flex items-center justify-between h-16 gap-4">
          <a href="/" className="flex items-center gap-2">
            <div className="w-10 h-10 rounded-full flex items-center justify-center" style={{ backgroundColor: '#52b788' }}>
              <svg viewBox="0 0 24 24" className="w-5 h-5 fill-white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H7l5-8v4h4l-5 8z" /></svg>
            </div>
            <span className="font-display font-semibold text-lg tracking-tight text-cream">Eco-Loop</span>
          </a>
          <div className="hidden lg:flex items-center gap-9">
            {navLinks.map((link) => (
              <a key={link.label} href={link.href} className="text-sm font-semibold text-cream-muted hover:text-sprout-light transition-colors" style={{ letterSpacing: '0.06em' }}>{link.label}</a>
            ))}
          </div>
          <div className="flex items-center gap-3">
            <a href="/login" className="px-5 py-2.5 text-sprout font-semibold rounded-lg hover:bg-sprout/10 transition-colors">Masuk</a>
            <a href="/register" className="px-7 py-2.5 rounded-full font-semibold text-sm text-white transition-all hover:brightness-110" style={{ backgroundColor: '#52b788', color: '#152e1c' }}>Daftar Gratis</a>
          </div>
        </div>
      </div>
    </nav>
  );
};

export { AnimatedCounter, HeroCounter, Navbar };


// Hero Section
const HeroSection = () => {
  return (
    <section className="relative min-h-screen flex items-center overflow-hidden" style={{ backgroundColor: '#152e1c' }}>
      <div className="absolute inset-0 opacity-30" style={{ backgroundImage: 'radial-gradient(ellipse 80% 50% at 70% 50%, #2d6a4f 0%, transparent 70%)' }} />
      <div className="absolute inset-0 opacity-10" style={{ backgroundImage: 'radial-gradient(circle, #95d5b2 1px, transparent 1px)', backgroundSize: '28px 28px' }} />
      <div className="relative max-w-7xl mx-auto px-6 lg:px-10 pt-28 pb-16 w-full">
        <div className="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
          <div>
            <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium mb-7" style={{ backgroundColor: 'rgba(82,183,136,0.15)', color: '#95d5b2', border: '1px solid rgba(82,183,136,0.25)', letterSpacing: '0.08em' }}>
              <span className="w-1.5 h-1.5 rounded-full bg-current animate-pulse" />
              Innoventure Chapter II 2026
            </div>
            <h1 className="font-display font-bold mb-7" style={{ color: '#f5f2e8', fontSize: 'clamp(2.4rem, 5vw, 4rem)', letterSpacing: '-0.02em', lineHeight: 1.15 }}>
              Jual. Beli.{' '}
              <span className="italic" style={{ color: '#52b788' }}>Selamatkan Bumi.</span>
            </h1>
            <p className="text-lg mb-10 max-w-lg" style={{ color: 'rgba(245,242,232,0.65)', letterSpacing: '0.01em', lineHeight: 1.75 }}>
              Platform jual-beli barang bekas, rumput segar, dan sisa makanan — setiap transaksi secara otomatis mengurangi jejak karbon Anda dan memberi{' '}
              <span style={{ color: '#95d5b2' }}>Voucher Karbon</span> sebagai hadiah.
            </p>
            <div className="flex flex-wrap gap-4 mb-14">
              <a href="/register" className="px-7 py-3.5 rounded-full font-semibold text-sm transition-all duration-200 hover:brightness-110 hover:scale-105" style={{ backgroundColor: '#52b788', color: '#152e1c' }}>
                Mulai Sekarang — Gratis
              </a>
              <a href="/products" className="px-7 py-3.5 rounded-full font-medium text-sm border transition-all duration-200 hover:bg-white/5" style={{ borderColor: 'rgba(245,242,232,0.25)', color: '#f5f2e8' }}>
                Lihat Katalog →
              </a>
            </div>
            <div className="inline-flex items-center gap-3 px-5 py-3 rounded-2xl" style={{ backgroundColor: 'rgba(82,183,136,0.1)', border: '1px solid rgba(82,183,136,0.2)' }}>
              <div className="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style={{ backgroundColor: 'rgba(82,183,136,0.2)' }}>
                <svg viewBox="0 0 24 24" className="w-5 h-5" style={{ fill: '#52b788' }}><path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 5.25-8 5.25S14.36 11.34 13 12.5A3.77 3.77 0 017.5 13.5c.66-2.32 2.48-4.56 6.5-5.5z" /></svg>
              </div>
              <div>
                <div className="text-xs mb-0.5" style={{ color: 'rgba(245,242,232,0.5)', lineHeight: 1.5 }}>Total Karbon Dihemat Komunitas</div>
                <div className="font-display font-bold text-xl" style={{ color: '#95d5b2' }}>
                  <HeroCounter end={48720} suffix=" kg CO₂" />
                </div>
              </div>
            </div>
          </div>
          <div className="relative hidden lg:block">
            <div className="grid grid-cols-2 gap-4" style={{ height: '520px' }}>
              <div className="rounded-3xl overflow-hidden" style={{ gridRow: 'span 2', backgroundColor: '#1f4d2e' }}>
                <img src="https://images.unsplash.com/photo-1750343293522-2f08b60a317a?w=500&h=600&fit=crop&auto=format" alt="Pusat daur ulang" className="w-full h-full object-cover" />
              </div>
              <div className="rounded-3xl overflow-hidden" style={{ backgroundColor: '#1f4d2e' }}>
                <img src="https://images.unsplash.com/photo-1569163139500-66446e2926ca?w=400&h=220&fit=crop&auto=format" alt="Bumi lebih berharga" className="w-full h-full object-cover" />
              </div>
              <div className="rounded-3xl p-5 flex flex-col justify-between" style={{ backgroundColor: '#52b788' }}>
                <div className="text-xs font-medium" style={{ color: '#152e1c', opacity: 0.7, lineHeight: 1.5 }}>Voucher Karbon Anda</div>
                <div>
                  <div className="font-display font-bold text-3xl" style={{ color: '#152e1c' }}>2.340</div>
                  <div className="text-xs font-medium mt-1" style={{ color: '#152e1c', opacity: 0.8, lineHeight: 1.5 }}>poin karbon terkumpul</div>
                </div>
                <div className="flex gap-1">
                  {[...Array(5)].map((_, i) => (
                    <div key={i} className="w-2 h-2 rounded-full" style={{ backgroundColor: i < 4 ? '#152e1c' : 'rgba(21,46,28,0.3)' }} />
                  ))}
                </div>
              </div>
            </div>
            <div className="absolute -left-8 bottom-20 px-4 py-3 rounded-2xl float-anim" style={{ backgroundColor: '#f5f2e8', boxShadow: '0 8px 32px rgba(0,0,0,0.25)' }}>
              <div className="text-xs font-medium text-gray-500 mb-1" style={{ lineHeight: 1.5 }}>Transaksi terbaru</div>
              <div className="flex items-center gap-2 font-semibold text-sm" style={{ color: '#1f4d2e', lineHeight: 1.5 }}>
                <span className="inline-flex items-center justify-center text-[#1f4d2e]" aria-hidden="true">{renderIcon('leaf', { size: 16, color: '#1f4d2e' })}</span>
                <span>Rumput 2kg — hemat 0.9kg CO₂</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" className="w-full">
          <path d="M0 60V30C240 0 480 60 720 30C960 0 1200 60 1440 30V60H0Z" fill="#f5f2e8" />
        </svg>
      </div>
    </section>
  );
};

export { HeroSection };


// Stats Section
const StatsSection = () => {
  const stats = [
    { value: 12480, suffix: '+', label: 'Pengguna Aktif' },
    { value: 48720, suffix: ' kg', label: 'CO₂ Dihemat' },
    { value: 9340, suffix: '+', label: 'Produk Tersedia' },
    { value: 3200, suffix: '+', label: 'Voucher Ditukarkan' },
  ];
  return (
    <section className="py-16" style={{ backgroundColor: '#f5f2e8' }}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10 grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-10">
        {stats.map((s) => (
          <div key={s.label} className="text-center">
            <div className="font-display font-bold mb-2" style={{ color: '#1f4d2e', fontSize: 'clamp(1.8rem, 3.5vw, 2.6rem)', lineHeight: 1.2 }}>
              <AnimatedCounter end={s.value} suffix={s.suffix} />
            </div>
            <div className="text-sm font-medium" style={{ color: '#7a8c72', letterSpacing: '0.02em', lineHeight: 1.5 }}>{s.label}</div>
          </div>
        ))}
      </div>
    </section>
  );
};

// How It Works Section
const HowItWorksSection = () => {
  const steps = [
    { num: '01', title: 'Daftarkan Barang', desc: 'Upload foto barang bekas, rumput segar, atau sisa makanan. Sistem otomatis menghitung potensi penghematan karbon.', icon: 'M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z' },
    { num: '02', title: 'Transaksi Terjadi', desc: 'Pembeli menemukan produk, memasukkan ke keranjang, dan checkout. Setiap transaksi tercatat di sistem karbon kami.', icon: 'M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-1.45-5c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0020 4H5.21L4 1H1v2h2l3.6 7.59-1.35 2.44C4.52 14.37 5.48 16 7 16h12v-2H7l1.1-2h7.45z' },
    { num: '03', title: 'Dapat Voucher Karbon', desc: 'Voucher langsung dikirim ke akun Anda. Tukarkan dengan diskon, bibit pohon, atau donasi penghijauan.', icon: 'M20 6h-2.18c.07-.44.18-.87.18-1.33C18 2.54 16.46 1 14.67 1c-1.74 0-3.41 1.01-4.67 2.44C8.74 2.01 7.07 1 5.33 1 3.54 1 2 2.54 2 4.67 2 7.25 4.31 9.35 7.88 12.6L10 14.55l2.12-1.96C15.69 9.35 18 7.25 18 4.67c0-.46-.11-.89-.18-1.33H20v2h2V7h-2V6z' },
  ];
  return (
    <section className="py-20 lg:py-28" style={{ backgroundColor: '#f5f2e8' }}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          <div>
            <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788', ...sectionLabelStyle }}>Cara Kerja</div>
            <h2 className="font-display font-bold mb-6" style={{ color: '#1f4d2e', fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)', letterSpacing: '-0.02em', lineHeight: 1.25 }}>
              Tiga langkah menuju <span className="italic">ekonomi yang lebih hijau</span>
            </h2>
            <p style={{ color: '#6b705c', fontSize: '1.05rem', letterSpacing: '0.01em', lineHeight: 1.75 }}>
              Eco-Loop menghubungkan penjual dan pembeli dalam ekosistem sirkular yang transparan — di mana setiap transaksi memiliki dampak nyata terhadap lingkungan.
            </p>
          </div>
          <div className="flex flex-col gap-6">
            {steps.map((step, i) => (
              <div key={step.num} className="flex gap-5 p-6 rounded-2xl transition-all duration-200 hover:-translate-y-0.5" style={{ backgroundColor: i === 1 ? '#1f4d2e' : '#fff', boxShadow: '0 2px 16px rgba(31,77,46,0.07)' }}>
                <div className="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style={{ backgroundColor: i === 1 ? 'rgba(82,183,136,0.2)' : '#f0faf4', color: i === 1 ? '#52b788' : '#1f4d2e' }}>
                  <svg viewBox="0 0 24 24" className="w-6 h-6 fill-current"><path d={step.icon} /></svg>
                </div>
                <div>
                  <div className="text-xs font-mono font-bold mb-2" style={{ color: i === 1 ? 'rgba(149,213,178,0.6)' : '#95d5b2', letterSpacing: '0.12em' }}>{step.num}</div>
                  <div className="font-semibold mb-2" style={{ color: i === 1 ? '#f5f2e8' : '#1f4d2e', letterSpacing: '0.02em', lineHeight: 1.4 }}>{step.title}</div>
                  <div className="text-sm" style={{ color: i === 1 ? 'rgba(245,242,232,0.65)' : '#7a8c72', letterSpacing: '0.01em', lineHeight: 1.65 }}>{step.desc}</div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};

export { StatsSection, HowItWorksSection };


// Categories Section
const CategoriesSection = () => {
  const cats = [
    { name: 'Barang Bekas', sub: 'Pakaian, elektronik, furnitur, & lebih', carbon: '0,3 – 2 kg CO₂ per item', color: '#2d4a22', img: 'https://images.unsplash.com/photo-1768145488790-185e20abfd08?w=600&h=400&fit=crop&auto=format', alt: 'Rak pakaian bekas', tag: '4.200+ produk' },
    { name: 'Rumput Segar', sub: 'Pakan ternak berkualitas langsung dari kebun', carbon: '0,45 kg CO₂ per kg', color: '#1f4d2e', img: 'https://images.unsplash.com/photo-1569163139599-0f4517e36f51?w=600&h=400&fit=crop&auto=format', alt: 'Rumput segar hijau', tag: '320+ penjual' },
    { name: 'Sisa Makanan', sub: 'Untuk kompos, pupuk organik, & biogas', carbon: '0,6 kg CO₂ per kg sisa', color: '#4a3520', img: 'https://images.unsplash.com/photo-1726572330396-0947f571ac19?w=600&h=400&fit=crop&auto=format', alt: 'Pengolahan sisa makanan', tag: '180+ penjual' },
  ];
  return (
    <section id="kategori" className="py-20 lg:py-28" style={{ backgroundColor: '#152e1c' }}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10">
        <div className="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
          <div>
            <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788', ...sectionLabelStyle }}>Kategori Produk</div>
            <h2 className="font-display font-bold" style={{ color: '#f5f2e8', fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)', letterSpacing: '-0.02em', lineHeight: 1.25 }}>
              Apa yang bisa kamu <span className="italic" style={{ color: '#95d5b2' }}>jual & beli</span>
            </h2>
          </div>
          <a href="/products" className="text-sm font-medium flex-shrink-0 transition-colors hover:opacity-80" style={{ color: '#52b788', letterSpacing: '0.04em' }}>Lihat semua kategori →</a>
        </div>
        <div className="grid md:grid-cols-3 gap-6">
          {cats.map((cat) => (
            <a href="/products" key={cat.name} className="rounded-3xl overflow-hidden group cursor-pointer block" style={{ backgroundColor: cat.color }}>
              <div className="relative h-52 overflow-hidden">
                <img src={cat.img} alt={cat.alt} className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                <div className="absolute inset-0" style={{ background: `linear-gradient(to top, ${cat.color} 15%, transparent 70%)` }} />
                <div className="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-medium" style={{ backgroundColor: 'rgba(245,242,232,0.15)', color: '#f5f2e8', backdropFilter: 'blur(8px)' }}>{cat.tag}</div>
              </div>
              <div className="p-6">
                <h3 className="font-display font-bold text-xl mb-2" style={{ color: '#f5f2e8', letterSpacing: '0.02em', lineHeight: 1.3 }}>{cat.name}</h3>
                <p className="text-sm mb-4" style={{ color: 'rgba(245,242,232,0.6)', letterSpacing: '0.01em', lineHeight: 1.6 }}>{cat.sub}</p>
                <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium" style={{ backgroundColor: 'rgba(82,183,136,0.15)', color: '#95d5b2' }}>
                  <span aria-hidden="true">{renderIcon('leaf', { size: 14, color: '#95d5b2' })}</span>
                  <span>Hemat {cat.carbon}</span>
                </div>
              </div>
            </a>
          ))}
        </div>
      </div>
    </section>
  );
};

// Voucher Feature Section
const VoucherFeatureSection = () => {
  const rewards = [
    { label: 'Diskon Belanja', pts: '500 poin', icon: 'ticket' },
    { label: 'Bibit Pohon', pts: '1.200 poin', icon: 'sprout' },
    { label: 'Tas Eco-Friendly', pts: '2.000 poin', icon: 'bag' },
    { label: 'Donasi Penghijauan', pts: '300 poin', icon: 'leaf' },
  ];
  return (
    <section id="voucher-karbon" className="py-20 lg:py-28" style={{ backgroundColor: '#f5f2e8' }}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          <div className="relative">
            <div className="relative rounded-3xl p-8 lg:p-10 overflow-hidden" style={{ backgroundColor: '#1f4d2e' }}>
              <div className="absolute -top-12 -right-12 w-48 h-48 rounded-full opacity-10" style={{ backgroundColor: '#52b788' }} />
              <div className="absolute -bottom-8 -left-8 w-32 h-32 rounded-full opacity-10" style={{ backgroundColor: '#95d5b2' }} />
              <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium mb-8" style={{ backgroundColor: 'rgba(82,183,136,0.2)', color: '#95d5b2' }}>
                <span aria-hidden="true">{renderIcon('ticket', { size: 14, color: '#95d5b2' })}</span>
                <span>Voucher Karbon Otomatis</span>
              </div>
              <div className="font-display font-bold text-5xl mb-3" style={{ color: '#f5f2e8', lineHeight: 1.1 }}>2.340</div>
              <div className="text-sm mb-8" style={{ color: 'rgba(245,242,232,0.5)', lineHeight: 1.6 }}>poin karbon — setara 1,4 kg CO₂ dihemat</div>
              <div className="grid grid-cols-2 gap-3">
                {rewards.map((r) => (
                  <div key={r.label} className="p-4 rounded-2xl" style={{ backgroundColor: 'rgba(255,255,255,0.06)' }}>
                      <div className="mb-3 text-[#52b788]" aria-hidden="true">{renderIcon(r.icon, { size: 22, color: '#52b788' })}</div>
                    <div className="text-sm font-medium mb-1" style={{ color: '#f5f2e8', lineHeight: 1.4 }}>{r.label}</div>
                    <div className="text-xs" style={{ color: '#52b788', lineHeight: 1.4 }}>{r.pts}</div>
                  </div>
                ))}
              </div>
            </div>
            <div className="absolute -right-4 top-8 px-4 py-3 rounded-2xl float-anim" style={{ backgroundColor: '#52b788', boxShadow: '0 8px 24px rgba(82,183,136,0.3)' }}>
              <div className="flex items-center gap-2 text-xs font-bold" style={{ color: '#152e1c', lineHeight: 1.4 }}>
                <span aria-hidden="true">{renderIcon('spark', { size: 14, color: '#152e1c' })}</span>
                <span>Voucher Diterima!</span>
              </div>
              <div className="text-xs mt-1" style={{ color: 'rgba(21,46,28,0.7)', lineHeight: 1.4 }}>+120 poin dari transaksi ini</div>
            </div>
          </div>
          <div>
            <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788', ...sectionLabelStyle }}>Sistem Reward</div>
            <h2 className="font-display font-bold mb-6" style={{ color: '#1f4d2e', fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)', letterSpacing: '-0.02em', lineHeight: 1.25 }}>
              Berbuat baik, <span className="italic">dapat hadiah nyata</span>
            </h2>
            <p className="mb-8" style={{ color: '#6b705c', fontSize: '1.05rem', letterSpacing: '0.01em', lineHeight: 1.75 }}>
              Setiap kali kamu menjual atau membeli di Eco-Loop, sistem menghitung karbon yang berhasil dihemat dan langsung mengkredit Voucher Karbon ke akunmu — tanpa perlu klaim manual.
            </p>
            <ul className="flex flex-col gap-4">
              {['Otomatis dihitung per transaksi', 'Tukarkan dengan diskon, bibit, atau donasi', 'Lihat riwayat dan progres di dashboard', 'Naiki peringkat "Pahlawan Hijau" wilayah'].map((item) => (
                <li key={item} className="flex items-start gap-3">
                  <div className="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5" style={{ backgroundColor: '#e8f5ec' }}>
                    <svg viewBox="0 0 24 24" className="w-3 h-3" style={{ fill: '#1f4d2e' }}><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" /></svg>
                  </div>
                  <span style={{ color: '#4a5e45', letterSpacing: '0.02em', lineHeight: 1.6 }}>{item}</span>
                </li>
              ))}
            </ul>
            <a href="/eco-shop" className="inline-flex items-center gap-2 mt-8 px-6 py-3 rounded-full font-semibold text-sm transition-all duration-200 hover:brightness-110" style={{ backgroundColor: '#1f4d2e', color: '#f5f2e8' }}>
              Lihat Eco-Shop →
            </a>
          </div>
        </div>
      </div>
    </section>
  );
};

export { CategoriesSection, VoucherFeatureSection };


// Target Users Section
const TargetUsersSection = () => {
  const users = [
    { icon: 'home', name: 'Warga Rumah Tangga', age: '15–60 tahun', need: 'Jual barang bekas, rumput, atau sisa makanan', benefit: 'Uang tambahan + Voucher Karbon otomatis' },
    { icon: 'cow', name: 'Peternak Kecil', age: 'Sapi, kambing, domba', need: 'Beli rumput segar dengan harga terjangkau', benefit: 'Hemat biaya pakan + dapat Voucher Karbon' },
    { icon: 'palette', name: 'Pengrajin & Seniman', age: 'Kreatif & inovatif', need: 'Bahan bekas: kain, kayu, plastik untuk karya', benefit: 'Bahan murah + karya bisa dijual kembali' },
    { icon: 'sprout', name: 'Urban Farming', age: 'Komunitas pertanian kota', need: 'Sisa makanan untuk kompos/pupuk organik', benefit: 'Pupuk gratis/murah + Voucher Karbon' },
  ];
  return (
    <section className="py-20 lg:py-28" style={{ backgroundColor: '#152e1c' }}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10">
        <div className="text-center mb-14">
          <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788' }}>Untuk Siapa?</div>
          <h2 className="font-display font-bold mx-auto" style={{ color: '#f5f2e8', fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)', maxWidth: '520px', lineHeight: 1.3 }}>
            Eco-Loop untuk semua <span className="italic" style={{ color: '#95d5b2' }}>lapisan masyarakat</span>
          </h2>
        </div>
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
          {users.map((u) => (
            <div key={u.name} className="p-6 rounded-2xl flex flex-col gap-4 transition-all duration-200 hover:scale-[1.02]" style={{ backgroundColor: 'rgba(255,255,255,0.05)', border: '1px solid rgba(82,183,136,0.12)' }}>
              <div className="flex items-center justify-center w-14 h-14 rounded-2xl" style={{ backgroundColor: 'rgba(82,183,136,0.08)', color: '#52b788' }} aria-hidden="true">
                {renderIcon(u.icon, { size: 26, color: '#52b788' })}
              </div>
              <div>
                <div className="font-semibold mb-1" style={{ color: '#f5f2e8', letterSpacing: '0.02em', lineHeight: 1.4 }}>{u.name}</div>
                <div className="text-xs" style={{ color: '#52b788', letterSpacing: '0.06em', lineHeight: 1.5 }}>{u.age}</div>
              </div>
              <div className="flex-1">
                <div className="text-xs font-medium mb-1.5" style={{ color: 'rgba(245,242,232,0.4)', letterSpacing: '0.04em' }}>Kebutuhan</div>
                <div className="text-sm" style={{ color: 'rgba(245,242,232,0.65)', letterSpacing: '0.01em', lineHeight: 1.65 }}>{u.need}</div>
              </div>
              <div className="pt-4 border-t text-sm" style={{ borderColor: 'rgba(82,183,136,0.15)', color: '#95d5b2', letterSpacing: '0.01em', lineHeight: 1.6 }}>✓ {u.benefit}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

// Features Section
const FeaturesSection = () => {
  const feats = [
    { icon: 'home', title: 'Beranda Hijau', desc: 'Total karbon dihemat komunitas & produk terbaru tampil real-time.', to: '/' },
    { icon: 'bag', title: 'Katalog Produk', desc: 'Filter berdasarkan kategori, lokasi, dan info penghematan karbon per produk.', to: '/products' },
    { icon: 'chart', title: 'Kalkulator Karbon', desc: 'Masukkan berat barang — sistem menghitung otomatis berapa kg CO₂ dikurangi.', to: '/products' },
    { icon: 'chart', title: 'Dasbor Pengguna', desc: 'Riwayat jual-beli, total karbon dihemat, dan koleksi Voucher Karbon kamu.', to: '/dashboard' },
    { icon: 'trophy', title: 'Papan Peringkat', desc: 'Pengguna paling banyak kurangi karbon tampil di leaderboard wilayah.', to: '/leaderboard' },
    { icon: 'bell', title: 'Notifikasi Cerdas', desc: 'Pengingat pesanan baru, voucher hampir kadaluarsa, dan tips daur ulang.', to: '/dashboard' },
  ];
  return (
    <section id="fitur" className="py-20 lg:py-28" style={{ backgroundColor: '#f5f2e8' }}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10">
        <div className="text-center mb-14">
          <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788', ...sectionLabelStyle }}>10 Fitur Utama</div>
          <h2 className="font-display font-bold" style={{ color: '#1f4d2e', fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)', letterSpacing: '-0.02em', lineHeight: 1.25 }}>
            Platform lengkap untuk <span className="italic">ekonomi sirkular</span>
          </h2>
        </div>
        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {feats.map((f) => (
            <a href={f.to} key={f.title} className="p-6 rounded-2xl transition-all duration-200 hover:-translate-y-1 hover:shadow-lg group block" style={{ backgroundColor: '#fff', boxShadow: '0 1px 12px rgba(31,77,46,0.06)' }}>
              <div className="inline-flex items-center justify-center w-12 h-12 rounded-xl mb-4" style={{ backgroundColor: '#e8f5ec', color: '#1f4d2e' }} aria-hidden="true">
                {renderIcon(f.icon, { size: 24, color: '#1f4d2e' })}
              </div>
              <div className="font-semibold mb-2" style={{ color: '#1f4d2e', letterSpacing: '0.02em', lineHeight: 1.4 }}>{f.title}</div>
              <div className="text-sm" style={{ color: '#7a8c72', letterSpacing: '0.01em', lineHeight: 1.65 }}>{f.desc}</div>
            </a>
          ))}
        </div>
      </div>
    </section>
  );
};

// Leaderboard Preview Section
const LeaderboardPreviewSection = () => {
  const leaders = [
    { rank: 1, name: 'Sari Dewi', loc: 'Bandung', pts: 8420, badge: 'trophy' },
    { rank: 2, name: 'Budi Santoso', loc: 'Surabaya', pts: 7150, badge: 'leaf' },
    { rank: 3, name: 'Ratna Wulandari', loc: 'Jakarta Sel.', pts: 6830, badge: 'bag' },
    { rank: 4, name: 'Agus Firmansyah', loc: 'Yogyakarta', pts: 5640, badge: '' },
    { rank: 5, name: 'Fitri Handayani', loc: 'Medan', pts: 4920, badge: '' },
  ];
  return (
    <section className="py-20 lg:py-28" style={{ background: 'linear-gradient(135deg, #1f4d2e 0%, #152e1c 100%)' }}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          <div>
            <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788', ...sectionLabelStyle }}>Papan Peringkat</div>
            <h2 className="font-display font-bold mb-6" style={{ color: '#f5f2e8', fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)', letterSpacing: '-0.02em', lineHeight: 1.25 }}>
              Jadilah <span className="italic" style={{ color: '#95d5b2' }}>Pahlawan Hijau</span> wilayahmu
            </h2>
            <p className="mb-8" style={{ color: 'rgba(245,242,232,0.6)', fontSize: '1.05rem', letterSpacing: '0.01em', lineHeight: 1.75 }}>
              Kompetisi sehat untuk bumi yang lebih sehat. Pengguna yang paling banyak mengurangi karbon mendapat lencana kehormatan.
            </p>
            <a href="/leaderboard" className="inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-sm transition-all duration-200 hover:brightness-110" style={{ backgroundColor: '#52b788', color: '#152e1c', letterSpacing: '0.05em' }}>
              Lihat Peringkat Lengkap →
            </a>
          </div>
          <div className="rounded-3xl overflow-hidden" style={{ backgroundColor: 'rgba(255,255,255,0.05)', border: '1px solid rgba(82,183,136,0.15)' }}>
            <div className="px-6 py-4 flex items-center justify-between" style={{ borderBottom: '1px solid rgba(82,183,136,0.1)', letterSpacing: '0.04em' }}>
              <span className="font-semibold text-sm" style={{ color: '#f5f2e8', lineHeight: 1.5 }}>Top Kontributor — Agustus 2026</span>
              <span className="text-xs px-2 py-1 rounded-full" style={{ backgroundColor: 'rgba(82,183,136,0.15)', color: '#52b788', letterSpacing: '0.12em' }}>Live</span>
            </div>
            <div>
              {leaders.map((l) => (
                <div key={l.rank} className="px-6 py-5 flex items-center gap-5" style={{ borderBottom: '1px solid rgba(82,183,136,0.06)' }}>
                  <div className="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0" style={{ backgroundColor: l.rank <= 3 ? '#52b788' : 'rgba(255,255,255,0.08)', color: l.rank <= 3 ? '#152e1c' : 'rgba(245,242,232,0.5)' }}>
                    {l.badge ? renderIcon(l.badge, { size: 14, color: l.rank <= 3 ? '#152e1c' : 'rgba(245,242,232,0.5)' }) : l.rank}
                  </div>
                  <div className="flex-1 min-w-0">
                    <div className="font-medium text-sm mb-0.5" style={{ color: '#f5f2e8', letterSpacing: '0.02em', lineHeight: 1.4 }}>{l.name}</div>
                    <div className="text-xs" style={{ color: 'rgba(245,242,232,0.45)', letterSpacing: '0.06em', lineHeight: 1.4 }}>{l.loc}</div>
                  </div>
                  <div className="font-display font-bold text-sm flex-shrink-0" style={{ color: '#52b788', letterSpacing: '0.02em' }}>
                    {l.pts.toLocaleString('id-ID')} <span className="font-sans font-normal text-xs" style={{ color: 'rgba(82,183,136,0.6)', letterSpacing: '0.04em' }}>pts</span>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export { TargetUsersSection, FeaturesSection, LeaderboardPreviewSection };


// CTA Section
const CTASection = () => {
  return (
    <section className="py-20 lg:py-28" style={{ backgroundColor: '#f5f2e8' }}>
      <div className="max-w-4xl mx-auto px-6 lg:px-10 text-center">
        <div className="relative rounded-3xl px-8 py-16 lg:py-20 overflow-hidden" style={{ backgroundColor: '#1f4d2e' }}>
          <div className="absolute -top-16 -right-16 w-64 h-64 rounded-full opacity-10" style={{ backgroundColor: '#52b788' }} />
          <div className="absolute -bottom-12 -left-12 w-48 h-48 rounded-full opacity-10" style={{ backgroundColor: '#95d5b2' }} />
          <div className="relative">
            <div className="inline-flex items-center justify-center w-16 h-16 rounded-full mb-5" style={{ backgroundColor: 'rgba(82,183,136,0.12)', color: '#95d5b2' }} aria-hidden="true">
              {renderIcon('leaf', { size: 30, color: '#95d5b2' })}
            </div>
            <h2 className="font-display font-bold mb-5" style={{ color: '#f5f2e8', fontSize: 'clamp(1.8rem, 3.5vw, 2.6rem)', letterSpacing: '-0.02em', lineHeight: 1.3 }}>
              Bergabunglah dan mulai <span className="italic" style={{ color: '#95d5b2' }}>ubah sampahmu</span> jadi nilai
            </h2>
            <p className="mb-10 text-lg mx-auto" style={{ color: 'rgba(245,242,232,0.6)', maxWidth: '480px', letterSpacing: '0.01em', lineHeight: 1.75 }}>
              Daftar gratis sekarang. Setiap transaksi pertama kamu sudah membantu mengurangi jejak karbon Indonesia.
            </p>
            <div className="flex flex-wrap justify-center gap-4">
              <a href="/register" className="px-8 py-4 rounded-full font-semibold text-sm transition-all duration-200 hover:brightness-110 hover:scale-105" style={{ backgroundColor: '#52b788', color: '#152e1c' }}>
                Daftar Gratis Sekarang
              </a>
              <a href="/products" className="px-8 py-4 rounded-full font-medium text-sm border transition-all duration-200 hover:bg-white/5" style={{ borderColor: 'rgba(245,242,232,0.25)', color: '#f5f2e8' }}>
                Lihat Katalog
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

// Footer Section
const FooterSection = () => {
  return (
    <footer style={{ backgroundColor: '#152e1c', borderTop: '1px solid rgba(82,183,136,0.1)' }}>
      <div className="max-w-7xl mx-auto px-6 lg:px-10 py-14">
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
          <div>
            <div className="flex items-center gap-2.5 mb-4">
              <div className="w-8 h-8 rounded-full flex items-center justify-center" style={{ backgroundColor: '#52b788' }}>
                <svg viewBox="0 0 24 24" className="w-5 h-5 fill-white"><path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 5.25-8 5.25S14.36 11.34 13 12.5A3.77 3.77 0 017.5 13.5c.66-2.32 2.48-4.56 6.5-5.5z" /></svg>
              </div>
              <span className="font-display font-semibold text-lg" style={{ color: '#f5f2e8' }}>Eco-Loop</span>
            </div>
            <p className="text-sm" style={{ color: 'rgba(245,242,232,0.45)', lineHeight: 1.7 }}>Platform jual-beli untuk mengurangi jejak karbon Indonesia. Innoventure Chapter II 2026.</p>
          </div>
          <div>
            <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788' }}>Platform</div>
            <ul className="flex flex-col gap-3">
              {['Katalog Produk', 'Kalkulator Karbon', 'Eco-Shop Hadiah', 'Dasbor Saya'].map((link) => (
                <li key={link}><a href="/products" className="text-sm transition-colors hover:opacity-80" style={{ color: 'rgba(245,242,232,0.5)', lineHeight: 1.5 }}>{link}</a></li>
              ))}
            </ul>
          </div>
          <div>
            <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788' }}>Komunitas</div>
            <ul className="flex flex-col gap-3">
              {['Papan Peringkat', 'Lencana Kehormatan', 'Notifikasi', 'Keranjang'].map((link) => (
                <li key={link}><a href="/leaderboard" className="text-sm transition-colors hover:opacity-80" style={{ color: 'rgba(245,242,232,0.5)', lineHeight: 1.5 }}>{link}</a></li>
              ))}
            </ul>
          </div>
          <div>
            <div className="text-xs font-semibold tracking-widest uppercase mb-5" style={{ color: '#52b788' }}>Tim</div>
            <ul className="flex flex-col gap-3">
              {['Tim Hanchou Sanchou', 'Innoventure 2026', 'Panel Admin', 'Masuk / Daftar'].map((link) => (
                <li key={link}><a href={link.includes('Daftar') ? '/register' : '#'} className="text-sm transition-colors hover:opacity-80" style={{ color: 'rgba(245,242,232,0.5)', lineHeight: 1.5 }}>{link}</a></li>
              ))}
            </ul>
          </div>
        </div>
        <div className="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4" style={{ borderTop: '1px solid rgba(82,183,136,0.1)' }}>
          <div className="text-xs" style={{ color: 'rgba(245,242,232,0.3)', lineHeight: 1.6 }}>© 2026 Eco-Loop Marketplace · Tim Hanchou Sanchou · Kompetisi Web Development SMA/SMK</div>
          <div className="inline-flex items-center gap-2 text-xs" style={{ color: 'rgba(245,242,232,0.3)', lineHeight: 1.6 }}>
            <span aria-hidden="true">{renderIcon('leaf', { size: 12, color: 'rgba(245,242,232,0.3)' })}</span>
            <span>Dibuat untuk bumi yang lebih hijau</span>
          </div>
        </div>
      </div>
    </footer>
  );
};

// Main LandingPage Component
const LandingPage = () => {
  return (
    <>
      <Navbar />
      <HeroSection />
      <StatsSection />
      <HowItWorksSection />
      <CategoriesSection />
      <VoucherFeatureSection />
      <TargetUsersSection />
      <FeaturesSection />
      <LeaderboardPreviewSection />
      <CTASection />
      <FooterSection />
    </>
  );
};

export default LandingPage;