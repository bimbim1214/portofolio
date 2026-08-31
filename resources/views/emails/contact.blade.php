<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesan Baru dari Portofolio Web</title>
    <style>
        body { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; background-color: #010828; color: #eff4ff; padding: 24px; margin: 0; }
        .card { background: #0b153c; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 20px; padding: 32px; max-width: 600px; margin: 0 auto; box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
        .header { display: flex; align-items: center; justify-content: space-between; border-b: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 16px; margin-bottom: 24px; }
        .title { font-size: 20px; color: #6fff00; font-weight: bold; letter-spacing: 0.05em; text-transform: uppercase; }
        .label { font-size: 11px; color: #8899ac; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 16px; font-weight: bold; }
        .value { font-size: 15px; color: #ffffff; margin-top: 4px; font-weight: 500; }
        .message-box { background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.12); padding: 20px; border-radius: 12px; margin-top: 8px; white-space: pre-wrap; word-wrap: break-word; color: #d0e0ff; font-size: 14px; leading-height: 1.6; }
        .footer { font-size: 11px; color: #667788; margin-top: 28px; border-t: 1px solid rgba(255, 255, 255, 0.1); padding-top: 16px; text-align: center; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <div class="title">⚡ Pesan Portofolio Baru</div>
        </div>
        
        <div class="label">Nama Pengirim</div>
        <div class="value">{{ $senderName }}</div>

        <div class="label">Email Pengirim</div>
        <div class="value"><a href="mailto:{{ $senderEmail }}" style="color: #6fff00; text-decoration: none;">{{ $senderEmail }}</a></div>

        <div class="label">Waktu Pengiriman</div>
        <div class="value">{{ $date }}</div>

        <div class="label">Isi Pesan</div>
        <div class="message-box">{{ $senderMessage }}</div>

        <div class="footer">
            Pesan ini dikirim secara otomatis melalui Formulir Kontak Portofolio Bimo Aditya Pangestu.<br>
            Anda dapat membalas email ini secara langsung untuk merespons pengirim.
        </div>
    </div>
</body>
</html>
