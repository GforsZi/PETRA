<link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

<style>
    .msg {
        max-width: 75%;
        padding: .6rem .9rem;
        border-radius: 14px;
        font-size: 14px;
        line-height: 1.4;
        word-wrap: break-word;
    }

    .msg.user {
        align-self: flex-end;
        background: var(--bs-success);
        color: #fff;
    }

    .msg.bot {
        align-self: flex-start;
        background: var(--bs-dark);
        color: #fff;
    }

    .quick-messages {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: .5rem;
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: max-height .3s ease, opacity .3s ease;
    }

    .quick-messages.show {
        max-height: 300px;
        opacity: 1;
    }

    .quick-item {
        max-width: 180px;
        text-wrap: balance:
    }
</style>

<main class="card shadow-lg rounded-0 h-100 w-100 border-0">
    <header class="card-header d-flex align-items-center gap-2 bg-body-tertiary">
        <div class="d-flex align-items-center justify-content-center bg-primary text-white fw-bold rounded-3"
            style="width:44px;height:44px;">
            <i class="bx bxs-robot fs-5"></i>
        </div>
        <div class="flex-grow-1">
            <h6 class="mb-0">MY — PETRA</h6>
            <small class="text-muted">• Online</small>
        </div>
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
    </header>

    <section id="chat-body" class="card-body d-flex flex-column gap-2 overflow-auto bg-body">
    </section>

    <div class="card-footer bg-body-tertiary">
        <div class="d-flex align-items-center gap-2">
            <button type="button" id="toggleQuickBtn" class="btn btn-success btn-sm">Opsi</button>
            <div class="input-group">
                <input type="text" id="chatInput" class="form-control"
                    placeholder="Ketik pesan...">
                <button type="button" id="sendBtn" class="btn btn-success">Kirim</button>
            </div>
        </div>

        <div class="quick-messages mt-3 overflow-y-scroll row" style="height: 200px ;"
            id="quickPanel">
        </div>
    </div>
</main>

<script>
    const chatBody = document.getElementById('chat-body');
    const chatInput = document.getElementById('chatInput');
    const sendBtn = document.getElementById('sendBtn');
    const toggleQuickBtn = document.getElementById('toggleQuickBtn');
    const quickPanel = document.getElementById('quickPanel');

    // 🔹 Tambah pesan bubble
    function addMessage(text, type) {
        const msg = document.createElement('div');
        msg.classList.add('msg', type);
        msg.textContent = text;
        chatBody.appendChild(msg);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function showTyping() {
        const typing = document.createElement('div');
        typing.classList.add('msg', 'bot');
        typing.textContent = 'Bot sedang mengetik...';
        typing.id = 'typing';
        chatBody.appendChild(typing);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function removeTyping() {
        const typing = document.getElementById('typing');
        if (typing) typing.remove();
    }

    // 🔹 Ambil balasan bot dari API
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    async function botReply(userMsg) {
        try {
            let response = await fetch('/system/option/chat/reply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    message: userMsg
                })
            });
            let data = await response.json();
            return data.reply;
        } catch (error) {
            console.error(error);
            return "⚠️ Terjadi kesalahan pada server.";
        }
    }

    // 🔹 Kirim pesan user
    async function sendUserMessage() {
        const text = chatInput.value.trim();
        if (!text) return;
        addMessage(text, 'user');
        chatInput.value = '';

        showTyping();
        setTimeout(async () => {
            removeTyping();
            addMessage(await botReply(text), 'bot');
        }, 1000);
    }

    sendBtn.addEventListener('click', sendUserMessage);
    chatInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendUserMessage();
        }
    });

    toggleQuickBtn.addEventListener('click', () => {
        quickPanel.classList.toggle('show');
    });

    // 🔹 Ambil quick replies dari API dan generate tombol
    async function loadQuickReplies() {
        try {
            let response = await fetch('/system/option/chat/quick_replies');
            let data = await response.json();

            quickPanel.innerHTML = '';
            data.forEach(item => {
                const btn = document.createElement('button');
                btn.classList.add('btn', 'btn-outline-secondary', 'col', 'text-wrap',
                    'btn-sm',
                    'quick-item');
                btn.dataset.msg = item.cht_opt_title;
                btn.textContent = item.cht_opt_title;

                btn.addEventListener('click', async () => {
                    addMessage(item.cht_opt_title, 'user');
                    quickPanel.classList.remove('show');

                    showTyping();
                    setTimeout(async () => {
                        removeTyping();
                        addMessage(await botReply(item
                                .cht_opt_title),
                            'bot');
                    }, 1000);
                });

                quickPanel.appendChild(btn);
            });
        } catch (error) {
            console.error("Gagal load quick replies", error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadQuickReplies);
</script>
