{{-- View Daftar Pertanyaan Evaluasi Alumni --}}
<!DOCTYPE html>
<html>

<head>
    <title>Kuesioner Penelitian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .section-title {
        background-color: rgb(58, 64, 183);
        color: white;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .question-card {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .radio-group {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-top: 10px;
    }

    .radio-group label {
        text-align: center;
    }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-3">Kuesioner Penelitian</h2>
        <p class="text-danger fw-semibold mb-4">* Wajib</p>

        <div class="section-title">
            <h5 class="mb-2">Petunjuk Pengisian Kuesioner</h5>
            <small>
                Pilihlah jawaban yang Anda anggap tepat saat ini:<br>
                Angka 1 menunjukkan tidak setuju.<br>
                Angka 2 menunjukkan kurang setuju.<br>
                Angka 3 menunjukkan setuju.<br>
                Angka 4 menunjukkan sangat setuju.
            </small>
        </div>

        <form method="POST" action="{{ route('evaluasi.store') }}">
            @csrf

            @foreach ($pertanyaan as $index => $item)
            <div class="question-card">
                <label class="form-label fw-semibold">
                    {{ $index + 1 }}. {{ $item->isi_pertanyaan }} <span class="text-danger">*</span>
                </label>

                <div class="radio-group">
                    @for ($i = 1; $i <= 4; $i++) <div>
                        <input class="form-check-input" type="radio" name="jawaban[{{ $item->id }}]"
                            id="pertanyaan_{{ $item->id }}_{{ $i }}" value="{{ $i }}" required>
                        <label class="form-check-label d-block" for="pertanyaan_{{ $item->id }}_{{ $i }}">
                            {{ $i }} <br>
                            @switch($i)
                            @case(1) <small class="text-muted">Tidak Setuju</small> @break
                            @case(2) <small class="text-muted">Kurang Setuju</small> @break
                            @case(3) <small class="text-muted">Setuju</small> @break
                            @case(4) <small class="text-muted">Sangat Setuju</small> @break
                            @endswitch
                        </label>
                </div>
                @endfor
            </div>
    </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
    </form>
    </div>
</body>

</html>