<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Halaman Cetak Kartu Keanggotaan</title>
<style>
@page {
  size: A4;
  margin: 0.5cm;
}

body {
  background: white;
  font-family: 'Poppins', sans-serif;
  display: grid;
  grid-template-columns: repeat(2, 86mm);
  place-content: start center;
  gap: 1cm 2cm;
  padding: 1cm 0;
  margin: 0;
  box-sizing: border-box;
}

@media print {
  html, body {
    height: auto;
    overflow: visible !important;
    margin: 0;
    padding: 0;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
  }
  .card {
    page-break-inside: avoid;
    break-inside: avoid;
  }
}

/* Kartu */
.card {
  width: 86mm;
  height: 54mm;
  background: #fff;
  border: 1.5px solid #1a2238;
  border-radius: 6px;
  overflow: hidden;
  box-shadow: 0 1px 2px rgba(0,0,0,0.15);
  display: flex;
  flex-direction: column;
}

/* Header: fix garis biru bawah */
.card-header {
  width: 100%;
  height: 1.55cm; /* sedikit lebih tinggi agar gambar bisa diangkat */
  margin: 0;
  padding: 0;
  border: none;
  line-height: 0;
  background: #0b1840;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

.card-header img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
  transform: translateY(-0.1px); /* ⬅️ angkat gambar 0.6px biar garis biru ilang */
}

/* Isi kartu */
.card-body {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 0.25cm;
  gap: 0.25cm;
  flex: 1;
}

/* Foto profil */
.photo {
  width: 15mm;
  height: 20mm;
  border: 1px solid #777;
  border-radius: 4px;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Info */
.info {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  font-size: 8pt;
  color: black;
}

.info-row {
  display: flex;
  align-items: center;
  margin: 1px 0;
}

.label {
  width: 2.8cm;
  font-weight: 600;
}

.separator {
  width: 0.3cm;
  text-align: center;
}

.value {
  flex: 1;
}
</style>
</head>
<body>

@foreach ($users as $user)
<div class="card">
  <div class="card-header">
    <img src="{{ public_path('logo/cop_kartu.svg') }}" alt="Kop Kartu">
  </div>
  <div class="card-body">
    <div class="photo">
      <img src="{{ public_path($user->usr_card_url ?? 'user_placeholder.jpg') }}" alt="Foto Profil">
    </div>
    <div class="info">
      <div class="info-row">
        <div class="label">Nama Lengkap</div>
        <div class="separator">:</div>
        <div class="value">{{ $user->name }}</div>
      </div>
      <div class="info-row">
        <div class="label">No. WhatsApp</div>
        <div class="separator">:</div>
        <div class="value">{{ $user->usr_no_wa }}</div>
      </div>
      <div class="info-row">
        <div class="label">Bergabung sejak</div>
        <div class="separator">:</div>
        <div class="value">{{ $user->usr_created_at->format('d M Y') }}</div>
      </div>
      <div class="info-row">
        <div class="label">Sebagai</div>
        <div class="separator">:</div>
        <div class="value">{{ $user->roles->rl_name }}</div>
      </div>
    </div>
  </div>
</div>
@endforeach

</body>
</html>
