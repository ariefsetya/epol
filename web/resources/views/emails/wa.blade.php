Dear Admin,<br>
<br>
berikut informasi tamu yang ingin mengirim QR Code ke WA
<br>
<br>
Nama : {{Auth::user()->name}}<br>
Nomor HP : +62{{Auth::user()->phone}}<br>
Link Kirim WA : <a target="_blank" href="https://api.whatsapp.com/send?phone=+62{{Auth::user()->phone}}">Klik disini</a>