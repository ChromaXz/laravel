<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello ini file pertama saya di view laravel</h1>
    @php
    $nama = 'Budi';
    $nilai = 60;
    @endphp
    {{-- ini komentar di blade engine --}}
    @if ($nilai >= 60)
    @php $ket = "lulus"; @endphp
    @else
    @php $ket = "Tidak Lulus"; @endphp
    @endif

    {{-- memanggil variabel hasil didalam laravel menggunakan kurung kurawal --}}
    {{$nama}} <p> Dengan nilai </p> {{$nilai}} <p> Dinyatakan </p> {{$ket}}
</body>
</html>