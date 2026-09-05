{{-- AI Chat Widget --}}

{{-- Overlay (mobile + backdrop) --}}
<div id="ai-overlay"></div>

{{-- Error Alert --}}
<div id="ai-alert" style="display:none">
    <div id="ai-alert-box">
        <div id="ai-alert-header">
            <span id="ai-alert-title"></span>
            <button id="ai-alert-close">✕</button>
        </div>
        <pre id="ai-alert-body"></pre>
    </div>
</div>

{{-- Floating Trigger Button --}}
<button id="ai-toggle-btn"
    title="دستیار هوش مصنوعی HSE"
    aria-label="باز کردن دستیار هوش مصنوعی">
    {{-- Sparkles (two 4-pointed stars) --}}
    <svg viewBox="0 0 22 22" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M8 1L9.5 6.5L15 8L9.5 9.5L8 15L6.5 9.5L1 8L6.5 6.5L8 1Z"/>
        <path d="M17 12L18 15L21 16L18 17L17 20L16 17L13 16L16 15L17 12Z"/>
    </svg>
</button>

{{-- Chat Panel (full-height sidebar on desktop, fullscreen on mobile) --}}
<div id="ai-panel" aria-hidden="true">

    {{-- Header --}}
    <div id="ai-panel-header">
        <div id="ai-header-info">
            <div id="ai-header-copy">
                <div id="ai-header-title">دستیار هوش مصنوعی</div>
                <div id="ai-header-status">
                    <span id="ai-status-dot"></span> آنلاین — HSE Expert
                </div>
            </div>
        </div>
        <div id="ai-header-actions">
            <button id="ai-clear-btn" title="پاک کردن مکالمه">
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

    {{-- Messages --}}
    <div id="ai-messages">
        <div class="ai-msg ai-msg-bot">
            <div class="ai-msg-bubble">
                سلام! من دستیار هوش مصنوعی سامانه HSE هستم ✨<br>
                می‌توانم در حوزه‌های <strong>ایمنی، بهداشت، ریسک‌ها، بازرسی‌ها و حوادث</strong> به شما کمک کنم.
            </div>
        </div>
        {{-- Suggestions داخل messages تا با اسکرول برود --}}
        <div id="ai-suggestions">
            <button class="ai-suggestion" data-text="چگونه یک گزارش حادثه ایمنی بنویسم؟">گزارش حادثه</button>
            <button class="ai-suggestion" data-text="مراحل ارزیابی ریسک در HSE چیست؟">ارزیابی ریسک</button>
            <button class="ai-suggestion" data-text="چک‌لیست بازرسی ایمنی محیط کار را بنویس">چک‌لیست بازرسی</button>
            <button class="ai-suggestion" data-text="قوانین حفاظت فردی (PPE) در محیط کار">تجهیزات PPE</button>
        </div>
    </div>

    {{-- Input Area --}}
    <div id="ai-input-area">
        <textarea id="ai-input"
            placeholder="سوال خود را بپرسید... (Enter برای ارسال)"
            rows="1"
            maxlength="2000"></textarea>
        <button id="ai-send-btn" title="ارسال" disabled>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M22 2L11 13M22 2L15 22l-4-9-9-4 19-7z"/>
            </svg>
        </button>
    </div>

</div>

<style>
/* ─────────────────────────────────────────────────────────────
   Base
───────────────────────────────────────────────────────────── */
#ai-toggle-btn,
#ai-panel,
#ai-overlay,
#ai-alert {
    font-family: YekanBakh, Tahoma, sans-serif;
    direction: rtl;
}

/* ─────────────────────────────────────────────────────────────
   Error Alert
───────────────────────────────────────────────────────────── */
#ai-alert {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 9999;
    padding: 12px 16px;
    background: #fef2f2;
    border-bottom: 2px solid #fca5a5;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    animation: ai-alert-in 0.2s ease;
}
@keyframes ai-alert-in {
    from { transform: translateY(-100%); opacity: 0; }
    to   { transform: translateY(0);     opacity: 1; }
}
#ai-alert-box {
    max-width: 900px;
    margin: 0 auto;
}
#ai-alert-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 6px;
}
#ai-alert-title {
    font-size: 13.5px;
    font-weight: 700;
    color: #b91c1c;
}
#ai-alert-close {
    background: none;
    border: none;
    cursor: pointer;
    color: #b91c1c;
    font-size: 16px;
    line-height: 1;
    padding: 2px 6px;
    border-radius: 4px;
    flex-shrink: 0;
}
#ai-alert-close:hover { background: #fee2e2; }
#ai-alert-body {
    font-size: 12px;
    color: #7f1d1d;
    background: #fee2e2;
    border: 1px solid #fca5a5;
    border-radius: 8px;
    padding: 8px 12px;
    margin: 0;
    white-space: pre-wrap;
    word-break: break-all;
    direction: ltr;
    text-align: left;
    max-height: 200px;
    overflow-y: auto;
    font-family: monospace;
}

/* ─────────────────────────────────────────────────────────────
   Floating Trigger Button
   — fixed bottom-right (چون layout پروژه RTL است و sidebar اصلی
     سمت راست است، دکمه AI سمت چپ فیزیکی می‌ماند)
───────────────────────────────────────────────────────────── */
#ai-toggle-btn {
    position: fixed;
    bottom: 86px;
    left: 18px;
    z-index: 1200;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #10b981 0%, #0d9488 100%);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 18px rgba(16,185,129,0.5), 0 2px 8px rgba(0,0,0,0.14);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    color: #fff;
}
@media (min-width: 1024px) {
    #ai-toggle-btn {
        bottom: 32px;
        left: 32px;
    }
}
#ai-toggle-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 26px rgba(16,185,129,0.6), 0 3px 12px rgba(0,0,0,0.18);
}
#ai-toggle-btn svg {
    width: 24px;
    height: 24px;
}
@keyframes ai-pulse-ring {
    0%,100% { transform: scale(1); opacity: 1; }
    50%      { transform: scale(1.4); opacity: 0.65; }
}

/* ─────────────────────────────────────────────────────────────
   Overlay — فقط در موبایل نمایش داده می‌شود
───────────────────────────────────────────────────────────── */
#ai-overlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 1099;
    background: rgba(0,0,0,0.45);
    opacity: 0;
    transition: opacity 0.28s ease;
}
#ai-overlay.ai-open {
    opacity: 1;
}

/* ─────────────────────────────────────────────────────────────
   Chat Panel
   دسکتاپ: sidebar کامل سمت چپ فیزیکی (right در RTL = left فیزیکی)
   پنل از چپ slide-in می‌کند تا با sidebar اصلی (سمت راست) تداخل نداشته باشد
───────────────────────────────────────────────────────────── */
#ai-panel {
<<<<<<< Updated upstream
    position: fixed;
    top: 0;
    left: 0;
    width: 380px;
    height: 100vh;
    height: 100dvh;
    z-index: 1100;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    box-shadow: 6px 0 40px rgba(0,0,0,0.13), 1px 0 0 #e5e7eb;
    /* شروع از خارج صفحه سمت چپ */
    transform: translateX(-100%);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
=======
    position:fixed; top:0; left:0; z-index:1100;
    width:340px; height:100vh; height:100dvh;
    display:flex; flex-direction:column;
    background:#fff;
    transform:translateX(-100%);
    transition:transform 0.3s cubic-bezier(0.4,0,0.2,1);
    overflow:hidden;
    box-shadow:6px 0 40px rgba(0,0,0,0.15);
>>>>>>> Stashed changes
}
#ai-panel.ai-open {
    transform: translateX(0);
}

/* دسکتاپ: وقتی پنل باز است دکمه toggle مخفی شود */
@media (min-width: 1024px) {
    body.ai-panel-open #ai-toggle-btn {
        display: none;
    }
}

/* ─────────────────────────────────────────────────────────────
   موبایل (<1024px): تمام صفحه، overlay پشتش
───────────────────────────────────────────────────────────── */
@media (max-width: 1023px) {
    #ai-panel {
        width: 100%;
        border-radius: 0;
    }
    #ai-toggle-btn {
        bottom: 82px;
        left: 14px;
    }
}

/* ─────────────────────────────────────────────────────────────
   Header
───────────────────────────────────────────────────────────── */
#ai-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    z-index: 20;
    padding: 0 16px;
    height: 64px;
    min-height: 64px;
    flex: 0 0 64px;
    background: linear-gradient(135deg, #064e3b 0%, #065f46 60%, #047857 100%);
    color: #fff;
    flex-shrink: 0;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
#ai-header-info {
    display: flex;
    align-items: center;
    min-width: 0;
}
#ai-header-copy { min-width: 0; }
#ai-header-title {
    font-size: 14.5px;
    font-weight: 700;
    line-height: 1.25;
    white-space: nowrap;
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
#ai-header-actions {
    display: flex;
    gap: 4px;
    flex-shrink: 0;
}
#ai-header-actions button {
    width: 30px;
    height: 30px;
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

<<<<<<< Updated upstream
/* ─────────────────────────────────────────────────────────────
   Messages
───────────────────────────────────────────────────────────── */
=======
/* ── History Sheet ────────────────────────────────────────── */
/* Sheet که به‌صورت absolute روی messages می‌افتد */
#ai-sidebar {
    position:absolute;
    top:64px; left:0; right:0; bottom:0;
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
>>>>>>> Stashed changes
#ai-messages {
    flex: 1;
    overflow-y: auto;
    padding: 18px 14px 10px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: #f8fafc;
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 transparent;
}
#ai-messages::-webkit-scrollbar { width: 4px; }
#ai-messages::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }

.ai-msg {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    animation: ai-msg-in 0.22s ease;
}
@keyframes ai-msg-in {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}
/* RTL layout: user = right side, bot = left side */
.ai-msg-user { justify-content: flex-start; }
.ai-msg-bot  { justify-content: flex-end; }

.ai-msg-bubble {
    max-width: 85%;
    padding: 10px 14px;
    border-radius: 18px;
    font-size: 13.5px;
    line-height: 1.7;
    word-break: break-word;
}
.ai-msg-user .ai-msg-bubble {
    background: #10b981;
    color: #fff;
    border-bottom-right-radius: 5px;
}
.ai-msg-bot .ai-msg-bubble {
    background: #fff;
    color: #1e293b;
    border: 1px solid #e5e7eb;
    border-bottom-left-radius: 5px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}

/* Typing indicator */
.ai-typing-dots {
    display: flex;
    gap: 5px;
    align-items: center;
    padding: 4px 2px;
}
.ai-typing-dots span {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #94a3b8;
    animation: ai-dot-bounce 1.2s ease-in-out infinite;
}
.ai-typing-dots span:nth-child(2) { animation-delay: 0.18s; }
.ai-typing-dots span:nth-child(3) { animation-delay: 0.36s; }
@keyframes ai-dot-bounce {
    0%,80%,100% { transform: translateY(0); }
    40%         { transform: translateY(-7px); }
}

/* ─────────────────────────────────────────────────────────────
   Suggestions — داخل messages، wrap می‌شوند
───────────────────────────────────────────────────────────── */
#ai-suggestions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    padding: 6px 0 2px;
}
.ai-suggestion {
    font-size: 12px;
    font-family: inherit;
    padding: 6px 13px;
    border-radius: 20px;
    border: 1px solid #d1fae5;
    background: #ecfdf5;
    color: #065f46;
    cursor: pointer;
    white-space: nowrap;
    transition: background 0.15s, border-color 0.15s;
}
.ai-suggestion:hover {
    background: #d1fae5;
    border-color: #10b981;
}

/* ─────────────────────────────────────────────────────────────
   Input Area
───────────────────────────────────────────────────────────── */
#ai-input-area {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    padding: 12px 14px;
    border-top: 1px solid #e5e7eb;
    background: #fff;
    flex-shrink: 0;
}
#ai-input {
    flex: 1;
    border: 1.5px solid #e2e8f0;
    border-radius: 14px;
    padding: 9px 13px;
    font-size: 13.5px;
    font-family: inherit;
    resize: none;
    outline: none;
    line-height: 1.55;
    max-height: 130px;
    overflow-y: auto;
    transition: border-color 0.18s, box-shadow 0.18s;
    direction: rtl;
    background: #f8fafc;
    color: #1e293b;
}
#ai-input:focus {
    border-color: #10b981;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(16,185,129,0.12);
}
#ai-input::placeholder { color: #94a3b8; }

#ai-send-btn {
    width: 42px;
    height: 42px;
    border-radius: 13px;
    background: #10b981;
    border: none;
    cursor: pointer;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background 0.15s, transform 0.15s;
}
#ai-send-btn:hover:not(:disabled) {
    background: #059669;
    transform: scale(1.06);
}
#ai-send-btn:disabled {
    background: #e2e8f0;
    color: #94a3b8;
    cursor: not-allowed;
    transform: none;
}
#ai-send-btn svg { width: 18px; height: 18px; }
</style>

<script>
(function () {
    const CSRF      = document.querySelector('meta[name="csrf-token"]').content;
    const ENDPOINT  = '{{ route("ai.chat") }}';

    const panel       = document.getElementById('ai-panel');
    const overlay     = document.getElementById('ai-overlay');
    const toggleBtn   = document.getElementById('ai-toggle-btn');
    const closeBtn    = document.getElementById('ai-close-btn');
    const clearBtn    = document.getElementById('ai-clear-btn');
    const messages    = document.getElementById('ai-messages');
    const input       = document.getElementById('ai-input');
    const sendBtn     = document.getElementById('ai-send-btn');
    const suggestions = document.getElementById('ai-suggestions');

    let history = [];
    let isOpen  = false;
    let loading = false;

    /* ── Open / Close ─────────────────────────────────────── */
    function openPanel() {
        isOpen = true;
        panel.classList.add('ai-open');
        panel.setAttribute('aria-hidden', 'false');
        // دکمه toggle را مخفی کن (در همه سایزها)
        toggleBtn.style.display = 'none';
        if (window.innerWidth < 1024) {
            // موبایل/تبلت: overlay نشان بده و اسکرول را قفل کن
            overlay.style.display = 'block';
            requestAnimationFrame(() => overlay.classList.add('ai-open'));
            document.body.style.overflow = 'hidden';
        }
        setTimeout(() => input.focus(), 320);
    }
    function closePanel() {
        isOpen = false;
        panel.classList.remove('ai-open');
        panel.setAttribute('aria-hidden', 'true');
        // دکمه toggle را دوباره نمایش بده
        toggleBtn.style.display = 'flex';
        overlay.classList.remove('ai-open');
        setTimeout(() => { overlay.style.display = 'none'; }, 300);
        document.body.style.overflow = '';
    }

    toggleBtn.addEventListener('click', () => isOpen ? closePanel() : openPanel());
    closeBtn.addEventListener('click', closePanel);
    overlay.addEventListener('click', closePanel);

    /* Escape key */
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && isOpen) closePanel(); });

    /* ── Clear ────────────────────────────────────────────── */
    clearBtn.addEventListener('click', function () {
        history = [];
        messages.innerHTML = '';
        suggestions.style.display = 'flex';
        appendBot('مکالمه پاک شد. چه کمکی می‌توانم بکنم؟ ✨');
    });

    /* ── Auto-resize textarea ─────────────────────────────── */
    input.addEventListener('input', function () {
        sendBtn.disabled = !this.value.trim();
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

    /* ── Suggestions ──────────────────────────────────────── */
    document.querySelectorAll('.ai-suggestion').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.dataset.text;
            input.dispatchEvent(new Event('input'));
            suggestions.style.display = 'none';
            sendMessage();
        });
    });

    /* ── Helpers ──────────────────────────────────────────── */
    function scrollBottom() {
        messages.scrollTop = messages.scrollHeight;
    }
    function appendUser(text) {
        const div = document.createElement('div');
        div.className = 'ai-msg ai-msg-user';
        div.innerHTML = `<div class="ai-msg-bubble">${escapeHtml(text)}</div>`;
        messages.appendChild(div);
        scrollBottom();
    }
    function appendBot(text) {
        const div = document.createElement('div');
        div.className = 'ai-msg ai-msg-bot';
        div.innerHTML = `<div class="ai-msg-bubble">${formatMarkdown(text)}</div>`;
        messages.appendChild(div);
        scrollBottom();
        return div;
    }
    function showTyping() {
        const div = document.createElement('div');
        div.className = 'ai-msg ai-msg-bot';
        div.id = 'ai-typing';
        div.innerHTML = `<div class="ai-msg-bubble"><div class="ai-typing-dots"><span></span><span></span><span></span></div></div>`;
        messages.appendChild(div);
        scrollBottom();
    }
    function hideTyping() {
        const el = document.getElementById('ai-typing');
        if (el) el.remove();
    }
    /* ── Error Alert ──────────────────────────────────────── */
    const alertEl    = document.getElementById('ai-alert');
    const alertTitle = document.getElementById('ai-alert-title');
    const alertBody  = document.getElementById('ai-alert-body');
    document.getElementById('ai-alert-close').addEventListener('click', () => {
        alertEl.style.display = 'none';
    });
    function showAlert(title, body) {
        alertTitle.textContent = '⛔ ' + title;
        alertBody.textContent  = body;
        alertEl.style.display  = 'block';
        // 15 ثانیه بعد خودکار بسته شود
        setTimeout(() => { alertEl.style.display = 'none'; }, 15000);
    }
    function escapeHtml(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }
    function formatMarkdown(text) {
        return escapeHtml(text)
            .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.+?)\*/g, '<em>$1</em>')
            .replace(/^[•\-]\s+(.+)$/gm, '<li>$1</li>')
            .replace(/(<li>[\s\S]+?<\/li>)/g, '<ul style="margin:.4em 0 .4em 1.4em;padding:0;list-style:disc">$1</ul>')
            .replace(/\n/g, '<br>');
    }

    /* ── Send ─────────────────────────────────────────────── */
    function sendMessage() {
        const text = input.value.trim();
        if (!text || loading) return;

        loading = true;
        sendBtn.disabled = true;
        input.value = '';
        input.style.height = 'auto';
        suggestions.style.display = 'none';

        appendUser(text);
        showTyping();

        fetch(ENDPOINT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message: text, history: history.slice(-10) }),
        })
        .then(r => r.json())
        .then(data => {
            hideTyping();
            if (data.error) {
                const debug = data.debug
                    ? '\n\nجزئیات:\nHTTP Status: ' + data.debug.http_status
                      + '\n' + JSON.stringify(data.debug.body, null, 2)
                    : '';
                showAlert('خطای هوش مصنوعی', data.error + debug);
            } else {
                history.push({ role: 'user',      content: text       });
                history.push({ role: 'assistant', content: data.reply });
                if (history.length > 20) history = history.slice(-20);
                appendBot(data.reply);
            }
        })
        .catch(err => {
            hideTyping();
            showAlert('خطای اتصال', 'خطا در ارتباط با سرور Laravel:\n' + err.message);
        })
        .finally(() => {
            loading = false;
            sendBtn.disabled = !input.value.trim();
        });
    }
})();
</script>
