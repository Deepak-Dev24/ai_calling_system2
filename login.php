<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Syne', sans-serif;
      background: #f0f0f0;
      color: #fff;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    /* Animated background blobs */
    .blob {
      position: absolute;
      width: 500px;
      height: 500px;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.6;
      animation: float 18s infinite ease-in-out;
    }

    .blob.blue {
      background: #00f6ff;
      top: -10%;
      right: -10%;
    }

    .blob.pink {
      background: #ff4ecd;
      bottom: -15%;
      left: -10%;
      animation-delay: -6s;
    }

    @keyframes float {
      0%,100% { transform: translate(0,0); }
      50% { transform: translate(40px,-40px); }
    }

    /* Card */
    .login-card {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 380px;
      padding: 2.5rem;
      border-radius: 18px;
      background: rgba(255,255,255,0.08);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255,255,255,0.15);
      box-shadow: 0 25px 60px rgba(0,0,0,0.6);
    }

    .login-card h2 {
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 1.8rem;
      background: linear-gradient(90deg,#00f6ff,#c77dff,#ff4ecd);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    label {
      font-size: 0.85rem;
      color: #000;
      margin-bottom: 0.4rem;
      display: block;
    }

    input {
      width: 100%;
      height: 44px;
      border-radius: 10px;
      border: 1px solid rgba(255,255,255,0.2);
      background: rgba(255,255,255,0.08);
      color: #010101;
      padding: 0 12px;
      font-size: 0.95rem;
      outline: none;
      margin-bottom: 1.2rem;
    }

    input::placeholder {
      color: #8f8383ff;
    }

    input:focus {
      border-color: #00f6ff;
      box-shadow: 0 0 20px rgba(0,246,255,0.3);
    }

    button {
      width: 100%;
      height: 46px;
      border-radius: 12px;
      border: none;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 600;
      color: #05060f;
      background: linear-gradient(90deg,#00f6ff,#c77dff,#ff4ecd);
      background-size: 200%;
      transition: 0.3s;
    }

    button:hover {
      background-position: right;
      transform: scale(1.02);
    }

    .error {
      margin-top: 1rem;
      text-align: center;
      font-size: 0.85rem;
      color: #ff6b6b;
    }

    .admin-note {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 0.75rem;
      color: #272b31ff;
    }
  </style>
</head>

<body>

  <!-- Background blobs -->
  <div class="blob blue"></div>
  <div class="blob pink"></div>

  <!-- Login Card -->
  <form class="login-card" method="POST" action="verify_login.php">

    <h2>Admin Panel Login</h2>

    <label>Username</label>
    <input type="text" name="username" placeholder="Admin username" required>

    <label>Password</label>
    <input type="password" name="password" placeholder="Admin password" required>

    <button type="submit">Sign In</button>

    <?php if (isset($_GET['error'])): ?>
      <div class="error">Invalid admin credentials</div>
    <?php endif; ?>

    <div class="admin-note">
      Authorized access only
    </div>

  </form>

</body>
</html>
