import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
document.querySelectorAll('[data-auto-dismiss]').forEach((el) => setTimeout(() => el.remove(), 4500));
document.querySelectorAll('[data-confirm]').forEach((el) => el.addEventListener('click', (e) => { if (!confirm(el.dataset.confirm)) e.preventDefault(); }));
document.querySelectorAll('[data-add-row]').forEach((button) => button.addEventListener('click', () => {
    const type = button.dataset.addRow;
    const target = document.getElementById(`${type}-rows`);
    const template = document.getElementById(`${type}-template`);
    if (!target || !template) return;
    const index = target.querySelectorAll('[data-row]').length;
    const row = template.content.cloneNode(true);
    row.querySelectorAll('[data-name]').forEach((input) => {
        input.name = `${type === 'jsa' ? 'steps' : 'items'}[${index}][${input.dataset.name}]`;
        if (!['controls', 'existing_control', 'recommended_action'].includes(input.dataset.name)) input.required = true;
    });
    target.appendChild(row);
}));
