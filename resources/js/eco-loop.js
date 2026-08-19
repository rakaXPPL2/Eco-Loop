// EcoLoop Custom JavaScript
import Swal from 'sweetalert2';

// Configure SweetAlert2 defaults
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    background: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
    color: '#ffffff',
    iconColor: '#ffffff',
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

const ConfirmDialog = Swal.mixin({
    confirmButtonText: '<i class="fas fa-check mr-1"></i> Ya',
    cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
    confirmButtonColor: '#10b981',
    cancelButtonColor: '#6b7280',
    showCancelButton: true,
    reverseButtons: true,
    allowOutsideClick: false
});

// Success Toast
window.toastSuccess = function(message) {
    Toast.fire({
        icon: 'success',
        title: message,
        background: 'linear-gradient(135deg, #10b981 0%, #059669 100%)'
    });
};

// Error Toast
window.toastError = function(message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: message,
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        background: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
        color: '#ffffff',
        iconColor: '#ffffff'
    });
};

// Info Toast
window.toastInfo = function(message) {
    Toast.fire({
        icon: 'info',
        title: message,
        background: 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)'
    });
};

// Warning Toast
window.toastWarning = function(message) {
    Toast.fire({
        icon: 'warning',
        title: message,
        background: 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)'
    });
};

// Confirm Dialog
window.confirmAction = async function(options) {
    const result = await ConfirmDialog.fire({
        title: options.title || 'Konfirmasi',
        text: options.text || 'Apakah Anda yakin?',
        icon: options.icon || 'question',
        showCancelButton: true,
        reverseButtons: true
    });
    return result.isConfirmed;
};

// Delete Confirmation
window.confirmDelete = async function(itemName = 'item ini') {
    const result = await Swal.fire({
        title: '<i class="fas fa-trash-alt text-red-500"></i> Hapus?',
        html: `Apakah Anda yakin ingin menghapus <strong>${itemName}</strong>?<br><span class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan.</span>`,
        icon: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Hapus',
        cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        background: '#ffffff',
        customClass: {
            popup: 'rounded-xl shadow-2xl',
            confirmButton: 'rounded-lg px-4 py-2',
            cancelButton: 'rounded-lg px-4 py-2'
        }
    });
    return result.isConfirmed;
};

// Success Alert
window.alertSuccess = async function(title, message) {
    await Swal.fire({
        icon: 'success',
        title: title || 'Berhasil!',
        html: message || '',
        confirmButtonText: '<i class="fas fa-check mr-1"></i> OK',
        confirmButtonColor: '#10b981',
        background: '#ffffff',
        customClass: {
            popup: 'rounded-xl shadow-2xl',
            confirmButton: 'rounded-lg px-6 py-2 bg-emerald-500 hover:bg-emerald-600'
        }
    });
};

// Error Alert
window.alertError = async function(title, message) {
    await Swal.fire({
        icon: 'error',
        title: title || 'Terjadi Kesalahan',
        html: message || '',
        confirmButtonText: '<i class="fas fa-times mr-1"></i> Tutup',
        confirmButtonColor: '#ef4444',
        background: '#ffffff',
        customClass: {
            popup: 'rounded-xl shadow-2xl',
            confirmButton: 'rounded-lg px-6 py-2'
        }
    });
};

// Show loading
window.showLoading = function(message = 'Memuat...') {
    Swal.fire({
        title: message,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
};

// Hide loading
window.hideLoading = function() {
    Swal.close();
};

// Flash message handler (called on page load)
document.addEventListener('DOMContentLoaded', function() {
    // Handle flash messages from data attributes
    const successMsg = document.body.dataset.success || document.querySelector('[data-flash-success]')?.dataset.flashSuccess;
    const errorMsg = document.body.dataset.error || document.querySelector('[data-flash-error]')?.dataset.flashError;

    if (successMsg) toastSuccess(successMsg);
    if (errorMsg) toastError(errorMsg);
});

// Add to cart animation
window.animateAddToCart = function(button) {
    if (!button) return;
    button.classList.add('scale-110');
    const icon = button.querySelector('i');
    if (icon) {
        icon.classList.add('fa-bounce');
    }
    setTimeout(() => {
        button.classList.remove('scale-110');
        if (icon) {
            icon.classList.remove('fa-bounce');
        }
    }, 500);
};

// Smooth scroll to element
window.scrollToElement = function(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

// Animate on scroll (Intersection Observer)
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.animate-on-scroll');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    elements.forEach(el => observer.observe(el));
};

document.addEventListener('DOMContentLoaded', animateOnScroll);

// Scroll reveal animation
const revealElements = document.querySelectorAll('.reveal');

const revealOnScroll = () => {
    revealElements.forEach(el => {
        const elementTop = el.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (elementTop < windowHeight - 100) {
            el.classList.add('visible');
        }
    });
};

window.addEventListener('scroll', revealOnScroll);
window.addEventListener('load', revealOnScroll);
