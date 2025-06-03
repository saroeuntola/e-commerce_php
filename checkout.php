<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

$nodePath = 'C:\\Program Files\\nodejs\\node.exe';
$scriptPath = __DIR__ . '\js\generate_khqr.js';

$command = "\"$nodePath\" \"$scriptPath\" $total";
$qrRaw = shell_exec($command . " 2>&1");

$khqrString = is_string($qrRaw) ? trim($qrRaw) : '';
?>

<?php if (!empty($khqrString)): ?>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

  <style>
    .khqr-card {
      width: 340px;
      margin: 2rem auto;
      font-family: 'Inter', sans-serif;
      border-radius: 16px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      background-color: #fff;
      text-align: center;
    }

    .khqr-header {
      background: #d0001f;
      color: white;
      padding: 1rem;
      font-weight: 700;
      font-size: 1.1rem;
    }

    .khqr-body {
      padding: 1.2rem;
    }

    .khqr-amount {
      font-size: 1.8rem;
      font-weight: 700;
      color: #333;
      margin: 0.5rem 0;
    }

    .khqr-recipient {
      font-size: 1rem;
      color: #555;
    }

    .khqr-divider {
      border-top: 1px dashed #ccc;
      margin: 1rem 0;
    }

    #bakongQR {
      border: 1px solid #eee;
      border-radius: 8px;
      margin-top: 1rem;
    }

    #timer {
      margin-top: 0.5rem;
      font-size: 0.85rem;
      color: #d0001f;
      font-family: monospace;
    }

    .qr-expired {
      filter: grayscale(100%);
      pointer-events: none;
      opacity: 0.5;
    }

    .btn-home {
      margin: 1.5rem auto 2rem;
      padding: 0.6rem 1.2rem;
      background-color: #d0001f;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-home:hover {
      background-color: #a8001a;
    }
  </style>

  <div class="khqr-card">
    <div class="khqr-header">KHQR</div>
    <div class="khqr-body">
      <div class="khqr-recipient">Tola</div>
      <div class="khqr-amount">$ <?= number_format($total, 2) ?></div>
      <div class="khqr-divider"></div>
      <canvas id="bakongQR" width="240" height="240"></canvas>
      <div id="timer"></div>
    </div>
    <button class="btn-home" onclick="window.location.href='index.php'">🏠 Back to Home</button>
  </div>

  <script>
    const qrString = <?= json_encode($khqrString) ?>;
    const duration = 2 * 60;
    let timeLeft = duration;

    const canvas = document.getElementById("bakongQR");
    const timerEl = document.getElementById("timer");

    QRCode.toCanvas(canvas, qrString, { width: 240 });

    const updateTimer = () => {
      const m = String(Math.floor(timeLeft / 60)).padStart(2, "0");
      const s = String(timeLeft % 60).padStart(2, "0");
      timerEl.textContent = `Expires in: ${m}:${s}`;
      if (timeLeft <= 0) {
        clearInterval(timer);
        timerEl.textContent = "⛔ QR expired. Please refresh.";
      }
      timeLeft--;
    };

    updateTimer();
    const timer = setInterval(updateTimer, 1000);
  </script>

<?php else: ?>
  <div class="text-red-600 text-center font-semibold mt-6">
    ❌ Failed to generate KHQR. Please try again.
  </div>
<?php endif; ?>
