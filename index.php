<?php
// =======================
// HANDLE ORDER SUBMISSION
// =======================
if (isset($_POST['submit_order'])) {

  $name   = htmlspecialchars($_POST['name']);
  $phone  = htmlspecialchars($_POST['phone']);
  $email  = htmlspecialchars($_POST['email']);
  $date   = htmlspecialchars($_POST['date']);
  $time   = htmlspecialchars($_POST['time']);
  $product= htmlspecialchars($_POST['product']);
  $amount = htmlspecialchars($_POST['amount']);

  $to = "wenloong8@gmail.com";
  $subject = "💻 New TechStore Payment Confirmation";

  $message = "
NEW PAYMENT RECEIVED

Product: $product
Amount: RM $amount

Customer Details
----------------
Name: $name
Phone: $phone
Email: $email

Payment Date: $date
Payment Time: $time

Payment Method: Malaysia National QR
";

  $headers = "From: TechStore <no-reply@techstore.com>";

  mail($to, $subject, $message, $headers);

  $success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>TechStore | PC & Laptop Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root {
  --bg: #020617;
  --card: #0f172a;
  --text: #e5e7eb;
  --primary: #38bdf8;
  --accent: #22c55e;
}

* {
  box-sizing: border-box;
  font-family: "Segoe UI", Arial, sans-serif;
}

body {
  margin: 0;
  background: var(--bg);
  color: var(--text);
}

header {
  background: #020617;
  padding: 25px 40px;
  border-bottom: 1px solid #1e293b;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

header h1 {
  margin: 0;
  color: var(--primary);
}

header span {
  opacity: 0.8;
  font-size: 14px;
}

.hero {
  padding: 80px 30px;
  text-align: center;
  background: linear-gradient(135deg, #020617, #020617, #0f172a);
}

.hero h2 {
  font-size: 40px;
  margin-bottom: 10px;
}

.hero p {
  opacity: 0.8;
}

.products {
  max-width: 1200px;
  margin: auto;
  padding: 60px 30px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 30px;
}

.product {
  background: var(--card);
  border-radius: 14px;
  padding: 20px;
  box-shadow: 0 15px 30px rgba(0,0,0,0.4);
}

.product img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 10px;
}

.product h3 {
  margin: 15px 0 5px;
}

.price {
  color: var(--accent);
  font-size: 20px;
  font-weight: bold;
}

.product button {
  width: 100%;
  margin-top: 15px;
  background: var(--primary);
  border: none;
  padding: 12px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 15px;
}

/* PURCHASE PAGE */
.purchase {
  max-width: 480px;
  margin: 60px auto;
  background: var(--card);
  padding: 30px;
  border-radius: 14px;
}

.purchase h2 {
  text-align: center;
}

input {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border-radius: 6px;
  border: none;
}

.qr {
  width: 260px;
  display: block;
  margin: 20px auto;
}

.submit {
  background: var(--accent);
  color: #000;
  border: none;
  width: 100%;
  padding: 12px;
  border-radius: 8px;
  font-size: 16px;
}

.success {
  text-align: center;
  background: #052e16;
  padding: 20px;
  border-radius: 10px;
  margin: 40px auto;
  max-width: 500px;
}
</style>
</head>

<body>

<header>
  <h1>TechStore</h1>
  <span>Professional PC & Laptop Solutions</span>
</header>

<?php if (!isset($_GET['buy'])): ?>

<section class="hero">
  <h2>High Performance PCs & Laptops</h2>
  <p>Secure payment via Malaysia National QR</p>
</section>

<section class="products">
  <div class="product">
    <img src="https://via.placeholder.com/400x250">
    <h3>Laptop Pro</h3>
    <div class="price">RM 3999</div>
    <button onclick="location.href='?buy=Laptop Pro&price=3999'">Buy Now</button>
  </div>

  <div class="product">
    <img src="https://via.placeholder.com/400x250">
    <h3>Gaming Laptop</h3>
    <div class="price">RM 5499</div>
    <button onclick="location.href='?buy=Gaming Laptop&price=5499'">Buy Now</button>
  </div>

  <div class="product">
    <img src="https://via.placeholder.com/400x250">
    <h3>Custom Gaming PC</h3>
    <div class="price">RM 6299</div>
    <button onclick="location.href='?buy=Custom Gaming PC&price=6299'">Buy Now</button>
  </div>
</section>

<?php else: ?>

<?php if (!empty($success)): ?>
<div class="success">
  <h2>✅ Payment Submitted</h2>
  <p>Thank you. We will contact you shortly.</p>
</div>
<?php endif; ?>

<div class="purchase">
  <h2>Complete Payment</h2>

  <p><strong>Product:</strong> <?= $_GET['buy'] ?></p>
  <p><strong>Amount:</strong> RM <?= $_GET['price'] ?></p>

  <img class="qr"
    src="https://onedrive.live.com/embed?resid=1ABB0EFD8FA6BC4D!110&authkey=!AOdeu80bEdbvqLV"
    alt="QR Payment">

  <form method="POST">
    <input type="hidden" name="product" value="<?= $_GET['buy'] ?>">
    <input type="hidden" name="amount" value="<?= $_GET['price'] ?>">

    <input name="name" placeholder="Full Name" required>
    <input name="phone" placeholder="Phone Number" required>
    <input name="email" type="email" placeholder="Email Address" required>
    <input name="date" type="date" required>
    <input name="time" type="time" required>

    <button class="submit" name="submit_order">I Have Completed Payment</button>
  </form>
</div>

<?php endif; ?>

</body>
</html>
