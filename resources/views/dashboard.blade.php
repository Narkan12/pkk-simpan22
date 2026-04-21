@extends('layouts.layout-admin')

@section('title', 'Dashboard')

@section('content')

    {{-- 1. Summary Cards --}}
    <div class="cards-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem;">
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

    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;">
        {{-- 2. Bar Chart --}}
        <div class="card-activity" style="padding:1.25rem;">
            <h5 class="card-section-title" style="margin-bottom:1rem;">Total Pegawai Setiap Departemen</h5>
            <div style="position: relative; height: 320px; width: 100%;">
                <canvas id="departemenChart"></canvas>
            </div>
        </div>

        {{-- 3. Aktivitas Terbaru --}}
        <div class="card-activity"
            style="padding:1.5rem; background: #fff; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid #f3f4f6; padding-bottom: 0.75rem;">
                <h5 class="card-section-title" style="margin: 0; font-size: 1.1rem; font-weight: 700; color: #1e293b;">
                    Aktivitas Terbaru</h5>
                <span
                    style="font-size: 0.75rem; color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 12px;">Real-time</span>
            </div>

            {{-- Scrollable Container --}}
            <div style="max-height: 400px; overflow-y: auto; padding-right: 0.5rem;" class="custom-scrollbar">
                @forelse($aktivitasTerbaru as $log)
                    <div class="activity-item"
                        style="display: flex; gap: 1rem; margin-bottom: 1.25rem; position: relative;">
                        {{-- Avatar dengan warna random lembut --}}
                        <div class="activity-avatar"
                            style="
                    flex: none;
                    width: 40px; 
                    height: 40px; 
                    background: #e0f2fe; 
                    color: #0369a1; 
                    border-radius: 10px; 
                    display: flex; 
                    align-items: center; 
                    justify-content: center; 
                    font-weight: 700; 
                    font-size: 1rem;
                    text-transform: uppercase;">
                            {{ substr($log->nama_lengkap, 0, 1) }}
                        </div>

                        <div style="flex: 1; border-bottom: 1px solid #f8fafc; padding-bottom: 0.75rem;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <span class="activity-name"
                                    style="font-weight: 600; color: #334155; font-size: 0.9375rem;">{{ $log->nama_lengkap }}</span>
                                <span class="activity-time"
                                    style="font-size: 0.75rem; color: #94a3b8; white-space: nowrap;">
                                    <i class="bi bi-clock"
                                        style="margin-right: 3px;"></i>{{ $log->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="activity-desc"
                                style="font-size: 0.875rem; color: #64748b; line-height: 1.4; margin-top: 2px;">
                                {{ $log->deskripsi }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 2rem 0;">
                        <i class="bi bi-inbox"
                            style="font-size: 2.5rem; color: #e2e8f0; display: block; margin-bottom: 0.5rem;"></i>
                        <p style="color:#94a3b8; font-size:0.875rem; font-style:italic;">Belum ada aktivitas tercatat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;margin-top:1.5rem;">
        {{-- 4. Statistik Cepat --}}
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

        {{-- 5. Info Tambahan --}}
        <div class="card-statistic"
            style="padding:1.25rem;display:flex;align-items:center;justify-content:center;border:2px dashed #d1d5db;border-radius:0.75rem;">
            <p style="color:#6b7280;font-style:italic;">Widget tambahan bisa diletakkan di sini</p>
        </div>

        {{-- Scripts --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                            backgroundColor: 'rgba(33, 136, 255, 0.6)',
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
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.05)'
                                },
                                ticks: {
                                    color: '#7a9a7a',
                                    stepSize: 1
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#7a9a7a'
                                }
                            }
                        }
                    }
                });
            });
        </script>

    @endsection
