// /var/www/html/ministore/js/generate_khqr.js
import { BakongKHQR, khqrData, IndividualInfo } from "bakong-khqr";

// Get amount from CLI arguments
const amount = parseFloat(process.argv[2]);

const optionalData = {
  currency: khqrData.currency.usd,
  amount: amount,
  billNumber: "#0001",
  mobileNumber: "855889890692",
  storeLabel: "T-Store",
  terminalLabel: "Cashier_1",
  expirationTimestamp: Date.now() + 2 * 60 * 1000,
};

const individualInfo = new IndividualInfo(
  "lim_laykuong@wing", // payee ID (email or UPI)
  "lim laykuong", // display name
  "Phnom Penh", // city
  optionalData // optional data
);

const khqr = new BakongKHQR();

try {
  const result = khqr.generateIndividual(individualInfo);
  if (result && result.data && result.data.qr) {
    console.log(result.data.qr); // output to PHP
  } else {
    console.error("❌ Invalid KHQR generated.");
    process.exit(1);
  }
} catch (e) {
  console.error("❌ Exception:", e.message);
  process.exit(1);
}
