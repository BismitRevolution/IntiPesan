<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Notification</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="description" content="Description of the page">
    </head>
    <body style="background-color: white; color: #1abc9c; font-family: Arial; margin: 35px 25px;">
        <p style="text-align: justify;">{{ $data->content }}</p>
        <div style="margin-top: 35px;">
            <h2>Lokasi Kegiatan</h2>
            <p>{{ $data->location }}</p>
        </div>
        <div style="margin-top: 35px; width: 100%; height: 2px; background-color: white;"></div>
        <div style="margin-top: 35px;">
            <h2>Kontak Kami</h2>
            <p>Telp. (021) 781 5858 (hunting)</p>
            <p>Telp. (021) 781 9844</p>
            <p>Fax. (021) 7883 8781</p>
            <p>Email : info@intipesan.co.id</p>
            <p>Jl. Baung IV No. 36A, Kebagusan, Pasar Minggu, Jakarta Selatan 12520</p>
        </div>
    </body>
</html>
