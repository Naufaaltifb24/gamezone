@extends('layouts.app')

@section('content')
<style>
    .statistics-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #007bff, #28a745, #ffc107, #dc3545);
    }
    
    .page-header h2 {
        color: #28a745;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }
    
    .page-header p {
        color: #6c757d;
        font-size: 1.1rem;
        margin: 0;
    }
    
    .stats-card {
        background: white;
        border: none;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        transition: all 0.3s ease;
    }
    
    .stats-card:nth-child(1)::before {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .stats-card:nth-child(2)::before {
        background: linear-gradient(135deg, #28a745, #1e7e34);
    }
    
    .stats-card:nth-child(3)::before {
        background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    
    .stats-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .stats-card:hover::before {
        height: 100%;
        opacity: 0.05;
    }
    
    .stats-card .card-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        animation: pulse 2s infinite;
    }
    
    .stats-card:nth-child(1) .card-icon {
        color: #007bff;
    }
    
    .stats-card:nth-child(2) .card-icon {
        color: #28a745;
    }
    
    .stats-card:nth-child(3) .card-icon {
        color: #ffc107;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .stats-card h5 {
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .stats-card h3 {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 0;
        color: #495057;
    }
    
    .chart-container {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .chart-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #007bff, #28a745);
    }
    
    .chart-title {
        text-align: center;
        margin-bottom: 2rem;
        color: #495057;
        font-weight: 600;
        font-size: 1.3rem;
    }
    
    .chart-wrapper {
        position: relative;
        height: 400px;
    }
    
    .stats-summary {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-top: 2rem;
    }
    
    .summary-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        margin-bottom: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .summary-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }
    
    .summary-item:last-child {
        margin-bottom: 0;
    }
    
    .summary-icon {
        font-size: 2rem;
        margin-right: 1rem;
        width: 60px;
        text-align: center;
    }
    
    .summary-content h6 {
        margin: 0;
        font-weight: 600;
        color: #495057;
    }
    
    .summary-content p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .back-button {
        position: fixed;
        top: 100px;
        left: 20px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #007bff, #28a745);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        z-index: 1000;
    }
    
    .back-button:hover {
        transform: scale(1.1);
        color: white;
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }
    
    @media (max-width: 768px) {
        .statistics-container {
            padding: 1rem 0;
        }
        
        .page-header {
            margin-bottom: 2rem;
            padding: 1.5rem;
        }
        
        .page-header h2 {
            font-size: 2rem;
        }
        
        .stats-card {
            height: 140px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stats-card .card-icon {
            font-size: 2.5rem;
        }
        
        .stats-card h3 {
            font-size: 2rem;
        }
        
        .chart-container {
            padding: 1.5rem;
        }
        
        .chart-wrapper {
            height: 300px;
        }
        
        .back-button {
            top: 80px;
            left: 15px;
            width: 45px;
            height: 45px;
        }
    }
</style>

<div class="statistics-container">
    <div class="container">
        <div class="page-header">
            <h2>📈 Statistik GameZone</h2>
            <p>Analisis mendalam tentang koleksi game, kategori, dan developer dalam database Anda</p>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="card-icon">🎮</div>
                    <h5>Total Game</h5>
                    <h3>{{ $totalGames }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="card-icon">📱</div>
                    <h5>Total Kategori</h5>
                    <h3>{{ $totalKategori }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="card-icon">👨‍💻</div>
                    <h5>Total Developer</h5>
                    <h3>{{ $totalDeveloper }}</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4 class="chart-title">📊 Distribusi Game per Kategori</h4>
                    <div class="chart-wrapper">
                        <canvas id="chartKategori"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4 class="chart-title">📈 Trend Game per Tahun</h4>
                    <div class="chart-wrapper">
                        <canvas id="chartTahun"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-summary">
            <h4 class="mb-4" style="color: #495057; font-weight: 600;">📋 Ringkasan Statistik</h4>
            <div class="summary-item">
                <div class="summary-icon">🏆</div>
                <div class="summary-content">
                    <h6>Game Terpopuler</h6>
                    <p>Kategori dengan game terbanyak dalam database</p>
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-icon">📅</div>
                <div class="summary-content">
                    <h6>Tahun Produktif</h6>
                    <p>Periode dengan penambahan game terbanyak</p>
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-icon">🎯</div>
                <div class="summary-content">
                    <h6>Total Koleksi</h6>
                    <p>Keseluruhan game yang tersimpan dalam database</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Enhanced color scheme
    const colorScheme = {
        primary: '#007bff',
        success: '#28a745',
        warning: '#ffc107',
        danger: '#dc3545',
        info: '#17a2b8',
        light: '#f8f9fa',
        dark: '#495057'
    };

    const textColor = '#495057';
    const gridColor = 'rgba(0,0,0,0.1)';

    // Enhanced Chart.js configuration
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    Chart.defaults.font.size = 12;

    const ctxKategori = document.getElementById('chartKategori').getContext('2d');
    new Chart(ctxKategori, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($gamePerKategori->pluck('nama')) !!},
            datasets: [{
                label: 'Game per Kategori',
                data: {!! json_encode($gamePerKategori->pluck('games_count')) !!},
                backgroundColor: [
                    colorScheme.primary,
                    colorScheme.success,
                    colorScheme.warning,
                    colorScheme.danger,
                    colorScheme.info,
                    '#e83e8c',
                    '#6f42c1',
                    '#fd7e14'
                ],
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: textColor,
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    cornerRadius: 8,
                    displayColors: true
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true
            }
        }
    });

    const ctxTahun = document.getElementById('chartTahun').getContext('2d');
    new Chart(ctxTahun, {
        type: 'line',
        data: {
            labels: {!! json_encode($gamePerTahun->pluck('tahun')) !!},
            datasets: [{
                label: 'Jumlah Game',
                data: {!! json_encode($gamePerTahun->pluck('total')) !!},
                fill: true,
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                borderColor: colorScheme.success,
                borderWidth: 3,
                pointBackgroundColor: colorScheme.success,
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: textColor,
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    cornerRadius: 8
                }
            },
            scales: {
                x: {
                    ticks: { 
                        color: textColor,
                        padding: 10
                    },
                    grid: { 
                        color: gridColor,
                        borderDash: [5, 5]
                    }
                },
                y: {
                    ticks: { 
                        color: textColor,
                        padding: 10
                    },
                    grid: { 
                        color: gridColor,
                        borderDash: [5, 5]
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Add smooth scroll animation for stats cards
    document.querySelectorAll('.stats-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });
</script>
@endpush