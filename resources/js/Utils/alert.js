import Swal from 'sweetalert2';
import { usePage } from '@inertiajs/vue3';

export function flashToast() {
    const flash = usePage().props.flash;
    console.log(flash)

    // Check for success message
    if (flash.success) {
        showToast('success', flash.success);
    }

    // Check for error message
    if (flash.error) {
        showToast('error', flash.error);
    }

    // Check for warning message
    if (flash.warning) {
        showToast('warning', flash.warning);
    }

    // Check for info message
    if (flash.info) {
        showToast('info', flash.info);
    }
}

function showToast(type, message) {
    const iconMap = {
        'success': 'success',
        'error': 'error',
        'warning': 'warning',
        'info': 'info'
    };

    Swal.fire({
        icon: iconMap[type] || 'info',
        title: getDefaultTitle(type),
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
}

function getDefaultTitle(type) {
    const titles = {
        'success': 'Success!',
        'error': 'Error!',
        'warning': 'Warning!',
        'info': 'Info'
    };
    return titles[type] || 'Notification';
}
