@extends('layouts.layout-admin')

@section('title', 'Dashboard')

@section('content')

    {{-- 1. Summary Cards --}}
    <div class="cards-grid-4" style="margin-bottom:2rem;">
        <div class="card-info">
            <i class="bi bi-people card-info-icon" style="color:#22c55e;"></i>
            <div class="card-info-value">{{ $totalPegawai }}</div>
            <div class="card-info-label">Total Pegawai</div>
        </div>
        <div class="card-info">
            <i class="bi bi-person-check card-info-icon" style="color:#3b82f6;"></i>
            <div class="card-info-value">{{ $pegawaiAktif }}</div>
            <div class="card-info-label">Pegawai Aktif</div>
        </div>
        <div class="card-info">
            <i class="bi bi-person-x card-info-icon" style="color:#ef4444;"></i>
            <div class="card-info-value">{{ ($pegawaiNonAktif ?? 0) + ($statusLainnya ?? 0) }}</div>
            <div class="card-info-label">Non Aktif / Lainnya</div>
        </div>
        <div class="card-info">
            <i class="bi bi-diagram-3 card-info-icon" style="color:#eab308;"></i>
            <div class="card-info-value">{{ $totalJabatan }}</div>
            <div class="card-info-label">Total Jabatan</div>
        </div>
    </div>

    <div class="cards-grid-2" style="gap:1.5rem;">
        {{-- 2. Bar Chart --}}
        <div class="card-activity" style="padding:1.25rem;">
            <h5 class="card-section-title" style="margin-bottom:1rem;">Total Pegawai Setiap Departemen</h5>
            <div style="position:relative;height:320px;width:100%;">
                <canvas id="departemenChart"></canvas>
            </div>
        </div>

        {{-- 3. Aktivitas Terbaru --}}
        <div class="card-activity"
            style="padding:1.5rem;background:#fff;border-radius:0.75rem;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
            <div
                style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;border-bottom:1px solid #f3f4f6;padding-bottom:0.75rem;">
                <h5 class="card-section-title" style="margin:0;font-size:1.1rem;font-weight:700;color:#1e293b;">Aktivitas
                    Terbaru</h5>
                <span
                    style="font-size:0.75rem;color:#64748b;background:#f1f5f9;padding:2px 8px;border-radius:12px;">Real-time</span>
            </div>
            <div style="max-height:400px;overflow-y:auto;padding-right:0.5rem;" class="custom-scrollbar">
                @forelse($aktivitasTerbaru as $log)
                    <div style="display:flex;gap:1rem;margin-bottom:1.25rem;position:relative;">
                        <div
                            style="flex:none;width:40px;height:40px;background:#e0f2fe;color:#0369a1;border-radius:10px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;text-transform:uppercase;">
                            {{ substr($log->nama_lengkap, 0, 1) }}
                        </div>
                        <div style="flex:1;border-bottom:1px solid #f8fafc;padding-bottom:0.75rem;">
                            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                                <span style="font-weight:600;color:#334155;font-size:0.9375rem;">
                                    {{ $log->nama_lengkap }}@if($log->role)<span style="font-weight:400;color:#94a3b8;font-size:0.8rem;"> - {{ $log->role }}</span>@endif
                                </span>
                            </div>
                            <div style="font-size:0.875rem;color:#64748b;line-height:1.4;margin-top:2px;">
                                {{ $log->deskripsi }}</div>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;padding:2rem 0;">
                        <i class="bi bi-inbox"
                            style="font-size:2.5rem;color:#e2e8f0;display:block;margin-bottom:0.5rem;"></i>
                        <p style="color:#94a3b8;font-size:0.875rem;font-style:italic;">Belum ada aktivitas tercatat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="cards-grid-2" style="gap:1.5rem;margin-top:1.5rem;">
        {{-- 4. Statistik Master Data --}}
        <div class="card-statistic" style="padding:1.25rem;">
            <h5 class="card-section-title" style="margin-bottom:1rem;">Statistik Master Data</h5>
            <div class="stat-item">
                <span class="stat-label">Total Departemen</span>
                <span class="stat-value">{{ $totalDepartemen }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Total Status Pegawai</span>
                <span class="stat-value">{{ $totalStatus }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Total Golongan Pegawai</span>
                <span class="stat-value">{{ $totalGolongan }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Total Jabatan Pegawai</span>
                <span class="stat-value">{{ $totalJabatan }}</span>
            </div>
        </div>

        {{-- 5. Widget: Ranking Departemen --}}
        <div class="card-statistic" style="padding:1.25rem;">

            {{-- Header --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                <h5 class="card-section-title" style="margin:0;">Ranking Departemen</h5>
                <span style="font-size:0.72rem;color:#64748b;background:#f1f5f9;padding:2px 8px;border-radius:12px;">
                    {{ $departemenStats->count() }} departemen
                </span>
            </div>

            {{-- Summary row --}}
            @php
                $maxPegawai = $departemenStats->max('employees_count') ?: 1;
                $topDept = $departemenStats->first();
                $colors = ['#3B8BD4', '#1D9E75', '#7F77DD', '#EF9F27', '#D4537E', '#D85A30', '#888780'];
                $ranks = ['#1', '#2', '#3'];
            @endphp

            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem;margin-bottom:1rem;">
                <div style="background:#f9fafb;border-radius:8px;padding:0.625rem 0.75rem;">
                    <div style="font-size:1.15rem;font-weight:600;color:#1e293b;">{{ $totalPegawai }}</div>
                    <div style="font-size:0.7rem;color:#6b7280;margin-top:2px;">Total karyawan</div>
                </div>
                <div style="background:#f9fafb;border-radius:8px;padding:0.625rem 0.75rem;min-width:0;">
                    <div style="font-size:1.15rem;font-weight:600;color:#1e293b;">
                        {{ $topDept ? $topDept->nama_departemen : '-' }}
                    </div>
                    <div style="font-size:0.7rem;color:#6b7280;margin-top:2px;">Dept. terbanyak</div>
                </div>
            </div>

            {{-- Bar list --}}
            <div style="max-height:210px;overflow-y:auto;padding-right:2px;" class="custom-scrollbar">
                @forelse($departemenStats->take(7) as $i => $dept)
                    @php
                        $pct = $maxPegawai > 0 ? round(($dept->employees_count / $maxPegawai) * 100) : 0;
                        $share = $totalPegawai > 0 ? round(($dept->employees_count / $totalPegawai) * 100) : 0;
                        $color = $colors[$i % count($colors)];
                    @endphp
                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:8px;">
                        {{-- Medal / rank --}}
                        <span style="font-size:0.7rem;width:18px;text-align:center;flex-shrink:0;color:#9ca3af;">
                            {{ $i < 3 ? $ranks[$i] : '#' . ($i + 1) }}
                        </span>
                        {{-- Label --}}
                        <span
                            style="font-size:0.72rem;color:#374151;width:100px;flex-shrink:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"
                            title="{{ $dept->nama_departemen }}">
                            {{ $dept->nama_departemen }}
                        </span>
                        {{-- Bar --}}
                        <div style="flex:1;background:#f3f4f6;border-radius:4px;height:20px;overflow:hidden;min-width:0;">
                            <div
                                style="width:{{ $pct }}%;background:{{ $color }};height:100%;border-radius:4px;display:flex;align-items:center;padding-left:6px;transition:width .4s ease;">
                                <span style="font-size:0.68rem;font-weight:600;color:#fff;white-space:nowrap;">
                                    {{ $dept->employees_count }}
                                </span>
                            </div>
                        </div>
                        {{-- Persen --}}
                        <span style="font-size:0.68rem;color:#9ca3af;width:28px;text-align:right;flex-shrink:0;">
                            {{ $share }}%
                        </span>
                    </div>
                @empty
                    <p style="font-size:0.8rem;color:#9ca3af;font-style:italic;text-align:center;padding:1rem 0;">
                        Belum ada data departemen.
                    </p>
                @endforelse
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('departemenChart').getContext('2d');
                const labels = {!! json_encode($departemenStats->pluck('nama_departemen') ?? []) !!};
                const dataCounts = {!! json_encode($departemenStats->pluck('employees_count') ?? []) !!};
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pegawai',
                            data: dataCounts,
                            backgroundColor: 'rgba(33,136,255,0.6)',
                            borderColor: '#2188ff',
                            borderWidth: 1,
                            borderRadius: 5,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#7a9a7a',
                                    stepSize: 1
                                },
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#7a9a7a'
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush

@endsection
