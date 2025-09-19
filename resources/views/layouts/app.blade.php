<!doctype html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css'])

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/adminlte.min.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <x-navbar></x-navbar>
        @if (auth()->user()?->roles['rl_admin'] == true)
            <x-sidebar></x-sidebar>
        @endif
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid ">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6 mt-1">
                            <h3 class="mb-0">{{ $title }}</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item w-100">
                                    <div class="d-flex mt-1 justify-content-between">
                                        <div>
                                            {{ $header_layout ?? '' }}
                                        </div>
                                        <button class="btn mx-1" type="button"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasRight"
                                            aria-controls="offcanvasRight"><i class="bi bi-robot"></i></button>
                                        <div class="offcanvas offcanvas-end" tabindex="-1"
                                            id="offcanvasRight"
                                            aria-labelledby="offcanvasRightLabel">
                                            <div class="offcanvas-header">
                                                <h5 class="offcanvas-title"
                                                    id="offcanvasRightLabel">Right Sidebar</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="offcanvas"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
                                                <style>

    .chat-card{
      width:360px;
      height:600px;                
      max-width:96vw;
      border-radius:18px;
      background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      box-shadow: 0 10px 30px rgba(2,6,23,0.7), inset 0 1px 0 rgba(255,255,255,0.02);
      overflow:hidden;
      border:1px solid rgba(255,255,255,0.04);
      display:flex;
      flex-direction:column;
    }

    .chat-header{
      display:flex;gap:12px;align-items:center;
      padding:14px 16px;
      background:linear-gradient(90deg, rgba(255,255,255,0.02), transparent);
    }
    .avatar{
      width:44px;height:44px;border-radius:10px;
      background:linear-gradient(135deg,var(--accent),#3b82f6);
      display:flex;align-items:center;justify-content:center;
      color:white;font-weight:700;
      box-shadow:0 6px 18px rgba(6,182,212,0.12)
    }
    .title{flex:1}
    .title h4{margin:0;font-size:15px;color:#e6f7fb}
    .title p{margin:0;font-size:12px;color:var(--muted)}

    .chat-body{
      flex:1;
      padding:16px;
      background:linear-gradient(180deg, rgba(255,255,255,0.007), transparent);
      display:flex;flex-direction:column;gap:12px;
      overflow:auto;
    }

    .chat-footer{
      display:flex;gap:8px;
      padding:12px;
      background:linear-gradient(90deg, transparent, rgba(255,255,255,0.01));
      align-items:center
    }

    .input {
      flex: 1;
      display: flex;
      gap: 8px;
      background: var(--glass);
      padding: 8px;
      border-radius: 12px;
      align-items: center;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .input input {
      flex: 1;
      border: 0;
      background: transparent;
      color: #e6f7fb;
      outline: none;
      font-size: 14px;
    }

    .tombol{
      background:var(--accent);
      border:0;
      padding:10px 12px;
      border-radius:10px;
      color:#042027;
      font-weight:600;
      cursor:pointer
    }

    /* 🟢 Chat bubble */
    .msg{
      max-width:75%;
      padding:10px 14px;
      border-radius:14px;
      font-size:14px;
      line-height:1.4;
      word-wrap:break-word;
    }
    .msg.user{
      align-self:flex-end;
      background:linear-gradient(180deg,#064e3b,#065f46);
      color:#eafbf5;
      border:1px solid rgba(255,255,255,0.05)
    }
    .msg.bot{
      align-self:flex-start;
      background:linear-gradient(180deg,#0b1323,#0e1a2d);
      color:#dff6fb;
      border:1px solid rgba(255,255,255,0.03)
    }

    .chat-body::-webkit-scrollbar{width:8px}
    .chat-body::-webkit-scrollbar-thumb{
      background:rgba(255,255,255,0.03);
      border-radius:8px
    }

/* #toggleQuickBtn {
  background: var(--accent);
  border: none;
  border-radius: 10px;
  color: #08CB00;
  font-weight: 700;
  cursor: pointer;
  padding: 8px 12px;
  margin-right: 6px;
} */

.quick-messages {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
  background: #0d0d0d;
  padding: 15px 20px;
  border-radius: 20px;
  margin: 10px 0;
  max-height: 0;
  overflow: hidden;
  opacity: 0;
  transition: max-height 0.3s ease, opacity 0.3s ease;
}

.quick-messages.show {
  max-height: 300px;
  opacity: 1;
}

.quick-item {
  background: #1a1a1a;
  color: #e6f7fb;
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 10px;
  padding: 10px;
  font-size: 13px;
  cursor: pointer;
  transition: background 0.2s;
}
.quick-item:hover {
  background: #242424;
}

  </style>

  <main class="chat-card">
    <header class="chat-header">
      <div class="avatar"><i class='bx bxs-robot' style='color:#f3fdfc'></i></div>
      <div class="title">
        <h4>ChatBot — PETRA</h4>
      </div> 
      <div style="font-size:13px;color:var(--muted)">• Online</div>
    </header>

    <section class="chat-body" id="chat-body">
      <!-- pesan muncul di sini -->
    </section>

<div class="chat-footer">
  <button type="button"id="toggleQuickBtn" class="btn btn-success">opsi</button>

  <div class="input">
    <input type="text" id="chatInput" placeholder="Ketik pesan..." />
    <button type="button" class="btn btn-success" id="sendBtn">Kirim</button>
  </div>
</div>

<!-- Panel quick message -->
<div class="quick-messages" id="quickPanel">
  <button class="quick-item" data-msg="Halo ">Halo </button>
  <button class="quick-item" data-msg="Apa kabar?">Apa kabar?</button>
  <button class="quick-item" data-msg="Saya butuh bantuan">Butuh bantuan</button>
  <button class="quick-item" data-msg="Terima kasih ">Terima kasih </button>
  <button class="quick-item" data-msg="Selamat pagi ">Selamat pagi </button>
  <button class="quick-item" data-msg="Selamat malam ">Selamat malam </button>
  <button class="quick-item" data-msg="Saya tertarik">Saya tertarik</button>
  <button class="quick-item" data-msg="Boleh info lebih lanjut?">Info lanjut</button>
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

// 🔹 Animasi mengetik
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

// 🔹 Balasan bot sesuai isi pesan (case-insensitive)
function botReply(userMsg) {
  const msg = userMsg.trim().toLowerCase(); // <- normalisasi

  if (msg === 'halo ' || msg === 'halo') {
    return 'Hai juga! 👋 Senang bertemu denganmu.';
  } else if (msg === 'apa kabar?' || msg === 'apa kabar') {
    return 'Aku baik, terima kasih sudah bertanya 😊';
  } else if (msg === 'saya butuh bantuan') {
    return 'Tentu! Bisa jelaskan bantuan apa yang kamu perlukan? 📝';
  } else if (msg === 'terima kasih ' || msg === 'terima kasih') {
    return 'Sama-sama! Semoga harimu menyenangkan 🌞';
  } else if (msg === 'selamat pagi ' || msg === 'selamat pagi') {
    return 'Selamat pagi juga! 🌻 Semoga harimu cerah!';
  } else if (msg === 'selamat malam ' || msg === 'selamat malam') {
    return 'Selamat malam 🌙 Semoga mimpi indah ya~';
  } else if (msg === 'saya tertarik') {
    return 'Wah senang mendengarnya! 😄 Ingin lanjut daftar?';
  } else if (msg === 'boleh info lebih lanjut?' || msg === 'boleh info lebih lanjut') {
    return 'Tentu! Aku bisa kirim detail infonya 📩';
  }

  return 'Maaf, saya tidak mengerti.';
}

// 🔹 Kirim pesan manual dari input
function sendUserMessage() {
  const text = chatInput.value.trim();
  if (!text) return;
  addMessage(text, 'user');
  chatInput.value = '';

  showTyping();
  setTimeout(() => {
    removeTyping();
    addMessage(botReply(text), 'bot');
  }, 1500);
}

sendBtn.addEventListener('click', sendUserMessage);

// Kirim saat tekan Enter
chatInput.addEventListener('keydown', (e) => {
  if (e.key === 'Enter') {
    e.preventDefault();
    sendUserMessage();
  }
});

// 🔹 Tampilkan/Sembunyikan panel quick message
toggleQuickBtn.addEventListener('click', () => {
  quickPanel.classList.toggle('show');
});

// 🔹 Saat quick message diklik
document.querySelectorAll('.quick-item').forEach(item => {
  item.addEventListener('click', () => {
    const text = item.dataset.msg;
    addMessage(text, 'user');
    quickPanel.classList.remove('show');

    showTyping();
    setTimeout(() => {
      removeTyping();
      addMessage(botReply(text), 'bot');
    }, 1500);
  });
});


</script>


    <!-- akhir -->
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
            <!--end::App Content-->
        </main>
        <x-footer></x-footer>
    </div>

</body>
@vite(['resources/js/app.js'])
<script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
    integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous">
</script>

<script src="{{ asset('/js/app.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('/js/adminlte.min.js') }}" type="text/javascript" charset="utf-8"></script>

</html>
