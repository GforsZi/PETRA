<!doctype html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

<link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <x-navbar></x-navbar>
        {{-- @if (auth()->user()?->roles['rl_admin'] == true)
        @endif --}}
        <x-sidebar></x-sidebar>
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
                                            aria-controls="offcanvasRight"><i
                                                class="bi bi-robot"></i></button>
                                        <div class="offcanvas offcanvas-end" tabindex="-1"
                                            id="offcanvasRight"
                                            aria-labelledby="offcanvasRightLabel">

                                       
                                            <div class="offcanvas-body p-0 h-100">
                                <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
                                                <style>



/* Bubble pesan */
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
</style>

<main class="card shadow-lg rounded-0 h-100 w-100 border-0">
  <!-- Header -->
  <header class="card-header d-flex align-items-center gap-2 bg-body-tertiary">
    <div class="d-flex align-items-center justify-content-center bg-primary text-white fw-bold rounded-3" style="width:44px;height:44px;">
      <i class="bx bxs-robot fs-5"></i>
    </div>
    <div class="flex-grow-1">
      <h6 class="mb-0">ChatBot — PETRA</h6>
      <small class="text-muted">• Online</small>
    </div>
         <div class="offcanvas-header">

      <button type="button" class="btn-close"
      data-bs-dismiss="offcanvas"
      aria-label="Close"></button>
      </div>
  </header>

  <!-- Body -->
  <section id="chat-body" class="card-body d-flex flex-column gap-2 overflow-auto bg-body">
    
  </section>

  <!-- Footer -->
  <div class="card-footer bg-body-tertiary">
    <div class="d-flex align-items-center gap-2">
      <button type="button" id="toggleQuickBtn" class="btn btn-success btn-sm">Opsi</button>
      <div class="input-group">
        <input type="text" id="chatInput" class="form-control" placeholder="Ketik pesan...">
        <button type="button" id="sendBtn" class="btn btn-success">Kirim</button>
      </div>
    </div>

    <!-- Panel Quick Message -->
    <div class="quick-messages mt-3" id="quickPanel">
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Halo">Halo</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Akun saya bermasalah">Akun saya bermasalah</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Saya butuh bantuan">Saya Butuh bantuan</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Terima kasih">Terima kasih</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Laporkan Masalah">Laporkan Masalah</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg=" masalah sudah selesai">masalah sudah selesai</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Saya tertarik">Saya tertarik</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg=" info lebih lanjut">Info lebih lanjut</button>

      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="adakah Buku terbaru"> adakah Buku terbaru</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Cara liat descripsi buku">Cara liat descripsi buku</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Cara pinjam buku">Cara pinjam buku</button>
      <button class="btn btn-outline-secondary btn-sm quick-item" data-msg="Oke">Oke</button>
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

// 🔹 Balasan bot sesuai isi pesan 
function botReply(userMsg) {
  const msg = userMsg.trim().toLowerCase(); 

  if (msg === 'halo') {
    return 'Hai juga! 👋 Senang bertemu denganmu.';
  } else if (msg === 'akun saya bermasalah') {
    return 'Baik, untuk masalah akun silakan hubungi admin untuk tindak lebih lanjut';
  } else if (msg === 'saya butuh bantuan' || msg === 'butuh bantuan') {
    return 'Tentu! Bisa jelaskan bantuan apa yang kamu perlukan? ';
  } else if (msg === 'terima kasih') {
    return 'Sama-sama! Semoga harimu menyenangkan ';
  } else if (msg === 'laporkan masalah') {
    return 'Siap, laporkan masalah kepada admin';
  } else if (msg === 'masalah sudah selesai') {
    return 'Bagus kamu memang pintar dalam menghadapi masalah';
  } else if (msg === 'saya tertarik') {
    return 'Wah senang mendengarnya!';
  } else if (msg === 'info lebih lanjut?' || msg === 'info lebih lanjut') {
    return 'Tentu! klik link dibawah ini untuk info dari admin';
  } else if (msg === 'adakah buku terbaru') {
    return 'Oh Tentu, ada buku baru dan menarik buat kamu yang special. apa kamu tertarik?';
  } else if (msg === 'cara liat descripsi buku') {
    return 'Klik pada buku atau button untuk melihat deskripsi lengkap.';
  } else if (msg === 'cara pinjam buku') {
    return 'Kamu bisa klik tombol pada sidebar lalu ikuti instruksi selanjutnya ';
  } else if (msg === 'oke') {
    return 'Sip 👍 Kalau ada yang lain, kabari aku ya.';
  }

  return 'Maaf, saya tidak mengerti. Bisa coba pilih pesan cepat di bawah';
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
<!-- <script>
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
</script> -->
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
