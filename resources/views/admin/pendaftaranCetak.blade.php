<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $pendaftaran->nama_anak }} ({{ $pendaftaran->kode_pendaftaran }})</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #111;
            background-color: #fff;
            padding: 20px;
        }
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo-box {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .table-cetak th {
            width: 30%;
            background-color: #f8f9fa;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container my-3 max-w-75">
        <div class="no-print mb-4 d-flex justify-content-between align-items-center bg-light p-3 rounded border">
            <div>
                <a href="{{ route('pendaftar.admin') }}" class="btn btn-secondary btn-sm">
                    &larr; Kembali ke Admin
                </a>
            </div>
            <div>
                <button onclick="window.print()" class="btn btn-primary btn-sm">
                    🖨️ Cetak / Simpan PDF
                </button>
            </div>
        </div>

        <!-- Kop Surat -->
        <div class="kop-surat d-flex align-items-center gap-3">
            <div class="text-center w-100">
                <h3 class="fw-bold m-0 text-uppercase">TAMAN KANAK-KANAK (TK) MARDI TAMA</h3>
                <p class="m-0 fs-6">Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
                <small class="text-muted">Jl. Raya Pendidikan No. 12, Kota Tangerang Selatan | Email: info@tkmarditama.sch.id | HP: 0812-3456-7890</small>
            </div>
        </div>

        <div class="text-center my-3">
            <h4 class="fw-bold text-decoration-underline text-uppercase mb-1">BUKTI PENDAFTARAN SISWA BARU</h4>
            <p class="fw-bold text-primary fs-5 m-0">KODE: {{ $pendaftaran->kode_pendaftaran }}</p>
        </div>

        <!-- Detail Data -->
        <table class="table table-bordered align-middle table-cetak">
            <tbody>
                <tr>
                    <th colspan="2" class="table-dark text-uppercase">A. Data Calon Siswa</th>
                </tr>
                <tr>
                    <th>Nama Lengkap Anak</th>
                    <td class="fw-bold fs-6">{{ $pendaftaran->nama_anak }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>{{ $pendaftaran->ttl }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $pendaftaran->agama }}</td>
                </tr>
                <tr>
                    <th>Alamat Rumah</th>
                    <td>{{ $pendaftaran->alamat }}</td>
                </tr>

                <tr>
                    <th colspan="2" class="table-dark text-uppercase">B. Data Orang Tua / Wali</th>
                </tr>
                <tr>
                    <th>Nama Orang Tua / Wali</th>
                    <td>{{ $pendaftaran->nama_ortu }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $pendaftaran->pekerjaan }}</td>
                </tr>
                <tr>
                    <th>Nomor WhatsApp / HP</th>
                    <td>{{ $pendaftaran->no_hp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pendaftaran->email }}</td>
                </tr>

                <tr>
                    <th colspan="2" class="table-dark text-uppercase">C. Status & Catatan Pendaftaran</th>
                </tr>
                <tr>
                    <th>Status Pendaftaran</th>
                    <td>
                        <strong class="text-uppercase 
                            {{ $pendaftaran->status == 'diterima' ? 'text-success' : ($pendaftaran->status == 'ditolak' ? 'text-danger' : 'text-warning') }}">
                            {{ $pendaftaran->status }}
                        </strong>
                    </td>
                </tr>
                <tr>
                    <th>Catatan Panitia</th>
                    <td>{{ $pendaftaran->catatan_admin ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Mendaftar</th>
                    <td>{{ $pendaftaran->created_at ? $pendaftaran->created_at->translatedFormat('d F Y H:i') : date('d F Y') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tanda Tangan -->
        <div class="row mt-5 pt-3">
            <div class="col-6 text-center">
                <p class="mb-5">Orang Tua / Wali Siswa,</p>
                <br><br>
                <p class="fw-bold text-decoration-underline m-0">({{ $pendaftaran->nama_ortu }})</p>
            </div>
            <div class="col-6 text-center">
                <p class="mb-0">Tangerang Selatan, {{ date('d F Y') }}</p>
                <p class="mb-5">Panitia PPDB TK Mardi Tama,</p>
                <br><br>
                <p class="fw-bold text-decoration-underline m-0">( Panitia PPDB )</p>
            </div>
        </div>
    </div>
</body>
</html>
