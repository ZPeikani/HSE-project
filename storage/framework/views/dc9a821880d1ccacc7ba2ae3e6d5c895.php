


<div id="ai-overlay"></div>


<div id="ai-alert" style="display:none">
    <div id="ai-alert-box">
        <div id="ai-alert-header">
            <span id="ai-alert-title"></span>
            <button id="ai-alert-close">✕</button>
        </div>
        <pre id="ai-alert-body"></pre>
    </div>
</div>


<div id="ai-modal-backdrop" style="display:none">
    <div id="ai-modal">
        <div id="ai-modal-title"></div>
        <div id="ai-modal-body"></div>
        <div id="ai-modal-actions">
            <button id="ai-modal-cancel" class="ai-modal-btn-secondary">انصراف</button>
            <button id="ai-modal-confirm" class="ai-modal-btn-primary">تأیید</button>
        </div>
    </div>
</div>


<button id="ai-toggle-btn" title="دستیار هوش مصنوعی HSE" aria-label="باز کردن دستیار هوش مصنوعی">
    <svg viewBox="0 0 22 22" fill="currentColor">
        <path d="M8 1L9.5 6.5L15 8L9.5 9.5L8 15L6.5 9.5L1 8L6.5 6.5L8 1Z"/>
        <path d="M17 12L18 15L21 16L18 17L17 20L16 17L13 16L16 15L17 12Z"/>
    </svg>
</button>


<div id="ai-panel" aria-hidden="true">

    
    <div id="ai-panel-header">
        <div id="ai-header-info">
            <div id="ai-avatar">
                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 2.5L10.09 6.41L14 7.5L10.09 8.59L9 12.5L7.91 8.59L4 7.5L7.91 6.41L9 2.5Z"/>
                    <path d="M17.5 11L18.27 13.23L20.5 14L18.27 14.77L17.5 17L16.73 14.77L14.5 14L16.73 13.23L17.5 11Z"/>
                </svg>
            </div>
            <div>
                <div id="ai-header-title">دستیار هوش مصنوعی</div>
                <div id="ai-header-status">
                    <span id="ai-status-dot"></span>
                    <span id="ai-msg-counter">آنلاین — HSE Expert</span>
                </div>
            </div>
        </div>
        <div id="ai-header-actions">
            <button id="ai-sidebar-toggle-btn" title="تاریخچه مکالمات">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h10"/>
                </svg>
            </button>
            <button id="ai-sidebar-new-btn" title="مکالمه جدید">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </button>
            <button id="ai-delete-all-btn" title="حذف همه مکالمات">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
            <button id="ai-close-btn" title="بستن">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    
    <div id="ai-sidebar">
        <div id="ai-sidebar-header">
            <span id="ai-sidebar-title">تاریخچه مکالمات</span>
            <button id="ai-sidebar-close-btn" title="بستن">✕</button>
        </div>
        <div id="ai-conv-list"></div>
    </div>

    
    <div id="ai-messages">
        <div class="ai-welcome">
            <div class="ai-welcome-icon">
                <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                    <path d="M9 2.5L10.09 6.41L14 7.5L10.09 8.59L9 12.5L7.91 8.59L4 7.5L7.91 6.41L9 2.5Z"/>
                    <path d="M17.5 11L18.27 13.23L20.5 14L18.27 14.77L17.5 17L16.73 14.77L14.5 14L16.73 13.23L17.5 11Z"/>
                </svg>
            </div>
            <div class="ai-welcome-title">دستیار هوش مصنوعی HSE</div>
            <div class="ai-welcome-subtitle">می‌توانم در ایمنی، بهداشت، ریسک‌ها، بازرسی‌ها و حوادث کمک کنم.</div>
        </div>
        <div id="ai-suggestions">
            <button class="ai-suggestion" data-text="چگونه یک گزارش حادثه ایمنی بنویسم؟">گزارش حادثه</button>
            <button class="ai-suggestion" data-text="مراحل ارزیابی ریسک در HSE چیست؟">ارزیابی ریسک</button>
            <button class="ai-suggestion" data-text="چک‌لیست بازرسی ایمنی محیط کار را بنویس">چک‌لیست بازرسی</button>
            <button class="ai-suggestion" data-text="قوانین حفاظت فردی (PPE) در محیط کار">تجهیزات PPE</button>
        </div>
    </div>

    
    <div id="ai-input-area">
        <textarea id="ai-input" placeholder="سوال بپرسید." rows="1" maxlength="2000"></textarea>
        <button id="ai-send-btn" title="ارسال" disabled>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="18" height="18">
                <path stroke-linecap="round" stroke-linejoin="round" d="M22 2L11 13M22 2L15 22l-4-9-9-4 19-7z"/>
            </svg>
        </button>
    </div>
</div>

<style>
/* ── Reset & Base ───────────────────────────────────────────── */
#ai-panel, #ai-toggle-btn, #ai-overlay, #ai-alert, #ai-modal-backdrop {
    font-family: YekanBakh, Tahoma, sans-serif;
    direction: rtl;
    box-sizing: border-box;
}
#ai-panel *, #ai-modal-backdrop * { box-sizing: border-box; }

/* ── Error Alert ──────────────────────────────────────────── */
#ai-alert {
    position: fixed; top:0; left:0; right:0; z-index:9999;
    padding:12px 16px;
    background:#fef2f2; border-bottom:2px solid #fca5a5;
    box-shadow:0 4px 16px rgba(0,0,0,0.1);
    animation:ai-alert-in 0.2s ease;
}
@keyframes ai-alert-in { from{transform:translateY(-100%);opacity:0} to{transform:translateY(0);opacity:1} }
#ai-alert-box { max-width:900px; margin:0 auto; }
#ai-alert-header { display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:6px; }
#ai-alert-title { font-size:13.5px; font-weight:700; color:#b91c1c; }
#ai-alert-close { background:none; border:none; cursor:pointer; color:#b91c1c; font-size:16px; padding:2px 6px; border-radius:4px; }
#ai-alert-close:hover { background:#fee2e2; }
#ai-alert-body { font-size:12px; color:#7f1d1d; background:#fee2e2; border:1px solid #fca5a5; border-radius:8px; padding:8px 12px; margin:0; white-space:pre-wrap; word-break:break-all; direction:ltr; text-align:left; max-height:200px; overflow-y:auto; font-family:monospace; }

/* ── Modal ────────────────────────────────────────────────── */
#ai-modal-backdrop {
    position:fixed; inset:0; z-index:9990;
    background:rgba(0,0,0,0.5);
    display:flex; align-items:center; justify-content:center;
    padding:16px;
}
#ai-modal {
    background:#fff; border-radius:16px; padding:24px;
    max-width:400px; width:100%;
    box-shadow:0 20px 60px rgba(0,0,0,0.25);
    direction:rtl;
}
#ai-modal-title {
    font-size:15px; font-weight:700; color:#1e293b;
    margin-bottom:12px;
}
#ai-modal-body {
    font-size:13.5px; color:#475569; line-height:1.7;
    margin-bottom:20px; white-space:pre-line;
}
#ai-modal-actions { display:flex; gap:8px; justify-content:flex-end; }
.ai-modal-btn-primary {
    background:#10b981; color:#fff; border:none; border-radius:10px;
    padding:9px 20px; font-size:13px; font-family:inherit;
    cursor:pointer; transition:background 0.15s;
}
.ai-modal-btn-primary:hover { background:#059669; }
.ai-modal-btn-secondary {
    background:#f1f5f9; color:#475569; border:none; border-radius:10px;
    padding:9px 20px; font-size:13px; font-family:inherit;
    cursor:pointer; transition:background 0.15s;
}
.ai-modal-btn-secondary:hover { background:#e2e8f0; }
.ai-modal-btn-danger {
    background:#ef4444 !important;
}
.ai-modal-btn-danger:hover { background:#dc2626 !important; }

/* ── Action Confirm Card ──────────────────────────────────── */
.ai-action-card {
    background:#f0fdf4; border:1.5px solid #86efac;
    border-radius:14px; padding:14px 16px; margin-top:8px;
    font-size:13px;
}
.ai-action-card-title {
    font-size:12px; font-weight:700; color:#166534;
    margin-bottom:8px; display:flex; align-items:center; gap:6px;
}
.ai-action-card-rows { display:grid; gap:4px; margin-bottom:12px; }
.ai-action-card-row { display:flex; gap:6px; font-size:12.5px; }
.ai-action-card-label { color:#6b7280; min-width:90px; flex-shrink:0; }
.ai-action-card-val { color:#1e293b; font-weight:600; }
.ai-action-card-btns { display:flex; gap:8px; }
.ai-action-confirm-btn {
    flex:1; padding:7px 12px; border-radius:8px; border:none;
    font-size:12.5px; font-family:inherit; cursor:pointer;
    transition:background 0.15s;
}
.ai-action-confirm-btn.primary { background:#10b981; color:#fff; }
.ai-action-confirm-btn.primary:hover { background:#059669; }
.ai-action-confirm-btn.secondary { background:#f1f5f9; color:#64748b; }
.ai-action-confirm-btn.secondary:hover { background:#e2e8f0; }

/* ── Float Button ─────────────────────────────────────────── */
#ai-toggle-btn {
    position:fixed; bottom:86px; left:18px; z-index:1200;
    width:56px; height:56px; border-radius:50%;
    background:linear-gradient(135deg,#10b981 0%,#0d9488 100%);
    border:none; cursor:pointer;
    display:flex; align-items:center; justify-content:center;
    box-shadow:0 4px 18px rgba(16,185,129,0.5),0 2px 8px rgba(0,0,0,0.14);
    transition:transform 0.2s,box-shadow 0.2s; color:#fff;
}
@media(min-width:1024px){#ai-toggle-btn{bottom:32px;left:32px;}}
#ai-toggle-btn:hover { transform:scale(1.1); box-shadow:0 6px 26px rgba(16,185,129,0.6),0 3px 12px rgba(0,0,0,0.18); }
#ai-toggle-btn svg { width:24px; height:24px; }
@keyframes ai-pulse-ring { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.4);opacity:0.65} }

/* ── Overlay ──────────────────────────────────────────────── */
#ai-overlay {
    display:none; position:fixed; inset:0; z-index:1099;
    background:rgba(0,0,0,0.45); opacity:0; transition:opacity 0.28s;
}
#ai-overlay.ai-open { opacity:1; }

/* ── Main Panel ───────────────────────────────────────────── */
#ai-panel {
    position:fixed; top:0; left:0; z-index:1100;
    width:380px; height:100vh; height:100dvh;
    display:flex; flex-direction:column;
    background:#fff;
    transform:translateX(-100%);
    transition:transform 0.3s cubic-bezier(0.4,0,0.2,1);
    overflow:hidden;
    box-shadow:6px 0 40px rgba(0,0,0,0.15);
}
#ai-panel.ai-open { transform:translateX(0); }
@media(min-width:1024px){ body.ai-panel-open #ai-toggle-btn { display:none; } }
@media(max-width:1023px){
    #ai-panel { width:100%; }
    #ai-toggle-btn { bottom:82px; left:14px; }
}

/* ── Panel Header ─────────────────────────────────────────── */
#ai-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 16px;
    height: 64px;
    background: linear-gradient(135deg, #064e3b 0%, #065f46 60%, #047857 100%);
    color: #fff;
    flex-shrink: 0;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
#ai-header-info {
    display: flex;
    align-items: center;
    gap: 11px;
}
#ai-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(255,255,255,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
#ai-avatar svg {
    width: 20px;
    height: 20px;
    color: #fff;
}
#ai-header-title {
    font-size: 14.5px;
    font-weight: 700;
    line-height: 1.25;
}
#ai-header-status {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    opacity: 0.75;
    margin-top: 3px;
}
#ai-status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #6ee7b7;
    display: inline-block;
    animation: ai-pulse-ring 2s infinite;
}
#ai-msg-counter { font-size: 11px; }
#ai-header-actions {
    display: flex;
    gap: 4px;
}
#ai-header-actions button {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    background: rgba(255,255,255,0.1);
    border: none;
    cursor: pointer;
    color: rgba(255,255,255,0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.15s, color 0.15s;
}
#ai-header-actions button:hover {
    background: rgba(255,255,255,0.22);
    color: #fff;
}
#ai-header-actions button svg { width: 16px; height: 16px; }

/* ── History Sheet ────────────────────────────────────────── */
/* Sheet که به‌صورت absolute روی messages می‌افتد */
#ai-sidebar {
    position:absolute;
    top:60px; left:0; right:0; bottom:0;
    z-index:10;
    background:#fff;
    display:flex; flex-direction:column;
    overflow:hidden;
    /* بسته: از بالا پوشیده شده */
    transform:translateY(-100%);
    transition:transform 0.28s cubic-bezier(0.4,0,0.2,1);
    box-shadow:0 4px 24px rgba(0,0,0,0.12);
}
#ai-sidebar.sheet-open { transform:translateY(0); }

#ai-sidebar-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:13px 16px 11px;
    border-bottom:1px solid #e5e7eb;
    flex-shrink:0; background:#fff;
}
#ai-sidebar-title {
    font-size:13.5px; font-weight:700; color:#1e293b;
}
#ai-sidebar-header button {
    background:none; border:none; cursor:pointer;
    color:#64748b; display:flex; align-items:center; justify-content:center;
    padding:4px 6px; border-radius:6px; font-size:14px;
    transition:background 0.12s,color 0.12s;
}
#ai-sidebar-header button:hover { background:#f1f5f9; color:#1e293b; }
#ai-delete-all-btn { gap:4px; font-size:12px; font-family:inherit; }
#ai-sidebar-close-btn { font-size:15px; }

#ai-conv-list {
    flex:1; overflow-y:auto; padding:4px 0;
    scrollbar-width:thin; scrollbar-color:#cbd5e1 transparent;
}
#ai-conv-list::-webkit-scrollbar { width:4px; }
#ai-conv-list::-webkit-scrollbar-thumb { background:#cbd5e1; border-radius:4px; }

.ai-conv-item {
    display:flex; align-items:center; gap:10px;
    padding:10px 16px; cursor:pointer;
    transition:background 0.12s; position:relative;
    border-bottom:1px solid #f1f5f9;
}
.ai-conv-item:last-child { border-bottom:none; }
.ai-conv-item:hover { background:#f8fafc; }
.ai-conv-item.active { background:#f0fdf4; }
.ai-conv-item.active::before {
    content:''; position:absolute; right:0; top:0; bottom:0;
    width:3px; background:#10b981; border-radius:0 2px 2px 0;
}
.ai-conv-icon {
    width:32px; height:32px; border-radius:10px; flex-shrink:0;
    background:#f1f5f9;
    display:flex; align-items:center; justify-content:center;
    font-size:14px;
}
.ai-conv-item.active .ai-conv-icon { background:#dcfce7; }
.ai-conv-meta { flex:1; min-width:0; }
.ai-conv-title {
    font-size:13px; color:#1e293b; line-height:1.4;
    overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
}
.ai-conv-item.active .ai-conv-title { color:#065f46; font-weight:600; }
.ai-conv-date { font-size:11px; color:#94a3b8; margin-top:2px; }
.ai-conv-del {
    background:none; border:none; cursor:pointer;
    color:#cbd5e1; padding:4px; border-radius:5px;
    display:flex; align-items:center; flex-shrink:0;
    transition:color 0.12s, background 0.12s;
}
.ai-conv-del:hover { color:#ef4444; background:#fee2e2; }
.ai-conv-del svg { width:14px; height:14px; }
.ai-conv-list-empty {
    padding:32px 16px; text-align:center;
    font-size:13px; color:#94a3b8;
}

/* ── Messages ─────────────────────────────────────────────── */
#ai-messages {
    flex:1; overflow-y:auto; padding:20px 18px 12px;
    display:flex; flex-direction:column; gap:14px;
    background:#f8fafc;
    scrollbar-width:thin; scrollbar-color:#cbd5e1 transparent;
}
#ai-messages::-webkit-scrollbar { width:4px; }
#ai-messages::-webkit-scrollbar-thumb { background:#cbd5e1; border-radius:99px; }

/* Welcome screen */
.ai-welcome { text-align:center; padding:32px 16px 8px; }
.ai-welcome-icon {
    width:56px; height:56px; border-radius:16px; margin:0 auto 12px;
    background:linear-gradient(135deg,#064e3b,#10b981);
    display:flex; align-items:center; justify-content:center; color:#fff;
}
.ai-welcome-title { font-size:15px; font-weight:700; color:#1e293b; margin-bottom:4px; }
.ai-welcome-subtitle { font-size:12.5px; color:#64748b; line-height:1.6; }

/* Messages */
.ai-msg { display:flex; align-items:flex-end; gap:8px; animation:ai-msg-in 0.22s ease; }
@keyframes ai-msg-in { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
.ai-msg-user { justify-content:flex-start; }
.ai-msg-bot  { justify-content:flex-end; }
.ai-msg-bubble {
    max-width:82%; padding:10px 14px; border-radius:18px;
    font-size:13.5px; line-height:1.7; word-break:break-word;
}
.ai-msg-user .ai-msg-bubble { background:#10b981; color:#fff; border-bottom-right-radius:5px; }
.ai-msg-bot  .ai-msg-bubble { background:#fff; color:#1e293b; border:1px solid #e5e7eb; border-bottom-left-radius:5px; box-shadow:0 1px 4px rgba(0,0,0,0.04); }

/* Typing */
.ai-typing-dots { display:flex; gap:5px; align-items:center; padding:4px 2px; }
.ai-typing-dots span { width:7px; height:7px; border-radius:50%; background:#94a3b8; animation:ai-dot-bounce 1.2s ease-in-out infinite; }
.ai-typing-dots span:nth-child(2){animation-delay:0.18s}
.ai-typing-dots span:nth-child(3){animation-delay:0.36s}
@keyframes ai-dot-bounce { 0%,80%,100%{transform:translateY(0)} 40%{transform:translateY(-7px)} }

/* Suggestions */
#ai-suggestions { display:flex; flex-wrap:wrap; gap:8px; padding:6px 0 2px; }
.ai-suggestion {
    font-size:12px; font-family:inherit; padding:7px 13px;
    border-radius:20px; border:1px solid #d1fae5; background:#ecfdf5; color:#065f46;
    cursor:pointer; white-space:nowrap; transition:background 0.15s,border-color 0.15s;
}
.ai-suggestion:hover { background:#d1fae5; border-color:#10b981; }

/* System info bubble */
.ai-msg-system .ai-msg-bubble {
    background:#fefce8; color:#713f12; border-color:#fde68a;
    font-size:12.5px;
}

/* ── Input Area ───────────────────────────────────────────── */
#ai-input-area {
    display:flex; align-items:flex-end; gap:8px;
    padding:12px 16px; border-top:1px solid #e5e7eb;
    background:#fff; flex-shrink:0;
}
#ai-input {
    flex:1; border:1.5px solid #e2e8f0; border-radius:14px;
    padding:9px 13px; font-size:13.5px; font-family:inherit;
    resize:none; outline:none; line-height:1.55;
    max-height:130px; overflow-y:auto;
    transition:border-color 0.18s,box-shadow 0.18s;
    direction:rtl; background:#f8fafc; color:#1e293b;
}
#ai-input:focus { border-color:#10b981; background:#fff; box-shadow:0 0 0 3px rgba(16,185,129,0.12); }
#ai-input::placeholder { color:#94a3b8; }
#ai-send-btn {
    width:42px; height:42px; border-radius:13px; background:#10b981;
    border:none; cursor:pointer; color:#fff;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
    transition:background 0.15s,transform 0.15s;
}
#ai-send-btn:hover:not(:disabled) { background:#059669; transform:scale(1.06); }
#ai-send-btn:disabled { background:#e2e8f0; color:#94a3b8; cursor:not-allowed; transform:none; }
</style>

<script>
(function () {
    const CSRF          = document.querySelector('meta[name="csrf-token"]').content;
    const ENDPOINT      = '<?php echo e(route("ai.chat")); ?>';
    const ACTION_EP     = '<?php echo e(route("ai.action")); ?>';
    const CONVS_BASE    = '/ai/conversations';
    const FORCE_NEW_EP  = '/ai/conversations/force-new';

    /* ── DOM refs ───────────────────────────────────────────── */
    const panel            = document.getElementById('ai-panel');
    const overlay          = document.getElementById('ai-overlay');
    const toggleBtn        = document.getElementById('ai-toggle-btn');
    const closeBtn         = document.getElementById('ai-close-btn');
    const sidebarToggleBtn = document.getElementById('ai-sidebar-toggle-btn');
    const sidebarCloseBtn  = document.getElementById('ai-sidebar-close-btn');
    const sidebarNewBtn    = document.getElementById('ai-sidebar-new-btn');
    const deleteAllBtn     = document.getElementById('ai-delete-all-btn');
    const convList         = document.getElementById('ai-conv-list');
    const messages         = document.getElementById('ai-messages');
    const input            = document.getElementById('ai-input');
    const sendBtn          = document.getElementById('ai-send-btn');
    const suggestions      = document.getElementById('ai-suggestions');
    const msgCounter       = document.getElementById('ai-msg-counter');

    /* Error alert */
    const alertEl    = document.getElementById('ai-alert');
    const alertTitle = document.getElementById('ai-alert-title');
    const alertBody  = document.getElementById('ai-alert-body');
    document.getElementById('ai-alert-close').addEventListener('click', () => { alertEl.style.display = 'none'; });

    /* Modal */
    const modalBackdrop = document.getElementById('ai-modal-backdrop');
    const modalTitle    = document.getElementById('ai-modal-title');
    const modalBody     = document.getElementById('ai-modal-body');
    const modalConfirm  = document.getElementById('ai-modal-confirm');
    const modalCancel   = document.getElementById('ai-modal-cancel');
    let modalResolve    = null;

    /* ── State ──────────────────────────────────────────────── */
    let currentConvId   = null;
    let currentMsgCount = 0;
    let maxMsgs         = 100;
    let maxConvs        = 50;
    let isOpen          = false;
    let loading         = false;

    /* ── Helpers ────────────────────────────────────────────── */
    function fetchJson(url, opts = {}) {
        const headers = { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF, ...(opts.headers || {}) };
        return fetch(url, { ...opts, headers }).then(r => r.json());
    }
    function escapeHtml(s) {
        return String(s)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
            .replace(/"/g,'&quot;').replace(/'/g,'&#39;');
    }
    function formatMarkdown(text) {
        return escapeHtml(text)
            .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.+?)\*/g, '<em>$1</em>')
            .replace(/`([^`]+)`/g, '<code style="background:#f1f5f9;padding:1px 5px;border-radius:4px;font-family:monospace;font-size:12px">$1</code>')
            .replace(/^[•\-]\s+(.+)$/gm, '<li>$1</li>')
            .replace(/(<li>[\s\S]+?<\/li>)/g, '<ul style="margin:.4em 0 .4em 1.4em;padding:0;list-style:disc">$1</ul>')
            .replace(/\n/g, '<br>');
    }
    function scrollBottom() { messages.scrollTop = messages.scrollHeight; }

    function appendUser(text) {
        removeSuggestions();
        const div = document.createElement('div');
        div.className = 'ai-msg ai-msg-user';
        div.innerHTML = `<div class="ai-msg-bubble">${escapeHtml(text)}</div>`;
        messages.appendChild(div);
        scrollBottom();
    }
    function appendBot(html, isSystem = false) {
        const div = document.createElement('div');
        div.className = 'ai-msg ai-msg-bot' + (isSystem ? ' ai-msg-system' : '');
        div.innerHTML = `<div class="ai-msg-bubble">${html}</div>`;
        messages.appendChild(div);
        scrollBottom();
        return div;
    }
    function showTyping() {
        const div = document.createElement('div');
        div.className = 'ai-msg ai-msg-bot'; div.id = 'ai-typing';
        div.innerHTML = `<div class="ai-msg-bubble"><div class="ai-typing-dots"><span></span><span></span><span></span></div></div>`;
        messages.appendChild(div); scrollBottom();
    }
    function hideTyping() { const e = document.getElementById('ai-typing'); if (e) e.remove(); }

    function showAlert(title, body) {
        alertTitle.textContent = '⛔ ' + title;
        alertBody.textContent = body;
        alertEl.style.display = 'block';
        setTimeout(() => { alertEl.style.display = 'none'; }, 15000);
    }

    function updateMsgCounter() {
        if (!currentConvId) { msgCounter.textContent = 'آنلاین — HSE Expert'; return; }
        const remaining = maxMsgs - currentMsgCount;
        if (remaining <= 10) {
            msgCounter.textContent = `⚠️ ${remaining} پیام باقی‌مانده`;
            msgCounter.style.color = remaining <= 5 ? '#fca5a5' : '#fde68a';
        } else {
            msgCounter.textContent = `${currentMsgCount} / ${maxMsgs} پیام`;
            msgCounter.style.color = '';
        }
    }

    function removeSuggestions() {
        const s = document.getElementById('ai-suggestions');
        if (s) s.style.display = 'none';
        const w = messages.querySelector('.ai-welcome');
        if (w) w.style.display = 'none';
    }

    /* ── Modal ──────────────────────────────────────────────── */
    function showModal(title, body, confirmLabel = 'تأیید', danger = false) {
        modalTitle.textContent = title;
        modalBody.textContent  = body;
        modalConfirm.textContent = confirmLabel;
        modalConfirm.className = 'ai-modal-btn-primary' + (danger ? ' ai-modal-btn-danger' : '');
        modalBackdrop.style.display = 'flex';
        return new Promise(resolve => { modalResolve = resolve; });
    }
    function closeModal(val) {
        modalBackdrop.style.display = 'none';
        if (modalResolve) { modalResolve(val); modalResolve = null; }
    }
    modalConfirm.addEventListener('click', () => closeModal(true));
    modalCancel.addEventListener('click',  () => closeModal(false));
    modalBackdrop.addEventListener('click', e => { if (e.target === modalBackdrop) closeModal(false); });

    const sidebar = document.getElementById('ai-sidebar');

    /* ── Panel Open/Close ───────────────────────────────────── */
    function openPanel() {
        isOpen = true;
        panel.classList.add('ai-open');
        panel.setAttribute('aria-hidden', 'false');
        toggleBtn.style.display = 'none';
        if (window.innerWidth < 1024) {
            overlay.style.display = 'block';
            requestAnimationFrame(() => overlay.classList.add('ai-open'));
            document.body.style.overflow = 'hidden';
        }
        if (!currentConvId) loadLastConversation();
        setTimeout(() => input.focus(), 320);
    }
    function closePanel() {
        isOpen = false;
        panel.classList.remove('ai-open');
        panel.setAttribute('aria-hidden', 'true');
        toggleBtn.style.display = 'flex';
        overlay.classList.remove('ai-open');
        setTimeout(() => { overlay.style.display = 'none'; }, 300);
        document.body.style.overflow = '';
        sidebar.classList.remove('sheet-open');
    }

    toggleBtn.addEventListener('click', () => isOpen ? closePanel() : openPanel());
    closeBtn.addEventListener('click', closePanel);
    overlay.addEventListener('click', closePanel);
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && isOpen) {
            if (sidebar.classList.contains('sheet-open')) {
                sidebar.classList.remove('sheet-open');
            } else {
                closePanel();
            }
        }
    });

    /* ── Sidebar Sheet Toggle ───────────────────────────────── */
    sidebarToggleBtn.addEventListener('click', () => {
        if (!sidebar.classList.contains('sheet-open')) {
            loadConvList(currentConvId);
            sidebar.classList.add('sheet-open');
        } else {
            sidebar.classList.remove('sheet-open');
        }
    });
    sidebarCloseBtn.addEventListener('click', () => {
        sidebar.classList.remove('sheet-open');
    });

    /* ── Load Conversations List ────────────────────────────── */
    function loadConvList(selectId = null) {
        fetchJson(CONVS_BASE)
            .then(data => {
                maxConvs = data.max_convs || 50;
                maxMsgs  = data.max_msgs  || 100;
                const convs = data.conversations || [];
                renderConvList(convs);
                if (selectId) {
                    document.querySelectorAll('.ai-conv-item').forEach(el => {
                        el.classList.toggle('active', parseInt(el.dataset.id) === parseInt(selectId));
                    });
                }
            })
            .catch(() => {});
    }

    function renderConvList(convs) {
        convList.innerHTML = '';
        if (!convs.length) {
            convList.innerHTML = '<div class="ai-conv-list-empty">هیچ مکالمه‌ای وجود ندارد</div>';
            return;
        }
        convs.forEach(c => convList.appendChild(buildConvItem(c)));
    }

    function buildConvItem(c) {
        const item = document.createElement('div');
        item.className = 'ai-conv-item' + (parseInt(c.id) === parseInt(currentConvId) ? ' active' : '');
        item.dataset.id = c.id;

        const date = c.updated_at
            ? new Date(c.updated_at).toLocaleDateString('fa-IR', { month: 'short', day: 'numeric' })
            : '';

        item.innerHTML = `
            <div class="ai-conv-icon">💬</div>
            <div class="ai-conv-meta">
                <div class="ai-conv-title" title="${escapeHtml(c.title || 'مکالمه')}">${escapeHtml(c.title || 'مکالمه')}</div>
                <div class="ai-conv-date">${escapeHtml(date)}</div>
            </div>
            <button class="ai-conv-del" title="حذف">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>`;

        item.querySelector('.ai-conv-meta').addEventListener('click', () => {
            loadConversation(c.id);
            sidebar.classList.remove('sheet-open');
        });
        item.querySelector('.ai-conv-del').addEventListener('click', async e => {
            e.stopPropagation();
            const ok = await showModal('حذف مکالمه', `مکالمه «${c.title || 'مکالمه'}» حذف شود؟`, 'حذف', true);
            if (!ok) return;
            fetchJson(CONVS_BASE + '/' + c.id, { method: 'DELETE' })
                .then(r => {
                    if (r.ok) {
                        item.remove();
                        if (!convList.querySelector('.ai-conv-item')) {
                            convList.innerHTML = '<div class="ai-conv-list-empty">هیچ مکالمه‌ای وجود ندارد</div>';
                        }
                        if (parseInt(currentConvId) === parseInt(c.id)) startNewChat();
                    }
                })
                .catch(() => showAlert('خطا', 'حذف ناموفق بود.'));
        });
        return item;
    }

    /* ── Load Last Conversation ─────────────────────────────── */
    function loadLastConversation() {
        fetchJson(CONVS_BASE)
            .then(data => {
                maxConvs = data.max_convs || 50;
                maxMsgs  = data.max_msgs  || 100;
                const convs = data.conversations || [];
                renderConvList(convs);
                if (convs.length) loadConversation(convs[0].id);
            })
            .catch(() => {});
    }

    /* ── Load a Conversation ────────────────────────────────── */
    function loadConversation(id) {
        fetchJson(CONVS_BASE + '/' + id)
            .then(data => {
                currentConvId   = data.id;
                currentMsgCount = data.message_count || 0;
                messages.innerHTML = '';

                if (data.messages && data.messages.length) {
                    data.messages.forEach(m => {
                        if (m.role === 'user') appendUser(m.content);
                        else appendBot(formatMarkdown(m.content));
                    });
                } else {
                    messages.innerHTML = `<div class="ai-welcome">
                        <div class="ai-welcome-icon"><svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><path d="M9 2.5L10.09 6.41L14 7.5L10.09 8.59L9 12.5L7.91 8.59L4 7.5L7.91 6.41L9 2.5Z"/><path d="M17.5 11L18.27 13.23L20.5 14L18.27 14.77L17.5 17L16.73 14.77L14.5 14L16.73 13.23L17.5 11Z"/></svg></div>
                        <div class="ai-welcome-title">مکالمه جدید</div>
                        <div class="ai-welcome-subtitle">چه کمکی می‌توانم بکنم؟</div>
                    </div>`;
                }

                // وقتی مکالمه پر شده
                if (currentMsgCount >= maxMsgs) {
                    appendBot('⚠️ ظرفیت این مکالمه تکمیل شده است. برای ادامه یک مکالمه جدید شروع کنید.', true);
                    input.disabled = true;
                    sendBtn.disabled = true;
                } else {
                    input.disabled = false;
                }

                updateMsgCounter();
                highlightConv(id);
            })
            .catch(() => showAlert('خطا', 'بارگذاری مکالمه ناموفق بود.'));
    }

    function highlightConv(id) {
        document.querySelectorAll('.ai-conv-item').forEach(el => {
            el.classList.toggle('active', parseInt(el.dataset.id) === parseInt(id));
        });
    }

    /* ── New Chat ───────────────────────────────────────────── */
    async function startNewChat() {
        // بررسی ظرفیت
        const data = await fetchJson(CONVS_BASE, { method: 'POST' }).catch(() => null);
        if (!data) return;

        if (data.needs_confirm) {
            const oldTitle = data.oldest_title || 'مکالمه قدیمی';
            const ok = await showModal(
                '⚠️ ظرفیت مکالمات تکمیل شده',
                `شما به سقف ${data.max} مکالمه رسیده‌اید.\n\nبرای ایجاد مکالمه جدید، قدیمی‌ترین مکالمه شما («${oldTitle}») حذف خواهد شد.\n\nاگر نیاز دارید محتوای آن را نگه دارید، ابتدا از پانل تاریخچه آن را مشاهده کنید.\n\nآیا ادامه می‌دهید؟`,
                'بله، مکالمه جدید بساز',
                true
            );
            if (!ok) return;

            // ایجاد اجباری
            const newData = await fetchJson(FORCE_NEW_EP, { method: 'POST' }).catch(() => null);
            if (!newData || !newData.id) { showAlert('خطا', 'ایجاد مکالمه ناموفق بود.'); return; }
            afterNewConv(newData);
        } else if (data.id) {
            afterNewConv(data);
        }
    }

    function afterNewConv(data) {
        currentConvId   = data.id;
        currentMsgCount = 0;
        messages.innerHTML = `<div class="ai-welcome">
            <div class="ai-welcome-icon"><svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><path d="M9 2.5L10.09 6.41L14 7.5L10.09 8.59L9 12.5L7.91 8.59L4 7.5L7.91 6.41L9 2.5Z"/><path d="M17.5 11L18.27 13.23L20.5 14L18.27 14.77L17.5 17L16.73 14.77L14.5 14L16.73 13.23L17.5 11Z"/></svg></div>
            <div class="ai-welcome-title">مکالمه جدید</div>
            <div class="ai-welcome-subtitle">چه کمکی می‌توانم بکنم؟</div>
        </div>
        <div id="ai-suggestions">
            <button class="ai-suggestion" data-text="چگونه یک گزارش حادثه ایمنی بنویسم؟">📋 گزارش حادثه</button>
            <button class="ai-suggestion" data-text="مراحل ارزیابی ریسک در HSE چیست؟">⚠️ ارزیابی ریسک</button>
            <button class="ai-suggestion" data-text="چک‌لیست بازرسی ایمنی محیط کار را بنویس">🔍 چک‌لیست بازرسی</button>
            <button class="ai-suggestion" data-text="قوانین حفاظت فردی (PPE) در محیط کار">🦺 تجهیزات PPE</button>
        </div>`;
        // re-bind suggestions
        document.querySelectorAll('.ai-suggestion').forEach(btn => {
            btn.addEventListener('click', () => {
                input.value = btn.dataset.text;
                input.dispatchEvent(new Event('input'));
                removeSuggestions();
                sendMessage();
            });
        });
        input.disabled = false;
        sendBtn.disabled = true;
        updateMsgCounter();
        loadConvList(data.id);
        input.focus();
    }

    sidebarNewBtn.addEventListener('click', startNewChat);

    /* ── Delete All ─────────────────────────────────────────── */
    deleteAllBtn.addEventListener('click', async () => {
        const ok = await showModal(
            '🗑️ حذف همه مکالمات',
            'همه مکالمات شما به‌طور دائمی حذف می‌شوند و این عمل قابل بازگشت نیست.\n\nآیا مطمئنید؟',
            'بله، همه را حذف کن',
            true
        );
        if (!ok) return;
        fetchJson(CONVS_BASE, { method: 'DELETE' })
            .then(r => {
                if (r.ok) {
                    currentConvId = null;
                    currentMsgCount = 0;
                    messages.innerHTML = `<div class="ai-welcome">
                        <div class="ai-welcome-icon"><svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><path d="M9 2.5L10.09 6.41L14 7.5L10.09 8.59L9 12.5L7.91 8.59L4 7.5L7.91 6.41L9 2.5Z"/><path d="M17.5 11L18.27 13.23L20.5 14L18.27 14.77L17.5 17L16.73 14.77L14.5 14L16.73 13.23L17.5 11Z"/></svg></div>
                        <div class="ai-welcome-title">دستیار هوش مصنوعی HSE</div>
                        <div class="ai-welcome-subtitle">می‌توانم در ایمنی، بهداشت، ریسک‌ها و حوادث کمک کنم.</div>
                    </div>`;
                    convList.innerHTML = '<div class="ai-conv-list-empty">هیچ مکالمه‌ای وجود ندارد</div>';
                    updateMsgCounter();
                    input.disabled = false;
                }
            })
            .catch(() => showAlert('خطا', 'حذف ناموفق بود.'));
    });

    /* ── Input Handlers ─────────────────────────────────────── */
    input.addEventListener('input', function () {
        sendBtn.disabled = !this.value.trim() || loading;
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 130) + 'px';
    });
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (!sendBtn.disabled && !loading) sendMessage();
        }
    });
    sendBtn.addEventListener('click', () => { if (!loading) sendMessage(); });

    /* ── Suggestions ────────────────────────────────────────── */
    document.querySelectorAll('.ai-suggestion').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.text;
            input.dispatchEvent(new Event('input'));
            removeSuggestions();
            sendMessage();
        });
    });

    /* ── Action Confirm Card ────────────────────────────────── */
    function appendActionCard(actionPayload) {
        const params  = actionPayload.params || {};
        const preview = actionPayload.preview || '';
        const action  = actionPayload.ACTION_REQUIRED;

        // برچسب‌های فارسی
        const labels = {
            name: 'نام', email: 'ایمیل', personnel_code: 'کد پرسنلی',
            phone: 'تلفن', role: 'نقش', department_id: 'واحد (ID)',
        };

        let rows = '';
        for (const [k, v] of Object.entries(params)) {
            if (v !== null && v !== undefined && v !== '') {
                rows += `<div class="ai-action-card-row">
                    <span class="ai-action-card-label">${escapeHtml(labels[k] || k)}:</span>
                    <span class="ai-action-card-val">${escapeHtml(String(v))}</span>
                </div>`;
            }
        }

        const card = document.createElement('div');
        card.className = 'ai-action-card';
        card.innerHTML = `
            <div class="ai-action-card-title">✅ آیا این کاربر ایجاد شود؟</div>
            ${preview ? `<div style="font-size:12.5px;color:#374151;margin-bottom:8px">${escapeHtml(preview)}</div>` : ''}
            <div class="ai-action-card-rows">${rows}</div>
            <div class="ai-action-card-btns">
                <button class="ai-action-confirm-btn primary" data-action="${escapeHtml(action)}" data-params='${escapeHtml(JSON.stringify(params))}'>✅ تأیید و ایجاد کاربر</button>
                <button class="ai-action-confirm-btn secondary">انصراف</button>
            </div>`;

        const msgWrap = document.createElement('div');
        msgWrap.className = 'ai-msg ai-msg-bot';
        msgWrap.appendChild(card);
        messages.appendChild(msgWrap);
        scrollBottom();

        // bind buttons
        card.querySelector('.ai-action-confirm-btn.primary').addEventListener('click', async function () {
            this.disabled = true;
            this.textContent = 'در حال اجرا...';
            try {
                const res = await fetchJson(ACTION_EP, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        action: action,
                        params: params,
                        conversation_id: currentConvId,
                    }),
                });
                card.innerHTML = `<div class="ai-action-card-title">${res.ok ? '✅ عملیات انجام شد' : '❌ خطا'}</div>
                    <div style="font-size:13px;color:#1e293b;line-height:1.7">${formatMarkdown(res.message || '')}</div>`;
                if (res.ok) currentMsgCount += 2;
                updateMsgCounter();
            } catch (e) {
                card.innerHTML = '<div class="ai-action-card-title">❌ خطای ارتباطی</div>';
            }
        });
        card.querySelector('.ai-action-confirm-btn.secondary').addEventListener('click', function () {
            card.innerHTML = '<div style="font-size:12.5px;color:#6b7280">عملیات لغو شد.</div>';
        });
    }

    /* ── Send Message ───────────────────────────────────────── */
    function sendMessage() {
        const text = input.value.trim();
        if (!text || loading) return;

        loading = true;
        sendBtn.disabled = true;
        input.value = '';
        input.style.height = 'auto';
        removeSuggestions();

        appendUser(text);
        showTyping();

        fetch(ENDPOINT, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: JSON.stringify({ message: text, conversation_id: currentConvId }),
        })
        .then(r => r.json())
        .then(data => {
            hideTyping();

            // ── ظرفیت مکالمه تکمیل شده ──
            if (data.conv_full) {
                appendBot('⚠️ ظرفیت این مکالمه تکمیل شده است (حداکثر ' + maxMsgs + ' پیام).<br>لطفاً با دکمه + یک مکالمه جدید شروع کنید.', true);
                input.disabled = true;
                sendBtn.disabled = true;
                return;
            }

            // ── خطا ──
            if (data.error) {
                if (data.needs_confirm) {
                    appendBot('⚠️ ظرفیت مکالمات شما تکمیل شده است. از دکمه + برای ایجاد مکالمه جدید استفاده کنید.', true);
                } else {
                    const debug = data.debug
                        ? '\n\nHTTP ' + data.debug.http_status + '\n' + JSON.stringify(data.debug.body, null, 2)
                        : '';
                    showAlert('خطای هوش مصنوعی', data.error + debug);
                }
                return;
            }

            // ── آپدیت state ──
            if (data.conversation_id) {
                const isNew = !currentConvId || currentConvId !== data.conversation_id;
                currentConvId = data.conversation_id;
                if (isNew) loadConvList(currentConvId);
                else highlightConv(currentConvId);
            }
            currentMsgCount = data.msg_count || (currentMsgCount + 2);
            updateMsgCounter();

            // ── پاسخ متنی ──
            if (data.reply) appendBot(formatMarkdown(data.reply));

            // ── action card ──
            if (data.action_pending) {
                appendActionCard(data.action_pending);
            }

            // ── هشدار نزدیک به پر شدن ──
            if (currentMsgCount >= maxMsgs - 10 && currentMsgCount < maxMsgs) {
                appendBot(`ℹ️ این مکالمه نزدیک به ظرفیت است (${maxMsgs - currentMsgCount} پیام باقی‌مانده).`, true);
            }
        })
        .catch(err => {
            hideTyping();
            showAlert('خطای اتصال', 'خطا در ارتباط با سرور:\n' + err.message);
        })
        .finally(() => {
            loading = false;
            sendBtn.disabled = !input.value.trim();
        });
    }
})();
</script>
<?php /**PATH E:\HSE\hse-manager\resources\views/components/ai-chat.blade.php ENDPATH**/ ?>