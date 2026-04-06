<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Contact - PROGULL Defence Gear</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        body {
            font-family: var(--default-font);
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
    url("assets/img/contact-bg.jpg");;
        }

        .contact-wrapper {
            max-width: 800px;
            margin: 120px auto 50px;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .contact-wrapper h2 {
            font-family: var(--heading-font);
            margin-bottom: 20px;
            color: #003008 ;
        }

        .contact-wrapper p {
            margin-bottom: 10px;
            line-height: 1.6;
            color: #003008;
        }

        .contact-box {
            margin: 25px 0;
            padding: 20px;
            background: #f5f5f5;
            border-left: 5px solid #1bbd36;
            border-radius: 6px;
        }

        .contact-box strong {
            color: #1bbd36;
        }

        .wa-button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 20px;
            background-color: #25D366;
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }

        .wa-button:hover {
            background-color: #1ebe5d;
        }
    </style>
</head>
<body>

<div class="contact-wrapper">
    <h2>Contact PROGULL Defence Gear</h2>

    <p>Untuk pemesanan produk, silakan hubungi kami melalui WhatsApp resmi di bawah ini.</p>

    <div class="contact-box">
        <p><strong>Contact Person:</strong></p>
        <p>📱 WhatsApp: <strong>+62 081-1320-9380</strong></p>
        <p>🕘 Jam Operasional Workshop: 10.00 – 16.00 WIB</p>
    </div>

    <h3>Aturan Pemesanan</h3>
    <ul>
        <li>Produk yang sudah dibeli <strong>tidak dapat dikembalikan bila barang cacat karena Costumer sendiri</strong></li>
        <li>Pastikan spesifikasi produk sesuai sebelum membeli</li>
        <li>Pembayaran dilakukan via metode yang disepakati</li>
        <li>Pengiriman dilakukan setelah pembayaran diterima</li>
        <li>Complain harus di sertai bukti video</li>
    </ul>

    <a class="wa-button" 
       href="https://wa.me/08113209380" 
       target="_blank">
        Chat via WhatsApp
    </a>
</div>

</body>
</html>
