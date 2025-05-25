<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style>
    body {
      font-family: "Times New Roman", Times, serif;
      margin: 6px 20px 5px 20px;
      line-height: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td, th {
      padding: 4px 3px;
      vertical-align: middle;
    }
    th {
      text-align: left;
    }
    img.image {
      width: auto;
      height: 80px;
      max-width: 150px;
      max-height: 150px;
    }
    .text-right {
      text-align: right;
    }
    .text-center {
      text-align: center;
    }
    .p-1 {
      padding: 5px 1px 5px 1px;
    }
    .font-10 {
      font-size: 10pt;
    }
    .font-11 {
      font-size: 11pt;
    }
    .font-12 {
      font-size: 12pt;
    }
    .font-13 {
      font-size: 13pt;
    }
    .font-bold {
      font-weight: bold;
    }
    .border-bottom-header {
      border-bottom: 1px solid;
      margin-bottom: 10px;
    }
    .border-all, .border-all th, .border-all td {
      border: 1px solid;
    }
    .header-table {
      width: 100%;
    }
    .header-left {
      width: 15%;
      text-align: center;
    }
    .header-right {
      width: 85%;
      text-align: center;
    }
    .mb-1 {
      margin-bottom: 3px;
      display: block;
    }
  </style>
</head>
<body>
  <table class="header-table border-bottom-header">
    <tr>
      <td class="header-left">
        <img src="{{ asset('polinema-bw.png') }}" class="image">
      </td>
      <td class="header-right">
        <span class="font-11 font-bold mb-1">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
        <span class="font-13 font-bold mb-1">POLITEKNIK NEGERI MALANG</span>
        <span class="font-10 mb-1">Jl. Soekarno-Hatta No. 9 Malang 65141</span>
        <span class="font-10 mb-1">Telepon (0341) 404424 Pes. 101-105, 0341-404420, Fax. (0341) 404420</span>
        <span class="font-10">Laman: www.polinema.ac.id</span>
      </td>
    </tr>
  </table>

  <h3 class="text-center">LAPORAN DATA BARANG</h3>

  <table class="border-all">
    <thead>
      <tr>
        <th class="text-center">No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th class="text-right">Harga Beli</th>
        <th class="text-right">Harga Jual</th>
        <th>Kategori</th>
      </tr>
    </thead>
    <tbody>
      @foreach($barang as $b)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $b->barang_kode }}</td>
        <td>{{ $b->barang_nama }}</td>
        <td class="text-right">{{ number_format($b->harga_beli, 0, ',', '.') }}</td>
        <td class="text-right">{{ number_format($b->harga_jual, 0, ',', '.') }}</td>
        <td>{{ $b->kategori->kategori_nama }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
