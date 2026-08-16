import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
document.querySelectorAll('[data-auto-dismiss]').forEach((el) => setTimeout(() => el.remove(), 4500));
document.querySelectorAll('[data-confirm]').forEach((el) => el.addEventListener('click', (e) => { if (!confirm(el.dataset.confirm)) e.preventDefault(); }));
