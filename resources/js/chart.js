import Chart from 'chart.js/auto'

(async function() {
  const data = [
    { bulan: 'Januari', pendapatan: totalJanuari },
    { bulan: 'Februari', pendapatan: totalFebruari },
    { bulan: 'Maret', pendapatan: totalMaret },
    { bulan: 'April', pendapatan: totalApril },
    { bulan: 'Mei', pendapatan: totalMei },
    { bulan: 'Juni', pendapatan: totalJuni },
    { bulan: 'Juli', pendapatan: totalJuli },
    { bulan: 'Agustus', pendapatan: totalAgustus },
    { bulan: 'September', pendapatan: totalSeptember },
    { bulan: 'Oktober', pendapatan: totalOktober },
    { bulan: 'November', pendapatan: totalNovember },
    { bulan: 'Desember', pendapatan: totalDesember }
  ];

  new Chart(
    document.getElementById('chart'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.bulan),
        datasets: [
          {
            label: 'Penjualan per Bulan (Tahun 2023)',
            data: data.map(row => row.pendapatan)
          }
        ]
      }
    }
  );
})();
