import axios from 'axios';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
document.querySelectorAll('[data-auto-dismiss]').forEach((el) => setTimeout(() => el.remove(), 4500));
document.querySelectorAll('[data-confirm]').forEach((el) => el.addEventListener('click', (e) => { if (!confirm(el.dataset.confirm)) e.preventDefault(); }));

const confirmationModal = document.getElementById('action-confirmation-modal');
const confirmationTitle = document.getElementById('action-confirmation-title');
const confirmationMessage = document.getElementById('action-confirmation-message');
const confirmationCancel = document.getElementById('action-confirmation-cancel');
const confirmationSubmit = document.getElementById('action-confirmation-submit');
let pendingConfirmationForm = null;

function closeConfirmationModal() {
    if (!confirmationModal) return;
    confirmationModal.classList.add('hidden');
    confirmationModal.classList.remove('flex');
    confirmationModal.setAttribute('aria-hidden', 'true');
    pendingConfirmationForm = null;
}

function openConfirmationModal(form) {
    if (!confirmationModal) return;
    const method = form.querySelector('input[name="_method"]')?.value;
    const isDelete = method === 'DELETE';
    const isToggle = form.action.includes('/toggle');
    pendingConfirmationForm = form;
    confirmationTitle.textContent = isDelete ? 'حذف مورد' : 'تغییر وضعیت';
    confirmationMessage.textContent = isDelete
        ? 'آیا از حذف این مورد مطمئن هستید؟ این عملیات قابل بازگشت نیست.'
        : 'آیا از تغییر وضعیت این مورد مطمئن هستید؟';
    confirmationSubmit.textContent = isDelete ? 'بله، حذف کن' : 'بله، ادامه بده';
    confirmationModal.classList.remove('hidden');
    confirmationModal.classList.add('flex');
    confirmationModal.setAttribute('aria-hidden', 'false');
    confirmationSubmit.focus();
}

document.querySelectorAll('form').forEach((form) => {
    if (!form.action.includes('/checklists/')) return;
    const method = form.querySelector('input[name="_method"]')?.value;
    if (!['PATCH', 'DELETE'].includes(method)) return;
    form.removeAttribute('onsubmit');
    form.addEventListener('submit', (event) => {
        if (pendingConfirmationForm === form) return;
        event.preventDefault();
        openConfirmationModal(form);
    });
});

confirmationCancel?.addEventListener('click', closeConfirmationModal);
confirmationSubmit?.addEventListener('click', () => {
    const form = pendingConfirmationForm;
    closeConfirmationModal();
    form?.submit();
});
confirmationModal?.addEventListener('click', (event) => {
    if (event.target === confirmationModal) closeConfirmationModal();
});
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && confirmationModal?.getAttribute('aria-hidden') === 'false') {
        closeConfirmationModal();
    }
});

const updateScoreOutputs = (row) => {
    if (row.dataset.scoreRow === 'fmea') {
        const values = ['severity', 'occurrence', 'detection'].map((name) => Number(row.querySelector(`[name$="[${name}]"]`)?.value || 0));
        const output = row.querySelector('[data-rpn-output]');
        if (output) output.value = values.reduce((score, value) => score * value, 1);
    }
    if (row.dataset.scoreRow === 'jsa') {
        const score = (likelihood, severity) => Number(row.querySelector(`[name$="[${likelihood}]"]`)?.value || 0) * Number(row.querySelector(`[name$="[${severity}]"]`)?.value || 0);
        const riskOutput = row.querySelector('[data-risk-score-output]');
        const residualOutput = row.querySelector('[data-residual-score-output]');
        if (riskOutput) riskOutput.value = score('likelihood', 'severity');
        if (residualOutput) residualOutput.value = score('residual_likelihood', 'residual_severity');
    }
};

document.querySelectorAll('[data-score-row]').forEach(updateScoreOutputs);
document.addEventListener('input', (event) => {
    const row = event.target.closest('[data-score-row]');
    if (row) updateScoreOutputs(row);
});

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
    updateScoreOutputs(target.lastElementChild);
}));

document.querySelectorAll('[data-chart]').forEach((canvas) => {
    const config = JSON.parse(canvas.dataset.chart);
    new Chart(canvas, config);
});
