<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Summary Nilai Similaritas Skripsi / Tugas Akhir </title>
    <link rel="stylesheet" href="{{ asset('css/paper.css') }}">
    <style>@page { size: A4 }</style>
    <style>
        body {
            font-size: 10pt;
        }

        table.bordered {
            border: thin solid black;
            border-collapse: collapse;
        }

        table.bordered td, table.bordered th {
            border: thin solid black;
        }

        h1, h2 {
            margin-top: 0.6rem;
            margin-bottom: 0.3rem;
        }

        h2 {
            font-size: 14pt;
        }

    </style>
</head>
<body class="A4">
    <section class="sheet padding-10mm">
        <h1 style="text-align: center; margin-bottom: 2rem"> Similaritas Skripsi / Tugas Akhir </h1>

        <table>
            <tbody>
                <tr>
                    <td> Nama Mahasiswa: </td>
                    <td> : </td>
                    <td> {{ $thesis->student_name }} </td>
                </tr>
                <tr>
                    <td> NIM: </td>
                    <td> : </td>
                    <td> {{ $thesis->student_id }} </td>
                </tr>
                <tr>
                    <td> Program Studi: </td>
                    <td> : </td>
                    <td> {{ $thesis->study_program }} </td>
                </tr>
                <tr>
                    <td> Judul Skripsi: </td>
                    <td> : </td>
                    <td> {{ $thesis->title }} </td>
                </tr>
                <tr>
                    <td> Tanggal Sidang: </td>
                    <td> : </td>
                    <td> {{ $thesis->seminar_date }} </td>
                </tr>
                <tr>
                    <td> Pembimbing I: </td>
                    <td> : </td>
                    <td> {{ $thesis->advisor_1_name }} </td>
                </tr>
                <tr>
                    <td> Pembimbing II: </td>
                    <td> : </td>
                    <td> {{ $thesis->advisor_2_name }} </td>
                </tr>
            </tbody>
        </table>

        <h2> Skripsi dengan Nilai Rata-Rata Similaritas Tertinggi </h2>

        <table class="bordered" style="text-align: center">
            <thead>
                <tr>
                    <th> Judul </th>
                    <th> Nilai Similaritas Judul </th>
                    <th> Nilai Similaritas Abstrak </th>
                    <th> Nilai Similaritas Bab I </th>
                    <th> Nilai Similaritas Bab II </th>
                    <th> Nilai Similaritas Bab V </th>
                    <th> Rata-Rata Nilai Similaritas </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($three_largest_averages as $similarity)
                <tr>
                    <td> {{ $other_theses->get($similarity['id'])->title }} </td>
                    <td> {{ $similarity['title'] }}% </td>
                    <td> {{ $similarity['abstract'] }}% </td>
                    <td> {{ $similarity['chapter_1'] }}% </td>
                    <td> {{ $similarity['chapter_2'] }}% </td>
                    <td> {{ $similarity['chapter_5'] }}% </td>
                    <td> {{ $similarity['average'] }}% </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2> Skripsi dengan Nilai Similaritas Abstrak Tertinggi </h2>

        <table class="bordered" style="text-align: center">
            <thead>
                <tr>
                    <th> Judul </th>
                    <th> Nilai Similaritas Judul </th>
                    <th> Nilai Similaritas Abstrak </th>
                    <th> Nilai Similaritas Bab I </th>
                    <th> Nilai Similaritas Bab II </th>
                    <th> Nilai Similaritas Bab V </th>
                    <th> Rata-Rata Nilai Similaritas </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $other_theses->get($largest_abstract_s['id'])->title }} </td>
                    <td> {{ $largest_abstract_s['title'] }}% </td>
                    <td> {{ $largest_abstract_s['abstract'] }}% </td>
                    <td> {{ $largest_abstract_s['chapter_1'] }}% </td>
                    <td> {{ $largest_abstract_s['chapter_2'] }}% </td>
                    <td> {{ $largest_abstract_s['chapter_5'] }}% </td>
                    <td> {{ $largest_abstract_s['average'] }}% </td>
                </tr>
            </tbody>
        </table>

        <h2> Skripsi dengan Nilai Similaritas Bab I Tertinggi </h2>

        <table class="bordered" style="text-align: center">
            <thead>
                <tr>
                    <th> Judul </th>
                    <th> Nilai Similaritas Judul </th>
                    <th> Nilai Similaritas Abstrak </th>
                    <th> Nilai Similaritas Bab I </th>
                    <th> Nilai Similaritas Bab II </th>
                    <th> Nilai Similaritas Bab V </th>
                    <th> Rata-Rata Nilai Similaritas </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $other_theses->get($largest_chapter_1_s['id'])->title }} </td>
                    <td> {{ $largest_chapter_1_s['title'] }}% </td>
                    <td> {{ $largest_chapter_1_s['abstract'] }}% </td>
                    <td> {{ $largest_chapter_1_s['chapter_1'] }}% </td>
                    <td> {{ $largest_chapter_1_s['chapter_2'] }}% </td>
                    <td> {{ $largest_chapter_1_s['chapter_5'] }}% </td>
                    <td> {{ $largest_chapter_1_s['average'] }}% </td>
                </tr>
            </tbody>
        </table>

        <h2> Skripsi dengan Nilai Similaritas Bab II Tertinggi </h2>

        <table class="bordered" style="text-align: center">
            <thead>
                <tr>
                    <th> Judul </th>
                    <th> Nilai Similaritas Judul </th>
                    <th> Nilai Similaritas Abstrak </th>
                    <th> Nilai Similaritas Bab I </th>
                    <th> Nilai Similaritas Bab II </th>
                    <th> Nilai Similaritas Bab V </th>
                    <th> Rata-Rata Nilai Similaritas </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $other_theses->get($largest_chapter_2_s['id'])->title }} </td>
                    <td> {{ $largest_chapter_2_s['title'] }}% </td>
                    <td> {{ $largest_chapter_2_s['abstract'] }}% </td>
                    <td> {{ $largest_chapter_2_s['chapter_1'] }}% </td>
                    <td> {{ $largest_chapter_2_s['chapter_2'] }}% </td>
                    <td> {{ $largest_chapter_2_s['chapter_5'] }}% </td>
                    <td> {{ $largest_chapter_2_s['average'] }}% </td>
                </tr>
            </tbody>
        </table>

        <h2> Skripsi dengan Nilai Similaritas Bab V Tertinggi </h2>

        <table class="bordered" style="text-align: center">
            <thead>
                <tr>
                    <th> Judul </th>
                    <th> Nilai Similaritas Judul </th>
                    <th> Nilai Similaritas Abstrak </th>
                    <th> Nilai Similaritas Bab I </th>
                    <th> Nilai Similaritas Bab II </th>
                    <th> Nilai Similaritas Bab V </th>
                    <th> Rata-Rata Nilai Similaritas </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $other_theses->get($largest_chapter_5_s['id'])->title }} </td>
                    <td> {{ $largest_chapter_5_s['title'] }}% </td>
                    <td> {{ $largest_chapter_5_s['abstract'] }}% </td>
                    <td> {{ $largest_chapter_5_s['chapter_1'] }}% </td>
                    <td> {{ $largest_chapter_5_s['chapter_2'] }}% </td>
                    <td> {{ $largest_chapter_5_s['chapter_5'] }}% </td>
                    <td> {{ $largest_chapter_5_s['average'] }}% </td>
                </tr>
            </tbody>
        </table>

        <table style="margin-top: 4rem">
            <tbody>
                <tr>
                    <td> Mahasiswa </td>
                    <td style="width: 100%; height: 8rem"> </td>
                    <td style="white-space: nowrap; padding-left: 1rem"> Dosen Pembimbing I </td>
                    <td style="white-space: nowrap; padding-left: 1rem"> Dosen Pembimbing II </td>
                </tr>
                <tr></tr>
                <tr>
                    <td> {{ $thesis->student_name }} </td>
                    <td> </td>
                    <td style="white-space: nowrap; padding-left: 1rem"> {{ $thesis->advisor_1_name }} </td>
                    <td style="white-space: nowrap; padding-left: 1rem"> {{ $thesis->advisor_2_name }} </td>
                </tr>
            </tbody>
        </table>

    </section>
</body>
</html>