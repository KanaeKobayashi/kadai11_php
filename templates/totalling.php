

<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート集計結果</title>
  <link rel="stylesheet" href="../css/totaling.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body>
  <div class="main">
  <h1>⭐️星の数集計結果</h1>
  
  <?php if (isset($labels) && isset($data)) : ?>
    <canvas id="chart" style="border: 1px solid #ccc;"></canvas>
  <?php else : ?>
    <p>まだアンケートがありません。</p>
  <?php endif; ?>
  
  <a href="" class="back-button">戻る</a>
  </div>
  <script>
   document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
          label: '回答数',
          data: <?php echo json_encode($data); ?>,
          backgroundColor: 'rgba(60, 182, 182, 0.6)'
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            precision: 0,
            ticks: {
              padding: 50,
              stepSize: 1
            }
          }
        },
        plugins: {
          legend: {
            display: false
          },
          layout: {
            padding: {
              left: 50,
              right: 50,
              top: 50,
              bottom: 50
            }
          }
        }
      }
    });
  });
  </script>
</body>
</html>
